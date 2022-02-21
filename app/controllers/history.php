<?php

Class History extends Controller
{
    function index()
    {

        $DB = new Database();
        //$data = $DB->read("SELECT * FROM USERS"); // data holds everything from query
        $data['title_page'] = 'Pomoro - About';

        if(isset($_SESSION['user_name']))
         {
            $history = $this->loadModel("historyModel");
            $historyLoad = new HistoryModel;
            $historyLoad->history($_POST);
            $historyRows = $historyLoad->history();
            $data['history'] = $historyRows;
        }

        $this->view("accounthistory", $data);
    }

}