<?php
include "../classes/product.php";

$products = new product();

if(isset($_REQUEST)){
    if (isset($_REQUEST["searchProduct"])){
        $result = $products->searchProduct($_REQUEST["searchProduct"]);
        echo json_encode($result);
        exit();
    }
}