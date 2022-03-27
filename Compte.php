<?php 
    session_start();
    $con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    } 
    @$new_nom=$_POST['newnom'];
    @$new_prenom=$_POST['newprenom'];
    @$new_email=$_POST['newemail'];
    @$new_mdp=$_POST['newpassword'];
    @$new_adresse=$_POST['newadresse'];
    @$new_ville=$_POST['newville'];
    @$valider=$_POST['submit'];
    @$retour=$_POST['retour'];
    @$message=null;

    if(isset($retour)){
        header('Location: http://projetweb/Accueil.php');
        exit();
    }
    if(isset($valider)){
        if(!empty($new_nom)){
            $req="update client set nom='".$new_nom."' where id='".$_SESSION['id']."'";
            $res=$con->query($req);

        }else if(!empty($new_prenom)){
            $req="update client set prenom='".$new_prenom."' where id='".$_SESSION['id']."'";
            $res=$con->query($req);

        }else if(!empty($new_email)&&filter_var($new_email,FILTER_VALIDATE_EMAIL)){
            $req="update client set email='".$new_email."' where id='".$_SESSION['id']."'";
            $res=$con->query($req);

        }else if(!empty($new_email)&&!filter_var($new_email,FILTER_VALIDATE_EMAIL)){
            $message='<div class="erreur">Email invalide.</div>';

        }else if(!empty($new_mdp)){
            $req="update client set password='".$new_mdp."' where id='".$_SESSION['id']."'";
            $res=$con->query($req);


        }else if(!empty($new_adresse)){
            $req="update client set adresse='".$new_adresse."' where id='".$_SESSION['id']."'";
            $res=$con->query($req);

        }else if(!empty($new_ville)){
            $req="update client set ville='".$new_ville."' where id='".$_SESSION['id']."'";
            $res=$con->query($req);
        }
    }
?>
<DOCTYPE>
    <html>
    <head>
        <title>Site de vente en ligne</title>
        <link rel="stylesheet" type="text/css" href="http://projetweb/Style.css?ver=<?php echo rand(111,999)?>" media="screen">
        <style>
        body{
            text-align: center;
        }
        fieldset{
            border:solid 1px #EE6600;
            border-radius:10px;
            padding:10px 0px 10px 0px;
            margin:10px 20px 10px 20px;
            float:center;
            display: inline;
            overflow: hidden;
         }

         fieldset#Info{
             padding: 0px 10px 0px 10px;
             margin: 20px 0px 20px 0px;
         }
         .champ{
             display: inline;
         }

         input[name="newnom"],input[name="newprenom"]{
             width: 125px;
         }

         input[name="newemail"],input[name="newpassword"]{
             width: 175px;
         }
         input[name="newnom"],input[name="newprenom"],input[name="newemail"]{
            margin-left: 0px; 
         }
         input[name="newadresse"],input[name="newville"]{
            width: 200px;
         }
         
         input{
            border:solid 1px #AAAAAA;
            margin:10px 100px 10px 0px;
            padding:5px;
            font:10pt verdana;
            color:#000000;
            outline:none;
            border-radius:6px;
         }

         div.Client div.SousGauche div.champ{
            margin-right: 8px;
        }

         input#button{
            border:none;
            background-color:#EE6600;
            color:#FFFFFF;
            width:150px;
            cursor:pointer;
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
                                $req="select * from carte";
                                $res=$con->query($req);
                                if(!$res){
                                    $req="create table carte(
                                        numero_carte int(19) primary key,
                                        cryptogramme int(3),
                                        date int(7)
                                        id_client int not null
                                    );";
                                    $res=$con->query($req);
                                }
                                $req="select * from categories";
                                $res=$con->query($req);
                                if(!$res){
                                        $req1="CREATE TABLE categories(
                                            id int(10) primary key,
                                            nom varchar(40)
                                        );";
                                    $res1=$con->query($req1);
                                    $req="insert into categories values('1','PC')";
                                    $res=$con->query($req);
                                    $req="insert into categories values('2','Objets Connectes')";
                                    $res=$con->query($req);
                                    $req="select * from categories";
                                    $res=$con->query($req);
                                    if(!$res)
                                        echo "<script>alert('Il y a un dysfonctionnement');</script>";
                                }else if($res=$con->query($req)){
                                    while($row=$res->fetch_assoc()){
                                        
                                        echo '<li>
                                                    <a href="Categories.php">'.$row["nom"].'</a>';
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
        <section class="Présentation">
            <div class="Client">
                <fieldset>
                <legend>Information Compte</legend>
                    <?php   
                            $req="select * from client where id='".$_SESSION['id']."'";
                            if($res=$con->query($req)){
                                $row=$res->fetch_assoc();
                                $nom=$row['nom'];
                                $prenom=$row['prenom'];
                                $email=$row['email'];
                                $password=$row['password'];
                                $adresse=$row['adresse'];
                                $ville=$row['ville'];
                                    echo 
                                    '<div class="SousGauche">
                                            <fieldset id="Info">
                                            <p>Nom : '. $nom.'</p>
                                            <p>Prénom : '.$prenom.'</p>
                                            <p>Email : '.$email.'</p>
                                            <p>Mot de passe : '.$password.'</p>
                                            <p>Adresse : '.$adresse.'</p>
                                            <p>Ville : '.$ville.'</p>
                                            </fieldset>
                                    </div>';
                                    ?>
                                    <div class="SousDroite">
                                        <form method="POST" action="">
                                            <div class="SousGauche">
                                                <div class="champ">
                                                    <input type="text" placeholder="Nouveau nom" name="newnom"><br>
                                                </div>


                                                <div class="champ">
                                                    <input type="text" placeholder="Nouveau prenom" name="newprenom"><br>
                                                </div>


                                                <div class="champ">
                                                    <input type="text" placeholder="Nouvel email" name="newemail"><br>
                                                </div>
                                                <div class="message"><?php echo $message ?></div>

                                                <div class="champ">
                                                    <input type = "button" id="button" value = " < Retour"  onclick = "history.back()">
                                                </div>

                                            </div>
                                            <div class="SousDroite">

                                                <div class="champ">
                                                    <input type="password" placeholder="Nouveau mot de passe" name="newpassword"><br>
                                                </div>


                                                <div class="champ">
                                                    <input type="text" placeholder="Adresse" name="newadresse"><br>
                                                </div>


                                                <div class="champ">
                                                    <input type="text" placeholder="Ville" name="newville"><br>
                                                </div>


                                                <div class="champ">
                                                    <input type="submit" name="submit" value="Modifier">
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                <?php                          
                                    }else{
                                        echo "<script> alert('Il y a un dysfonctionnement!');</script>";
                                    }
                                ?>
                </fieldset>
            </div>
        </section>
    </body>
<html>