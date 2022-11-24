<?php

define('SERVER', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE','aniria');

$conn = new mysqli(SERVER,USER,PASSWORD,DATABASE);

// if ($conn) {
//     echo '<pre>';
//     print_r($conn);
// }
