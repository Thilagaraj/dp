<?php include('includes/header.php');?>
   <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title pull-left"><i class="icon wb-list" aria-hidden="true"></i>Custom Fields</h1>
	  <a class="btn btn-success pull-right"  href="custom-field-entry" data-loading ><i class="icon wb-plus" aria-hidden="true"></i>&nbsp;&nbsp;Create Field</a>
    </div>
		
    <div class="page-content" style="padding-top:5px;margin-top:20px;">

      <!-- Panel Basic -->
      <div class="panel" >        
        <div class="panel-body">
		 <?php if(isset($_SESSION['message']) && $_SESSION['message']!=''):?>
			<div class="alert alert-success"><strong><?php echo $_SESSION['message'];unset($_SESSION['message']);?></strong></div><br />
		<?php endif;?>
		   <table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Field Name</th>
                <th>Field Type</th>
                <th>Categories</th>
                <th>Status</th>
                <th width="12%">Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
               <th>S.No</th>
                <th>Field Name</th>
                <th>Field Type</th>
                <th>Categories</th>
                <th>Status</th>
                <th width="12%">Action</th>                
              </tr>
            </tfoot>
            <tbody>
			<?php
				$fieldTypes=array(
					'text'=>'Text',
					'number'=>'Number',
					'price'=>'Price',
					'textarea'=>'Multiline Text',
					'dropdown'=>'Dropdown(With Price)',
					'dropdownnp'=>'Dropdown'
				);
				$fieldData=getAllFields();
			    foreach($fieldData as $index=>$data):
			?>
			<tr>
				<td><?php echo ($index+1);?> </td>
				<td><?php echo $data->field_name;?></td>
				<td><?php echo $fieldTypes[$data->field_type];?></td>
				<td>
					<?php $products=getProductsByFieldId($data->id); if(!empty($products)):?>
					<ul style='list-style:none;padding:0;margin:0;'>
						<?php foreach($products as $prod):?>
							<li><a style="text-decoration:none;" href="product-entry?id=<?php echo $prod->id;?>"><i class="icon wb-pencil"></i>&nbsp;&nbsp;<?php echo $prod->product_name;?></a></li>
						<?php endforeach;?>
					</ul>
					<?php endif;?>
				</td>
				<td>
				<?php if($data->field_status=='0'):?>
					<div class="label label-danger" style="background:#F70505;">Disabled</div>
				<?php endif;?>
				<?php if($data->field_status=='1'):?>
					<div class="label label-success" style="background:#79A70A;">Enabled</div>
				<?php endif;?>				
				</td>
				<td style="vertical-align:middle">
					<a class="btn btn-xs btn-success" href="custom-field-entry?id=<?php echo $data->id;?>"><i class="icon wb-pencil"></i>&nbsp;Edit</a>&nbsp;					
					<a class="btn btn-xs btn-dark" href="custom-fields?id=<?php echo $data->id;?>&task=delete" onclick="if(!confirm('Are you sure to delete?')){return false;}"  ><i class="icon wb-trash"></i>&nbsp;Delete</a>
				</td>
			</tr>			
			<?php endforeach;?>
			</tbody>
          </table>
        </div>
      </div>
      <!-- End Panel Basic -->

      
    </div>
	  </div>
	  </div>
  <!-- End Page -->
<?php include('includes/footer.php');?>