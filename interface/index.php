<?php
include "../api/classes/product.php";
$product = new product();
$err = '';
if(isset($_GET)) {
    if (isset($_GET["insertId"])){
        $err = '<div class="alert alert-success">New product has been added with id: '.$_GET["insertId"].', <a href="create.php">click here</a> to add more.</div>';
    }
    if (isset($_GET["editid"])){
        $err = '<div class="alert alert-success">Product has been updated with id: '.$_GET["editid"].'</div>';
    }
    if (isset($_GET["deleteId"])){
        if($product->deleteProduct($_GET["deleteId"])){
            $err = '<div class="alert alert-success">Product has been deleted with id: '.$_GET["deleteId"].'</div>';
        }
        else
            $err = '<div class="alert alert-danger">No product is deleted please try again!</div>';
    }
}
$allProducts = $product->getProduct();
include "header.php";
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="margin-0">List of Products</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-offset-9 col-md-3 form-group">
                                <input type="text" name="searchKey" id="searchKey" class="form-control" placeholder="Quick Search">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <button type="button" name="btnAddMore" onclick='window.location.href="create.php"' class="btn btn-primary pull-right">Add New Product</button>
                            </div>
                        </div>
                        <div id="err"><?php echo $err;?></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Color</th>
                                        <th>Created at</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="productData">
                                    <?php
                                    if(count($allProducts)>0):
                                        foreach ($allProducts as $product):?>
                                            <tr class="product-data-row">
                                                <td><?php echo $product["id"] ?></td>
                                                <td><?php echo $product["product_name"] ?></td>
                                                <td><?php echo $product["price"] ?></td>
                                                <td><?php echo $product["color"] ?></td>
                                                <td><?php echo $product["created_at"] ?></td>
                                                <td><?php echo $product["updated_at"]==$product["created_at"]?"Never":$product["updated_at"]; ?></td>
                                                <td>
                                                    <a type="button" class="btn btn-default fa fa-pencil" id="edit" href="edit.php?id=<?php echo $product["id"] ?>"></a>
                                                    <button type="button" class="btn btn-default fa fa-trash" id="delete" data-id="<?php echo $product["id"] ?>"></button>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    else:?>
                                    <tr class="product-data-row">
                                        <td colspan="7" class="text-center">Currently there is no product</td>
                                    </tr>
                                    <?php endif;
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td class="strong" colspan="5">Total Records</td>
                                        <td class="strong" id="totalRecords"><?php echo count($allProducts);?></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <button type="button" name="btnAddMore" onclick='window.location.href="create.php"' class="btn btn-primary pull-right">Add New Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
include "footer.php";
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#searchKey').keyup(function () {
            $.ajax({url:"../api/ajax/ajax-handler.php?searchProduct="+$('#searchKey').val(), success:function (result) {
                $("#productData").html('');
                var data = $.parseJSON(result);
                var dataHtml = '';
                if(data.length>0) {
                    for (var i = 0; i < data.length; i++) {
                        var updated = data[i].updated_at==data[i].created_at?data[i].updated_at:'never';
                        dataHtml += '<tr class="product-data-row">' +
                            '<td>'+data[i].id+'</td>' +
                            '<td>'+data[i].product_name+'</td>' +
                            '<td>'+data[i].price+'</td>' +
                            '<td>'+data[i].color+'</td>' +
                            '<td>'+data[i].created_at+'</td>' +
                            '<td>'+updated+'</td>' +
                            '<td><a type="button" class="btn btn-default fa fa-pencil" id="edit" href="edit.php?id='+data[i].id+'"></a>&nbsp;' +
                                '<button type="button" class="btn btn-default fa fa-trash" id="delete" data-id="'+data[i].id+'"></button></td>' +
                            '</tr>';
                    }
                }
                else {
                    dataHtml = '<tr><td colspan="7" class="text-center">No product found! </td></tr>';
                }
                $("#productData").html(dataHtml);
                $("#totalRecords").html(data.length);
            }})
        });
        $(document).on('click', '#delete', function (e) {
//            console.log($(".product-data-row").length);
            if(confirm("Do you want to delete product with Id: "+$(this).attr('data-id')+"?")) {
                $.ajax({
                    url: "../api/ajax/ajax-handler.php?deleteProduct=" + $(this).attr('data-id'),
                    success: function (result) {
                        var data = $.parseJSON(result);
                        if(data==true){
                            $('#err').html('<div class="alert alert-success">Product has been deleted successfully.</div>');
                            $("#delete").parent().parent().remove();
                        }
                        else {
                            $('#err').html('<div class="alert alert-danger">Product could not be deleted please refresh and try again!</div>');
                        }
                    }
                });
                $("#totalRecords").html($(".product-data-row").length);
            }
        });
    });
</script>