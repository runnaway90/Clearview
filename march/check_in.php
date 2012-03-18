<?php

    require_once($path.'login/login_functions.php');
    session_start();
    
    error_reporting(E_ALL ^ E_NOTICE); // Error report notice OFF

    // connect to database
    require_once($path.'database/db_config.php');
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname, $conn);
    // end of connect to database

    $username_valid = true;
    if (isLoggedIn()) 
    {
        $username = $_SESSION['username'];
        $isAdmin = $_SESSION['userlevel'] == $mem_status_admin;
    }
    else if (isset($_COOKIE['clearview_user']) && isset($_COOKIE['clearview_pass']))
    {
        $username = $_COOKIE['clearview_user'];
       
        $query = 	"SELECT password, username, membership_status_id
                    FROM $usertable
                    WHERE username = '$username';";
        $result = mysql_query($query);
        
        if((mysql_num_rows($result) < 1)) //no such user exists
        {
            $username_valid = false;
            $_SESSION['userlevel'] = -1; 
        }
        else 
        {
            $userData = mysql_fetch_array($result, MYSQL_ASSOC);
            if($userData['username'] == $_COOKIE['clearview_user'] && 
                md5($userData['password']) == $_COOKIE['clearview_pass'])
            {
                $_SESSION['username'] = $userData['username'];
                $_SESSION['userlevel'] = $userData['membership_status_id'];
                validateUser();
                $isAdmin = $userData['membership_status_id'] == $mem_status_admin;
            }
        }
        //$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
        
    }
    else // guest level
    { 
        $_SESSION['userlevel'] = -1; 
    }
    
?>