<?php
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
	$id=$_GET['id'];
 
	$nom=$_POST['nom'];
	$page=$_POST['page'];
 
	mysqli_query($con,"update `categories` set nom='$nom', page='$page' where id='$id'");
	header('location:Gestion.php');
?>