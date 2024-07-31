<?php
function connect($DB_DATABASE, $DB_HOST, $DB_USER, $DB_PASSWORD)
{
    $dsn = "mysql:dbname=$DB_DATABASE;host=$DB_HOST;port=3306;";
    try {
        $db = new PDO($dsn, $DB_USER, $DB_PASSWORD);
        return $db;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return false;
    }
}

function selectAll($db, $table)
{
    try {
        #selecting table
        $select = "select * from `{$table}`;";
        $selected = $db->query($select);

        #fetching rows as associative array 
        $rows = $selected->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        return false;
    }
}

function deleteAll($db, $table)
{
    $delete = "DELETE FROM {$table};";
    $deleted = $db->query($delete);
    $reset_id = "ALTER TABLE {$table} AUTO_INCREMENT = 1";
    $db->query($reset_id);
    if ($deleted->fetchAll(PDO::FETCH_ASSOC)) {
        return false;
    }
    return true;
}
function displayDBAsTable($rows)
{
    echo '<pre>';
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>';
    echo "<link rel='stylesheet' href='data.css'>";
    echo "<h3> USERS DATA </h3>";
    $table = '<table class="table">  <tr> <th>ID</th> <th>Name</th> <th>Email</th> <th>Password</th> <th>Room No.</th> <th>Extension</th> <th>Image</th><th>Delete</th><th> Edit </th>  </tr>'; //<th> Show</th> 
    foreach ($rows as $row) {
        $table .= "<tr> <td> {$row['id']}</td>
        <td> {$row['name']}</td>
        <td> {$row['email']}</td>
        <td> {$row['password']}</td>
        <td> {$row['room']}</td>
        <td> {$row['ext']}</td>
        <td> <img src='{$row['image']}' height='50' width='50'> </td>
        <td> <a href='delete-user.php?email={$row['email']}' class='btn btn-danger'> Delete</a></td>
        <td> <a href='edit-user.php?email={$row['email']}' class='btn btn-warning'> Edit</a></td>
        </tr>";
        // <td> <a href='' class='btn btn-info'> Show</a></td>

    }
    $table .= "</table>";

    echo $table;

    echo "<div class='buttons'>
    <a href='signup.php' class='btn btn-success' style='margin-left:10px;font-weight:bold;'>Add New User</a>
    <a href='delete-all.php' class='btn btn-danger' style='margin-left:10px;font-weight:bold;'>Delete All Users</a>
    <a href='admin-home.php' class='btn btn-primary' style='margin-left:10px;font-weight:bold;'>Home</a>
    <a href='logout-server.php' class='btn btn-secondary' style='margin-left:10px;font-weight:bold;'>Logout</a>
</div>" . '</pre>';
    // echo 
}

function insertToDB($db, $table, $values)
{
    try {
        $inst_query = "INSERT INTO $table (name, email, password, room, ext, image) VALUES (:n, :e, :p, :r, :ex, :i);";
        $inst_stmt = $db->prepare($inst_query);

        $inst_stmt->bindParam(':n', $values["name"]);
        $inst_stmt->bindParam(':e', $values["email"]);
        $inst_stmt->bindParam(':p', $values["password"]);
        $inst_stmt->bindParam(':r', $values["room"]);
        $inst_stmt->bindParam(':ex', $values["ext"]);
        $inst_stmt->bindParam(':i', $values["image"]);
        $inst_stmt->execute();
        return true;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}


