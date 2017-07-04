<?php include('includes/header.php');?>
   <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title"><i class="icon wb-pencil" aria-hidden="true"></i>
	  <?php if(isset($_REQUEST['id']) && $_REQUEST['id']!=''):echo 'Edit Order';else:echo 'Create Order';endif;?>
	  </h1>
    </div>
    <?php
	$orderDetail=array();
	if(isset($_REQUEST['id']) && $_REQUEST['id']!=''){
		 $orderDetail=getOrderById($_REQUEST['id']);		
	}	
	$productList=getProducts();
	?>
    <div class="page-content" style="padding-top:5px;">
      <!-- Panel Basic -->
      <div class="panel" >        
        <div class="panel-body">
		  <form id="orderform" autocomplete="off" action="" method="POST" novalidate="novalidate" class="fv-form fv-form-bootstrap"><button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
            <div class="row row-lg">
              <div class="col-lg-6 form-horizontal">
			  
                <div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Full Name
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9">
                      <input type="text" class="form-control" value="<?php echo fieldValue($orderDetail,'order_name');?>" name="order_name" required="true"  />
					</div>
                </div>				
				<div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Mobile
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9">
                      <input type="text" class="form-control" value="<?php echo fieldValue($orderDetail,'order_phone');?>" name="order_phone" required="true"  />
					</div>
                </div>
				<div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Email
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9">
                      <input type="text" class="form-control" value="<?php echo fieldValue($orderDetail,'order_email');?>" name="order_email" required="true"  />
					</div>
                </div>
				<div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Address
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9">
                      <textarea class="form-control" name="order_address" required="true" ><?php echo fieldValue($orderDetail,'order_address');?></textarea>
					</div>
                </div>
				<div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Product
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9">
                      <select class="form-control order_product" name="order_product" data-selected="<?php echo fieldValue($orderDetail,'order_product');?>">
						<option value="">- Select Product -</option>
						<?php foreach($productList as $product):?>
							<option data-productfields="<?php echo $product->product_fields;?>" value="<?php echo $product->id;?>"><?php echo $product->product_name;?></option>
						<?php endforeach;?>
					  </select>
					</div>
                </div>
				<div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Product Information
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9">
                    <div class="productCustomFields" style="background:#fdfdfd;border:1px dashed #eee;min-height:100px;padding:5px;position:relative;">
						<div style="position:absolute;top:0;bottom:0;right:0;left:0;margin:auto;width:300px;height:50px;line-height:50px;color:#ddd;text-align:center;">- Select Product to load related fields -</div>
					</div>
					</div>
                </div>
				
              </div>

              <div class="col-lg-6 form-horizontal">
				<div class="form-group">
				  <label class="col-lg-12 col-sm-3 control-label">Estimated Costs&nbsp;&nbsp;<a type="button" class="btn btn-dark pull-right btn-xs" href="javascript:estimate();">Re Calculate&nbsp;<i class="icon wb-refresh" aria-hidden="true"></i></a>
				  </label>
				  <div class="col-lg-12 col-sm-9">                    
					    <div class="estimations" style="background:#fdfdfd;border:1px dashed #eee;min-height:100px;padding:5px;">
						<div style="position:absolute;top:0;bottom:0;right:0;left:0;margin:auto;width:300px;height:50px;line-height:50px;color:#ddd;text-align:center;">- Select Product to calculate -</div>
						</div>            
				 </div>
				</div>
			  <div class="row">
					<div class="col-md-6">
						   <div class="form-group">
							  <label class="col-lg-12 col-sm-3 control-label">Quantity
								<span class="required">*</span>
							  </label>
							  <div class="col-lg-12 col-sm-9">                    
								 <input type="number" class="form-control order_quantity" value="<?php echo fieldValue($orderDetail,'order_quantity','1');?>" name="order_quantity"  required="" />                 
							 </div>
							</div>
						</div>
						<div class="col-md-6">		
						  <div class="form-group">
							  <label class="col-lg-12 col-sm-3 control-label">Discount Amount
								<span class="required">*</span>
							  </label>
							  <div class="col-lg-12 col-sm-9">                    
								 &#8377; <input type="number" class="form-control order_discount" value="<?php echo fieldValue($orderDetail,'order_discount',0);?>" name="order_discount" placeholder="&#8377; 500" required="" style="width:90%;display:initial;" />                 
							 </div>
							</div>
					</div>
                </div>
				 <div class="row">
				 <div class="col-md-4">		
						  <div class="form-group">
							  <label class="col-lg-12 col-sm-3 control-label">Total Amount
								<span class="required">*</span>
							  </label>
							  <div class="col-lg-12 col-sm-9">                    
								 &#8377; <input type="number" class="form-control order_amount" value="<?php echo fieldValue($orderDetail,'order_amount',0);?>" name="order_amount"  required="" style="width:90%;display:initial;" />                 
							 </div>
							</div>
					</div>
					<div class="col-md-4">
						   <div class="form-group">
							  <label class="col-lg-12 col-sm-3 control-label">Amount Paid
								<span class="required">*</span>
							  </label>
							  <div class="col-lg-12 col-sm-9">                    
								&#8377; <input type="number" class="form-control order_amount_paid" value="<?php echo fieldValue($orderDetail,'order_amount_paid',0);?>" name="order_amount_paid"  required="" style="width:90%;display:initial;" />                 
							 </div>
							</div>
						</div>
						<div class="col-md-4">		
						  <div class="form-group">
							  <label class="col-lg-12 col-sm-3 control-label">Amount Balance
								<span class="required">*</span>
							  </label>
							  <div class="col-lg-12 col-sm-9">                    
								 &#8377; <input type="number" class="form-control order_amount_balance" readonly value="<?php echo fieldValue($orderDetail,'order_amount_balance',0);?>" name="order_amount_balance"  required="" style="width:90%;display:initial;" />                 
							 </div>
							</div>
					</div>
                </div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						  <label class="col-lg-12 col-sm-3 control-label">Recieved Date
							<span class="required">*</span>
						  </label>
						  <div class="col-lg-12 col-sm-9">                    
							 <input type="text" class="form-control" value="<?php echo fieldValue($orderDetail,'order_date',date('Y-m-d'),true);?>" name="order_date" placeholder="DD/MM/YYYY" required="" readonly data-format="dd/mm/yyyy" data-plugin="datepicker" />                 
						 </div>
						</div>
					</div>
					<div class="col-md-6">	
					   <div class="form-group">
						  <label class="col-lg-12 col-sm-3 control-label">Delivery Date
							<span class="required">*</span>
						  </label>
						  <div class="col-lg-12 col-sm-9">                    
							 <input type="text" class="form-control" value="<?php echo fieldValue($orderDetail,'order_delivery_date','',true);?>" name="order_delivery_date" placeholder="DD/MM/YYYY" required="" readonly data-format="dd/mm/yyyy" data-plugin="datepicker" />                 
						 </div>
						</div>
					</div>
				</div>
				
				 <div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Actual Delivered Date
                  </label>
                  <div class="col-lg-12 col-sm-9">                    
                      <input type="text" class="form-control" value="<?php echo fieldValue($orderDetail,'order_actual_delivered_date','',true);?>" name="order_actual_delivered_date" placeholder="DD/MM/YYYY" readonly />               
                 </div>
                </div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						  <label class="col-lg-12 col-sm-3 control-label">Status
							<span class="required">*</span>
						  </label>
						  <div class="col-lg-12 col-sm-9">                    
							 <select class="form-control" name="order_status" data-selected="<?php echo fieldValue($orderDetail,'order_status','In Progress');?>">
								<option value="">- Select Status -</option>
								<option value="In Progress">In Progress</option>
								<option value="Delivered">Delivered</option>
							  </select>              
						 </div>
						</div>
					</div>
					<div class="col-md-6">	
						<div class="form-group">
						  <label class="col-lg-12 col-sm-3 control-label">Location
							<span class="required">*</span>
						  </label>
						  <div class="col-lg-12 col-sm-9">                    
							 <select class="form-control" name="order_location" data-selected="<?php echo fieldValue($orderDetail,'order_location','Sathyamanagalam');?>">
								<option value="">- Select Location -</option>
								<option value="Sathyamanagalam">Sathyamanagalam</option>
								<option value="Sathyamanagalam Main">Sathyamanagalam Main</option>
							  </select>              
						 </div>
						</div>
                </div>
                </div>
				
                
				<div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Additional Information
                  </label>
                  <div class="col-lg-12 col-sm-9">                    
                     <textarea class="form-control" name="order_additional_info" ><?php echo fieldValue($orderDetail,'order_additional_info');?></textarea>
                 </div>
                </div>
               
              <div class="form-group  text-right padding-top-m">
			   <div class="col-lg-12 col-sm-9"> 
			    <input type="hidden" name="id" class="order_id" value="<?php echo fieldValue($orderDetail,'id');?>"/>
				<a type="button" class="btn btn-danger" href="index">Cancel&nbsp;<i class="icon wb-close" aria-hidden="true"></i></a>	
				<?php if(!isset($_REQUEST['id'])):?>
				<button type="reset" class="btn btn-default" >Reset&nbsp;<i class="icon wb-refresh" aria-hidden="true"></i></button>
				<?php endif;?>
                <button type="submit" class="btn btn-success" id="validateButton1"><?php if(isset($_REQUEST['id']) && $_REQUEST['id']!=''):echo 'Update';else:echo 'Create';endif;?>&nbsp;<i class="icon wb-check" aria-hidden="true"></i></button>
              </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- End Panel Basic -->

      
    </div>
	  </div>
	  </div>
	  <script>
		$(document).ready(function(){
			var $productFields=$('.order_product option:selected').data('productfields');
			var $orderId=$('.order_id').val();
			getCustonFields($productFields,$orderId);
			
			$(document).on('change','.order_product',function(){
				var $productFields=$('.order_product option:selected').data('productfields');
				var $orderId=$('.order_id').val();
				getCustonFields($productFields,$orderId);
			});
			
			$(document).on('change','.order_custom_field,.order_product,.order_quantity,.order_amount_paid,.order_amount',function(){
				calcBalance();
				estimate();
			});
			
			$(document).on('change','.order_discount',function(){
				if($(this).val()==''){
					$(this).val(0);
				}
				if(parseInt($(this).val())>parseInt($('.order_amount').val())){
					$(this).val(0);
				}
				calcBalance();
				estimate();
			});
			
			$(document).on('change','input[name="order_date"]',function(){
				$('#orderform').formValidation('revalidateField', 'order_date');
			});
			
			$(document).on('change','input[name="order_delivery_date"]',function(){
				$('#orderform').formValidation('revalidateField', 'order_delivery_date');
			});
    
		});
		
		function getCustonFields($productFields,$orderId){
			if($productFields){
				$.ajax({
					method:'POST',
					data:{'product_fields':$productFields,'order_id':$orderId},
					url:'order-fields',
					beforeSend:function(){
						$('.productCustomFields,.estimations').html('<div style="position:absolute;top:0;bottom:0;right:0;left:0;margin:auto;width:300px;height:50px;line-height:50px;color:#ddd;text-align:center;">Loading...</div>');
					},
					success:function(resp){
						$('.productCustomFields').html(resp);
					},
					complete:function(){
						setTimeout(function(){
							estimate();
						},1000);
					}
					
				});
			}			
		}
		function estimate(){
			if($('.order_product').val()!=''){
				var $html="";
				var $total=0;
				var $quantity=parseInt(($('.order_quantity').val() ? $('.order_quantity').val() : 1));
				var $discount=parseInt(($('.order_discount').val() ? $('.order_discount').val() : 0));
				$('.custom_field_dropdown').each(function(indx,elem){
					var $price=$(elem).find('option:selected').data('price');
					var $label=$(elem).data('fieldlabel');
					var $selectedOption=$(elem).val();
					$html+='<div class="row">';
					$html+='<div class="col-lg-10">';
					$html+=''+$label+' (<i>'+$selectedOption+'</i>)';
					$html+='</div>';
					$html+='<div class="col-lg-2 text-right">';
					$html+='&#8377; '+$price+'';
					$html+='</div>';
					$html+='</div>';
					if($price){
						$total+=parseFloat($price);
					}
				});
				$('.custom_field_price').each(function(indx,elem){
					var $price=$(elem).val();
					var $label=$(elem).data('fieldlabel');
					$html+='<div class="row">';
					$html+='<div class="col-lg-10">';
					$html+=''+$label+'';
					$html+='</div>';
					$html+='<div class="col-lg-2 text-right">';
					$html+='&#8377; '+numberWithCommas($price)+'';
					$html+='</div>';
					$html+='</div>';
					if($price){
						$total+=parseFloat($price);
					}
				});
				$total=($quantity*$total)-$discount;
				$html+='<div class="row">';
				$html+='<div class="col-lg-10">';
				$html+='<strong>Quantity</strong>';
				$html+='</div>';
				$html+='<div class="col-lg-2 text-right">';
				$html+='<strong>x '+$quantity+'</strong>';
				$html+='</div>';
				$html+='</div>';
				$html+='<div class="row">';
				$html+='<div class="col-lg-10">';
				$html+='<strong>Discount</strong>';
				$html+='</div>';
				$html+='<div class="col-lg-2 text-right">';
				$html+='<strong>- &#8377; '+$discount+'</strong>';
				$html+='</div>';
				$html+='</div>';
				$html+='<div class="row">';
				$html+='<div class="col-lg-10">';
				$html+='<strong class="green-color">Total</strong>';
				$html+='</div>';
				$html+='<div class="col-lg-2 text-right">';
				$html+='<strong class="green-color">&#8377; '+numberWithCommas($total)+'</strong>';
				$html+='</div>';
				$html+='</div>';
				$('.order_amount').val($total);
				$('.estimations').html($html);
				calcBalance();
			}
		}
		function numberWithCommas(x) {
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}
		function calcBalance(){
			var $total=parseFloat($('.order_amount').val());
			var $totalPaid=parseFloat($('.order_amount_paid').val());
			$('.order_amount_balance').val(($total)-$totalPaid);
		}
	  </script>
  <!-- End Page -->
<?php include('includes/footer.php');?>