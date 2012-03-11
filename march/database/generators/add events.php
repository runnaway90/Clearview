<?php
include '../../login/db_config.php';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname, $conn);
$query = "INSERT INTO `events`
(`event_id`, `title`, `privacy_level`, `price`, `body`, `short_description`, `long_description`, `society_id`, `online_booking`, `available_places`, `start_time`, `end_time`, `place`)
VALUES
( '109', 'Praesent eu', '1', '244', 'massa nunc in quis ultrices In tempor erat', 'massa nunc in quis', 'massa nunc in quis ultrices In', '28', '0', '13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sed cubilia' ),
( '86', 'semper urna', '0', '176', 'et Proin ante Suspendisse Nam auctor fermentum purus', 'et Proin ante Suspendisse', 'et Proin ante Suspendisse Nam auctor', '31', '1', '163', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Etiam mauris' ),
( '193', 'cursus eu', '0', '175', 'quam sagittis magnis Vivamus ut Praesent Sed Suspendisse', 'quam sagittis magnis Vivamus', 'quam sagittis magnis Vivamus ut Praesent', '55', '1', '12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'feugiat in' );";
$result = mysql_query($query);
?>