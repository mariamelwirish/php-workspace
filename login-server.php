<?php
require 'utils.php';
require "connect-to-db.php";
require "connection-credits.php";
$db = connect($DB_DATABASE, $DB_HOST, $DB_USER, $DB_PASSWORD);

$errors = [];
$old = [];

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email)) {
    $errors['email'] = 'Email field is required!';
} else {
    $old['email'] = $email;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['invalid'] = 'Invalid email format';
    }
}
if ($email == "admin@php.com" and $password == "admin") {
    session_start();
    $_SESSION['login'] = true;
    $_SESSION['name'] = 'ADMIN';
    $_SESSION['image'] = "imgs/admin.png";
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    header("Location: data.php");
    exit();
}
if (empty($password)) {
    $errors['password'] = 'Password field is required!';
}



if (count($errors) == 0) {
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        if ($password == $row['password']) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['room'] = $row['room'];
            $_SESSION['ext'] = $row['ext'];
            $_SESSION['image'] = $row['image'];
            $_SESSION['login'] = true;
            header("Location: home.php");
            exit();
        } else {
            $errors['wrongpassword'] = "Wrong password.";
        }
    } else {
        $errors['notfound'] = "This email is not associated with any account.<br>Not signed up? Sign Up <a href='signup.php'> here </a>";
    }
}
if ($errors) {
    $errors_str = json_encode($errors);
    $url = "Location: login.php?errors={$errors_str}";
    if ($old) {
        $old_str = json_encode($old);
        $url .= "&old={$old_str}";
    }
    header($url);
}

