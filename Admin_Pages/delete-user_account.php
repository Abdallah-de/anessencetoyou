<?php
session_start();
include '../db_config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM user_accounts WHERE id=$id";
    $connect->query($sql);
}

header('location:crud-user_accounts.php');
?>
