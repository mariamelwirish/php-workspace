<?php
require 'connect-to-db.php';
require 'connection-credits.php';
$db = connect($DB_DATABASE, $DB_HOST, $DB_USER, $DB_PASSWORD);

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    if ($db) {
        try {
            $selected_query = "SELECT * FROM users WHERE email=:email";
            $stmt = $db->prepare($selected_query);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
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
    <title> PHP Workspace - Edit </title>
    <style>
        .buttons-container {
            margin-top: 15px;
        }

        .submit {
            margin-right: 0px;
            width: 18%;
            text-align: center;
        }
    </style>
</head>

<body>

    <header>
        <nav>
            <ul>
                <li> <a href="login.php"> LOGIN </a> </li>
                <li> <a href="signup.php" class="signup"> SIGN UP </a> </li>
            </ul>
        </nav>
    </header>
    <div class="bg"> </div>
    <h1> WELCOME TO PHP WORKSPACE </h1>



    <form action="edit.php" method="post" enctype="multipart/form-data">
        <h2> SIGN UP </h2>

        <div class="container">
            <div class="name-container">
                <label for="name"> Name </label>
                <input type="text" name="name" id="name" class="name" placeholder="Enter Your Name Here"
                    value="<?php echo $row['name'] ?>" />
                <p> <?php if (isset($errors['name'])) {
                    echo $errors['name'];
                } ?> </p>
            </div>
            <div>
                <label for="email"> Email </label>
                <input type="text" name="email" id="email" class="email" placeholder="Enter Your Email Here"
                    value="<?php echo $row['email'] ?>" readonly />
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
                    placeholder="Enter Your Password Here" value="<?php echo $row['password'] ?>" />
                <p> <?php if (isset($errors['password'])) {
                    echo $errors['password'];
                } else if (isset($errors['passlen'])) {
                    echo $errors['passlen'];
                } ?> </p>

            </div>
            <div>
                <label for="room"> Room No. </label>
                <input type="number" name="room" id="room" class="room" placeholder="Enter Room Number Here"
                    value="<?php echo $row['room'] ?>" />
                <!-- <p> <?php if (isset($errors['room'])) {
                    echo $errors['room'];
                } ?> </p> -->
            </div>
            <div>
                <label for="ext"> Extension </label>
                <input type="number" name="ext" id="ext" class="ext" placeholder="Enter Your Extension Here"
                    value="<?php echo $row['ext'] ?>" />
                <!-- <p> <?php if (isset($errors['ext'])) {
                    echo $errors['ext'];
                } ?> </p> -->
            </div>
            <div class="buttons-container">
                <input type="submit" class="submit" value="EDIT" />
            </div>
    </form>
    <div class="footer"> </div>

</body>

</html>