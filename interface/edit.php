<?php
include "../api/classes/product.php";
$product = new product();
$err = '';
$id = '';
$product_name = '';
$price = '';
$color = '';

//if (isset($_POST)){
//    if (isset($_POST["submit"])){
//        $result = $product->updateProduct($_POST);
//        if($result==1){
//            header('location: index.php?editid='.$_POST['id']);
//        }
//        else
//            $err = $result;
//    }
//}
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
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="margin-0">Edit Product</h4>
            </div>
            <div class="panel-body">
                <form action="#" method="post" class="form-horizontal" name="edit-form" id="edit-form">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <label for="id">Product id<span class="text-danger">*</span></label>
                            <input type="text" name="id-copy" id="id-copy" readonly value="<?php echo $id; ?>"  class="form-control">
                            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"  class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <label for="name">Product Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="<?php echo $product_name; ?>" class="form-control" autofocus placeholder="e.g: Bluetooth Handfree...">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <label for="price">Price<span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" value="<?php echo $price; ?>" class="form-control" placeholder="e.g: 22.32">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <label for="color">Color</label>
                            <input type="text" name="color" id="color" value="<?php echo $color; ?>" class="form-control" placeholder="e.g: Red">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-8 col-md-offset-2 text-danger" id="err"><?php echo $err; ?></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="submit" name="submit" class="btn btn-primary pull-right">
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer"><a href="../">Go back to homepage</a></div>
        </div>
    </div>
        </div>
    </div>
<?php include "footer.php";?>
<script type="text/javascript">
    $.validator.setDefaults({
        submitHandler: function () {
            $.ajax({
                type: "POST",
                url: "../api/ajax/ajax-handler.php?updateProduct",
                data: {id:$("#id").val(), name: $("#name").val(), price: $("#price").val(), color: $("#color").val()},
                success: function (result) {
                    var data = $.parseJSON(result);
                    if (data == 1) {
                        $("#err").removeClass("text-danger");
                        $("#err").addClass("text-success");
                        $("#err").html('Product has been updated <a href="../">Go back</a>');
                        $("#name").focus();
                    }
                    else if (data == 0) {
                        $("#err").removeClass("text-success");
                        $("#err").addClass("text-danger");
                        $("#err").html('Product couldn\'t be added, please refresh and continue!');
                    }
                    else {
                        $("#err").removeClass("text-success");
                        $("#err").addClass("text-danger");
                        $("#err").html(data);
                    }
                }
            });
            return false;
        }
    });

    $(document).ready(function (e) {
        $('#edit-form').validate({
            rules: {
                id:{
                    required:true,
                    number: true
                },
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                price: {
                    required: true,
                    number: true
                },
                color: {
                    minlength: 3,
                    maxlength: 25
                }
            }
        });
    });
</script>
