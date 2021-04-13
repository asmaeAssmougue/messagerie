<?php
session_start();
include ("connexion.php");
if(empty($_SESSION['id_user'])){
    header("Location: authentification.php?error=emptysession");
    exit();
}
else{
	$id_user=$_SESSION['id_user'];
    $sql1="SELECT * FROM `user` WHERE id_user='".$id_user."'";
    $rst1=mysqli_query($link,$sql1);
    $data1=mysqli_fetch_assoc($rst1);
    if(isset($_POST['connexion'])){
  $username=addslashes(htmlspecialchars($_POST['name']));
  $pwd=addslashes(htmlspecialchars($_POST['password']));
  $r_pwd=addslashes(htmlspecialchars($_POST['re_password']));
  $email=addslashes(htmlspecialchars($_POST['email']));
  if(isset($_FILES['fichier']) and $_FILES['fichier']['error']==0)
  {
    $dossier = 'photo/';
    $temp_name = $_FILES['fichier']['tmp_name'];
    if(!is_uploaded_file($temp_name))
    {
            exit("le fichier est introuvable");
    }
        if($_FILES['fichier']['size'] >= 1000000){
          exit("Erreur le fichier est volumineux");
        }
        $infosfichier = pathinfo($_FILES['fichier']['name']);
        $extension_upload = $infosfichier['extension'];
        $extension_upload = strtolower($extension_upload);
        $extensions_autorisee = array('jpg','png','jpeg');
        if(!in_array($extension_upload,$extensions_autorisee))
        {
          exit("Erreur , veuillez inserer une image(extension autorise: png)");

        }
        $nom_photo=$username.".".$extension_upload;
        if(!move_uploaded_file($temp_name, $dossier.$nom_photo)){
          exit("Problem dans le téléchargement de l'image, ressayez");

        }
        $ph_name=$nom_photo;
        
  }
  else{
     $ph_name="inconnu.jpg";
  }
  if(empty($username)||empty($pwd)||empty($r_pwd)||empty($email)||empty($ph_name)){
    echo "<span style=\"color:#fff; background-color:red;font-size:1.2em;\">veuillez remplir tous les champs</span>";
  }
  else{
    if($r_pwd!=$pwd){
  echo "<span style=\"color:#fff; background-color:red;font-size:1.2em;\">repassword Incorrect</span>";
      }
   else{
    $sql1="UPDATE `user` SET `username`='$username',`password`='$pwd',`email`='$email',`photo`='$ph_name' WHERE id_user='".$id_user."'";
       
       $rslt1=mysqli_query($link,$sql1);
       if($rslt1){
        echo "<span style=\"color:#fff; background-color:green;font-size:1.2em;\">votre Profil est Modifié</span>";
       
       }
       else{
        echo "<span style=\"color:#fff; background-color:red;font-size:1.2em;\">error sql ressayez</span>";
       }
   }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier profil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="" method="post" enctype="multipart/form-data">
     	<p>Vous pouvez modifier vos informations:</p>
     	<label>Nom d'utilisateur</label>
     	<input type="text" name="name" value="<?php 
        
              echo (isset($data1['username'])) ? $data1['username'] : '';
          ?>"><br>
     	<label>mot de passe</label>
     	<input type="password" name="password" value="<?php 
        
              echo (isset($data1['password'])) ? $data1['password'] : '';
          ?>"><br>
     	<label>mot de passe(verification)</label>
        <input type="password" name="re_password" value="<?php
              echo (isset($data1['password'])) ? $data1['password'] : '';
          ?>"><br>
        <label>Email</label>
         <input type="email" name="email" value="<?php 
        
              echo (isset($data1['email'])) ? $data1['email'] : '';
          ?>"><br>
         <label for="photo">image personnelle:</label>
       <input type="file" name="fichier" value="<?php 
        
              echo (isset($data1['photo'])) ? $data1['photo'] : '';
          ?>"><br><br>
       <button type="submit" name="connexion">envoyer</button>

     </form>
</body>
</html>
<?php } mysqli_close($link); ?>