<?php
session_start();
include ("connexion.php");
if(empty($_SESSION['id_user'])){
    header("Location: authentification.php?error=emptysession");
    exit();
}
else{
    $id_destinataire=$_SESSION['id_user'];
    $sql1="SELECT * FROM `message` WHERE id_destinataire='".$id_destinataire."'";
    $rst1=mysqli_query($link,$sql1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Boite de reception</title>
	<meta charset="utf-8">
	<style type="text/css">

	
		th,td{
			padding-right:35px;
			padding-bottom:15px;
		}
		h1{
			font-size:1.3em;
			font-weight:bold;
			color:#03045e;
		}
        .error{
        	font-size:1.3em;
        	color:red;
        }
        .menu{

        	font-size:1.2em;
        }
	</style>
</head>
<body>
	<h1>Boite de reception:</h1>
	<?php
	if(mysqli_num_rows($rst1)==0){
				echo "<span class=\"error\">Vous n'avez aucune message</span>"."<br>";
				echo "<span class=\"menu\"><a href=\"index.php\">retour vers menu</a></span>";
			}
	else{		
			?>
      <table border="0" cellspacing="0" cellpadding="1">
      	<tr>
				<th>Titre</th>
				<th>Expediteur</th>
				<th>Date d'envoi</th>
				<th>Message</th>
			</tr>
			<?php
            while($data1=mysqli_fetch_assoc($rst1)){
            	$titre=$data1['titre'];
            	$id_expediteur=$data1['id_expediteur'];
            	$date_envoi=$data1['date_message'];
            	$message=$data1['message'];
            	if($titre!="" && $id_expediteur!="" && $date_envoi!="" && $message!=""){
            		$sql2="SELECT * FROM `user` WHERE id_user='".$id_expediteur."'";
            		$rst2=mysqli_query($link,$sql2);
                    $data2=mysqli_fetch_assoc($rst2);
                    $expediteur=$data2['username'];

                    if($expediteur!=""){
                          echo "<tr>";
            	echo "<td>".$titre."</td>";
            	echo "<td>".$expediteur."</td>";
            	echo "<td>".$date_envoi."</td>";
            	echo "<td>".$message."</td>";
            	echo "</tr>";
                    }

            	}
           }
       
			?>

      </table>
  <?php 
  echo "<span class=\"menu\"><a href=\"index.php\">retour vers menu</a></span>";
  } ?>
</body>
</html>
<?php } mysqli_close($link); ?>
