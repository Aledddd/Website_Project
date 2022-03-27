<?php
    /*Session_start() permet de créer une session pour le client afin de garder des informations dans des variables globlales (voir un peu plus bas dans le code)*/
    session_start();
    /*variables qui récupère des champs saisis grâce à la balise form contenant la méthode POST*/
    @$email=$_POST['email'];
    @$password=$_POST['password'];
    @$valider=$_POST['submit'];
    @$message_email=null;
    @$message_mdp=null;
    @$compte=null;
    
    $con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
    
    if(isset($valider)){
        /*Vérifie si les champs sont vides et retourne un message*/
        if((empty($email))&&(empty($password))){
            $message_email='<div class="erreur">Champ vide.</div>';
            $message_mdp='<div class="erreur">Champ vide.</div>';  
        }
        elseif(empty($email))
            $message_email='<div class="erreur">Champ vide.</div>';
        elseif(empty($password))
            $message_mdp='<div class="erreur">Champ vide.</div>';     
        else
        {
            /*envoie une requête pour savoir si les informations rentrées existent*/
            $req="SELECT id,nom,email,password FROM client";
            if($res=$con->query($req)){
                    while($row=$res->fetch_assoc()){   
                        if(($row['email']==$email) && ($row['password']==$password)){
                            $_SESSION['id']=$row['id'];
                            $_SESSION['nom']=$row['nom'];
                            header('Location: http://projetweb/Accueil.php');
                            exit();
                        }
                    }
                    echo "<script> alert('Informations incorrectes, veuilez les resaisir ou veuillez vous inscrire !');</script>";
               
            }else{
                echo "<script> alert('Inscrivez-vous !');</script>";
            }
        } 
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
            margin:10px 20px 10px 20px;
            padding: 10px 50px 10px 50px;
            text-align: center;
            overflow: hidden;
         }

        legend{
            font:bold 16pt arial;
            color:#EE6600;
         }

         a,input{
            border:solid 1px #AAAAAA;
            padding:10px;
            font:10pt verdana;
            color:#EE6600;
            outline:none;
            border-radius:6px;
            width: 125px;
            display:inline;
         }


         .message{
            font-family:verdana;
            font-weight:500;
            color:#FF0101;
            width: 30%;
            display: inline-block;
         }
        
        .label{
            font:10pt arial;
            color:#000000;
            text-align: justify;
         }
         a:link{ 
            text-decoration:none; 
        }
        a{
            border:none;
            background-color:#EE6600;
            color:#FFFFFF;
            width:200px;
            cursor:pointer;
        }
        </style>
    </head>
    <body>
        <fieldset>
            <legend>Connexion</legend>
            <!--Ici nous récupérons les champs saisis par le client pour lors de la connexion pour vérification-->
            <div class="Client">
                <form name="Client" method="POST" action="">
                    <input type="email" name="email" placeholder="email" value='<?php echo $email ?>'><br><br>
                    <div class="message"><?php echo $message_email ?></div><br>
                    <input type="password" name="password" placeholder="Mot de passe"><br><br>
                    <div class="message"><?php echo $message_mdp ?></div><br>
                    <input type="submit" name="submit" value="Se connecter">
                </form><br>
                    <a href="CreationCompte.php">S'inscrire</a>
                    <a href="ConnexionAdmin.php">Accès Admin</a>
            </div>
        </fieldset>
    </body>
<html>