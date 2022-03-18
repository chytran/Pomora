<?php

Class HistoryModel
{

    function history()
    {
        $DB = new Database();

        $_SESSION['error'] = "";
        if(isset($_SESSION['user_name1']))
        //if(isset($POST['username']) && isset($POST['password'])) 
        {
                // array for holding exact values
            //$arr['history'] = $POST['history']; // run if value is in array and isset
         
            

            $query = "SELECT * FROM history WHERE email = '" . $_SESSION['email'] . "'";
            $data = $DB->read($query);
            if(is_array($data)) 
            {
                // logged in
                return $data;
                // New query that is not functional as of yet. 
                // trying to create array with stored HTML tags that will display on accountHistory
                // based on rows within table that have the user's username
               /* $currentUser = ($_SESSION['user_name']);
                $query = "SELECT * FROM history WHERE username = '$currentUser'";
                $data = $DB->read($query);
                if(is_array($data)) 
                {
                    //set array
                    $array = array();

                    while($row = mysql_fetch_assoc($query))

                        $array[] = $row;

                    // logged in
                    $_SESSION['history'] = $data[0]->history;
                    $_SESSION['message'] = $data[0]->message;
                    $_SESSION['changes'] = $data[0]->changes;
                    $_SESSION['currentAmount'] = $data[0]->currentAmount;*/
      

            } else {
                //$_SESSION['history'] = 'No history found';
            }
        } else {
            $_SESSION['error'] = 'Transactions must be found in order to be displayed';
        }
        
    }

    function amountChange($POST) 
    {
        print_r("I am here");
        print_r("I am an array");
        $DB = new Database();

        $_SESSION['error'] = "";
        if(isset($POST['depositOrWithdraw']))
        {
            // list($creditCardChange, $creditCardID) = explode("_", $_POST['creditCardChange'], 2);
            
                // Array for holding exact values
                $arr['creditCardChange'] = $POST['creditCardChange']; 
                $arr['email2'] = $POST['email2'];
                $arr['amountChange'] = $POST['amountChange']; // Set account to have 0 initially
                // $arr['creditCard'] = $POST['creditCard'];

            // Query Changes based on condition
            if(($POST['depositOrWithdraw'] == 'withdraw') && ($POST['amountChange'] > 0)) {    
                // inner join with insert
                $query = "INSERT INTO historyChange (email, changes, currentAmount) 
                            SELECT  account.amount FROM account
                            INNER JOIN historyChange
                            ON historyChange.email = account.email
                            values (:email2, -:amountChange, account.amount)
                            ";
            } 
            else if(($POST['depositOrWithdraw'] == 'deposit') && ($POST['amountChange'] > 0)) {
                $query =  "INSERT INTO historyChange (email, changes, currentAmount) 
                            SELECT  account.amount FROM account
                            INNER JOIN historyChange
                            ON historyChange.email = account.email
                            values (:email2, :amountChange, account.amount)
                            ";
            } 

            // Run the conditional query
            $data = $DB->write($query, $arr);
            if($data) 
            {
                
                header("Location:" . ROOT . "account");
                die;
            } else {
                $_SESSION['error'] = 'Please enter valid information to create an card';
            }
        }
    }

// update history with deposit
    function depositFunction($POST) 
    {
        print_r("I am here");
        print_r("I am an array");
        $DB = new Database();

        $_SESSION['error'] = "";
        if(isset($POST['depositOrWithdraw']))
        {
            // Array for holding exact values
            $arr['email4'] = $_SESSION['email'];
            $arr['history2'] = date("Y-m-d H:i:s");
            $arr['message2'] = "A deposit has been made to " . $POST['transactionCard']; // run if value is in array and isset
            $arr['amount2'] = 0; // Set account to have 0 initially
            $arr['change2'] = $POST['amountChange'];

            if(($POST['depositOrWithdraw'] == 'withdraw') && ($POST['amountChange'] > 0)) {    
                // inner join with insert
                $query = "INSERT INTO history (email, history, message, currentAmount, changes) values (:email4, :history2, :message2, :amount2, -:change2)";
            } 
            else if(($POST['depositOrWithdraw'] == 'deposit') && ($POST['amountChange'] > 0)) {
                $query =  "INSERT INTO history (email, history, message, currentAmount, changes) values (:email4, :history2, :message2, :amount2, :change2)";
            }
            $data = $DB->write($query, $arr);
            if($data) 
            {
                //header("Location:" . ROOT . "account");
                //die;
            } else {
                $_SESSION['error'] = 'Please enter valid information to create an card';
            }
        }
    }

    function shoppingCartHistory($POST) 
    {
        print_r("I am here");
        print_r("I am an array");
        $DB = new Database();

        $_SESSION['error'] = "";
        if(isset($POST['email5']))
        {
            // Array for holding exact values
            $arr['email5'] = $_SESSION['email'];
            $arr['history2'] = date("Y-m-d H:i:s");
            $arr['message5'] = "Pomoro Shopping Purchase"; // run if value is in array and isset
            $arr['amount2'] = 0; // Set account to have 0 initially
            $arr['change5'] = $_SESSION['orderTotal'];

            $query =  "INSERT INTO history (email, history, message, currentAmount, changes) values (:email5, :history2, :message5, :amount2, :change5)";
            $data = $DB->write($query, $arr);
            if($data) 
            {
                //header("Location:" . ROOT . "account");
                //die;
            } else {
                $_SESSION['error'] = 'Please enter valid information to create an card';
            }
        }
    }

    function fundTransferWithdraw($POST) 
    {
        print_r("I am here");
        print_r("I am an array");
        $DB = new Database();

        $_SESSION['error'] = "";
        if(isset($POST['creditCardOne'], $POST['creditCardTwo']))
        {
            // Array for holding exact values
            $arr['email4'] = $_SESSION['email'];
            $arr['history2'] = date("Y-m-d H:i:s");
            $arr['message3'] = "Funds transfered to " . $POST['creditCardTwo'] . " card"; // run if value is in array and isset
            $arr['amount2'] = 0; // Set account to have 0 initially
            $arr['change3'] = $POST['amountChange1'];

            $query = "INSERT INTO history (email, history, message, currentAmount, changes) values (:email4, :history2, :message3, :amount2, -:change3)";
            $data = $DB->write($query, $arr);
            if($data) 
            {
                //header("Location:" . ROOT . "account");
                //die;
            } else {
                $_SESSION['error'] = 'Please enter valid information to create an card';
            }
        }
    }

    function fundTransferDeposit($POST) 
    {
        print_r("I am here");
        print_r("I am an array");
        $DB = new Database();

        $_SESSION['error'] = "";
        if(isset($POST['creditCardOne'], $POST['creditCardTwo']))
        {
            // Array for holding exact values
            $arr['email4'] = $_SESSION['email'];
            $arr['history2'] = date("Y-m-d H:i:s");
            $arr['message3'] = "Funds transfered to " . $POST['creditCardTwo'] . " card"; // run if value is in array and isset
            $arr['amount2'] = 0; // Set account to have 0 initially
            $arr['change3'] = $POST['amountChange1'];

            $query = "INSERT INTO history (email, history, message, currentAmount, changes) values (:email4, :history2, :message3, :amount2, :change3)";
            $data = $DB->write($query, $arr);
            if($data) 
            {
                //header("Location:" . ROOT . "account");
                //die;
            } else {
                $_SESSION['error'] = 'Please enter valid information to create an card';
            }
        }
    }


    /*function signup($POST)
    {
        // print("I Am here");
        $DB = new Database();

        $_SESSION['error'] = "";
        if(isset($POST['username']) && isset($POST['password'])) 
        {
                // array for holding exact values
            $arr['username'] = $POST['username']; // run if value is in array and isset
            $arr['password'] = $POST['password'];
            $arr['email'] = $POST['email'];
            $arr['url_address'] = get_random_string_max(60);
            $arr['date'] = date("Y-m-d H:i:s");
            
            $query = "INSERT INTO users (username, password, email, url_address, date) values (:username, :password, :email, :url_address, :date)";
            $data = $DB->write($query,$arr);
            if($data) 
            {
                header("Location:" . ROOT . "login");
                die;
            } 
        } else {
            $_SESSION['error'] = 'Please enter a valid username and password';
        }
        
    }

    function check_logged_in()
    {
        $DB = new Database();

        $arr['user_url'] = $POST['user_url'];
        if(isset($_SESSION['user_url'])) 
        {
            $query = "SELECT * FROM users where url_address = :user_url limit 1";
            $data = $DB->read($query,$arr);
            if(is_array($data)) 
            {
                // logged in
                $_SESSION['user_id'] = $data[0]->userid;
                $_SESSION['user_name'] = $data[0]->username;
                $_SESSION['user_url'] = $data[0]->url_address;

                return true;
            }
        }
        return false;
        header("Location:" . ROOT . "login");
        
    }

    function logout()
    {
        // logged out
        unset($_SESSION['user_name']);
        unset($_SESSION['url_url']);

        // header("location:" . ROOT . "signout");
        // exit();
        // die;
    }*/
}