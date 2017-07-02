<!doctype html>
<?php
include('common/functions.php');
$orderDetail=getOrderById($_REQUEST['id']);
$productDetail=getProductById($orderDetail['order_product']);
$productFields=$productDetail['product_fields'];
$orderId=$orderDetail['id'];
$productFields=getProductsFields($productFields);
$orderDetails=getOrderById($orderId);
$orderFieldsTemp=json_decode($orderDetails['order_custom_fields']);
$orderFields=[];
foreach($orderFieldsTemp as $of):
	$orderFields[$of->field_id]=$of->field_value;
endforeach;

?>
<html>
<head>
    <meta charset="utf-8">
    <title>Dharani Printers Order Invoice</title>
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-extend.min.css">
<link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">

    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:15px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:10px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    
    .box{
		background: #fdfdfd;
		border: 1px dashed #eee;
		min-height: 100px;
		padding: 10px;
	}
	.text-right{
		text-align:right;
	}
	.text-left{
		text-align:left;
	}
	.adInfoTbl .item:last-child td{
		border-bottom:0;
	}
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
	.buttons{
		position:fixed;
		top:5px;
		right:5px;
		width:200px;
		height:100px;
	}
	@media only print{
		.buttons{
			display:none;
		}
	}
	strong{
		font-weight:bold !important;
	}
    </style>
</head>

<body>
<div class="buttons">
	<a type="button" class="btn btn-dark" href="index">Cancel&nbsp;<i class="icon wb-close" aria-hidden="true"></i></a>	
	<a type="button" class="btn btn-success" href="javascript:window.print();">Print&nbsp;<i class="icon wb-print" aria-hidden="true"></i></a>	
</div>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="http://thilagaraj.me/wp/wp-content/themes/dharaniprinters/assets/images/logo.png" style="width:150px; max-width:150px;">
                            </td>
                            
                            <td>
                                Invoice #: <?php echo 'DPORD0000'.fieldValue($orderDetail,'id');?><br>
                                Created: <?php echo fieldValue($orderDetail,'order_date','',true);?><br>
                                Due: <?php echo fieldValue($orderDetail,'order_delivery_date','',true);?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2" style="padding:0;">
                    <table>
                        <tr>
                            <td width="49%" style="padding:0;padding-bottom:10px;">
								<div class="box">
								<strong>Order From :</strong><br>
                               <i> Dharani Offset Printers,<br>
                                #10,N.T.Road,Near Old Market,Sathyamangalam.<br>
								Erode(DT)-638401, Tamil Nadu, India.<br></i> <br>
								<strong>Tel: </strong> +91-4295-222110 / 223500<br>
								<strong>Fax: </strong> ++91-4295-220033<br>
								<strong>Email: </strong> dharaniprinters@yahoo.com<br>
								<strong>Email: </strong> dharaniprinter@gmail.com
								</div>
                            </td>
                            <td width="2%">
							</td>
                            <td  width="49%" style="padding:0;padding-bottom:10px;">
							<div class="box text-right">
								<strong>Order To :</strong><br>
                                <i> <?php echo fieldValue($orderDetail,'order_name');?><br>
                               <?php echo fieldValue($orderDetail,'order_address');?><br></i> <br>
								<strong>Tel: </strong> <?php echo fieldValue($orderDetail,'order_phone');?><br>
								<strong>Email: </strong> <?php echo fieldValue($orderDetail,'order_email');?>
							</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading" >
                <td >
                    Price Details (<?php echo getProductName($orderDetail['order_product']);?>)
                </td>
                
                <td>
                    Price
                </td>
            </tr>
            
            <?php 
			$totalPrice=0;
			foreach($productFields as $productField):?>
            <?php if( $productField->field_type=='price' || $productField->field_type=='dropdown' ):?>
            <tr class="item">
                <td>
                    <?php echo $productField->field_label;?> 
					<?php if( $productField->field_type=='dropdown'):?>
						( <i><?php echo fieldValue($orderFields,$productField->id);?></i> )
					<?php endif;?>
					
                </td>
                <td>
                    <?php if( $productField->field_type=='price'):?>
						<i><?php echo '&#8377;  '.fieldValue($orderFields,$productField->id);?></i>
					<?php endif;?>
					 <?php 
						if( $productField->field_type=='dropdown'):
						$fieldOptions=json_decode($productField->field_options);						
						foreach($fieldOptions as $fopt):	
						if(fieldValue($orderFields,$productField->id)==$fopt->option_value){
						?>
						<?php echo '&#8377;  '.($fopt->option_price ? $fopt->option_price : 0);?>					
						<?php
						$totalPrice+=number_format($fopt->option_price ? $fopt->option_price : 0);
						}
						endforeach;
						endif;
					?>
                </td>
            </tr>
            <?php endif;?>
            <?php endforeach;?>
			<tr class="item">
					<td>
						<strong>Quantity</strong>
					</td>
					<td>
						<strong>x <?php echo fieldValue($orderDetail,'order_quantity',1);?></strong>
					</td>
				</tr>
			  <tr class="item">
					<td>
						<strong>Total</strong>
					</td>
					<td>
						<strong>&#8377; <?php echo number_format($totalPrice*fieldValue($orderDetail,'order_quantity',1));?></strong>
					</td>
				</tr>
				<tr class="item">
					<td>
						Paid Amount 
					</td>
					<td>
						&#8377; <?php echo number_format(fieldValue($orderDetail,'order_amount_paid',1));?>
					</td>
				</tr>
				<tr class="item">
					<td>
						Balance Amount
					</td>
					<td>
						&#8377; <?php echo number_format(fieldValue($orderDetail,'order_amount_balance',1));?>
					</td>
				</tr>
				<tr><td colspan="2" ></td></tr>
				<tr><td colspan="2" ></td></tr>
				<tr>
					<td width="50%">
						<div class="box">
							<strong>Additional Information</strong><br/>
							<p><?php echo fieldValue($orderDetail,'order_additional_info');?></p>
						</div>
					</td>
					<td width="50%">
						<div class="box">
							<strong>Additional Printing Options</strong><br/>
							<table class="adInfoTbl">
								<?php 
								$totalPrice=0;
								foreach($productFields as $productField):?>
								<?php if( $productField->field_type!='price' && $productField->field_type!='dropdown' ):?>
								<tr class="item">
									<td class="text-right">
										<?php echo $productField->field_label;?> 
										( <i><?php echo fieldValue($orderFields,$productField->id);?></i> )
									</td>
								</tr>
								<?php endif;?>
								<?php endforeach;?>
							</table>
						</div>
					</td>
				</tr>
				
				<tr><td colspan="2" ></td></tr>
				<tr style="border-top:1px solid #ddd;font-size:13px;">
				<td >
				&copy; 2017,  All rights reserved.
				</td>
				<td class="text-right">
				Dharani Offset Printers, Sathyamangalam.
				</td>
				</tr>
        </table>
    </div>
</body>
</html>