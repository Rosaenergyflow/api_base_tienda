<?php
/**********************************************************
    INSERT ADMIN O ADMINS  
    (administradores de la tienda)
***********************************************************/
error_reporting(E_ALL);
ini_set('display_error', 1);

// Headers

Header('Access-Control-Allow-Origin: localhost');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: POST');

// Including required files.
include_once('../../config/Database.php');
include_once('../../models/Products.php');

// Connecting with database.s

$database = new Database;
$db =  $database->connect();

$producto = new Products($db);
$data = json_decode(file_get_contents("php://input"));

if(count($_POST)){
    

    // Creating new producto from user input.

    $params = [
        'user_id' => $_POST['user_id'],
        'user_email' => $_POST['user_email'],
        'user_name' => $_POST['user_name'],
        'user_password' => $_POST['user_password'],
        'user_bank_account' => $_POST['user_bank_account'],
    ];

    if($producto->create_new_product($params))
    {
        echo json_encode(['message' => 'Products added successfully']);
    }
}
else if(isset($data))
{
     // Creating new producto from user input.

     $params = [
        'user_id'=> $data -> user_id,
        'user_email'=> $data -> user_email,
        'user_name'=> $data -> user_name,
        'user_password'=> $data -> user_password,
        'user_bank_account'=> $data -> user_bank_account,
    ];

    if($producto->create_new_product($params))
    {
        echo json_encode(['message' => 'Product added successfully']);
    }
}