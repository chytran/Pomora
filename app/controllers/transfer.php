<?php

Class Transfer extends Controller
{
    function index()
    {
        $DB = new Database();
        $data = $DB->read("SELECT * FROM USERS"); // data holds everything from query
        $data['title_page'] = 'Pomoro - About';
        
        $this->view("accountFundTrans", $data);
    }

}