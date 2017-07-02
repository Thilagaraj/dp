<?php include('includes/header.php');?>
   <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title pull-left"><i class="icon wb-list" aria-hidden="true"></i>Products</h1>
	  <a class="btn btn-success pull-right"  href="product-entry" data-loading ><i class="icon wb-plus" aria-hidden="true"></i>&nbsp;&nbsp;Create Product</a>
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
                <th>Product Name</th>
                <th>Product Descripion</th>
                <th>Product Fields</th>
                <th>Status</th>
                <th width="12%">Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
               <th>S.No</th>
                <th>Product Name</th>
                <th>Product Descripion</th>
                <th>Product Fields</th>
                <th>Status</th>
                <th width="12%">Action</th>                
              </tr>
            </tfoot>
            <tbody>
			<?php 
				
				$fieldData=getProducts();
			    foreach($fieldData as $index=>$data):
			?>
			<tr>
				<td><?php echo ($index+1);?> </td>
				<td><?php echo $data->product_name;?></td>
				<td><?php echo $data->product_description;?></td>
				<td>
					<?php $fields=getProductsFields($data->product_fields); if(!empty($fields)):?>
					<ul style='list-style:none;padding:0;margin:0;'>
						<?php foreach($fields as $field):?>
							<li><a style="text-decoration:none;" href="custom-field-entry?id=<?php echo $field->id;?>"><i class="icon wb-pencil"></i>&nbsp;&nbsp;<?php echo $field->field_name;?></a></li>
						<?php endforeach;?>
					</ul>
					<?php endif;?>
				</td>
				<td style="vertical-align:middle">
				<?php if($data->product_status=='0'):?>
					<div class="label label-danger" style="background:#F70505;">Disabled</div>
				<?php endif;?>
				<?php if($data->product_status=='1'):?>
					<div class="label label-success" style="background:#79A70A;">Enabled</div>
				<?php endif;?>				
				</td>
				<td style="vertical-align:middle">
					<a class="btn btn-xs btn-success" href="product-entry?id=<?php echo $data->id;?>"><i class="icon wb-pencil"></i>&nbsp;Edit</a>&nbsp;		
					<a class="btn btn-xs btn-dark" href="products?id=<?php echo $data->id;?>&task=delete" onclick="if(!confirm('Are you sure to delete?')){return false;}"  ><i class="icon wb-trash"></i>&nbsp;Delete</a>
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