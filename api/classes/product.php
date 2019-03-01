<?php
if(file_exists("../config.php")){
    include("../config.php");
}
else{
    include ("../api/config.php");
}

class product extends config {
//    public $Id;
//    public $name;
//    public $price;
//    public $color;
//    public $creted_at;
//    public $updated_at;

    public function addProduct($product_name, $product_price, $product_color) {
        $error = '';

//        $product_name = $post_request['name'];
//        $price = $post_request['price'];
//        $color = $post_request['color'];
        if(strlen($product_name)>100 || strlen($product_name)<3){
            $error .= 'Product name must be between 3-100 <br>';
        }
        if(round($product_price, 2) < 0.01){
            $error .= 'Product price must be at least 0.01 <br>';
        }
        if(strlen($product_color)>25){
            $error .= 'Product color must be between 3-25 <br>';
        }
        if($error!='')
        {
            return $error;
        }

        $query = $this->conn->prepare("INSERT INTO products (product_name, price, color) VALUES (?,?,?)");
        $query->bind_param("sds", $product_name, $product_price, $product_color);
        $query->execute();
        if($query->affected_rows>0)
        {
            return $query->insert_id;
        }
        else
            return 0;
    }

    public function updateProduct($Id, $product_name, $product_price, $product_color) {
        $error = '';
//        $Id = $post_request['id'];
//        $product_name = $post_request['name'];
//        $price = $post_request['price'];
//        $color = $post_request['color'];

        if(round($Id)<0){
            $error .= 'Unable to update product (Invalid product Id). <br>';
        }
        if(strlen($product_name)>100 || strlen($product_name)<3){
            $error .= 'Product name must be between 3-100 <br>';
        }
        if(round($product_price, 2) < 0.01){
            $error .= 'Product price must be at least 0.01 <br>';
        }
        if(strlen($product_color)>25){
            $error .= 'Product color must be max 25 <br>';
        }
        if($error!='')
        {
            return $error;
        }
        $query = $this->conn->prepare("UPDATE products SET product_name=?, price=?, color=? WHERE id = ?");
        $query->bind_param("sdsi", $product_name, $product_price, $product_color, $Id);
        $query->execute();
        if($query->affected_rows>0)
        {
            return 1;
        }
        else
            return 'No product is updated!';
    }

    public function getProduct($id = 0){
        $query = "";
        if($id==0){
            $query = $this->conn->prepare("SELECT * FROM products ORDER BY id DESC ");
        }
        else{
            $query = $this->conn->prepare("SELECT * FROM products WHERE id = ? ORDER BY id DESC ");
            $query->bind_param("i", $id);
        }
        $query->execute();
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function deleteProduct($id){
        $query = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        if($query->affected_rows>0)
        {
            return true;
        }
        else
            return false;
    }

    public function searchProduct($productName=""){
        $query = "";
        if($productName==""){
            $query = $this->conn->prepare("SELECT * FROM products ORDER BY id DESC ");
        }
        else{
            $query = $this->conn->prepare("SELECT * FROM products WHERE product_name LIKE CONCAT('%',?,'%') ORDER BY product_name ASC ");
            $query->bind_param("s", $productName);
        }
        $query->execute();
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}
?>