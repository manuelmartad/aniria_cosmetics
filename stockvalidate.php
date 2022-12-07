<?php
require_once "config/db.php";
require_once "config/funciones.php";

if (isset($_POST['quantity'])) {
    $product = $_POST["product"];
    $quantity = $_POST["quantity"];

    $r = $conn->query("SELECT * FROM product_spot WHERE product_id = $product and spot_id =1");
    print_r ($d = $r->fetch_assoc()) ;
        if ($d['quantity'] > $quantity) {
            echo 200;
        } else {
            echo 400;
        }
    
}
