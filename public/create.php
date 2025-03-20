<?php
$header = 'Add Product';

require '../includes/header.php';
require '../config/database.php';

$config = require "../config/config.php";
$db = new Database($config['database']);

$errors = [];
$name = $description = $price = $image = $availability_date = "";
$in_stock = 1;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $price = trim($_POST["price"]);
    $image = trim($_POST["image"]);
    $availability_date = trim($_POST["availability_date"]);
    $in_stock = isset($_POST["in_stock"]) ? 1 : 0;

    if (empty($name)) {
        $errors[] = "Product name is required.";
    }

    if (empty($price) || !is_numeric($price)) {
        $errors[] = "Valid price is required.";
    } elseif ($price > 99999999.99) {
        $errors[] = "Price is too large. Maximum allowed is 99,999,999.99.";
    }

    if (!empty($availability_date) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $availability_date)) {
        $errors[] = "Invalid date format (YYYY-MM-DD).";
    }

    if (empty($errors)) {
        try {
            $db->query("INSERT INTO products (name, description, price, image, availability_date, in_stock) 
                    VALUES (:name, :description, :price, :image, :availability_date, :in_stock)", [
                "name" => $name,
                "description" => $description,
                "price" => $price,
                "image" => $image,
                "availability_date" => $availability_date,
                "in_stock" => $in_stock
            ]);

            header("Location: create.php?success=1");
            exit();
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }

}
require '../views/create.view.php';