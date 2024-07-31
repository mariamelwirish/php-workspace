<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    if ($_SESSION['email'] == "admin@php.com") {
        header("location:data.php");
    } else {
        header("location:home.php");
    }
    exit();
} else {
    session_destroy();
}
if (isset($_GET['errors'])) { #get it from the url.
    $errors = json_decode($_GET['errors'], true);
    if (isset($_GET['old'])) {
        $old = json_decode($_GET['old'], true);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-style.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="buttons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <title> PHP Workspace - Login </title>
</head>

<body>

    <header>
        <nav>
            <ul>
                <li> <a href="signup.php" class="signup"> SIGN UP </a> </li>
                <li> <a href="login.php"> LOGIN </a> </li>

            </ul>
        </nav>
    </header>
    <div class="bg"> </div>
    <h1> WELCOME TO PHP WORKSPACE </h1>



    <form action="login-server.php" method="post">
        <h2> LOGIN </h2>

        <div class="container">
            <div class="email-container">
                <label for="email"> Email </label>
                <input type="text" name="email" id="email" class="email" placeholder="Enter Your Name Here" value="<?php if (isset($old['email'])) {
                    echo $old['email'];
                } ?>" />
                <p> <?php if (isset($errors['email'])) {
                    echo $errors['email'];
                } else if (isset($errors['invalid'])) {
                    echo $errors['invalid'];
                } else if (isset($errors['notfound'])) {
                    echo $errors['notfound'];
                } ?> </p>
            </div>
            <div class="password-container">
                <label for="password"> Password </label>
                <input type="password" name="password" id="password" class="password"
                    placeholder="Enter Your Password Here" />
                <p> <?php if (isset($errors['password'])) {
                    echo $errors['password'];
                } else if (isset($errors['wrongpassword'])) {
                    echo $errors['wrongpassword'];
                }
                ;
                ?> </p>
            </div>
            <a href="signup.php" class="noacc"> Don't have an account? </a>

        </div>
        <div class="buttons-container">
            <input type="submit" class="submit" />
            <input type="reset" class="reset" />
        </div>

    </form>

</body>

</html>