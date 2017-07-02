<?php include('includes/header.php');?>
   <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title"><i class="icon wb-pencil" aria-hidden="true"></i>
	  <?php if(isset($_REQUEST['id']) && $_REQUEST['id']!=''):echo 'Edit Product';else:echo 'Create Product';endif;?>
	  </h1>
    </div>
    <?php
	$productDetail=array();
	if(isset($_REQUEST['id']) && $_REQUEST['id']!=''){
		 $productDetail=getProductById($_REQUEST['id']);
	}	
	$fieldList=getAllFields(true);
	?>
    <div class="page-content" style="padding-top:5px;">
      <!-- Panel Basic -->
      <div class="panel" >        
        <div class="panel-body">
		  <form id="orderform" autocomplete="off" action="" method="POST" novalidate="novalidate" class="fv-form fv-form-bootstrap"><button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
            <div class="row row-lg">
              <div class="col-lg-6 form-horizontal">
			  
                <div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Product Name
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9">
                      <input type="text" class="form-control" value="<?php echo fieldValue($productDetail,'product_name');?>" name="product_name" required="true"  />
					</div>
                </div>	
				<div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Product Description
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9">
                       <textarea class="form-control" name="product_description" ><?php echo fieldValue($productDetail,'product_description');?></textarea>
					</div>
                </div>					
				<div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Product Fields
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9 select2-primary">
                      <select class="form-control field_type " name="product_fields[]" multiple data-plugin="select2">
						<option value="">- Select Type -</option>
						<?php  $pf=explode(',',fieldValue($productDetail,'product_fields'));foreach($fieldList as $field):?>
							<option value="<?php echo $field->id;?>" <?php echo (in_array($field->id,$pf) ? 'selected': '');?>><?php echo $field->field_name;?></option>
						<?php endforeach;?>
					  </select>
					</div>
                </div>				
              </div>

              <div class="col-lg-6 form-horizontal">			   
				<div class="form-group">
				  <label class="col-lg-12 col-sm-3 control-label">Status
					<span class="required">*</span>
				  </label>
				  <div class="col-lg-12 col-sm-9">                    
					 <select class="form-control" name="product_status" data-selected="<?php echo fieldValue($productDetail,'product_status','1');?>">
						<option value="">- Select Status -</option>
						<option value="1">Enabled</option>
						<option value="0">Disabled</option>
					  </select>              
				 </div>
				</div>
            </div>
			<div class="dummyOptions" style="display:none;">
				<div class="row" style="margin-top:5px;">
					<div class="col-lg-7">
						<input type="text" placeholder="Option" name="option_value[]" disabled class="form-control option_value"/>
					</div>
					<div class="col-lg-3">
						&#8377; <input type="number" placeholder="Price" name="option_price[]" disabled class="form-control option_price" style="width:90%;display:initial"/>
					</div>
					<div class="col-lg-2">
						<div style="position:relative;top:7px;">
							<a href="javascript:void(0);" class="btn btn-xs btn-info addOption"><i class="icon wb-plus" aria-hidden="true"></i></a>
							<a href="javascript:void(0);" class="btn btn-xs btn-danger removeOption"><i class="icon wb-trash" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group  text-right padding-top-m">
			   <div class="col-lg-12 col-sm-9"> 
			    <input type="hidden" name="id" value="<?php echo fieldValue($productDetail,'id');?>"/>
				<a type="button" class="btn btn-danger" href="javascript:history.go(-1);">Cancel&nbsp;<i class="icon wb-close" aria-hidden="true"></i></a>	
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
			$(document).on('click','.addOption',function(){
				var $html=$('.dummyOptions').html();
				$(this).closest('.row').after($html);
				if($('.dropdownOptions .addOption').length>1){
					$('.removeOption').show();
				}else{
					$('.removeOption').hide();
				}
				$('.dropdownOptions input').removeAttr('disabled');
			});
			$(document).on('click','.removeOption',function(){
				if(confirm('Are you sure to delete?')){
					$(this).closest('.row').remove();
					if($('.dropdownOptions .addOption').length>1){
						$('.removeOption').show();
					}else{
						$('.removeOption').hide();
					}
				}
			});
						
			$(document).on('change','.field_type',function(){
				if($(this).val()=='dropdown'){
					$('.ddoptions').show();
				}else{
					$('.ddoptions').hide();
				}
			});
			
			
			
		});
	  </script>
  <!-- End Page -->
<?php include('includes/footer.php');?>