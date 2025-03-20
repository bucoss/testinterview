<?php
require '../config/database.php';

$config = require "../config/config.php";
$db = new Database($config['database']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid product ID.");
}

$id = (int)$_GET['id'];

$product = $db->query("SELECT * FROM products WHERE id = :id", ["id" => $id])->find();

if (!$product) {
    die("Product not found.");
}

if (isset($_POST['confirm_delete'])) {
    $db->query("DELETE FROM products WHERE id = :id", ["id" => $id]);

    header("Location: index.php?deleted=1");
    exit();
}

require '../views/delete.view.php';
