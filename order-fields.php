<?php
include('common/functions.php');
if(isset($_REQUEST['product_fields']) && $_REQUEST['product_fields']!=''):
$productFields=$_REQUEST['product_fields'];
$orderId=$_REQUEST['order_id'];
$productFields=getProductsFields($productFields);
$orderDetails=getOrderById($orderId);
$orderFieldsTemp=json_decode($orderDetails['order_custom_fields']);
if(empty($orderFieldsTemp))
	$orderFieldsTemp=[];
$orderFields=[];
foreach($orderFieldsTemp as $of):
	$orderFields[$of->field_id]=$of->field_value;
endforeach;

?>
<div class="orderFieldDetails">
	<div class="row">
	<?php foreach($productFields as $productField):?>
		<div class="col-lg-6">
			<?php if($productField->field_type=='text'):?> 
				<div class="form-group">
				  <label class="col-lg-12 col-sm-3 control-label"><?php echo $productField->field_label;?>
					<span class="required">*</span>
				  </label>
				  <div class="col-lg-12 col-sm-9">   
				<input data-fieldlabel="<?php echo $productField->field_label;?>" data-fieldname="<?php echo $productField->field_name;?>" type="text" name="field[<?php echo $productField->id;?>]" class="order_custom_field custom_field_text form-control" value="<?php echo fieldValue($orderFields,$productField->id);?>"/>
				 </div>
				</div>
			<?php endif;?>
			<?php if($productField->field_type=='number'):?>
				<div class="form-group">
				  <label class="col-lg-12 col-sm-3 control-label"><?php echo $productField->field_label;?>
					<span class="required">*</span>
				  </label>
				  <div class="col-lg-12 col-sm-9">  
				<input data-fieldlabel="<?php echo $productField->field_label;?>" data-fieldname="<?php echo $productField->field_name;?>" type="number" name="field[<?php echo $productField->id;?>]" class="order_custom_field custom_field_number form-control" value="<?php echo fieldValue($orderFields,$productField->id);?>"/>
				 </div>
				</div>
			<?php endif;?>
			<?php if($productField->field_type=='price'):?>
				<div class="form-group">
				  <label class="col-lg-12 col-sm-3 control-label"><?php echo $productField->field_label;?>
					<span class="required">*</span>
				  </label>
				  <div class="col-lg-12 col-sm-9">  
				&#8377; <input data-fieldlabel="<?php echo $productField->field_label;?>" data-fieldname="<?php echo $productField->field_name;?>" type="number" name="field[<?php echo $productField->id;?>]" class="order_custom_field custom_field_price form-control" value="<?php echo fieldValue($orderFields,$productField->id,0);?>" style="display:initial;width:90%;"/>
				 </div>
				</div>
			<?php endif;?>
			<?php if($productField->field_type=='textarea'):?>
				<div class="form-group">
				  <label class="col-lg-12 col-sm-3 control-label"><?php echo $productField->field_label;?>
					<span class="required">*</span>
				  </label>
				  <div class="col-lg-12 col-sm-9"> 
				<textarea data-fieldlabel="<?php echo $productField->field_label;?>" data-fieldname="<?php echo $productField->field_name;?>" name="field[<?php echo $productField->id;?>]" class="order_custom_field custom_field_textarea form-control" ><?php echo fieldValue($orderFields,$productField->id);?></textarea>
				 </div>
				</div>
			<?php endif;?>
			<?php if($productField->field_type=='dropdown'):
			$fieldOptions=json_decode($productField->field_options);
			?>
			<div class="form-group">
			  <label class="col-lg-12 col-sm-3 control-label"><?php echo $productField->field_label;?>
				<span class="required">*</span>
			  </label>
			  <div class="col-lg-12 col-sm-9"> 
			<select data-fieldlabel="<?php echo $productField->field_label;?>" data-fieldname="<?php echo $productField->field_name;?>" name="field[<?php echo $productField->id;?>]" class="order_custom_field custom_field_dropdown form-control">
			<option data-price="0" value="">- Select <?php echo $productField->field_label;?> -</option>
			<?php
			foreach($fieldOptions as $fopt):
			?>
				<option data-price="<?php echo ($fopt->option_price ? $fopt->option_price : 0);?>" <?php echo (fieldValue($orderFields,$productField->id)==$fopt->option_value ? 'selected' : '')?> value="<?php echo $fopt->option_value;?>"><?php echo $fopt->option_name;?></option>
			<?php
			endforeach;
			?>
			</select>
			 </div>
			</div>
			<?php endif;?>
			<?php if($productField->field_type=='dropdownnp'):
			$fieldOptions=json_decode($productField->field_options);
			?>
			<div class="form-group">
			  <label class="col-lg-12 col-sm-3 control-label"><?php echo $productField->field_label;?>
				<span class="required">*</span>
			  </label>
			  <div class="col-lg-12 col-sm-9"> 
			<select data-fieldlabel="<?php echo $productField->field_label;?>" data-fieldname="<?php echo $productField->field_name;?>" name="field[<?php echo $productField->id;?>]" class="order_custom_field custom_field_dropdownnp form-control">
			<option value="">- Select <?php echo $productField->field_label;?> -</option>
			<?php
			foreach($fieldOptions as $fopt):
			?>
				<option <?php echo (fieldValue($orderFields,$productField->id)==$fopt->option_value ? 'selected' : '')?> value="<?php echo $fopt->option_value;?>"><?php echo $fopt->option_name;?></option>
			<?php
			endforeach;
			?>
			</select>
			 </div>
			</div>
			<?php endif;?>
		</div>
		<?php endforeach;?>
	</div>
</div>
<?php endif;exit(0);?>