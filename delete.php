<?php
	$id=$_GET['id'];
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
	mysqli_query($con,"delete from `categories` where id='$id'");
	header('location:Gestion.php');
?>