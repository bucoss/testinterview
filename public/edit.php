<?php
require '../includes/header.php';
require '../config/database.php';

$header = 'Edit Page';

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

$name = $product['name'];
$description = $product['description'];
$price = $product['price'];
$image = $product['image'];
$availability_date = $product['availability_date'];
$in_stock = $product['in_stock'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $price = trim($_POST["price"]);
    $image = trim($_POST["image"]);
    $availability_date = trim($_POST["availability_date"]);
    $in_stock = isset($_POST["in_stock"]) ? 1 : 0;

    $errors = [];
    if (empty($name)) {
        $errors[] = "Product name is required.";
    }
    if (empty($price) || !is_numeric($price)) {
        $errors[] = "Valid price is required.";
    }
    if (!empty($availability_date) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $availability_date)) {
        $errors[] = "Invalid date format (YYYY-MM-DD).";
    }

    if (empty($errors)) {
        $db->query("UPDATE products SET name = :name, description = :description, price = :price, image = :image, availability_date = :availability_date, in_stock = :in_stock WHERE id = :id", [
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "image" => $image,
            "availability_date" => $availability_date,
            "in_stock" => $in_stock,
            "id" => $id
        ]);

        header("Location: edit.php?id=$id&edited=1");
        exit();
    }
}

require '../views/edit.view.php';
