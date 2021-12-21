<?php
// Connecting to database
$server = "localhost";
$username = "root";
$password = "";
$database = "internship";

// Creating a connection
$conn = mysqli_connect($server, $username, $password, $database);

// Checking connection
if(!$conn)
{
    die("Error". mysqli_connect_error());
}
?>