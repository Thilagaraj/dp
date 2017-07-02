<?php 
include('MysqliDb.php');
$mysqlHost='localhost';
$mysqlUser='root';
$mysqlPassword='';
$mysqlDB='dharani';
$db = new MysqliDb($mysqlHost, $mysqlUser, $mysqlPassword,$mysqlDB);

function login($email,$password){
	$isValid=false;
	if($email!='' && $password!=''){
		global $db;
		$db->where('email',$email);
		$db->where('password',$password);
		$row = $db->ObjectBuilder()->getOne('dp_users');
		if(!empty($row)){
			$isValid=$row;
		}else{
			$isValid=false;
		}
	}
	return $isValid;
}

function fieldValue($array,$name,$default="",$isDate=false){
	$value=$default;
	if(isset($array) && isset($array[$name])){
		$value=$array[$name];
	}
	if($value && $isDate){
		$value=date('d/m/Y',strtotime($value));
	}
	if($value==='01/01/1970'){
		$value="";
	}
	return $value;
}

function dataFilterForDB($array){
	$temparray=[];
	foreach($array as $key=>$value){
		if(strpos($key,'order_')>-1 || strpos($key,'field_')>-1 || strpos($key,'product_')>-1){
			$temparray[$key]=$value;
			if(strpos($key,'date')>-1){
				$temparray[$key]=getFormatedDate($value,true);
			}
		}		
	}
	return $temparray;
}

function createOrder($postArray){
	$dataArray=dataFilterForDB($postArray);
	global $db;
	$id=$db->insert('dp_orders', $dataArray);
	return $id;
}

function updateOrder($postArray){
	$dataArray=dataFilterForDB($postArray);
	global $db;
	$db->where('id',$postArray['id']);
	if($postArray['delete']==1){
		$dataArray['is_deleted']=1;
	}
	if($postArray['order_status']=='Delivered' && $dataArray['order_actual_delivered_date']==''){
		$dataArray['order_actual_delivered_date']=date('Y-m-d');
	}else{
		$dataArray['order_actual_delivered_date']="";
	}
	$dataArray['modified_date']=date('Y-m-d');
	$id=$db->update('dp_orders', $dataArray);
	return $id;
}

function getAllOrders($filterArray){
	global $db;
	if((isset($filterArray['filterType']) && $filterArray['filterType']=='between') && (isset($filterArray['from_date']) && $filterArray['from_date']!='') && (isset($filterArray['to_date']) && $filterArray['to_date']!='')){
		$filerQuery= 'where date between "'.getFormatedDate($filterArray['from_date'],true).'" and "'.getFormatedDate($filterArray['to_date'],true).'"';
		$db->where('order_date',array(getFormatedDate($filterArray['from_date'],true),getFormatedDate($filterArray['to_date'],true)),'BETWEEN');
	}
	if((isset($filterArray['filterType']) && $filterArray['filterType']=='specific') && (isset($filterArray['specific_date']) && $filterArray['specific_date']!='')){
		$filerQuery= 'where date = "'.getFormatedDate($filterArray['specific_date'],true).'"';
		$db->where('order_date',getFormatedDate($filterArray['specific_date'],true));
	}
	if((isset($filterArray['filterType']) && $filterArray['filterType']=='status') && (isset($filterArray['status']) && $filterArray['status']!='')){
		$db->where('order_status',$filterArray['status']);
	}
	$db->where('is_deleted',0);
	$db->orderBy("id","desc");
	$data = $db->ObjectBuilder()->get('dp_orders');
	return $data;
}

function getOrderById($id){	
	global $db;
	$db->where('id',$id);	
	$row = $db->getOne('dp_orders');
	return $row;
}

function getProducts($enabledOnly=false){
	global $db;
	if($enabledOnly)
		$db->where('product_status',1);
	$db->where('is_deleted',0);
	$db->orderBy("id","desc");
	$data = $db->ObjectBuilder()->get('dp_products');
	return $data;
}

function getProductById($id){	
	global $db;
	$db->where('id',$id);	
	$row = $db->getOne('dp_products');
	return $row;
}

function createUpdateProduct($postArray){
	$dataArray=dataFilterForDB($postArray);
	global $db;
	if($postArray['id']!=''){
		if($postArray['delete']==1){
			$dataArray['is_deleted']=1;
		}
		$db->where('id',$postArray['id']);
		$dataArray['modified_date']=date('Y-m-d');
		$id=$db->update('dp_products', $dataArray);
	}else{
		$id=$db->insert('dp_products', $dataArray);
	}
	return $id;
}

function getProductName($id){
	global $db;
	$db->where('id',$id);
	$data = $db->getValue('dp_products','product_name',null);
	return $data[0];
}

function createUpdateField($postArray){
	$dataArray=dataFilterForDB($postArray);
	global $db;
	if($postArray['id']!=''){
		if($postArray['delete']==1){
			$dataArray['is_deleted']=1;
		}
		$db->where('id',$postArray['id']);
		$dataArray['modified_date']=date('Y-m-d');
		$id=$db->update('dp_fields', $dataArray);
	}else{
		$id=$db->insert('dp_fields', $dataArray);
	}
	return $id;
}

function getFieldById($id){	
	global $db;
	$db->where('id',$id);	
	$row = $db->getOne('dp_fields');
	return $row;
}

function getAllFields($enabledOnly=false){
	global $db;
	if($enabledOnly)
		$db->where('field_status',1);
	$db->where('is_deleted',0);
	$db->orderBy("id","desc");
	$data = $db->ObjectBuilder()->get('dp_fields');
	return $data;
}

function getProductsByFieldId($fieldId){
	global $db;	
	$db->where("product_fields like '%".$fieldId.",%'");
	$db->orWhere("product_fields like '%,".$fieldId."%'");
	$data = $db->ObjectBuilder()->get('dp_products');
	return $data;
}

function getProductsFields($fieldIds){
	global $db;	
	$db->where("id in(".$fieldIds.")");
	$data = $db->ObjectBuilder()->get('dp_fields');
	return $data;
}

function getFormatedDate($dateStr,$dbInsert){
	if($dbInsert){
		list($d,$m,$y)=explode('/',$dateStr);
		$dt=$y.'-'.$m.'-'.$d;
		return $dt;		
	}else{
		list($d,$m,$y)=explode('-',$dateStr);
		$dt=$d.'/'.$m.'/'.$y;
		return $dt;
	}
	
}
