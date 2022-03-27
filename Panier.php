<?php
    session_start();
    $con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
    @$quantite=$_POST['quantite']
?>
<DOCTYPE>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="Description" content="Site Web Personnel Statique">
        <link rel="stylesheet" type="text/css" href="http://projetweb/Style.css?ver=<?php echo rand(111,999)?>" media="screen">
       
    </head>
    <body>
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
                    <li class="Categories"><a href="#">Categorie</a>
                        <ul class="sous">
                            <?php
                                $req="select * from categories";
                                $res=$con->query($req);
                                if(!$res){
                                        $req1="CREATE TABLE categories(
                                            id int(10) primary key,
                                            nom varchar(40),
                                            page varchar(40)
                                        );";
                                    $res1=$con->query($req1);
                                    $req="insert into categories values('1','PC','Categories.php')";
                                    $res=$con->query($req);
                                    $req="insert into categories values('2','Objets Connectes','Categories.php')";
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
            $req="select * from panier where id_client='".$_SESSION['id']."'";
            $res=$con->query($req);
            if(!$res){
            echo '<center><h1>LE PANIER EST VIDE</h1><center>';
            }else{
            echo'<fieldset>';
            while($row=$res->fetch_assoc()){
                echo '<div>';
                    echo '<p>Nom : '.$row["nom_produit"].'</p><p>Prix : '.$row["prix"].'€</p>';
                echo '</div>';
            }     
        ?>
        <form action="paiement.php">
            <?php
                @$prix_final=0;
                $req="select prix from panier";
                if($res=$con->query($req)){
                    while($row=$res->fetch_assoc()){
                        $prix_final= $prix_final+$row['prix'];
                    }
                }
                echo '<p>Total prix: '.$prix_final.'€</p>';
            ?>
                <input type="submit" name="submit" value="Paiement carte">
        </form>
        </fieldset>
        <?php 
            }
        ?>
    </body>        
</html>