<?php

Class Cart
{
    /*xxxxxxxxxxxxxxx needs $POST to insert xxxxxxxxxxxxxxxx*/
    function addToCart($username, $productID) {
        $query = "INSERT INTO cart (username, productID) VALUES (" . $username . ", " . $productID . ");";
        
        $DB = new Database();
        $data = $DB->write($query);
    }
    
    function getCartItems($username) {
        $query = "SELECT * FROM cart WHERE username = " . $username .";";
        
        $DB = new Database();
        $data = $DB->read($query);
        if(is_array($data))
        {
            return $data;
        }
        return false;
    }

    function deleteFromCart($username, $productID) {
        $query = "DELETE FROM cart WHERE username = " . $username . " AND productID = " . $productID . ";";
        
        $DB = new Database();
        $data = $DB->write($query);
    }

    function emptyCart($username) {
        $query = "DELETE * FROM cart WHERE username = " . $username . ";";
        
        $DB = new Database();
        $data = $DB->write($query);
    }
}