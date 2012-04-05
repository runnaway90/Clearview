<?php
include '../../login/db_config.php';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname, $conn);
$query = "INSERT INTO `events`
(`event_id`, `title`, `privacy_level`, `price`, `body`, `short_description`, `long_description`, `society_id`, `online_booking`, `available_places`, `start_time`, `end_time`, `place`)
VALUES
( '111', 'ultrices in', '2', '22', 'malesuada lacinia sollicitudin vel Sed sollicitudin Sed eros', 'malesuada lacinia sollicitudin vel', 'malesuada lacinia sollicitudin vel Sed sollicitudin', '248', '0', '206', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sollicitudin Duis' ),
( '63', 'Cum sed', '2', '129', 'purus ante semper Sed lectus blandit nisi purus', 'purus ante semper Sed', 'purus ante semper Sed lectus blandit', '81', '0', '225', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'dictum Curae' ),
( '200', 'dignissim ultrices', '1', '191', 'quis sed Mauris posuere vestibulum quam a faucibus', 'quis sed Mauris posuere', 'quis sed Mauris posuere vestibulum quam', '74', '0', '132', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'justo faucibus' ),
( '13', 'placerat Curae', '2', '209', 'luctus augue ac Sed blandit quam Suspendisse auctor', 'luctus augue ac Sed', 'luctus augue ac Sed blandit quam', '71', '1', '210', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'semper felis' ),
( '207', 'posuere cursus', '2', '134', 'lacinia Curae penatibus eleifend pretium lacinia dis dictum', 'lacinia Curae penatibus eleifend', 'lacinia Curae penatibus eleifend pretium lacinia', '69', '0', '94', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Integer massa' ),
( '113', 'mus lorem', '2', '247', 'in venenatis dui quis Etiam Suspendisse orci condimentum', 'in venenatis dui quis', 'in venenatis dui quis Etiam Suspendisse', '40', '1', '164', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'massa sollicitudin' ),
( '105', 'cursus Duis', '0', '110', 'Duis magnis dictum nisl sed ante aliquam ultrices', 'Duis magnis dictum nisl', 'Duis magnis dictum nisl sed ante', '38', '1', '254', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'molestie Proin' ),
( '169', 'viverra risus', '2', '4', 'Pellentesque sagittis in nisl pretium purus Sed molestie', 'Pellentesque sagittis in nisl', 'Pellentesque sagittis in nisl pretium purus', '209', '1', '23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'primis ridiculus' ),
( '251', 'magna Mauris', '0', '24', 'cubilia congue Cum consequat sit at quis urna', 'cubilia congue Cum consequat', 'cubilia congue Cum consequat sit at', '49', '0', '224', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fermentum in' ),
( '96', 'augue molestie', '1', '21', 'ac magna quis fermentum blandit non pretium vestibulum', 'ac magna quis fermentum', 'ac magna quis fermentum blandit non', '202', '1', '26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Suspendisse adipiscing' ),
( '151', 'elementum ante', '0', '10', 'ultrices aliquet urna aliquet arcu ac tortor vel', 'ultrices aliquet urna aliquet', 'ultrices aliquet urna aliquet arcu ac', '64', '0', '190', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'eleifend vestibulum' ),
( '120', 'amet Nam', '1', '234', 'Pellentesque pretium a lobortis ac fringilla magna primis', 'Pellentesque pretium a lobortis', 'Pellentesque pretium a lobortis ac fringilla', '144', '0', '19', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'hendrerit Suspendisse' ),
( '223', 'ante lobortis', '2', '28', 'ipsum fermentum Sed nulla consequat posuere congue lacus', 'ipsum fermentum Sed nulla', 'ipsum fermentum Sed nulla consequat posuere', '51', '1', '202', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'nisl posuere' ),
( '121', 'vestibulum nisl', '2', '56', 'ac mus malesuada purus nisi nec fringilla fringilla', 'ac mus malesuada purus', 'ac mus malesuada purus nisi nec', '148', '1', '211', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'adipiscing orci' ),
( '56', 'sollicitudin quis', '2', '100', 'aliquam sagittis mus ipsum natoque quis amet Vestibulum', 'aliquam sagittis mus ipsum', 'aliquam sagittis mus ipsum natoque quis', '135', '0', '183', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Phasellus Nam' ),
( '255', 'ut ornare', '1', '214', 'cubilia at Pellentesque eleifend sollicitudin nisi faucibus faucibus', 'cubilia at Pellentesque eleifend', 'cubilia at Pellentesque eleifend sollicitudin nisi', '131', '0', '68', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'lorem sem' ),
( '41', 'lectus pretium', '2', '211', 'hendrerit nec lectus quis quis nisl ultrices auctor', 'hendrerit nec lectus quis', 'hendrerit nec lectus quis quis nisl', '217', '1', '191', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sociis volutpat' ),
( '11', 'nisl et', '0', '158', 'aliquam nisl facilisis Pellentesque ornare dignissim orci vel', 'aliquam nisl facilisis Pellentesque', 'aliquam nisl facilisis Pellentesque ornare dignissim', '223', '1', '32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'accumsan mauris' ),
( '199', 'eros ac', '0', '19', 'Duis dui penatibus parturient sollicitudin luctus nisl Cras', 'Duis dui penatibus parturient', 'Duis dui penatibus parturient sollicitudin luctus', '90', '0', '208', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ornare eros' ),
( '147', 'fermentum pretium', '1', '104', 'hendrerit velit sagittis risus lorem vel nisl quis', 'hendrerit velit sagittis risus', 'hendrerit velit sagittis risus lorem vel', '57', '1', '54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'aliquet ante' );";
$result = mysql_query($query);
?>