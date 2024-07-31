<?php
require 'connect-to-db.php';
require 'connection-credits.php';
$db = connect($DB_DATABASE, $DB_HOST, $DB_USER, $DB_PASSWORD);

$email = $_POST['email'];
$name = $_POST['name'];
$password = $_POST['password'];
$ext = $_POST['ext'];
$room = $_POST['room'];

var_dump($_POST);

try {
    // $update_query = "UPDATE `users` SET `name`='ahmedjkdsh'WHERE `email`='qweqw';";
    // $db->query($update_query);

    // $db->query($update_query);

    // $update_query = "UPDATE `users` SET `name`=:name WHERE `email`='qweqw';";

    $update_query = "UPDATE users SET `name` = :name, `password`=:password, `room`=:room, `ext`=:ext WHERE `email`= :email";
    $update_stmt = $db->prepare($update_query);
    $update_stmt->bindParam(':email', $email);
    $update_stmt->bindParam(':name', $name);
    $update_stmt->bindParam(':password', $password);
    $update_stmt->bindParam(':room', $room);
    $update_stmt->bindParam(':ext', $ext);
    $update_stmt->execute();
    header("Location: data.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>