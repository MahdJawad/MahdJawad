<?php
if(isset($_POST['login'])){
  $login = $_POST['login'];
  $password = $_POST['password'];
  $requete = mysqli_query($connection, "select * from user inner join profil on profil.id = user.profil_id where login='$login' and password=md5('$password')  limit 1") or die(mysqli_error($connection));
 
  if(mysqli_num_rows($requete)>0) {
    $user = mysqli_fetch_all($requete);
    $_SESSION['login'] = $user[0]['1'];
    $_SESSION['profil'] = $user[0]['3'];
    $_SESSION['libelleprofil'] = $user[0]['7'];
    $_SESSION['tconnexion']=time();
    $_SESSION['temps']=900;
   echo " <script type='text/javascript'>document.location.href='./?page=accueil'; </script>";
  }
  else {
    echo "Login ou mot de passe incorrect";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Login - HRMS admin template</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="#"><img src="assets/img/logo2.png" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Connection</h3>
							<p class="account-subtitle"></p>
							
							<!-- Account Form -->
							<form id="formAuthentication" class="mb-3" action="./?page=login" method="POST">
								<div class="form-group">
									<label>Login</label>
                  <input type="text" class="form-control" id="email" name="login" placeholder="Entrer le nom d'utilisateur" autofocus="">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Mot de passe</label>
										</div>
									</div>
									<div class="position-relative">
                  <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
										<span class="fa fa-eye-slash" id="toggle-password"></span>
									</div>
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Se connecter</button>
								</div>
								<div class="account-footer">
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
    </body>
</html>
	