<?php


session_start();

require "connect-to-db.php";
require "connection-credits.php";
$db = connect($DB_DATABASE, $DB_HOST, $DB_USER, $DB_PASSWORD);

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    if ($_SESSION['email'] != 'admin@php.com') {
        header('location:home.php');
    }
} else {
    header('Location: login.php');
    session_destroy();
}



#selecting all
$rows = selectAll($db, "users");

#displaying as table
displayDBAsTable($rows);
