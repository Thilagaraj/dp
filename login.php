<?php 
session_start();
if(isset($_SESSION['email']) && $_SESSION['email']!=''){
	header('location:index');
	exit(0);
}
?>
<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>Dharani Printers | Login</title>

  <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="assets/images/logo-d.png">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="assets/css/site.css">

  <link rel="stylesheet" href="assets/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="assets/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="assets/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="assets/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="assets/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="assets/vendor/flag-icon-css/flag-icon.css">


  <!-- Page -->
  <link rel="stylesheet" href="assets/css/pages/login.css">
  <link rel="stylesheet" href="assets/vendor/formvalidation/formValidation.css">

  <!-- Fonts -->
  <link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="assets/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


  <!--[if lt IE 9]>
    <script src="assets/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="assets/vendor/media-match/media.match.min.js"></script>
    <script src="assets/vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="assets/vendor/modernizr/modernizr.js"></script>
  <script src="assets/vendor/breakpoints/breakpoints.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
<body class="page-login layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


  <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
  data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle">
      <div class="brand">
        <img class="brand-img" src="assets/images/logo-f.png" alt="...">
      </div>
      <p>Sign into your account</p>
	  <?php
		include('common/functions.php');
		if(isset($_REQUEST['email'])){
			$validUser=false;
			$userDetails=login($_REQUEST['email'],$_REQUEST['password']);
			if(!$userDetails){
				$validUser=false;
			}elseif(!empty($userDetails) && $userDetails->email!=''){
				
				$_SESSION['name']=$userDetails->name;
				$_SESSION['email']=$userDetails->email;
				$_SESSION['avatar']=$userDetails->avatar;
				$validUser=true;
			}else{
				$validUser=false;
			}
			if(!$validUser){
				echo '<div class="alert alert-danger" style="background:#fff;"><b>Invalid Email and Password, Please try again</b></div>';
			}else{
				echo '<div class="alert alert-success" style="background:#fff;"><b>Success logging in please wait...</b></div>';				
				echo '<script>window.location.href="index"</script>';
			}
			
		}
	  
	  ?>
      <form method="post" action="" id="loginform" class="fv-form fv-form-bootstrap">
        <div class="form-group">
          <label class="sr-only" for="inputEmail">Email</label>
          <input type="email" class="form-control" id="inputEmail" name="email" required placeholder="Email" data-fv-field="email">
        </div>
        <div class="form-group">
          <label class="sr-only" for="inputPassword">Password</label>
          <input type="password" class="form-control" id="inputPassword" required name="password"
          placeholder="Password" data-fv-field="password">
        </div>
      
        <button type="submit" id="loginbtn" name="loginSubmit" class="btn btn-success btn-block">Sign in</button>
      </form>
     

      <footer class="page-copyright">
        <p>MANAGED BY DHARANI PRINTERS</p>
        <p>© 2017. All RIGHT RESERVED.</p>
        
      </footer>
    </div>
  </div>
  <!-- End Page -->


  <!-- Core  -->
  <script src="assets/vendor/jquery/jquery.js"></script>
  <script src="assets/vendor/bootstrap/bootstrap.js"></script>
  <script src="assets/vendor/animsition/jquery.animsition.js"></script>
  <script src="assets/vendor/asscroll/jquery-asScroll.js"></script>
  <script src="assets/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

  <!-- Plugins -->
  <script src="assets/vendor/switchery/switchery.min.js"></script>
  <script src="assets/vendor/intro-js/intro.js"></script>
  <script src="assets/vendor/screenfull/screenfull.js"></script>
  <script src="assets/vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

  <script src="assets/vendor/formvalidation/formValidation.min.js"></script>
  <script src="assets/vendor/formvalidation/framework/bootstrap.min.js"></script>
  
  <!-- Scripts -->
  <script src="assets/js/core.js"></script>
  <script src="assets/js/site.js"></script>

  <script src="assets/js/sections/menu.js"></script>
  <script src="assets/js/sections/menubar.js"></script>
  <script src="assets/js/sections/sidebar.js"></script>

  <script src="assets/js/configs/config-colors.js"></script>
  <script src="assets/js/configs/config-tour.js"></script>

  <script src="assets/js/components/asscrollable.js"></script>
  <script src="assets/js/components/animsition.js"></script>
  <script src="assets/js/components/slidepanel.js"></script>
  <script src="assets/js/components/switchery.js"></script>
  <script src="assets/js/components/jquery-placeholder.js"></script>
<script>
    (function(document, window, $) {
      'use strict';
      var Site = window.Site;
      $(document).ready(function($) {
        Site.run();
      });

      // Example Validataion Full
      // ------------------------
      (function() {
        $('#loginform').formValidation({
          framework: "bootstrap",
          icon: null,
          fields: {
			  email: {
              validators: {
                notEmpty: {
                  message: 'The email address is required'
                },
                emailAddress: {
                  message: 'The email address is not valid'
                }
              }
            },
			 password: {
              validators: {
                notEmpty: {
                  message: 'The password is required'
                }
              }
            },
			
		}
        });
      })();

      
    })(document, window, jQuery);
  </script>


</body>

</html>