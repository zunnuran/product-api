<?php
include "classes/product.php";
$product = new product();
$err = '';

if (isset($_POST)){
    if (isset($_POST["submit"])){
        $result = $product->addProduct($_POST);
        if($result>0){
            header('location: index.php?insertId='.$result);
        }
        else
            $err = '<div class=="alert alert-danger">'.$result.'</div>';
    }
}
?>
<?php include "header.php";?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="margin-0">Add New Product</h2>
        </div>
        <div class="panel-body">
    <form action="#" method="post" class="form-horizontal">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6 col-md-offset-3">
                <label for="name">Product Name<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" autofocus placeholder="e.g: Bluetooth Handfree...">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6 col-md-offset-3">
                <label for="price">Price<span class="text-danger">*</span></label>
                <input type="text" name="price" class="form-control" placeholder="e.g: 22.32">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6 col-md-offset-3">
                <label for="color">Color</label>
                <input type="text" name="color" class="form-control" placeholder="e.g: Red">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6 col-md-offset-3 text-danger"><?php echo $err; ?></div>
        </div>
        <div class="row form-group">
            <div class="col-md-6 col-md-offset-3">
                <input type="submit" name="submit" class="btn btn-primary pull-right">
            </div>
        </div>
    </form>
        </div>
    </div>
</div>
<?php include "footer.php";?>