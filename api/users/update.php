<?php
/**********************************************************
    UPDATE ADMIN   
***********************************************************/
error_reporting(E_ALL);
ini_set('display_error', 1);

// Headers

Header('Access-Control-Allow-Origin: localhost');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: POST');

// Including required files.
include_once('../../config/Database.php');
include_once('../../models/Users.php');

// Connecting with database.

$database = new Database;
$db =  $database->connect();

$post = new User($db);
$data = json_decode(file_get_contents("php://input"));


if(isset($data))
{
     // Updating post from user input.

    $params = [
        'user_id' => $row -> id,
        'user_email'=> $row -> user_email,
        'user_name'=> $row -> user_name,
        'user_rol'=> $row -> user_rol,
        'user_password'=> $row -> user_password,
        'user_bank_account'=> $row -> user_bank_account
    ];

    if($post->update($params))
    {
        echo json_encode(['message' => 'User Updated successfully']);
    }

}