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

$data = $products->readProducts();

// If there is products in database.

if($data->rowCount())
{
    $products = [];

    // re-aggrange the products data.

    while($row = $data->fetch(PDO::FETCH_OBJ))
    {
        $products[$row->product_id] = [
            'product_id' => $row -> product_id,
            'product_ref' => $row -> product_ref,
            'product_name' => $row -> product_name,
            'product_img' => $row -> product_img,
            'product_category' => $row -> product_category,
            'product_price' => $row -> product_price,
            'product_discount' => $row -> product_discount
        ];
    }

    echo json_encode($products);


}
else
{
    echo json_encode(['message' => ' No products found']);
}