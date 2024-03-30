<?php

$con=mysqli_connect("localhost","root","","live_search");
if(!$con)
{
    echo "Connection Failed" . $con->mysqli_connect_error;
}
?>