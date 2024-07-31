<?php
require 'connect-to-db.php';
require 'connection-credits.php';

$db = connect($DB_DATABASE, $DB_HOST, $DB_USER, $DB_PASSWORD);


if (isset($_GET['email'])) {
    $email = $_GET['email'];
    try {
        $delete_query = "DELETE FROM users WHERE email = :email";
        $stmt = $db->prepare($delete_query);
        $stmt->bindParam(':email', $email);
        $deleted = $stmt->execute();
        if ($stmt->rowCount()) {
            echo "Record deleted successfully";
            header("Location: data.php");
        } else {
            echo "No record found with that email";
        }
    } catch (PDOException $e) {
        echo "Error while deleting record: " . $e->getMessage();
    }
} else {
    echo "Email is missing.";
}