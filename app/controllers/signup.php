<?php

Class Signup extends Controller
{
    function index()
    {
        $data['title_page'] = 'Pomoro - Signup';
        
        if(isset($_POST['email']))
        {
            if(is_array($_POST)) {
                var_dump($_POST);
                print_r("I am an array");
            }
            $user = $this->loadModel("user");
            $user->signup($_POST);
            
            
        } else if(isset($_POST['username']) && !isset($_POST['email'])) {
            $user = $this->loadModel("user");
            $user->login($_POST);
        }

        $this->view("signup", $data);
    }
}