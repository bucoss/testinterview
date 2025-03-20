<?php
require '../helpers/functions.php';
require '../config/database.php';

$config = require "../config/config.php";
$db = new Database($config['database']);

$header = "Home Page";

$perPage = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
if (!in_array($perPage, [5, 10, 15, 20])) {
    $perPage = 10; // Dacă valoarea nu e validă, resetăm la 10
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$offset = ($page - 1) * $perPage;

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

$query = "SELECT * FROM products WHERE 1";
$params = [];

if (!empty($search)) {
    $query .= " AND name LIKE :search";
    $params['search'] = "%$search%";
}

switch ($sort) {
    case 'name_asc':
        $query .= " ORDER BY name ASC";
        break;
    case 'name_desc':
        $query .= " ORDER BY name DESC";
        break;
    case 'price_asc':
        $query .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $query .= " ORDER BY price DESC";
        break;
    default:
        $query .= " ORDER BY id ASC";
        break;
}

$query .= " LIMIT $perPage OFFSET $offset";

$products = $db->query($query, $params)->get();

$totalProductsQuery = "SELECT COUNT(*) as count FROM products WHERE 1";

if (!empty($search)) {
    $totalProductsQuery .= " AND name LIKE :search";
}

$totalProducts = $db->query($totalProductsQuery, $params)->find()['count'];

$totalPages = ceil($totalProducts / $perPage);

require '../views/index.view.php';
