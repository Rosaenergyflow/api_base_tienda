<?php
/**********************************************************
    DESTROY ADMIN   
    (useristradores de la tienda)
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

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));


if(isset($data))
{
     // Deleting user from user input.

    if($user->destroy_user($data->user_id))
    {
        echo json_encode(['message' => 'User Deleted successfully']);
    }
}