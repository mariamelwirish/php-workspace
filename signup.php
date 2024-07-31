<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] === true && $_SESSION['email'] !== "admin@php.com") {
    header("location:home.php");
    exit();
} else if (isset($_SESSION['login']) && $_SESSION['login'] === true && $_SESSION['email'] !== "admin@php.com") {
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
    <link rel="stylesheet" href="signup-style.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="buttons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <title> PHP Workspace - Sign Up </title>
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



    <form action="signup-server" method="post" enctype="multipart/form-data">
        <h2> SIGN UP </h2>

        <div class="container">
            <div class="name-container">
                <label for="name"> Name </label>
                <input type="text" name="name" id="name" class="name" placeholder="Enter Your Name Here" value="<?php if (isset($old['name'])) {
                    echo $old['name'];
                } ?>" />
                <p> <?php if (isset($errors['name'])) {
                    echo $errors['name'];
                } ?> </p>
            </div>
            <div>
                <label for="email"> Email </label>
                <input type="text" name="email" id="email" class="email" placeholder="Enter Your Email Here" value="<?php if (isset($old['email'])) {
                    echo $old['email'];
                } ?>" />
                <p> <?php if (isset($errors['email'])) {
                    echo $errors['email'];
                } else if (isset($errors['invalid'])) {
                    echo $errors['invalid'];
                } else if (isset($errors['exists'])) {
                    echo $errors['exists'];
                }
                ?> </p>
            </div>
            <div>
                <label for="password"> Password </label>
                <input type="password" name="password" id="password" class="password"
                    placeholder="Enter Your Password Here" />
                <p> <?php if (isset($errors['password'])) {
                    echo $errors['password'];
                } else if (isset($errors['passlen'])) {
                    echo $errors['passlen'];
                } ?> </p>

            </div>
            <div>
                <label for="cpassword"> Confirm Password </label>
                <input type="password" name="cpassword" id="cpassword" class="cpassword"
                    placeholder="Re-enter Your Password Here" />
                <p> <?php if (isset($errors['cpassword'])) {
                    echo $errors['cpassword'];
                } ?> </p>
            </div>
            <div>
                <label for="room"> Room No. </label>
                <input type="number" name="room" id="room" class="room" placeholder="Enter Room Number Here" value="<?php if (isset($old['room'])) {
                    echo $old['room'];
                } ?>" />
                <!-- <p> <?php if (isset($errors['room'])) {
                    echo $errors['room'];
                } ?> </p> -->
            </div>
            <div>
                <label for="ext"> Extension </label>
                <input type="number" name="ext" id="ext" class="ext" placeholder="Enter Your Extension Here" value="<?php if (isset($old['ext'])) {
                    echo $old['ext'];
                } ?>" />
                <!-- <p> <?php if (isset($errors['ext'])) {
                    echo $errors['ext'];
                } ?> </p> -->
            </div>
            <div class="pp">
                <label for="image-button" class="ppt"> Profile Picture </label>
                <!-- <label for="image" class="image-button">
                    Upload Photo
                </label> -->
                <input type="file" id="image" class="image" name="image" placeholder="Upload Here" />

            </div>
            <p class="img-error"> <?php if (isset($errors['image'])) {
                echo $errors['image'];
            } else if (isset($errors['extension'])) {
                echo $errors['extension'];
            }
            ?> </p>
        </div>
        <a href="login.php" class="already"> Already have an account? </a>
        <div class="buttons-container">
            <input type="submit" class="submit" value="SUBMIT" />
            <input type="reset" class="reset" value="RESET" />
        </div>
    </form>
    <div class="footer"> </div>

</body>

</html>