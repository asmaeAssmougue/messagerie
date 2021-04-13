<?php
session_start();
include ("connexion.php");
if(isset($_POST['envoyer'])){
  
  function validate($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
$pass = validate($_POST['password']);
$name = validate($_POST['name']);
$re_pass = validate($_POST['re_password']);
$email =validate($_POST['email']);

$user_data = 'name='. $name. '&email='. $email;
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
        $nom_photo=$name.".".$extension_upload;
        if(!move_uploaded_file($temp_name, $dossier.$nom_photo)){
          exit("Problem dans le téléchargement de l'image, ressayez");

        }
        $ph_name=$nom_photo;
        
  }
  else{
     $ph_name="inconnu.jpg";
  }
if(empty($pass)){
  header("Location: creer_compte.php?error=Password is required&$user_data");
  exit();
}else if(empty($name)){
  header("Location: creer_compte.php?error=name is required&$user_data");
  exit();
}
else if(empty($re_pass)){
  header("Location: creer_compte.php?error=Re Password is required&$user_data");
  exit();
}
else if($re_pass != $pass){
  header("Location: creer_compte.php?error=the confirmation password does not match&$user_data");
  exit();
}
else{
 
  
  $sql = "SELECT * FROM `user` WHERE username = '$name'";
  $reslt = mysqli_query($link, $sql);
  if(mysqli_num_rows($reslt) > 0){
    
      header("Location: creer_compte.php?error=The name is taken try another&$user_data");
      exit();
    }
    else{
      $sql2 = "INSERT INTO  `user`(`id_user`, `username`, `password`, `email`, `photo`) VALUES (0,'$name', '$pass', '$email','$ph_name')";
      $reslt2 = mysqli_query($link, $sql2);
      if($reslt2){
        header("Location: authentification.php?success=Your account has been created successflly");
      exit();
      }
      else{
        header("Location: creer_compte.php?error=unknown error occurred&$user_data");
      exit();
      }

    }
  
}
}
else{
  
  ?>
<!DOCTYPE html>
<html>
<head>
	 <title>Creer compte</title>
	 <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
    <h2>Veuilllez remplir ce formulaire pour s'inscrire</h2>	
    <?php if(isset($_GET['error'])){ ?>
    <p class="error"><?php echo $_GET['error'];  ?></p>
    <?php } ?>

    <?php if(isset($_GET['success'])){ ?>
    <p class="success"><?php echo $_GET['success'] ?></p>
    <?php } ?>


    <label>Nom d'utilisateur</label>
    <?php if(isset($_GET['name'])){ ?>
    <input type="text" name="name" placeholder="Name" value="<?php echo $_GET['name'];  ?>"><br>
    <?php }else{ ?>
    <input type="text" name="name" placeholder="Name"><br>
    <?php } ?>
    <label>mot de passe</label>
    <input type="password" name="password" placeholder="password"><br>
    <label>mot de passe(verification)</label>
    <input type="password" name="re_password" placeholder="re_password"><br>
  
          <label>Email</label>
    <?php if (isset($_GET['email'])) { ?>
               <input type="email" 
                      name="email" 
                      placeholder="email"
                      value="<?php echo $_GET['email']; ?>"><br>
          <?php }else{ ?>
               <input type="email" 
                      name="email" 
                      placeholder="email" required="required"><br>
          <?php }?>
    
    <label for="photo">image personnelle:</label>
       <input type="file" name="fichier"><br><br>
    <button type="submit" name="envoyer">envoyer</button>
    <a href="authentification.php" class="ca">Already have an account</a>

</form>
</body>	 	 
</html>
<?php } mysqli_close($link); ?>	
