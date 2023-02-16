<?php 
// this code is for redirecting to different pages if the credentials are correct.
   session_start();
  
   if (isset($_SESSION['Email']) && isset($_SESSION['ID_Utilisateur'])) {  
	
		echo $_SESSION['Email'];
       	header("Location: ../home/acceuil.php");
 }
else{
	header("Location: login-index.php");
} ?>
