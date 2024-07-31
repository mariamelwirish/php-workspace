<?php
require 'connect-to-db.php';
require 'connection-credits.php';

$db = connect($DB_DATABASE, $DB_HOST, $DB_USER, $DB_PASSWORD);


deleteAll($db, 'users');
header("location:data.php");