<?php
require 'utils.php';
require "connect-to-db.php";
require "connection-credits.php";
$db = connect($DB_DATABASE, $DB_HOST, $DB_USER, $DB_PASSWORD);

$errors = [];
$old = [];

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$room = $_POST['room'];
$ext = $_POST['ext'];
$image = $_FILES['image'];
$image_name = $_FILES['image']['name'];
$image_path = $_FILES['image']['tmp_name'];
$image_info = pathinfo($image_name);
$image_extension = $image_info['extension'];

if (empty($name)) {
    $errors['name'] = 'Name field is required!';
} else {
    $old['name'] = $name;
}
if (empty($email)) {
    $errors['email'] = 'Email field is required!';
} else {
    $old['email'] = $email;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['invalid'] = 'Invalid email format';
    }
}
if (empty($password)) {
    $errors['password'] = 'Password field is required!';
}
if (strlen($password) < 8 and !empty($password)) {
    $errors['passlen'] = 'Password length must be more than 8 characters.';
}
if ($password != $cpassword) {
    $errors['cpassword'] = 'Passwords must match! Please re-check your password.';
}
if (empty($room)) {
    $errors['room'] = 'Room field is required!';
} else {
    $old['room'] = $room;
}
if (empty($ext)) {
    $errors['ext'] = 'Extension field is required!';
} else {
    $old['ext'] = $ext;
}
if (empty($image_path)) {
    $errors['image'] = 'Profile Image is required!';
}
if (!in_array($image_extension, ['jpg', 'png', 'jpeg', 'gif'])) {
    $errors['extension'] = 'Only jpg, png, jpeg, and gif are allowed';
}
$stmt = $db->prepare("SELECT email FROM users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$user_exists = false;
if ($stmt->fetch(PDO::FETCH_ASSOC)) {
    $errors['exists'] = "This email is already associated with an account. <a href='login.php'> Login? </a>";
    $user_exists = true;
}

if (count($errors) == 0) {
    move_uploaded_file($image_path, "imgs/{$image_name}");
    $arr = ["email" => $email, "name" => $name, "password" => $password, "room" => $room, "ext" => $ext, "image" => "imgs/{$image_name}"];
    header("Location: data.php");
    insertToDB($db, 'users', $arr);
    session_start();
    if (isset($_SESSION['login']) && $_SESSION['login'] === true && $_SESSION['email'] === "admin@php.com")
        header("Location: data.php");
    else
        header("Location: login.php");

} else {
    $errors_str = json_encode($errors);
    $url = "Location: signup.php?errors={$errors_str}";
    if ($old) {
        $old_str = json_encode($old);
        $url .= "&old={$old_str}";
    }
    header($url);
}

