<?php  

session_start();
include "../db_conn.php";

if (isset($_POST['Email']) && isset($_POST['MotDePasse'])) {

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$email = test_input($_POST['Email']);
	$password = test_input($_POST['MotDePasse']);

	if (empty($email)) {
		header("Location: login-index.php?error=User Name is Required");
	}else if (empty($password)) {
		header("Location: login-index.php?error=Password is Required");
	}else {
        $sql = "SELECT * FROM Utilisateur WHERE Email='$email' AND MotDePasse='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
        	
        	$row = mysqli_fetch_assoc($result);
        	if ($row['MotDePasse'] === $password && $row['Email'] === $email) {
        		$_SESSION['ID_Utilisateur'] = $row['ID_Utilisateur'];
        		$_SESSION['Email'] = $row['Email'];
        		$_SESSION['NomComplet'] = $row['NomComplet'];

				header("Location: redirect.php");

        	}else {
        		header("Location: login-index.php?error=Incorect User name or password");
        	}
        }else {
        	header("Location: login-index.php?error=Incorect User name or password");
        }

	}
	
}else {
	header("Location: redirect.php");
}