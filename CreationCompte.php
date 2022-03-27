<?php
   /*Récupération des données pour transmission à la BDD*/
   /*@ est utilisé pour ignorer les warnings concernant les variables car elles ne sont pas directement utilisées*/ 
   @$civilite=$_POST['civilite'];
   @$nom=$_POST['nom'];
   @$prenom=$_POST['prenom'];
   @$email=$_POST['email'];
   @$password=$_POST['pass'];
   @$repassword=$_POST['repass'];
   @$adresse=$_POST['adresse'];
   @$ville=$_POST['ville'];
   @$valider=$_POST['valider'];
   /*Message d'erreur si un champ est vide ou invalide défini à null pour éviter les erreurs*/ 
   @$message=null;
   @$message_civilite=null;
   @$message_nom=null;
   @$message_prenom=null;
   @$message_email=null;
   @$message_pass=null;
   @$message_repass=null;
   @$message_adresse=null;
   @$message_ville=null;

   
   /*Verification des champs saisis*/ 
   if(isset($valider)){
        if(empty($nom)&&empty($prenom)&&empty($email)&&empty($password)&&empty($username)&&empty($adresse)&&empty($ville)){
            $message='<div class="erreur">Champ vide.</div>';
        }
        if($civilite=="--")
            $message_civilite='<div class="erreur">Champ vide.</div>';
        elseif(empty($nom))
            $message_nom='<div class="erreur">Champ vide.</div>';
        elseif(empty($prenom))
            $message_prenom='<div class="erreur">Champ vide.</div>';
        elseif(empty($email))
            $message_email='<div class="erreur">Champ vide.</div>';
        elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
            $message_email='<div class="erreur">Champ invalide.</div>';
        elseif(empty($password))
            $message_pass='<div class="erreur">Champ vide.</div>';
        elseif($password!=$repassword)
            $message_repass='<div class="erreur">Les mots de passe ne sont pas identiques.</div>';
        elseif(empty($adresse))
            $message_adresse='<div class="erreur">Champ vide.</div>';
        elseif(empty($ville))
            $message_ville='<div class="erreur">Champ vide.</div>';
        
        else{
           /*Connexion à la BDD pour enregistrer le contenu qui a été saisi*/
            $con = new mysqli('localhost','root','','bdd_projetweb');
            if($con->connect_error){
                  die("Connection failed: ". $con->connect_error);
            }
            $req="select * from client";
            $res=$con->query($req);
            /*Verification de l'existence de la table client en envoyant une requête*/ 
            if(!$res){
               $req="CREATE TABLE client(
                  id int not null primary key,
                  civilite varchar(20) null,
                  nom varchar(30) null,
                  prenom varchar(30) null,
                  email varchar(60) null,
                  password varchar(15) null,
                  adresse varchar(60) null,
                  ville varchar(60) null
                );";
               $res=$con->query($req);
               $id=1;
               $req="insert into client VALUES('$id','$civilite','$nom','$prenom','$email','$password','$adresse','$ville')";
               $res= $con->query($req);
                  if($res){
                     /*Si la requête a été effectuée, renvoie vers la page de connexion*/
                     header("Location: http://projetweb/ConnexionClient.php");
                     exit();
                  }
                  else
                     echo "<script> alert('Il y a un dysfonctionnement');</script>";
            
            }else{
               $req="Select * from client order by id desc limit 1";/*Récupère l'Identifiant le plus grand*/ 
               $res=$con->query($req);
               $row=$res->fetch_assoc();
               $id = $row['id']+1;
               $req="INSERT INTO client VALUES('$id','$civilite','$nom','$prenom','$email','$password','$adresse','$ville')";
               $res= $con->query($req);
                  if($res){
                     /*Si la requête a été effectuée, renvoie vers la page de connexion*/
                     header("Location: http://projetweb/ConnexionClient.php");
                     exit();
                  }
                  else{
                     echo "<script> alert('Il y a un dysfonctionnement:')</script>";

                  }
            }
         }
   }
