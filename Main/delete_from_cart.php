<?php
    session_start();
    $idProduct = $_GET['idProduct'];

    if (isset($_SESSION['cart'][$idProduct])) {
        unset($_SESSION['cart'][$idProduct]);
    }
    header('Location: view_cart.php');