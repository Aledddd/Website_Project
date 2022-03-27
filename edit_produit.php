<?php
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
	$id=$_GET['id'];
	$req="select * from produit";
	$res=$con->query($req);
	while($row=$res->fetch_assoc()){
		if($id==$row["id_prod"]){
?>
<!DOCTYPE html>
<html>
<head>
<title>Basic MySQLi Commands</title>
</head>
<body>
	<h2>Edit</h2>
	<form method="POST" action="update_produit.php?id=<?php echo $id; ?>">
		<label>ID Categorie :</label><input type="text" value="<?php echo $row['id_categorie']; ?>" name="id_categorie">
		<label>Nom :</label><input type="text" value="<?php echo $row['nom']; ?>" name="nom">
		<label>Nom Image :</label><input type="text" value="<?php echo $row['nom_image']; ?>" name="nom_image">
		<label>Prix :</label><input type="text" value="<?php echo $row['prix']; }}?>" name="prix">
		<input type="submit" name="submit">
		<a href="Gestion.php">Retour</a>
	</form>
</body>
</html>