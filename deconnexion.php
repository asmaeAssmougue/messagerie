<?php
session_start();
session_unset();
session_destroy();
echo "<span style=\"color:#adb5bd;font-size:1.3em;background-color:#48cae4;\"><h1>Vous avez bien deconnecté</h1></span>";
echo "<a href=\"authentification.php\"><span style=\"color:#48cae4;font-size:1.2em;text-align:center;\">Acceuil</span></a>";
?>
