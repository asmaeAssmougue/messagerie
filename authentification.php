<?php
session_start();
include ('connexion.php');    
if(isset($_POST['connexion'])){
    if(isset($_POST['login']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

$username = validate($_POST['login']);
$pass = validate($_POST['password']);
if(empty($username)){
    header("Location: authentification.php?error=login is required");
    exit();
}else if(empty($pass)){
    header("Location: authentification.php?error=Password is required");
    exit();
}else{
    //hashing password
    
    $sql = "SELECT * FROM `user` WHERE username = '$username' AND password = '$pass'";
    $reslt = mysqli_query($link, $sql);
    if(mysqli_num_rows($reslt) === 1){
        $row = mysqli_fetch_assoc($reslt);
        if($row['username'] == $username && $row['password'] == $pass){
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['photo'] = $row['photo'];
            $_SESSION['id_user'] = $row['id_user'];
            header("Location: index.php");
            exit();
        }
        else{
            header("Location: authentification.php?error=Incorect User name or password");
                exit();
            }
        }
    else{
            header("Location: authentification.php?error=Incorect User name or password");
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
	 <title>Login</title>
	 <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
    <h2>Veuillez entrez vos identifiants pour vos connecter:</h2>	
    <?php if(isset($_GET['error'])){ ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <label>Nom d'utilisateur</label>
    <input type="text" name="login" placeholder="login"><br>
    <label>Mot de passe</label>
    <input type="password" name="password" placeholder="password"><br>
    <button type="submit" name="connexion">connexion</button>
    <a href="creer_compte.php" class="ca">Create an account</a>

</form>
</body>	 	 
</html>
<?php } mysqli_close($link); ?>

