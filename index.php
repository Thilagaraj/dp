<?php include('includes/header.php');?>
   <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title"><i class="icon wb-list" aria-hidden="true"></i>Printing Orders</h1>
    </div>
		<div class="page-content">
		 <div class="panel" style="padding-bottom:0;">
			<div class="panel-body">
				<div class="row">
				<form method="POST">
					<div class="col-lg-2 col-md-2 col-sm-5 col-xs-12">
						<div class="input-group">
						<span class="input-group-addon">
						  <i class="icon wb-calendar" aria-hidden="true"></i>
						</span>
						<input type="text" class="form-control" style="background:#fff;cursor:text;"  name="from_date" placeholder="From Date" readonly data-plugin="datepicker" value="<?php echo (isset($_REQUEST['from_date']) ? $_REQUEST['from_date'] : '');?>" placeholder="DD/MM/YYYY" required="" readonly data-format="dd/mm/yyyy">
					  </div>
					</div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 visible-xs" style="height:10px;"></div>
					<div class="col-lg-2 col-md-2 col-sm-5 col-xs-12">
						<div class="input-group">
						<span class="input-group-addon">
						  <i class="icon wb-calendar" aria-hidden="true"></i>
						</span>
						<input type="text" class="form-control" style="background:#fff;cursor:text;" name="to_date" placeholder="To Date" readonly data-plugin="datepicker" placeholder="DD/MM/YYYY" value="<?php echo (isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : '');?>" required="" readonly data-format="dd/mm/yyyy">
					  </div>
					</div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 visible-xs" style="height:10px;"></div>
					<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
						<button class="btn btn-success" style="position:relative;right:20px;" data-loading><i class="icon wb-stats-bars" aria-hidden="true"></i>Filter</button>
					</div>
					<input type="hidden" name="filterType" value="between"/>
					</form>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 visible-xs visible-sm" style="height:10px;"></div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 visible-xs" style="height:20px;"></div>
					
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 visible-xs visible-sm" style="height:10px;"></div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 visible-xs" style="height:20px;"></div>
					<form method="POST" >
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
						<div class="input-group">
						<span class="input-group-addon">
						  <i class="icon wb-calendar" aria-hidden="true"></i>
						</span>
						<input type="text" class="form-control" style="background:#fff;cursor:text;" name="specific_date" placeholder="Specific Date" readonly data-plugin="datepicker" placeholder="DD/MM/YYYY" required="" readonly data-format="dd/mm/yyyy" value="<?php echo (isset($_REQUEST['specific_date']) ? $_REQUEST['specific_date'] : '');?>">
					  </div>
					</div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 visible-xs" style="height:10px;"></div>
					<div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
						<button class="btn btn-success" style="position:relative;right:20px;" data-loading ><i class="icon wb-stats-bars" aria-hidden="true"></i>Filter</button>
					</div>
					
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
						<a class="btn btn-success" href="index" data-loading ><i class="icon wb-refresh" aria-hidden="true"></i>Clear Filtered</a>
					</div>
					<input type="hidden" name="filterType" value="specific"/>
					</form>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 visible-xs" style="height:10px;"></div>
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 text-right">
						<a class="btn btn-success"  href="order-entry" data-loading ><i class="icon wb-plus" aria-hidden="true"></i>&nbsp;&nbsp;Create Order</a>
					</div>
					
					
				</div>
			</div>
		 </div>
	</div>
    <div class="page-content" style="padding-top:5px;">

      <!-- Panel Basic -->
      <div class="panel" >        
        <div class="panel-body">
		 <?php if(isset($_SESSION['message']) && $_SESSION['message']!=''):?>
			<div class="alert alert-success"><strong><?php echo $_SESSION['message'];unset($_SESSION['message']);?></strong></div><br />
		<?php endif;?>
			<div class="row" style="border-bottom:1px solid #ddd">
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" >
				<form method="POST" name="sfilter">
					 <select class="form-control" id="initial" name="status"  style="position:relative;bottom:10px;right:10px;" onchange="sfilter.submit();" data-selected="<?php echo (isset($_REQUEST['status']) ? $_REQUEST['status'] : '');?>">
						  <option value="">- Filter By Status -</option>
						  <option value="In Progress">In Progress</option>
						  <option value="Delivered">Delivered</option>
					</select>			
					<input type="hidden" name="filterType" value="status"/>
					</form>
				</div>
			</div><br/>
		   <table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Order Id</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Product</th>
                <th>Qty.</th>
                <th>Recieved Date</th>
                <th>Due Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th width="18%">Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>S.No</th>
				<th>Order Id</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Product</th>
				<th>Qty.</th>
                <th>Recieved Date</th>
                <th>Due Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th width="18%">Action</th>
              </tr>
            </tfoot>
            <tbody>
			<?php 
				if(isset($_REQUEST['filterType'])){
					$orderData=getAllOrders($_REQUEST);
				}else{
					$orderData=getAllOrders([]);
				}				
			    foreach($orderData as $index=>$data):
			?>
			<tr>
				<td><?php echo ($index+1);?> </td>
				<td><?php echo 'DPORD0000'.$data->id;?></td>
				<td><?php echo $data->order_name;?></td>
				<td><?php echo $data->order_phone;?></td>
				<td><?php echo getProductName($data->order_product);?></td>
				<td><?php echo $data->order_quantity;?></td>
				<td><?php echo date('d/m/Y',strtotime($data->order_date));?></td>
				<td><?php echo date('d/m/Y',strtotime($data->order_delivery_date));?></td>
				<td>&#8377; <?php echo $data->order_amount;?></td>
				<td>
				<?php if($data->order_status=='In Progress'):?>
					<div class="label label-danger" style="background:#F70505;"><?php echo $data->order_status;?></div>
				<?php endif;?>
				<?php if($data->order_status=='Delivered'):?>
					<div class="label label-success" style="background:#79A70A;"><?php echo $data->order_status;?></div>
				<?php endif;?>				
				</td>
				<td style="vertical-align:middle">
					<a class="btn btn-xs btn-success" href="order-entry?id=<?php echo $data->id;?>"><i class="icon wb-pencil"></i>&nbsp;Edit</a>&nbsp;
					<a class="btn btn-xs btn-dark" href="order-print?id=<?php echo $data->id;?>"><i class="icon wb-print"></i>&nbsp;Print</a>&nbsp;
					<a class="btn btn-xs btn-danger" href="index?id=<?php echo $data->id;?>&task=delete" onclick="if(!confirm('Are you sure to delete?')){return false;}"  ><i class="icon wb-trash"></i>&nbsp;Delete</a>
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