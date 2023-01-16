<?php

error_reporting(E_ALL);
ini_set('display_error', 1);

// Headers

Header('Access-Control-Allow-Origin: localhost');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: POST');

// Including required files.
include_once('../../config/Database.php');
include_once('../../models/Products.php');

// Connecting with database.

$database = new Database;
$db =  $database->connect();

$product = new Product($db);

if(count($_POST)){

    // Creating new products from user input.
    $params = [
        'product_ref' => $_POST['product_ref'],
        'product_name' => $_POST['product_name'],
        'product_img' => $_POST['product_img'],
        'product_category' => $_POST['product_category'],
        'product_price' => $_POST['product_price'],
        'product_discount' => $_POST['product_discount'],
    ];

    if($product->create_new_products($params))
    {
        echo json_encode(['message' => 'Products added successfully']);
    }
}