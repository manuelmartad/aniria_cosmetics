<?php
require_once "config/db.php";
require_once "config/funciones.php";
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE product_id = $id";
    $conn->query($sql);

    // $msg = json_encode("El usuario ha sido bloqueado");
    // echo trim($msg, '"');
    $_SESSION["success"] = '<div class="alert alert-success alert-dismissible show text-center" role="alert">
        <small> <i class="fa-solid fa-check"></i>Usuario Eliminado</small>
    </div>';

    echo json_encode($_SESSION["success"]);
}

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    $sql = "UPDATE products SET stars = stars + 1 WHERE product_id = '$productId'";
    if ($conn->multi_query($sql)) {
        echo 200;
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $com = $_POST['comment'];
    $id = $_POST['productid'];
    //   $date = date()

    $sql = "INSERT INTO comments(comment_text, date, product_id) VALUES('$com', NOW(), '$id')";
    if ($conn->query($sql)) {
        echo 200;
    }
}
