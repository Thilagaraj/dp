<?php 
session_start();
if((isset($_SESSION['email']) && $_SESSION['email']=='') || !isset($_SESSION['email'])){
	header('location:login');
	exit(0);
}
$page=str_replace('.php','',basename($_SERVER['SCRIPT_FILENAME']));	
include('common/functions.php');

if($page=='order-entry' && isset($_REQUEST['order_phone']) && isset($_POST['id']) && $_POST['id']==''){	
	$_REQUEST['order_custom_fields']=[];
	foreach($_REQUEST['field'] as $key=>$optval){
		$temOpts=[];
		$temOpts['field_id']=$key;
		$temOpts['field_value']=$optval;
		$_REQUEST['order_custom_fields'][]=$temOpts;
	}	
	$_REQUEST['order_custom_fields']=json_encode($_REQUEST['order_custom_fields']);
	createOrder($_REQUEST);		
	$_SESSION['message']='Order created successfully';
	header('location:index');
	exit(0);
}

if($page=='order-entry' && isset($_POST['id']) && $_POST['id']!=''){	
	$_REQUEST['order_custom_fields']=[];
	foreach($_REQUEST['field'] as $key=>$optval){
		$temOpts=[];
		$temOpts['field_id']=$key;
		$temOpts['field_value']=$optval;
		$_REQUEST['order_custom_fields'][]=$temOpts;
	}	
	$_REQUEST['order_custom_fields']=json_encode($_REQUEST['order_custom_fields']);
	updateOrder($_REQUEST);		
	$_SESSION['message']='Order updated successfully';
	header('location:index');
	exit(0);
}

if($page=='custom-field-entry' && isset($_REQUEST['field_name']) && isset($_POST['id'])){	
	$_REQUEST['field_options']=[];
	if($_REQUEST['field_type']=='dropdown' || $_REQUEST['field_type']=='dropdownnp'){
		foreach($_REQUEST['option_value'] as $key=>$optval){
			$temOpts=array(
				'option_name'=>$optval,
				'option_value'=>$optval,
				'option_price'=>$_REQUEST['option_price'][$key]
			);
			$_REQUEST['field_options'][]=$temOpts;
		}
	}
	$_REQUEST['field_options']=json_encode($_REQUEST['field_options']);
	createUpdateField($_REQUEST);
	if($_POST['id']!=''){
		$_SESSION['message']='Field Updated successfully';
	}else{
		$_SESSION['message']='Field created successfully';
	}
	header('location:custom-fields');
	exit(0);
}

if($page=='product-entry' && isset($_REQUEST['product_name']) && isset($_POST['id'])){	
	
	$_REQUEST['product_fields']=implode(',',$_REQUEST['product_fields']);
	createUpdateProduct($_REQUEST);
	if($_POST['id']!=''){
		$_SESSION['message']='Product Updated successfully';
	}else{
		$_SESSION['message']='Product created successfully';
	}
	header('location:products');
	exit(0);
}

if($page=='custom-fields' && isset($_REQUEST['id']) && $_REQUEST['id']!='' && isset($_REQUEST['task']) && $_REQUEST['task']=='delete'){	
	$postArray['delete']=1;
	$postArray['id']=$_REQUEST['id'];
	createUpdateField($postArray);		
	$_SESSION['message']='Field deleted successfully';
	header('location:custom-fields');
	exit(0);
}

if($page=='products' && isset($_REQUEST['id']) && $_REQUEST['id']!='' && isset($_REQUEST['task']) && $_REQUEST['task']=='delete'){	
	$postArray['delete']=1;
	$postArray['id']=$_REQUEST['id'];
	createUpdateProduct($postArray);		
	$_SESSION['message']='Product deleted successfully';
	header('location:products');
	exit(0);
}


if($page=='index' && isset($_REQUEST['id']) && $_REQUEST['id']!='' && isset($_REQUEST['task']) && $_REQUEST['task']=='delete'){	
	$postArray['delete']=1;
	$postArray['id']=$_REQUEST['id'];
	updateOrder($postArray);		
	$_SESSION['message']='Order deleted successfully';
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
  <meta name="description" content="Qtepy.com">
  <meta name="author" content="">

  <title>Dharani Printers | Order Manager</title>

  <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
 <link rel="shortcut icon" href="assets/images/logo-d.png">

 <!-- Stylesheets -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="assets/css/site.css">

  <link rel="stylesheet" href="assets/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="assets/vendor/select2/select2.css">
  <link rel="stylesheet" href="assets/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="assets/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="assets/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="assets/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="assets/vendor/flag-icon-css/flag-icon.css">

  <!-- Plugin -->
  <link rel="stylesheet" href="assets/vendor/datatables-bootstrap/dataTables.bootstrap.css">
  <link rel="stylesheet" href="assets/vendor/datatables-fixedheader/dataTables.fixedHeader.css">
  <link rel="stylesheet" href="assets/vendor/datatables-responsive/dataTables.responsive.css">
  <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
  <link rel="stylesheet" href="assets/vendor/formvalidation/formValidation.css">


  <!-- Fonts -->
  <link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="assets/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


  <!-- Inline -->
  <style>
    @media (max-width: 480px) {
      .panel-actions .dataTables_length {
        display: none;
      }
    }
    
    @media (max-width: 320px) {
      .panel-actions .dataTables_filter {
        display: none;
      }
    }
    
    @media (max-width: 767px) {
      .dataTables_length {
        float: left;
      }
    }
    
    #exampleTableAddToolbar {
      padding-left: 30px;
    }
  </style>

  <!--[if lt IE 9]>
    <script src="assets/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="assets/vendor/media-match/media.match.min.js"></script>
    <script src="assets/vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="assets/vendor/modernizr/modernizr.min.js"></script>
  <script src="assets/vendor/breakpoints/breakpoints.min.js"></script>
  <script src="assets/vendor/jquery/jquery.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
<body>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega bg-teal-800" role="navigation">
  <ul class="nav navbar-toolbar">
          <li>
            <h2 style="color:#fff;position:relative;left:20px;bottom:6px;margin:0;margin-top:18px;"><img src="assets/images/logo-h.png" class="img-responsive" alt="TANMAG"/></h2> 
          </li>
		   <li class="<?php if($page=='' || $page=='index' || $page=='order-entry' || $page=='order-entry'): echo 'active';endif;?>" style="margin-left:60px;"><a href="index"><i class="icon wb-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Orders</a></li>
		   <li class="<?php if($page=='products' || $page=='product-entry'): echo 'active';endif;?>"><a href="products"><i class="icon wb-folder" aria-hidden="true"></i>&nbsp;&nbsp;Products</a></li>
		   <li class="<?php if($page=='custom-fields' || $page=='custom-field-entry'): echo 'active';endif;?>"><a href="custom-fields"><i class="icon wb-list" aria-hidden="true"></i>&nbsp;&nbsp;Custom Fields</a></li>		  
		   <li><a href="logout"><i class="icon wb-power" aria-hidden="true"></i>&nbsp;&nbsp;Logout</a></li>
        </ul>
		<ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
          <li>
           <a class="navbar-avatar ">
		     <span>Welcome <strong style="font-weight:700;"><?php echo $_SESSION['name'];?></strong>&nbsp;</span>
              <span class="avatar avatar-online">
                <img src="<?php echo $_SESSION['avatar'];?>" alt="<?php echo $_SESSION['name'];?>"><br />
              </span>
            </a>
          </li>		 
        </ul>
  </nav>