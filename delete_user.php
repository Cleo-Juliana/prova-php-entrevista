<?php

require 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $connection = new Connection();
    $connection->execute("DELETE FROM users WHERE id = ?", [$id]);

    header("Location: index.php");
    exit();
}
