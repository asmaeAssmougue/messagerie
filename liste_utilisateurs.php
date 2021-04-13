<?php
session_start();
include('connexion.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>liste utilisateur</title>
	<meta charset="utf-8">
	<style type="text/css">
		body{
			width:900px;

		}
		
		th,td{
			padding-right:20px;
            width:150px;
            padding-bottom:10px;
		}
		a{
			
			color:red;
			font-size:1.3em;

		}
		.menu {
			position:relative;
			top:10px;
		}
		p{
			color:#03045e;
		}
		
		
	</style>
</head>
<body>
  <p style="font-size:1.3em;font-weight:bold;">Voici la liste des utilisateurs:</p>
     <table border="0" cellspacing="0" cellpadding="1">
			<tr>
				<th>Id</th>
				<th>Nom d'utilisateur</th>
				<th>Email</th>
			</tr>
			<?php
			$sql1="SELECT * FROM `user`";
			$rsl1=mysqli_query($link,$sql1);
			
            while($data1=mysqli_fetch_assoc($rsl1)){
            	$id=$data1['id_user'];
            	$username=$data1['username'];
            	$email=$data1['email'];
            	if($id!="" and $username!="" and $email!=""){
            	echo "<tr>";
            	echo "<td>".$id."</td>";
            	echo "<td>".$username."</td>";
            	echo "<td>".$email."</td>";
            	echo "</tr>";
            }
           }
			?>
      
     </table>
     <span class="menu"><a href="index.php">retour vers le menu</a></span>
</body>
</html>
<?php mysqli_close($link); ?>