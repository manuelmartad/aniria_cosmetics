<?php

require 'config/env.php';
require 'config/db.php';
require 'config/funciones.php';

foreach ($_SESSION['cart'] as $key => $value) {
    // echo '<pre>';
    // var_dump($value);
    // echo '</pre>';
    $conn->query("UPDATE product_spot SET quantity = quantity - {$value['productQty']} 
    WHERE product_id = {$value['productId']} AND spot_id = {$_SESSION['spot']} ");
}
