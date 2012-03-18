<?php 
    $path = '../';
    include $path.'check_in.php';
    $adminView = true;
    include $path.'header.php';


    $tab1_link = '';
    $tab2_link = '?l=pers';
    $tab1_title = 'Home';
    $tab2_title = 'Notifications';
    if (isset($_GET['l'])) // specific page requested
    {
        if ($_GET['l']=='pers') // second tab
        {
            function showTitle() { echo 'admin notifications'; }
            function showContent () { include 'pers.php'; }
        }
        else 
        {
            function showTitle() { echo 'admin home'; }
            function showContent () { include 'home.php'; }
        }
    }
    else if (isset($_GET['q']))  // search view
    {
        function showTitle() { echo 'admin search'; }
        function showContent () { include 'search.php'; }
    }
    else 
    {                      // first tab
        function showTitle() { echo 'admin home'; }
        function showContent () { include 'home.php'; }
    }


    include $path.'page_struct.php';


?>