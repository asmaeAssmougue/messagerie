<?php
session_start();
include('connexion.php');
if(empty($_SESSION['username'])){
	header("Location: authentification.php?error=emptysession");
	exit();
}
else{
	$username=addslashes(htmlspecialchars($_SESSION['username']));
	if(isset($_POST['connexion'])){
	$expediteur=addslashes(htmlspecialchars($_SESSION['username']));
	$titre=addslashes(htmlspecialchars($_POST['titre']));
	$destinataire=addslashes(htmlspecialchars($_POST['destinataire']));
	$message=addslashes(htmlspecialchars($_POST['message']));
	if($expediteur!="" and $titre!="" and $destinataire!="" and $message!=""){
        $sql1="SELECT * FROM `user` WHERE username='".$expediteur."'";
        $rslt1=mysqli_query($link,$sql1);
        
        if($data1=mysqli_fetch_assoc($rslt1)){
        	$id_expediteur=$data1['id_user'];
        	
        	 $sql2="SELECT * FROM `user` WHERE username='".$destinataire."'";
        $rslt2=mysqli_query($link,$sql2);
        $data2=mysqli_fetch_assoc($rslt2);
        if($data2==null || $destinataire!=$data2['username']){
        	echo "<span style=\"color:#fff; background-color:red;font-size:1.2em;\">destinataire non trouvé</span>";
        }
        else{
        	$id_destinataire=$data2['id_user'];
        	$sql3="INSERT INTO `message`(titre,id_destinataire,id_expediteur,message) VALUES ('$titre','$id_destinataire','$id_expediteur','$message')";
                $rslt3=mysqli_query($link,$sql3);
          if($rslt3){
                echo "<span style=\"color:#fff; background-color:green;font-size:1.2em;\">messageEnvoyé avec succes</span>";
          }
          else{
                echo "<span style=\"color:#fff; background-color:red;font-size:1.2em;\">problem lors de l'insertion</span>";
          }        
	}
        }
               
}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Message privé</title>
	<meta charset="utf-8">
	<style type="text/css">
	h1{
		font-size:1.4em;
		text-align:center;
		font-weight:bold;
	}	
	label{
		display:inline-block;
		width:200px;
		margin-top:10px;
	}
	label,textarea{
		vertical-align:top;
	}
	button{
		margin-bottom:10px;
	}
	</style>
</head>
<body>
	<h1>Nouveau message privé</h1>
     <p>Veuilllez remplir ce formulaire pour envoyer le MP.</p>
     <form action="" method="post">
     <label>Titre</label>
    <input type="text" name="titre" required="required"><br>
    <label>Destinataire</label>
    <input type="text" name="destinataire" required="required"><br>
   <label>Message</label>
   <textarea  name="message" rows="4" cols="50" required="required"></textarea><br>
    <button type="submit" name="connexion">Envoyer</button>
    </form>
    <a href="index.php" class="ca">retour vers le menu</a>

</body>
</html>
<?php } mysqli_close($link); ?>