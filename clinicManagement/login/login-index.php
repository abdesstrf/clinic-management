<?php 
//login template
   session_start();
   if (!isset($_SESSION['Email']) && !isset($_SESSION['ID_Utilisateur'])) {   

?>

<!DOCTYPE html>
<html>
<head>
<title>LOGIN</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!-- <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<style>
/* Add background image */
body {
  background-image: url("../includes/img/Background.png");
  background-size: cover;
  background-position: center;
}
/* Center the form container on the page */
.form-container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
}
</style>
</head>
<body>
  <div class="form-container" id="box">
    <form method="post" action="check-login.php"  class="shadow-sm p-3 mb-5 bg-tranparent rounded">
    <div class="text-center">
      <!-- add your own logo -->
      <img src="../includes/img/myLogo.png" style="width: 138px; height: 138px;">
    </div>
    <label for="email" >Email:</label>
    <input type="email" id="email" name="Email" placeholder="exemple@tfci.tg" class="form-control mb-3">

    <div class="form-group">
      <label for="password">Password:</label>
      <div class="input-group">
          <input type="password" class="form-control" onkeyup="validateInput()" placeholder="************" id="password" name="MotDePasse">
          <div class="input-group-append">
            <span class="input-group-text bg-white"  onclick="showPassword()">
              <i class="fa fa-eye"></i>
            </span>
          </div>
        </div>
        <div id="message" class="invalid-feedback"></div>
    </div>

    <div class="text-center">
      <input type="submit" id="login" value="Se connecter" class="btn btn-dark">
    </div>
    <div id="error"></div>
  </form>
</div>
</body>
<script type="text/javascript" >
  function validateInput() {
  var input = document.getElementById("password");
  var message = document.getElementById("message");

  if(input == "") {
    message.innerHTML = "Please enter a password";
    input.classList.add("is-invalid");
  } else {
    message.innerHTML = "";
    input.classList.remove("is-invalid");
  }
};

function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</html>


<?php }else{
	header("Location: redirect.php");
} ?>