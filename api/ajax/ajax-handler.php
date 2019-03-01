<?php
include "../classes/product.php";

$products = new product();

if(isset($_REQUEST)){
    if (isset($_REQUEST["addProduct"])){
        $result = $products->addProduct($_REQUEST["name"], $_REQUEST["price"], $_REQUEST["color"]);
        echo json_encode($result);
        exit();
    }

    if (isset($_REQUEST["updateProduct"])){
        $result = $products->updateProduct($_REQUEST["id"], $_REQUEST["name"], $_REQUEST["price"], $_REQUEST["color"]);
        echo json_encode($result);
        exit();
    }

    if (isset($_REQUEST["getProduct"])){
        $result = $products->getProduct($_GET["id"]);
        echo json_encode($result);
        exit();
    }

    if (isset($_REQUEST["deleteProduct"])){
        $result = $products->deleteProduct($_REQUEST["deleteProduct"]);
        echo json_encode($result);
        exit();
    }

    if (isset($_REQUEST["searchProduct"])){
        $result = $products->searchProduct($_REQUEST["searchProduct"]);
        echo json_encode($result);
        exit();
    }
}