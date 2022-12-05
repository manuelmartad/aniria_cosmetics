<?php
require 'config/env.php';
// print_r($_POST);
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();

    $productId = $_POST["productId"];
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];
    $productQty = $_POST["productQty"];
    $productImage = $_POST["productImage"];

    /*Añadimos el producto a la sesion 'cart'*/
    $producto = array(
        "productId" => $productId,
        "productName" => $productName,
        "productPrice" => $productPrice,
        "productQty" => $productQty,
        "productImage" => $productImage
    );

    $_SESSION['cart'][$productId] = $producto;
} else {
    // $_SESSION['cart'] = array();

    $productId = $_POST["productId"];
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];
    $productQty = $_POST["productQty"];
    $productImage = $_POST["productImage"];

    /*Añadimos el producto a la sesion 'cart'*/
    $producto = array(
        "productId" => $productId,
        "productName" => $productName,
        "productPrice" => $productPrice,
        "productQty" => $productQty,
        "productImage" => $productImage

    );

    $_SESSION['cart'][$productId] = $producto;

    // $_SESSION['cart'][$productId] += $productId;
}
