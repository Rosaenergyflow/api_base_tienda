<?php
/////////////////////////////////////////////////////////
//////////////  MODELO PARA TABLA USERS  ////////////////
/////////////////////////////////////////////////////////

error_reporting(E_ALL);
ini_set('display_error', 1);

class User
{

    // User Properties.
    public $user_id;
    public $user_email;
    public $user_name;
    public $user_password;
    public $user_bank_account;


    // Database Data.

    private $connection;
    private $table = 'users';

    public function __construct($db)
    {
        $this->connection = $db;
    }

    // Method to read all the saved users from database.

    public function readUsers()
    {
        //Query for reading users from table.

        $query = 'SELECT * FROM ' . $this->table;

        $user = $this->connection->prepare($query);

        $user->execute();

        return $user;
    }

    // Method for reading single admin.

    public function read_single_user($user_id)
    {
        $this->user_id = $user_id;

        //Query for reading users from table.

        $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $user_id . ' = user_id';

        $user = $this->connection->prepare($query);

        //$user->execute([$this -> user_id]);
        $user->bindValue(1, $this->user_id, PDO::PARAM_INT);
        $user->execute();
        return $user;
    }

    // Method to create new records.

    public function create_new_user($params)
    {
        try
        {
            // Assigning values.
            $this->user_id = $params['user_id'];
            $this->user_name = $params['user_name'];
            $this->user_email = $params['user_email'];
            $this->user_rol = $params['user_rol'];
            $this->user_password = $params['user_password'];
            $this->user_bank_account = $params['user_bank_account'];

            

            // Query to store new admin in database.

            $query = 'INSERT INTO ' . $this->table . '
                    SET
                    user_id = :user_id,
                    user_name = :user_name,
                    user_email = :user_email,
                    user_rol = :user_rol,
                    user_password = :user_password,
                    user_bank_account = :user_bank_account';

            $user = $this->connection->prepare($query);

            $user->binValue('user_id', $this->user_id);
            $user->binValue('user_name', $this->user_name);
            $user->binValue('user_email', $this->user_email);
            $user->binValue('user_rol', $this->user_rol);
            $user->binValue('user_password', $this->user_password);
            $user->binValue('user_bank_account', $this->user_bank_account);

            // Query for updating existing record.

            $query = 'UPDATE ' . $this->table . '
              SET
              user_id = :user_id,
              user_name = :user_name,
              user_email = :user_email,
              user_rol = :user_rol,
              user_password = :user_password,
              user_bank_account = :user_bank_account';

            $user = $this->connection->prepare($query);

            $user->binValue('user_id', $this->user_id);
            $user->binValue('user_name', $this->user_name);
            $user->binValue('user_email', $this->user_email);
            $user->binValue('user_rol', $this->user_rol);
            $user->binValue('user_password', $this->user_password);
            $user->binValue('user_bank_account', $this->user_bank_account);

            if ($user->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Method to delete admin from database.

    public function destroy_user($user_id)
    {
        try
        {
            // Assigning values.

            $this->user_id = $user_id;

            // Query for updating existing record.

            $query = 'DELETE FROM ' . $this->table . '
                   WHERE user_id = :user_id';

            $user = $this->connection->prepare($query);

            $user->bindValue('user_id', $this->user_id);

            if ($user->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
