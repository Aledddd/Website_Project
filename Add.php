<?php
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
	$nom=$_POST['Nom'];
	$page=$_POST['page'];
	$req="Select * from categories order by id desc limit 1";
	$res=$con->query($req);
    $row=$res->fetch_assoc();
	$id= $row['id']+1;
	mysqli_query($con,"insert into `categories` (id,nom,page) values ('$id','$nom','$page')");
	header('location:Gestion.php');
 
?>