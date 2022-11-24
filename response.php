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
    $conn->query($sql);

    // $msg = json_encode("El usuario ha sido bloqueado");
    // echo trim($msg, '"');
    // $_SESSION["success"] = '<div class="alert alert-success alert-dismissible show text-center" role="alert">
    //     <small> <i class="fa-solid fa-check"></i>Usuario Eliminado</small>
    // </div>';
    // $i = 1;
    // $i=+1;

    // echo $i;
}

if (isset($_POST['cartInfo'])) {
    $buyerName = $conn->real_escape_string(sanitizeData($_POST['buyerName']));
    $cartItems = $conn->real_escape_string(sanitizeData($_POST['cartItems']));
    $orderId = $conn->real_escape_string(sanitizeData($_POST['orderId']));
    $total = $conn->real_escape_string(sanitizeData($_POST['total']));
    $date = date('d-m-Y');

    $sql = $conn->prepare("INSERT INTO orders(orderid,buyerName,totalItems,total, date)
    values(?,?,?,?,?)");
    $sql->bind_param('isiss', $orderId, $buyerName, $cartItems, $total, $date);
    if ($sql->execute()) {
        // header("location:checkout.php");
        var_dump($sql->bind_param('isids', $orderId, $buyerName, $cartItems, $total, $date));
    }
}
