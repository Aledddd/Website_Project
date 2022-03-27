<?php
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
	$id=$_GET['id'];
	$req="select * from client";
	$res=$con->query($req);
	while($row=$res->fetch_assoc()){
		if($id==$row["id"]){
?>
<!DOCTYPE html>
<html>
<head>
<title>Basic MySQLi Commands</title>
</head>
<body>
	<h2>Edit</h2>
	<form method="POST" action="update_client.php?id=<?php echo $id; ?>">
		<label>Civilité :</label><input type="text" value="<?php echo $row['civilite']; ?>" name="civilite">
		<label>Nom :</label><input type="text" value="<?php echo $row['nom']; ?>" name="nom">
		<label>Prénom :</label><input type="text" value="<?php echo $row['prenom']; ?>" name="prenom">
		<label>Email :</label><input type="text" value="<?php echo $row['email']; ?>" name="email">
		<label>Mot de passe :</label><input type="text" value="<?php echo $row['password']; ?>" name="password">
		<label>Adresse :</label><input type="text" value="<?php echo $row['adresse']; ?>" name="adresse">
		<label>Ville :</label><input type="text" value="<?php echo $row['ville']; }}?>" name="ville">
		<input type="submit" name="submit">
		<a href="Gestion.php">Retour</a>
	</form>
</body>
</html>