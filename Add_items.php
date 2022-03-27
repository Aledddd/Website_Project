<?php
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
	$nom=$_POST['Nom'];
	$prix=$_POST['Prix'];
	$categ=$_POST['id_categ'];
	$image=$_POST['image'];
	$req="Select * from produit order by id_prod desc limit 1";
	$res=$con->query($req);
    $row=$res->fetch_assoc();
	$id= $row['id_prod']+1;
	mysqli_query($con,"insert into `produit` (id_prod,id_categorie,nom,nom_image,prix) values ('$id','$categ','$nom','$image','$prix')");
	header('location:Gestion.php');
 
?>