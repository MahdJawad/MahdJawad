<?php include_once "pages/connect.php"; ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Plateforme de Gestion des Ressources Humaines">
		<meta name="keywords" content="ressources humaines, employes, paie, congés, absences, management">
        <meta name="author" content="Sirba Communication">
        
        <title> Sirba RH - Gestion des Ressources humaines</title>
		
		<!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="assets/css/line-awesome.min.css">
		
		<!-- Datatable CSS -->
		<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/css/select2.min.css">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
    <!-- jQuery -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
        <?php 
         if (isset($_GET['page'])) {
                          if (file_exists("pages/" . $_GET['page'] . ".php")) {
                            if (isset($_SESSION['profil']))
                            {
                              if (in_array($_GET['page'],$pages[$_SESSION['profil']]) or in_array($_GET['page'],$pages['common']) or($_SESSION['profil']==7))
                              {
                                $page_afficher = "pages/" . $_GET['page'] . ".php";
                              }
                              else 
                              $page_afficher = "pages/pasdroit.php";
                            }
                            else{
                              if($_GET['page']='login'){
                                $page_afficher = "pages/" . $_GET['page'] . ".php";
                              }

                            }
                            
                          } else {
                            $page_afficher = "pages/introuvable.php";
                          }
                        } else {
                          $page_afficher = "Pages/accueil.php";
                        }

        

          if ($page_afficher =='pages/login.php' and isset($_SESSION['login']))
          {
            echo "<script type='text/javascript'>document.location.href='./?page=accueil'; </script>";
          }

          if ($page_afficher !=='pages/login.php')
          {
            if(!isset($_SESSION['login']))
            {
              echo "<script type='text/javascript'>document.location.href='./?page=login'; </script>";
            }
            //decompte après X mn sans activite
            if (time()>($_SESSION['temps']+$_SESSION['tconnexion']))
            {
              echo "<script type='text/javascript'>document.location.href='./?page=logout'; </script>";
            }
            else 
            {
              $_SESSION['tconnexion']=time();
            }
            
          }

         

         ?>
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="" class="logo">
						<img src="assets/img/logo.png" width="40" height="40" alt="">
					</a>
                </div>
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
                <div class="page-title-box">
					<h3>Gestion des ressources humaines</h3>
                </div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">
		
					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<span class="user-img"><img src="assets/img/profiles/avatar-21.jpg" alt="">
							<span class="status online"></span></span>
							<span><?php echo $_SESSION['login']; ?></span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?php echo $_SESSION['libelleprofil']; ?>">My Profile</a>
							<a class="dropdown-item" href="./?page=logout">Logout</a>
						</div>
					</li>
				</ul>
        <!-- /Header Menu -->
    
    </div>
    <!-- /Header -->
   
	
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
            <?php
                if($page_afficher !=='pages/login.php'){
                    include_once "pages/menu.php";
                  }
            ?>
            
            </div>
        </div>
    </div>
    <!-- /Sidebar -->

<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
    
    <!-- Content Starts -->
    <div class="row"> <div class="col">
                                  <?php
                                    if(isset($_GET['message']) && $_GET['message']!=""){
                                      if($_GET['message']=="ModifOk"){
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Modification effectuée avec succès.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        </button>
                                      </div>';
                                      }

                                      if($_GET['message']=="ModifNOk"){
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Oups!!, modification non effectuée.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        </button>
                                      </div>';
                                      }

                                      if($_GET['message']=="AddOk"){
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Enrégistrement effectuée avec succès.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        </button>
                                      </div>';
                                      }

                                      if($_GET['message']=="AddNOk"){
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Oups!!, enrégistrement non effectuée.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        </button>
                                      </div>';
                                      }
                                      if($_GET['message']=="DeleteOk"){
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Suppresion effectuée avec succès.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        </button>
                                      </div>';
                                      }

                                      if($_GET['message']=="DeleteNOk"){
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Oups!!, suppresion non effectuée.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        </button>
                                      </div>';
                                      }
                                    }
                                  ?>
                                </div>  </div>
    <?php include_once $page_afficher; ?>
    <!-- /Content End -->
    
</div>
<!-- /Page Content -->

</div>
<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->


		<!-- Bootstrap Core JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>

		<!-- Slimscroll JS -->
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/js/select2.min.js"></script>
		
		<!-- Datatable JS -->
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/dataTables.bootstrap4.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
</body>
</html>