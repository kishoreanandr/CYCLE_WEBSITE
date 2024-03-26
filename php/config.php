<?php

$con=mysqli_connect("localhost","root","","cycle_details");
if(!$con)
{
    echo "Connection Failed" . $con->mysqli_connect_error;
}
?>