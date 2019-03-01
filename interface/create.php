<?php
include "../api/classes/product.php";
$product = new product();
$err = '';

//if (isset($_POST)){
//    if (isset($_POST["submit"])){
//        $result = $product->addProduct($_POST[""]);
//        if($result>0){
//            header('location: index.php?insertId='.$result);
//        }
//        else
//            $err = '<div class=="alert alert-danger">'.$result.'</div>';
//    }
//}
?>
<?php include "header.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="margin-0">Add New Product</h4>
                </div>
                <div class="panel-body">
                    <form action="#" method="post" class="form-horizontal" name="create-form" id="create-form">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="name">Product Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" autofocus
                                           placeholder="e.g: Bluetooth Handfree...">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="price">Price<span class="text-danger">*</span></label>
                                    <input type="number" name="price" id="price" class="form-control"
                                           placeholder="e.g: 22.32">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="color">Color</label>
                                    <input type="text" name="color" id="color" class="form-control"
                                           placeholder="e.g: Red">
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
                        </fieldset>
                    </form>
                </div>
                <div class="panel-footer"><a href="../">Go back to homepage</a></div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
<script type="text/javascript">
    $.validator.setDefaults({
        submitHandler: function () {
            $.ajax({
                type: "POST",
                url: "../api/ajax/ajax-handler.php?addProduct",
                data: {name: $("#name").val(), price: $("#price").val(), color: $("#color").val()},
                success: function (result) {
                    var data = $.parseJSON(result);
                    if (data > 0) {
                        $("#err").removeClass("text-danger");
                        $("#err").addClass("text-success");
                        $("#err").html('Product has been added with product Id: ' + data);
                        $("#name").val('');
                        $("#price").val('');
                        $("#color").val('');
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
        $('#create-form').validate({
            rules: {
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