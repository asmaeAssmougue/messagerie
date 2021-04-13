<?php 
session_start();
include('connexion.php');
if(empty($_SESSION['username'])){
	header("Location: authentification.php?error=emptysession");
	exit();
}
else{
	$username=$_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>index</title>
	<meta charset="utf-8">
	<style type="text/css">
		body{
			background-color:#48cae4;
		}
	h1{
		color:#03071e;
		font-size:1.7em;
		text-align:center;
        font-weight: bold;
	}
	p{
		font-size:1.2em;
		margin-left:10px;
	}
	.menu ul{
		background-color:#efd3d7;
		color:#370617;
		font-size:1.3em;
		text-align:center;
		margin:10px 20px;
		list-style-type: none;
        font-weight: bold;
	}
	.menu ul a{
        text-decoration: none;
	}
	.menu li a:active{
	    color: white;
     }
    .menu li a:visited{
	       color: #03071e;
    }

	</style>
</head>
<body>
      <h1>Espace membre</h1>
      <p>Bonjour <?php echo (isset($username)) ? $username : ''; ?><br>
       Bienvenue sur notre site<br>
       Vous pouvez voir la liste des utilisateurs<br>
       <div class="menu">
       	<ul>
       		<li><a href="liste_utilisateurs.php">liste des utilisateurs</a></li>
       		<li><a href="boite_reception.php">Boite de reception</a></li>
       		<li><a href="poster.php">nouveau message</a></li>
       		<li><a href="modifier_profil.php">modifier profil</a></li>
       		<li><a href="deconnexion.php">Se deconnecter</a></li>
       	</ul>
       	
       </div>
      	
      </p>

</body>
</html>
<?php } mysqli_close($link); ?>