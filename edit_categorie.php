<?php
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
	$id=$_GET['id'];
	$req="select * from categories";
	$res=$con->query($req);
	while($row=$res->fetch_assoc()){
		if($id==$row['id']){
?>
<!DOCTYPE html>
<html>
<head>
<title>Basic MySQLi Commands</title>
</head>
<body>
	<h2>Edit</h2>
	<form method="POST" action="update_categorie.php?id=<?php echo $id; ?>">
		<label>Nom :</label><input type="text" value="<?php echo $row['nom']; ?>" name="nom">
		<label>Page :</label><input type="text" value="<?php echo $row['page']; }}?>" name="page">
		<input type="submit" name="submit">
		<a href="Gestion.php">Retour</a>
	</form>
</body>
</html>