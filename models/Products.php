<?php

/********************************************************
    MODELO PARA TABLA PRODUCTS        
*********************************************************/



error_reporting(E_ALL);
ini_set('display_error', 1);


class Product{
    
    // Product Properties.
    public $product_id;  
    public $product_ref;  
    public $product_name;  
    public $product_img;  
    public $product_category;  
    public $product_price;  
    public $product_discount;  

    // Database Data.

    private $connection;
    private $table = 'products';

    public function __construct($db)
    {
        $this -> connection = $db;
    }


    // Method to read all the saved products from database.
    public function readProducts()
    {
        //Query for reading products from table.
        
        $query = 'SELECT * FROM '.$this -> table ;

        $products = $this -> connection->prepare($query);

        $products->execute();

        return $products;
    }


    // Method for reading single products.

    public function read_single_product($product_id)
    {
        $this -> product_id = $product_id;

        //Query for reading products from table.
        
        $query = 'SELECT * FROM '.$this -> table.' WHERE '.$product_id.' = product_id';

        $products = $this -> connection->prepare($query);

        $products->execute();
        return $products;
    }

    // Method to create new records.

    public function create_new_products($params)
    {
        try
        {
            // Query to store new products in database.
            $products  = $this -> connection->prepare( 'INSERT INTO '. $this -> table .'(
                                                            product_ref, 
                                                            product_name, 
                                                            product_img, 
                                                            product_category, 
                                                            product_price, 
                                                            product_discount
                                                        ) 
                                                        VALUES (
                                                            :product_ref, 
                                                            :product_name, 
                                                            :product_img, 
                                                            :product_category, 
                                                            :product_price, 
                                                            :product_discount
                                                            )'
                                                    );

            $products->bindParam(':product_ref' ,  $product_ref);
            $products->bindParam(':product_name' ,  $product_name);
            $products->bindParam(':product_img' ,  $product_img);
            $products->bindParam(':product_category' ,  $product_category);
            $products->bindParam(':product_price' ,  $product_price);
            $products->bindParam(':product_discount' ,  $product_discount);
            
            // Assigning values.
            $product_ref = $params['product_ref'];
            $product_name = $params['product_name'];
            $product_img = $params['product_img'];
            $product_category = $params['product_category'];
            $product_price = $params['product_price'];
            $product_discount = $params['product_discount'];

            if($products->execute())
            {
                return true;
            }

            return false;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    // Method for updating products.

    public function update($params)
    {
                                                        
        try
        {
            
            // Query to store new products in database.
            $products  = $this -> connection->prepare( 'UPDATE '. $this -> table .'
                                                        SET
                                                        product_ref = :product_ref, 
                                                        product_name = :product_name, 
                                                        product_img = :product_img, 
                                                        product_category = :product_category, 
                                                        product_price = :product_price, 
                                                        product_discount = :product_discount
                                                        WHERE product_id = :product_id'
                                                     );
            $products->bindParam(':product_id' ,  $params['product_id']);
            $products->bindParam(':product_ref' ,  $params['product_ref']);
            $products->bindParam(':product_name' ,  $params['product_name']);
            $products->bindParam(':product_img' ,  $params['product_img']);
            $products->bindParam(':product_category' , $params['product_category']);
            $products->bindParam(':product_price' , $params['product_price']);
            $products->bindParam(':product_discount' , $params['product_discount']);
          

            if($products->execute())
            {
                return true;
            }

            return false;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    // Method to delete products from database.

    public function destroy_product($product_id)
    {
        try
        {
            
            // Query to store new products in database.
            $products  = $this -> connection->prepare( 'DELETE FROM '. $this -> table .'
                                                        WHERE product_id = :product_id'
                                                     );
            $products->bindParam(':product_id',  $product_id);
           
            if($products->execute())
            {
                return true;
            }

            return false;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}