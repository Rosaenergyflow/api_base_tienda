<?php

error_reporting(E_ALL);
ini_set('display_error', 1);

// Headers

Header('Access-Control-Allow-Origin: *');
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
    
    while($row = $data->fetchAll(PDO::FETCH_ASSOC))
    {
        foreach($row as $product) {
 
            array_push($products, [
                'product_id' => $product['product_id'],
                'product_ref' => $product['product_ref'],
                'product_name' => $product['product_name'],
                'product_img' => $product['product_img'],
                'product_category' => $product['product_category'],
                'product_price' => $product['product_price'],
                'product_discount' => $product['product_discount']
            ]);
        }
    }
    
    echo json_encode($products);

}
else
{
    echo json_encode(['message' => ' No products found']);
}