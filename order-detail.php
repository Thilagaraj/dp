<?php include('includes/header.php');?>
   <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title"><i class="icon wb-list" aria-hidden="true"></i>
	 Order Details
	  </h1>
    </div>
    <?php
	if(isset($_REQUEST['id']) && $_REQUEST['id']!=''){
		$orderDetail=getOrderById($_REQUEST['id']);		
	}	
	?>
    <div class="page-content" style="padding-top:5px;">
      <!-- Panel Basic -->
      <div class="panel" >        
        <div class="panel-body">
			<ul class="list-group-gap list-group">
				<li class="list-group-item"><strong>Name</strong><br><p><?php echo fieldValue($orderDetail,'order_name');?></p></li>
				<li class="list-group-item"><strong>Mobile</strong><br><p><?php echo fieldValue($orderDetail,'order_phone');?></p></li>
				<li class="list-group-item"><strong>Email</strong><br><p><?php echo fieldValue($orderDetail,'order_email');?></p></li>
				<li class="list-group-item"><strong>Product</strong><br><p><?php echo getProductName($orderDetail['order_product']);?></p></li>
				<li class="list-group-item"><strong>Product Additional Info</strong><br><p><?php echo fieldValue($orderDetail,'order_product_information');?></p></li>
				<li class="list-group-item"><strong>Amount</strong><br><p>&#8377;  <?php echo fieldValue($orderDetail,'order_amount',0);?></p></li>
				<li class="list-group-item"><strong>Quantity</strong><br><p><?php echo fieldValue($orderDetail,'order_quantity',1);?></p></li>
				<li class="list-group-item"><strong>Delivery Date</strong><br><p><?php echo fieldValue($orderDetail,'order_delivery_date');?></p></li>
				<li class="list-group-item"><strong>Actual Delivered Date</strong><br><p><?php echo fieldValue($orderDetail,'order_delivery_date');?></p></li>
				<li class="list-group-item"><strong>Location</strong><br><p><?php echo fieldValue($orderDetail,'order_location');?></p></li>
				<li class="list-group-item"><strong>Additional Information</strong><br><p><?php echo fieldValue($orderDetail,'order_additional_info');?></p></li>					
			</ul>
			<?php if($orderDetail['order_status']=='In Progress'):?>
				<div class="ribbon-danger"><span>In Progress</span></div>
			<?php endif;?>
			<?php if($orderDetail['order_status']=='Delivered'):?>
				<div class="ribbon-success"><span>Delivered</span></div>
			<?php endif;?>				
			<div class="text-right">
				<a style="text-decoration:none;" class="btn btn-success" href="order-entry?id=<?php echo $orderDetail['id'];?>"><i class="icon wb-pencil"></i>&nbsp;Edit</a>&nbsp;
					<a class="btn btn-dark" href="index?id=<?php echo $orderDetail['id'];?>&task=delete" onclick="if(!confirm('Are you sure to delete?')){return false;}"  ><i class="icon wb-trash"></i>&nbsp;Delete</a>&nbsp;
				<a href="index" style="text-decoration:none;" class="btn btn-dark" data-loading=""><i class="icon wb-arrow-left" aria-hidden="true"></i> Cancel</a>
				<a href="index" style="text-decoration:none;position:absolute;top:20px;right:20px;color:#526069;" data-loading=""><i class="icon wb-close" aria-hidden="true"></i></a>
			</div>
		
        </div>
      </div>
      <!-- End Panel Basic -->

      
    </div>
	  </div>
	  </div>
  <!-- End Page -->
<?php include('includes/footer.php');?>