<?php 
require 'config.php';
if(isset($_POST['action']))
{
    $sql="SELECT * FROM cycle_detail WHERE brand !=''";
    if(isset($_POST['brand']))
    {
        $brand=implode("','",$_POST['brand']); //for converting array to sting
        $sql.="AND brand IN('".$brand."')";//for checking multiple checkbox
    }
    if(isset($_POST['category']))
    {
        $category=implode("','",$_POST['category']); //for converting array to sting
        $sql.="AND category IN('".$category."')";//for checking multiple checkbox
    }

    $result=$con->query($sql);
    $output='';
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            $output .='<div class="col-md-3 mb-2">
            <div class="card-deck">
                <div class="card border-secondary">
                    <img src="'.$row['product_images'].'" alt="Product Details..." class="card-img-top" width="300" height="200px">

                    <div class="card-img-overlay">
                        <h6 style="margin-top:175px;" class="text-light bg-info text-center rounded p-1"> '.$row['product_name'].'</h6>

                    </div>
                    
                    <div class="card-body">

                        <h4 class="card-title text-danger">Price: '. number_format($row['product_price']).'/-</h4>
                        <p>
                          Category :'. $row['category'].'<br>  
                        </p>
                        <a href="#" class="btn btn-success btn-block">Add to Cart</a>
                
                    </div>

                </div>
            </div>
    </div>';
        }
    }
    else
    {
        $output="<h3> No Products Found! </h3>";
    }
    echo $output;
}
?>