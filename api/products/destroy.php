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

$products = new Product($db);

if(isset($_GET['product_id']))
{
     // Deleting products from user input.
    if($products->destroy_product($_GET['product_id']))
    {
        echo json_encode(['message' => 'Products Deleted successfully']);
    }
}