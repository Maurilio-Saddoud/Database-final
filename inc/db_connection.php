<?php

/**
 *  Default for localhost
 */

$servername = "127.0.0.1"; // Do not use "localhost"
// In the Real World (TM), you should not connect using the root account.
// Create a privileged account instead.
$username = "root";
// In the Real World (TM), this password would be cracked in miliseconds.
$password = "02042001";
$dbname = "ClassQuestions";


/**
 *  Update vars if on heroku
 */

// print_r($_SERVER);
if ($_SERVER['HTTP_HOST'] != "localhost") {
    $servername = "us-cdbr-east-04.cleardb.com";
    $username = "b5aaf46e003945";
    $password = "993ea034";
    $dbname = "heroku_4717abc48367a8a";
}


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn, $dbname) or die("Could not open the '$dbname'");

?>