<?php
	session_start();
	$con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
?>
<html>
    <head>
        <title>Site de vente en ligne</title>
        <link rel="stylesheet" type="text/css" href="http://projetweb/Style.css?ver=<?php echo rand(111,999)?>" media="screen">
		<style>
        fieldset{
            border:solid 1px #EE6600;
            border-radius:10px;
            padding:20px;
            text-align: center;
         }

        legend{
            font:bold 16pt arial;
            color:#EE6600;
         }

         input{
            border:solid 1px #AAAAAA;
            padding:10px;
            font:10pt verdana;
            color:#EE6600;
            outline:none;
            border-radius:6px;
            width: 20%;
         }
        </style> 
    </head>
    <body>
		<div class="return">
		<a href="Accueil.php">
			<input type="button" id="button" value="Return">
		</a>
		</div>
		<div class="corp">
			<fieldset>
				<legend>Categories : </legend>
				<?php
					$req="select * from categories";
					$res=$con->query($req);
					while($row=$res->fetch_assoc()){
						echo '<li class="ad">
							<a><p>ID : '.$row["id"].' |Nom : '.$row["nom"].'</a><a href="edit_categorie.php?id='.$row['id'].'">	Edit</a>
							<a href="delete.php?id= '.$row['id'].'"> Delete</a>';
						echo '</li>';
					}
				?>
				<p>Ajouter une catégorie : </p>
				<form method="POST" action="add.php">
					<label>Nom :</label><input type="text" name="Nom">
					<label>Page :</label><input type="text" name="Page">
					<input type="submit" name="Ajouter">
				</form>
			</fieldset>
			<fieldset>
				<legend>Produits : </legend>
				<?php
					$req="select * from produit";
					$res=$con->query($req);
					while($row=$res->fetch_assoc()){
						echo '<li class="ad">
							<a><p>ID : '.$row["id_prod"].'| Nom : '.$row["nom"].'| Prix : '.$row["prix"].'</a><a href="edit_produit.php?id='.$row["id_prod"].'">	Edit</a>
							<a href="delete_produit.php?id= '.$row['id_prod'].'"> Delete</a>';
				
						echo '</li>';          
					}
				?>
				<p>Ajouter un produit : </p>
				<form method="POST" action="Add_items.php">
					<label>Nom :</label><input type="text" name="Nom">
					<label>Prix :</label><input type="text" name="Prix">
					<label>ID Categorie :</label><input type="text" name="id_categ">
					<label>Image :</label><input type="text" name="image">
					<input type="submit" name="Ajouter">
				</form>
			</fieldset>
			<fieldset>
				<legend>Utilisateurs : </legend>
				<?php
					$req="select * from client";
					if($res=$con->query($req)){
						while($row=$res->fetch_assoc()){
							echo '<li class="ad">
								<a><p>ID : '.$row["id"].'| Nom Prenom: '.$row["nom"].' '.$row["prenom"].'| email : '.$row["email"].'</a><a href="edit_client.php?id='.$row["id"].'">	Edit</a>
								<a href="delete_client.php?id= '.$row['id'].'"> Delete</a>';
							echo '</li>';          
						}
					}else{
						echo'<center><h1>Pas de client</h1><center>';
					}
				?>

				<p>Ajouter un utilisateur : </p>
				<form method="POST" action="Add_user.php">
					<label>Nom :</label><input type="text" name="Nom">
					<label>Prenom :</label><input type="text" name="Prenom">
					<label>Email :</label><input type="text" name="Email">
					<input type="submit" name="Ajouter">
				</form>
			</fieldset>
		</div>
    </body>
</html>