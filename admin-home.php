<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    session_destroy();
    header("location: login.php");
    exit();
}


$image = isset($_SESSION['image']) ? htmlspecialchars($_SESSION['image']) : 'NONE';
$name = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Guest';
$room = isset($_SESSION['room']) ? htmlspecialchars($_SESSION['room']) : 'NONE';
$ext = isset($_SESSION['ext']) ? htmlspecialchars($_SESSION['ext']) : 'NONE';
$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'NONE';
$password = isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : 'NONE';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="home-style.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
    <header>
        <nav>
            <ul>
                <li> <a href="admin-home.php"> HOME </a> </li>
                <li> <a href="data.php"> DATA </a> </li>
                <li> <a href="logout-server.php" class="signup"> LOGOUT </a> </li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="avatar-flip">
            <img src="<?php echo $image; ?>" height="150" width="150">
        </div>
        <h2><?php echo $name; ?></h2>
        <h4>Room No. <?php echo $room; ?> | Ext:<?php echo $ext; ?></h4>
        <p> Email: <?php echo $email; ?> <br> Password: <?php echo $password; ?> </p>
        <a href="logout-server.php" class='btn btn-danger' style='margin-left:10px;font-weight:bold;'> Log out </a>
        <a href="data.php" class='btn btn-success' style='margin-left:10px;font-weight:bold;'> Data </a>
    </div>
</body>

</html>