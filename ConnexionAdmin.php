<?php 
session_start();
    @$login=$_POST['login'];
    @$password=$_POST['password'];
    @$valider=$_POST['submit'];
    @$message_login=null;
    @$message_mdp=null;
    
    $con = new mysqli('localhost','root','','bdd_projetweb');
    if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
    
    if(isset($valider)){
        if((empty($email))&&(empty($password))){
            $message_login='<div class="erreur">Champ vide.</div>';
            $message_mdp='<div class="erreur">Champ vide.</div>';  
        }
        elseif(empty($login))
            $message_login='<div class="erreur">Champ vide.</div>';
        elseif(empty($password))
            $message_mdp='<div class="erreur">Champ vide.</div>';     
        else
        {
            $req="SELECT login,password FROM Admin";
            $res= $con->query($req);
            if(!$res){
                $req="CREATE TABLE Admin(
                   login varchar(10) primary key,
                   password varchar(20),
                 );";
                $res= $con->query($req);
                $req="insert into admin values('$login','$password')";
                $res= $con->query($req);
                echo "<script> alert('Connecté en tant qu'ADMIN !');</script>";
                header('Location: http://projetweb/Gestion.php');
            }else{
                if($res=$con->query($req)){
                    while($row=$res->fetch_assoc()){    
                    if(($row['login']==$login) && ($row['password']==$password)){
                        $_SESSION['id']=$row['id'];
                        header('Location: http://projetweb/Gestion.php');
                        exit();
						}
					}
				}
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
            width: 50%;
         }
        </style> 
    </head>
    <body>
        <fieldset>
            <legend>Connexion</legend>
            <div class="Client">
                <form name="Client" method="POST">
                    <input type="text" name="login" placeholder="Login" value="<?php echo $login?>"><br><br>
                    <div class="message"><?php echo $message_login ?></div><br>
                    <input type="password" name="password" placeholder="Mot de passe" value=""><br><br>
                    <div class="message"><?php echo $message_mdp ?></div><br>
                    <input type="submit" name="submit" value="Se connecter">
                </form><br>
            </div>
        </fieldset>
    </body>
</html>