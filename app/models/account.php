<?php

Class Account
{
    function registerCard($POST) 
    {
        print_r("I am here");
        print_r("I am an array");
        $DB = new Database();

        $_SESSION['error'] = "";
        if(isset($POST['email1']))
        {
            // Array for holding exact values
            $arr['email'] = $POST['email1']; // run if value is in array and isset
            $arr['amount'] = $_POST['amount'];
            $arr['creditCard'] = $POST['creditCard'];

            $query = "INSERT INTO account (email, amount, creditCard) values (:email, :amount, :creditCard)";
            $data = $DB->write($query, $arr);
            if($data) 
            {
                header("Location:" . ROOT . "home");
                die;
            } else {
                $_SESSION['error'] = 'Please enter valid information to create an card';
            }
        }
    }
}