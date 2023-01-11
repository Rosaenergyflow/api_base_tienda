<?php
/**********************************************************
    MOSTRAR USERS
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

$data = $user->readUsers();

// If there is users in database.

if($data->rowCount())
{
    $users = [];

    // re-aggrange the users data.

    while($row = $data->fetch(PDO::FETCH_OBJ))
    {
        $users[$row->id] = [
            'user_id' => $row -> user_id,
            'user_email' => $row -> user_email,
            'user_name' => $row -> user_name,
            'user_password' => $row -> user_password,
            'user_bank_account' => $row -> user_bank_account,
        ];
    }

    echo json_encode($users);

}
else
{
    echo json_encode(['message' => ' No users found']);
}