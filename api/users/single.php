<?php
/**********************************************************
    SINGLE ADMIN   
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

if(isset($_GET['user_id']))
{
    $data =  $post->read_single_user($_GET['user_id']);
    
    if($data->rowCount())
    {
        $user = [];

        // re-aggrange the user data.
    
        while($row = $data->fetch(PDO::FETCH_OBJ))
        {
            $user[$row->user_id] = [
                'user_id' => $row -> user_id,
                'user_email'=> $row -> user_email,
                'user_name'=> $row -> user_name,
                'user_rol'=> $row -> user_rol,
                'user_password'=> $row -> user_password,
                'user_bank_account'=> $row -> user_bank_account
            ];
        }
    
        echo json_encode($user);
    }
    else
    {
        echo json_encode(['message' => ' No user data found']);
    }
}