?>
<!DOCTYPE html>
<html>
   <head>
   <link rel="stylesheet" type="text/css" href="http://projetweb/Style.css?ver=<?php echo rand(111,999)?>" media="screen">
      <style>
         fieldset{
            border:solid 1px #EE6600;
            border-radius:10px;
            padding:20px;
            margin: 50px;
         }
         legend{
            font:bold 16pt arial;
            color:#EE6600;
         }
         input,select{
            border:solid 1px #AAAAAA;
            padding:10px;
            font:10pt verdana;
            color:#EE6600;
            outline:none;
            border-radius:6px;
            width: 55%;
         }

         input[type="submit"]{
            border:none;
            background-color:#EE6600;
            color:#FFFFFF;
            width:200px;
            cursor:pointer;
         }
         .label{
            margin-bottom:4px;
            font:10pt arial;
            color:#AAAAAA;
         }
         .champ{
            margin-bottom:20px;
         }
         .erreur{
            font:10pt arial;
            color:#DD0000;
            background-color:#EEEEEE;
            padding:10px;
            border-radius:10px;
            margin-bottom:10px;
         }
         .rappel{
            font:10pt arial;
            color:#888888;
            background-color:#EEEEEE;
            padding:10px;
            border-radius:10px;
            margin-bottom:10px;
         }
         .message{
            font-family:verdana;
            font-weight:500;
            color:#FF0101;
            margin-right: 35%;
            width: 55%;
            display: inline-block;
         }

         form{
            margin-left: 10%;
            margin-right:10%;
         }

         div.Gauche{
            float:left;
            width: 25%;
         }

         div.Droite{
            float:right;
            width: 70%;
         }

         
      </style>
   </head>
   <body>
      <!--Ici nous récupérons les champs saisis par le client lors de l'incription pour vérification-->
      <form method="POST" action="">
         <fieldset>
         <legend>Inscription</legend>
            <div class="Gauche">
            <div class="champ">
               <select name="civilite">
                  <option <?php if($civilite=="--") echo "selected";?>>--</option>
                  <option <?php if($civilite=="Madame") echo "selected";?>>Madame</option>
                  <option <?php if($civilite=="Monsieur") echo "selected";?>>Monsieur</option>
               </select>
               <div class="message"><?php echo $message_civilite ?></div>
               <div class="message"><?php echo $message ?></div>
            </div>

                  <div class="champ">
                     <input type="text" name="nom" placeholder="Nom" value="<?php echo $nom?>" />
                  </div>
                  <div class="message"><?php echo $message_nom ?></div>
                  <div class="message"><?php echo $message ?></div>


                  <div class="champ">
                     <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom?>" />
                  </div>
                  <div class="message"><?php echo $message_prenom ?></div>
                  <div class="message"><?php echo $message ?></div>


                  <div class="champ">
                     <input type="text" name="email" placeholder="Email" value="<?php echo $email?>" />
                  </div>
                  <div class="message"><?php echo $message_email ?></div>
                  <div class="message"><?php echo $message ?></div>


                  <div class="champ">
                     <input type="password" name="pass" placeholder="Mot de passe" value="<?php echo $password?>" />
                  </div>
                  <div class="message"><?php echo $message_pass ?></div>
                  <div class="message"><?php echo $message ?></div>


                  <div class="champ">
                     <input type="password" name="repass" placeholder="Confirmer mot de passe" value="<?php echo $repassword?>" />
                  </div>
                  <div class="message"><?php echo $message_repass ?></div>
                  <div class="message"><?php echo $message ?></div>

            </div>
            <div class="Droite">   
                  <div class="champ">
                     <input type="text" name="adresse" placeholder="Adresse" value="<?php echo $adresse?>" />
                  </div>
                  <div class="message"><?php echo $message_adresse ?></div>
                  <div class="message"><?php echo $message ?></div>


                  <div class="champ">
                     <input type="text" name="ville" placeholder="Ville" value="<?php echo $ville?>" />
                  </div>
                  <div class="message"><?php echo $message_ville ?></div>
                  <div class="message"><?php echo $message ?></div>               
                  
                  <div class="champ">
                     <input type="submit" name="valider" value="Valider l'inscription" />
                  </div>
            </div>
         </fieldset>
      </form>
   </body>
</html>