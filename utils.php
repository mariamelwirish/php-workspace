<?php
function append($filename, $line)
{
    $fileobj = fopen($filename, "a");
    if ($fileobj) {
        fwrite($fileobj, $line);
        fclose($fileobj);
        return true;
    }
    return false;
}

function displayAsTable($filename)
{
    $lines = file($filename); #Converts into array of lines.
    echo "<style> 
                table,td,th {
                    border: 1px solid black;
                } 
                td,th {
                    padding: 5px;
                }
                </style>";
    $table = "<table>";
    $table .= "<tr> <th>Name</th> <th>Email</th> <th>Password</th> <th>Room</th> <th>Extension</th> </tr>";
    if ($lines) {
        foreach ($lines as $line) {
            $line = trim($line); #Removes the \n.
            $line_data = explode(":", $line); #Converts into array of values.
            $table .= "<tr>";
            foreach ($line_data as $value) {
                $table .= "<td>{$value}</td>";
            }
            $table .= "</tr>";
        }
    }
    $table .= "</table>";
    echo $table;
}

