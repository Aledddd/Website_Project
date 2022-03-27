<?php
    session_start();
    $con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
   @$message=null;
   @$message_numcarte=null;
   @$message_crypto=null;
   @$message_mois=null;
   @$message_annee=null;
   @$numcarte=$_POST['num_carte'];
   @$cryptogramme=$_POST['cryptogramme'];
   @$date=$_POST['date'];
   @$valider=$_POST['valider'];

   if(isset($valider)){
    if(empty($numcarte)&&empty($cryptogramme)&&empty($mois)&&empty($annee))
            $message='<div class="erreur">Champ vide.</div>';
    elseif(empty($numcarte))
            $message_numcarte='<div class="erreur">Champ vide.</div>';
    elseif(empty($cryptogramme))
            $message_crypto='<div class="erreur">Champ vide.</div>';
    elseif(empty($mois))
            $message_mois='<div class="erreur">Champ vide.</div>';
    elseif(empty($annee))
            $message_annee='<div class="erreur">Champ vide.</div>';
   }else{
    
   }
?>
<DOCTYPE>
<html>
    <head>
        <title>Accueil</title>
        <meta charset="UTF-8">
        <meta name="Description" content="Site Web Personnel Statique">
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
        <link rel="stylesheet" type="text/css" href="http://projetweb/Style.css?ver=<?php echo rand(111,999)?>" media="screen">
        <header>
			<ul class="michel">
            <?php
                if(isset($_SESSION['nom'])){
            ?>
                <li class="michel"><a href="#">Bienvenue <?php echo $_SESSION['nom'];?></a></li>
				<li><a class="michel" href="Deconnexion.php">Deconnexion</a></li>
			<?php
                }else{
            ?>
                <li class="michel"><a class="michel" href="ConnexionClient.php">Se connecter</a></li>
				<li class="michel"><a class="michel" href="CreationCompte.php">S'inscrire</a></li>
                
            <?php
                }
            ?>
            </ul>
            <h1>ABDOU&DUMONT website</h1>
        </header>
        <nav>
            <div class="Centre">
                <ul>
                    <li class="Accueil"><a href="Accueil.php">Accueil</a></li>
                    <li class="Categories"><a href="#">Categories</a>
                        <ul class="sous">
                            <?php
                                $con = new mysqli('localhost','root','','bdd_projetweb');
                                if($con->connect_error){
                                    die("Connection failed: ". $con->connect_error);
                                }
                                $req="select * from categories";
                                $res=$con->query($req);
                                if(!$res){
                                        $req1="CREATE TABLE categories(
                                            id int(10) primary key,
                                            nom varchar(40),
											page varchar(40)
                                        );";
                                    $res1=$con->query($req1);
                                    $req="insert into categories values('1','PC','categories.php')";
                                    $res=$con->query($req);
                                    $req="insert into categories values('2','Objets Connectes','categories.php')";
                                    $res=$con->query($req);
                                    $req="select * from categories";
                                    $res=$con->query($req);
                                    if(!$res)
                                        echo "<script>alert('Il y a un dysfonctionnement');</script>";
                                }else if($res=$con->query($req)){
                                    while($row=$res->fetch_assoc()){
                                        
                                        echo '<li>
                                                    <a href="'.$row["page"].'?id_cat='.$row["id"].'">'.$row["nom"].'</a>';
                                        echo '</li>';
                                    }
                                }
                            ?>    
                        </ul>
                    </li>
                    <?php
                        if(isset($_SESSION['nom'])){
                    ?>    
                        <li class="Panier"><a href="Panier.php">Panier</a></li>
                        <li class="Compte"><a href="Compte.php">Compte</a></li>
                    <?php
                        }else{
                    ?> 
                        <li class="Panier"><a href="ConnexionClient.php">Panier</a></li>
                        <li class="Compte"><a href="ConnexionClient.php">Compte</a></li>
                    <?php
                        }
                    ?>       
                    <li class="Contact"><a href="Contact.php">Contact</a></li>
                </ul>
            </div>
        </nav>
		<div>
			<fieldset>
				<div class="SousGauche">
				<fieldset>
					<legend>Carte actuelle :</legend>
					<?php
						$req="Select * from carte where id='".$_SESSION['id']."'";
						$res=$con->query($req);
						if(!$res){
					?>
					<form method="POST" action="validation.php">
						<label>Carte N° :</label><input name="numcarte" id="num_carte" type="text" placeholder="9999 9999 9999 9999" data-inputmask="'mask': '9999 9999 9999 9999'" value="<?php echo $row['numero_carte'] ?>"/><br>
						<label>CVV :</label><input name="cryptogramme" id="crypto" type="password" placeholder="XXX" value="<?php echo $row['cryptogramme']; ?>"/><br>
						<label>Mois/Annee :</label><input name="date" id="cc" type="text" placeholder="MM/YYYY" class="masked" pattern="(1[5-9]|2\d)\/(1[0-2]|0[1-9])" data-valid-example="05/2021" min="06/2021" max="12/2099" value="<?php echo $row['date']?>"/><br>
						<input type="submit" name="Ajouter">
					</form>
				</fieldset>
                <?php
                    }else{
                        $row=$res->fetch_assoc();
                        echo'<fieldset>
                        <p>Nom : '. $row['numero_carte'].'</p>
                        <p>Prénom : '.$row['cryptogramme'].'</p>
                        <p>Email : '.$row['date'].'</p>
                        </fieldset>';
                    }
                ?>
				</div>
				<div class="SousDroite">
				<fieldset>
					<legend>Changer de carte :</legend>
					<form method="POST" action="validation.php">
						<label>Carte N° :</label><input name="numcarte" id="num_carte" type="text" placeholder="9999 9999 9999 9999" data-inputmask="'mask': '9999 9999 9999 9999'"/><br>
						<label>CVV :</label><input name="cryptogramme" id="crypto" type="password" placeholder="XXX"><br>
						<label>Mois/Annee :</label><input name="date" id="cc" type="text" placeholder="MM/YYYY" class="masked" pattern="(1[5-9]|2\d)\/(1[0-2]|0[1-9])" data-valid-example="05/2021" min="06/2021" max="12/2099"/><br>
						<input type="submit" name="Ajouter">
					</form>
				</fieldset>
				</div>
			</fieldset>
		</div>
    </body>
</html>