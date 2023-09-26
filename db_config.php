<?php
$servername = "localhost";
$username = "if0_35104433";
$password = "BGeHk0HgU8u";
$dbname = "if0_35104433_anessencetoyou";


$connect = new mysqli($servername, $username, $password, $dbname);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>
