<?php

$con = mysqli_connect("localhost:3306","root","","clinic");

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}

?>