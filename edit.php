<?php
include "classes/product.php";
$product = new product();
$err = '';
$id = '';
$product_name = '';
$price = '';
$color = '';

if (isset($_POST)){
    if (isset($_POST["submit"])){
        $result = $product->updateProduct($_POST);
        if($result==1){
            header('location: index.php?editid='.$_POST['id']);
        }
        else
            $err = $result;
    }
}
if(isset($_GET)){
    if (isset($_GET['id'])){
        $productData = $product->getProduct($_GET['id']);
        if(count($productData)>0){
            $id = $productData[0]['id'];
            $product_name = $productData[0]['product_name'];
            $price = $productData[0]['price'];
            $color = $productData[0]['color'];
        }
    }
}
?>
<?php include "header.php";?>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="margin-0">Edit Product</h2>
            </div>
            <div class="panel-body">
                <form action="#" method="post" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <label for="id">Product id<span class="text-danger">*</span></label>
                            <input type="text" name="id" value="<?php echo $id; ?>"  class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <label for="name">Product Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" value="<?php echo $product_name; ?>" class="form-control" autofocus placeholder="e.g: Bluetooth Handfree...">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <label for="price">Price<span class="text-danger">*</span></label>
                            <input type="text" name="price" value="<?php echo $price; ?>" class="form-control" placeholder="e.g: 22.32">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <label for="color">Color</label>
                            <input type="text" name="color" value="<?php echo $color; ?>" class="form-control" placeholder="e.g: Red">
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