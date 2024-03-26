<?php
    require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtering using ajax</title>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h3 class="text-center text-light bg-info p-2">Product Filtering using ajax</h3>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <h5>Filter Product</h5>
                <hr>

                <!--Check Box -->
                <h6 class="text-info">Select Brand</h6>

                <ul class="list-group"><!-- unique brands from data base-->
                        <?php
                        $sql="SELECT DISTINCT brand FROM cycle_detail ORDER BY brand";//distinct->unique values
                        $result=$con->query($sql);

                        while($row=$result->fetch_assoc())
                        {
                        ?>
                        <!-- fetching brand -->
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-ckeck-label">
                                    <input type="checkbox" class="form-check-input product_check" value="<?=$row['brand']; ?>" id="brand">
                                    <?= $row['brand']; ?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                </ul>

                
                <!-- selecting category-->
                <h6 class="text-info mt-1">Select Category</h6>

                <ul class="list-group"><!-- unique brands from data base-->
                        <?php
                        $sql="SELECT DISTINCT category FROM cycle_detail ORDER BY category";//distinct->unique values
                        $result=$con->query($sql);

                        while($row=$result->fetch_assoc())
                        {
                        ?>
                        <!-- fetching brand -->
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-ckeck-label">
                                    <input type="checkbox" class="form-check-input product_check" value="<?=$row['category']; ?>" id="category">
                                    <?= $row['category']; ?>
                                </label>
                            </div>
                        </li>
                        <?php } ?>
                </ul>
                
            </div>


            <div class="col-lg-9">
                <h5 class="text-center" id="textChange">All Products</h5>
                <hr>

                <!-- Loadder image-->
                <div class="text-center">
                    <img src="../imgs/Loading.gif" alt="Loading..." id="loader" width=300 style="display:none">
                </div>

                <!-- product fetching-->
                <div class="row" id="result">
                <?php

                $sql="SELECT * FROM cycle_detail";
                $result=$con->query($sql);
                while($row=$result->fetch_assoc())
                {

                ?>

                <div class="col-md-3 mb-2">
                        <div class="card-deck">
                            <div class="card border-secondary">
                                <img src="<?php echo $row['product_images']; ?>" alt="Product Details..." class="card-img-top" width="300" height="200px" style="object-fit:cover">

                                <div class="card-img-overlay">
                                    <h6 style="margin-top:190px;" class="text-light bg-info text-center rounded p-2"><?= $row['product_name']; ?></h6>

                                </div>
                                
                                <div class="card-body">

                                    <h4 class="card-title text-danger mt-5">Price: <?= number_format($row['product_price']); ?>/-</h4>
                                    <p>
                                      Category : <?= $row['category']; ?><br>  
                                    </p>
                                    <a href="#" class="btn btn-success btn-block">Add to Cart</a>
                            
                                </div>

                            </div>
                        </div>
                </div>
                <?php } ?>
              
            </div>

            </div>
        </div>
    </div>

    <script>
     $(document).ready(function()
     {

        //this is for showing loader
        $(".product_check").click(function()
        {
            $("#loader").show();

            var action='data';
            var brand=get_filter_text('brand');
            var category=get_filter_text('category');

            $.ajax({
                url:'action.php',
                method:'POST',
                data:{action:action,brand:brand,category:category},
                success:function(response)
                {
                    $("#result").html(response);//display the details in the result id 
                    $("#loader").hide();
                    $("#textChange").text("Filtered Produts");//it will show when checked 
                }
            });
            
        });

        //this is for storing the value checking by user 
        function get_filter_text(text_id)
        {
            var filterData=[];
            $('#'+text_id+':checked').each(function()
            {
                filterData.push($(this).val());
            });
            return filterData;
        }
     });            
    </script>
</body>
</html>