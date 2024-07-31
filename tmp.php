<?php
/*
$user_exists = false;
$file = fopen('users', 'r');
if ($file) {
    // $line = fgets($file);
    while (($line = fgets($file)) !== false) {
        $user_data = explode(":", $line);
        // var_dump($user_data[1]);
        if ($user_data[1] === $email) {
            $user_exists = true;
            break;
        }
    }
    fclose($file);
}
if ($user_exists) {
    // echo "hi";
    $errors['exists'] = "This email is already associated to an account. <a href='login.php'> Login? </a>";
}

$data = $name . ":" . $email . ":" . $password . ":" . $room . ":" . $ext . ":" . "imgs/{$image_name}" . "\n";
append('users', $data);
