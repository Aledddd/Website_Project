<?php
    session_start();
	@$id_categ=$_GET['id_cat'];
?>
<DOCTYPE>
<html>
    <head>
        <title>Categorie</title>
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
			margin: 0px;
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
		<?php
			$req1="CREATE TABLE produit(
				id_prod int(10) primary key,
				id_categorie int(10),
				nom varchar(40),
				nom_image varchar(40),
				prix int(10)
			);";
			$res1=$con->query($req1);
			$req2="insert into produit values('1000','1','Acer Nitro 5','/Image/Nitro5.jpg','1000')";
			$res2=$con->query($req2);
			$req3="insert into produit values('1001','1','HP Pavilion 17','Image/Pavillon17.jpg','1500')";
			$res3=$con->query($req3);
			$req4="insert into produit values('1002','1','Millenium ML-3','Image/Milenium.jpg','1650')";
			$res4=$con->query($req4);
			$req5="insert into produit values('1003','1','Dell G3','Image/DellG3.jpg','1230')";
			$res5=$con->query($req5);				
			$req6="insert into produit values('1004','2','Samsung S21 Ultra','Image/S21Ultra.jpg','1200')";
			$res6=$con->query($req6);
			$req7="insert into produit values('1005','2','Samsung Galaxy fold 2','Image/ZFold2.jpg','1100')";
			$res7=$con->query($req7);
			$req8="insert into produit values('1006','2','IPhone 12','Image/Iphone12.jpg','1500')";
			$res8=$con->query($req8);
			$req9="insert into produit values('1007','2','One Plus 9 Pro','Image/OnePlus9Pro.jpg','950')";
			$res9=$con->query($req9);
			$req="select * produit";
            $res=$con->query($req);
		?>
		<div class="items_list">
			<div class="item">
				<fieldset>
				<?php
					$req="select * from produit";
                    $res=$con->query($req);
					while($row=$res->fetch_assoc()){
						if($_GET['id_cat']==$row["id_categorie"]){
                            if(($row['id_prod']%2)==0){
                                echo '<div class="SousGauche">';
								echo '<fieldset>';
                                    echo '<img src="'.$row['nom_image'].'"><p>Nom : '.$row["nom"].'</p><p>Prix : '.$row["prix"].'€</p>';
									echo '<a href="Add_panier.php?id_prod='.$row["id_prod"].'"><input type="submit" name="ajouter" value="Ajouter au panier"></a>';
                                echo '</fieldset>';
								echo '</div>';
                            }else{
                                echo '<div class="SousDroite">';
								echo '<fieldset>';
                                    echo '<img src="'.$row['nom_image'].'"><p>Nom : '.$row["nom"].'</p><p>Prix : '.$row["prix"].'€</p>';
									echo '<a href="Add_panier.php?id_prod='.$row["id_prod"].'"><input type="submit" name="ajouter" value="Ajouter au panier"></a>';
								echo '</fieldset>';
                                echo '</div>';
                            }
						}
					}
				?>
				</fieldset>
			</div>
		</div>
    </body>
</html>