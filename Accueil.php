<?php
    session_start();
?>
<DOCTYPE>
<html>
    <head>
        <title>Accueil</title>
        <meta charset="UTF-16">
        <meta name="Description" content="Site Web Personnel Statique">
        <link rel="stylesheet" type="text/css" href="http://projet_web/Style.css" media="screen">
        <style>
            p{
                margin-left:125px;
            }
        </style>
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
                                $con = new mysqli('localhost','root','','bdd_projetweb');
                                if($con->connect_error){
                                    die("Connection failed: ". $con->connect_error);
                                }
                                $req="select *from panier";
                                $res=$con->query($req);
                                if(!$res){
                                    $req="create table panier(
                                        id_panier int(10) primary key,
                                        id_produit int(10),
                                        nom_produit varchar(60),
                                        prix int(10),
                                        id_cartegorie int(10),
                                        id_client int(10)
                                    );";
                                    $res=$con->query($req);
                                }                                
                                $req="select * from carte";
                                $res=$con->query($req);
                                if(!$res){
                                    $req="create table carte(
                                        numero_carte int(19) primary key,
                                        cryptogramme int(3),
                                        date int(7),
                                        id_client int not null
                                    );";
                                    $res=$con->query($req);
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
        <fieldset>
        <legend>Presentation</legend>
            <section class="Présentation">
                <div class="Globale">
                    <div class="Gauche">
                            <img src="/Image/ImagePresentation.jpg" height="300" width="250">
                    </div>
                    <div class="Droite">
                            <p>Qu'est-ce ABDOU&DUMONT Website ?</p>
                            <p>Il s'agit d'un site permettant un choix parmi une gamme variée de produits technologiques.</p>
                            <p>Vous donnez le dernier est notre mot d'ordre, si vous n'êtes pas satifait pas de panique !</p>
                            <p>Nous serions ravi de répondre à votre avis qu'il soit positif ou péjoratif en allant dans la rubrique "Contact".</p>
                    </div>
                </div>
            </section>
        </fieldset>
    </body>
</html>