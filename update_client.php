<?php
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
	$id=$_GET['id'];
 
	$civ=$_POST['ciilite'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$email=$_POST['email'];
	$mdp=$_POST['password'];
	$adr=$_POST['adresse'];
	$ville=$_POST['ville'];
 
	mysqli_query($con,"update `client` set civilite='$civ', nom='$nom', prenom='$prenom', email='$email', password='$mdp', adresse='$adr', ville='$ville' where id='$id'");
	header('location:Gestion.php');
?>