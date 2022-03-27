<?php
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
	$id=$_GET['id'];
	
	$id_cat=$_POST['id_categorie'];
	$nom=$_POST['nom'];
	$image=$_POST['nom_image'];
	$prix=$_POST['prix'];
 
	mysqli_query($con,"update `produit` set id_categorie='$id_cat', nom='$nom', nom_image='$image', prix='$prix' where id_prod='$id'");
	header('location:Gestion.php');
?>