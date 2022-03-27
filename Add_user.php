<?php
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
	$nom=$_POST['Nom'];
	$prenom=$_POST['Prenom'];
	$email=$_POST['Email'];
	$req="Select * from client order by id desc limit 1";
	$res=$con->query($req);
    $row=$res->fetch_assoc();
	$id= $row['id']+1;
	mysqli_query($con,"insert into `client` (id,civilite,nom,prenom,email,password,adresse,ville) values ('$id','','$nom','$prenom','$email','','','')");
	header('location:Gestion.php');
 
?>