<?php include('includes/header.php');?>
   <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title"><i class="icon wb-pencil" aria-hidden="true"></i>
	  <?php if(isset($_REQUEST['id']) && $_REQUEST['id']!=''):echo 'Edit Field';else:echo 'Create Field';endif;?>
	  </h1>
    </div>
    <?php
	$fieldDetail=array();
	if(isset($_REQUEST['id']) && $_REQUEST['id']!=''){
		 $fieldDetail=getFieldById($_REQUEST['id']);
	}	
	$productList=getProducts(true);
	?>
    <div class="page-content" style="padding-top:5px;">
      <!-- Panel Basic -->
      <div class="panel" >        
        <div class="panel-body">
		  <form id="orderform" autocomplete="off" action="" method="POST" novalidate="novalidate" class="fv-form fv-form-bootstrap"><button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
            <div class="row row-lg">
              <div class="col-lg-6 form-horizontal">
			  
                <div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Field Name
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9">
                      <input type="text" class="form-control" value="<?php echo fieldValue($fieldDetail,'field_name');?>" name="field_name" required="true"  />
					</div>
                </div>	
				<div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Field Label
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9">
                      <input type="text" class="form-control" value="<?php echo fieldValue($fieldDetail,'field_label');?>" name="field_label" required="true"  />
					</div>
                </div>					
				<div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Field Type
                    <span class="required">*</span>
                  </label>
					<div class=" col-lg-12 col-sm-9">
                      <select class="form-control field_type" name="field_type" data-selected="<?php echo fieldValue($fieldDetail,'field_type');?>">
						<option value="">- Select Type -</option>
						<option value="text">Text</option>
						<option value="number">Number</option>
						<option value="price">Price</option>
						<option value="textarea">Multiline Text</option>
						<option value="dropdown">Dropdown(With Price)</option>
						<option value="dropdownnp">Dropdown</option>
					  </select>
					</div>
                </div>
				<div class="form-group">
                  <label class="col-lg-12 col-sm-3 control-label">Field Description
                  </label>
					<div class=" col-lg-12 col-sm-9">
                     <textarea class="form-control" name="field_desc" ><?php echo fieldValue($fieldDetail,'field_desc');?></textarea>
					</div>
                </div>
              </div>

              <div class="col-lg-6 form-horizontal">
			   <div class="form-group ddoptions" style="<?php echo (fieldValue($fieldDetail,'field_type')=='dropdown' || fieldValue($fieldDetail,'field_type')=='dropdownnp'? '': 'display:none');?>">
				  <label class="col-lg-12 col-sm-3 control-label">Dropdown Options
					<span class="required">*</span>
				  </label>
				  <div class="col-lg-12 col-sm-9">                    
					    <div class="dropdownOptions" >
						<?php
							$fieldOptions=json_decode(fieldValue($fieldDetail,'field_options'));
							if(empty($fieldOptions)){
								$fieldOptions[]=array('option_value'=>'','option_price'=>'');
							}
							
						?>
							<?php foreach($fieldOptions as $fopt): $fopt=(array)$fopt;?>
							<div class="row" style="margin-top:5px;">
								<div class="col-lg-7">
									<input type="text" placeholder="Option" name="option_value[]" value="<?php echo $fopt['option_value'];?>" class="form-control option_value"/>
								</div>
								<div class="col-lg-3"  style="<?php echo (fieldValue($fieldDetail,'field_type')=='dropdownnp'? 'display:none': '');?>">
									&#8377; <input type="number" placeholder="Price" name="option_price[]" value="<?php echo $fopt['option_price'];?>" class="form-control option_price" style="width:90%;display:initial"/>
								</div>
								<div class="col-lg-2">
									<div style="position:relative;top:7px;">
										<a href="javascript:void(0);" class="btn btn-xs btn-info addOption"><i class="icon wb-plus" aria-hidden="true"></i></a>
										<a href="javascript:void(0);" class="btn btn-xs btn-danger removeOption"><i class="icon wb-trash" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
							<?php endforeach;?>
						</div>       
				 </div>
				</div>
				<div class="form-group">
				  <label class="col-lg-12 col-sm-3 control-label">Status
					<span class="required">*</span>
				  </label>
				  <div class="col-lg-12 col-sm-9">                    
					 <select class="form-control" name="field_status" data-selected="<?php echo fieldValue($fieldDetail,'field_status','1');?>">
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
			    <input type="hidden" name="id" value="<?php echo fieldValue($fieldDetail,'id');?>"/>
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
				if($('.field_type').val()=='dropdown'){
					$('.option_price').closest('.col-lg-3').show();
				}
				if($('.field_type').val()=='dropdownnp'){
					$('.option_price').closest('.col-lg-3').hide();
				}
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
				if($('.field_type').val()=='dropdown'){
					$('.option_price').closest('.col-lg-3').show();
				}
				if($('.field_type').val()=='dropdownnp'){
					$('.option_price').closest('.col-lg-3').hide();
				}
			});
						
			$(document).on('change','.field_type',function(){
				if($(this).val()=='dropdown' || $(this).val()=='dropdownnp'){
					$('.ddoptions').show();
				}else{
					$('.ddoptions').hide();
				}
				if($(this).val()=='dropdown'){
					$('.option_price').closest('.col-lg-3').show();
				}
				if($(this).val()=='dropdownnp'){
					$('.option_price').closest('.col-lg-3').hide();
				}
				
			});
			
			
			
		});
	  </script>
  <!-- End Page -->
<?php include('includes/footer.php');?>