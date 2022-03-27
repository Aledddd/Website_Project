<?php
    session_start();
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
	$id_prod=$_GET['id_prod'];
	$req="Select * from produit where id_prod='$id_prod'";
	if($res=$con->query($req)){
    	$row=$res->fetch_assoc();
		$nom=$row['nom'];
		$prix=$row['prix'];
		$cat=$row['id_categorie'];
		$req="Select id_panier from panier order by id_panier desc limit 1";
		if($res=$con->query($req)){
			$row=$res->fetch_assoc();
			$id_panier= $row['id_panier']+1;
		}else{
			$id_panier=1;
		}
		$req="insert into panier values('$id_panier','$id_prod','$nom','$prix','$cat','".$_SESSION['id']."')";
		$res=$con->query($req);
		header('Location: http://projetweb/Accueil.php');
	}
?>