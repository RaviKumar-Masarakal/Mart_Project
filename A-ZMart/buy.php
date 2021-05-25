<?php session_start();
include "includes/db.php";
if(isset($_GET['chk_item_id'])){
	
	$date = date('y-m-d h:i:s'); 
	$rand_num = mt_rand();
	
	if(isset($_SESSION['ref'])){
		  
	}else{
		$_SESSION['ref']= $date.'_'.$rand_num;
	}
	
	
	$chk_sql = "INSERT INTO checkout (chk_item,chk_ref,chk_timing,chk_quantity) VALUES('$_GET[chk_item_id]','$_SESSION[ref]','$date',1)";
	
	if( mysqli_query($conn,$chk_sql)){
		?>
		
		<script>window.location ="buy.php";</script>
		
		<?php
	}
  }
  if(isset($_POST['order_submit'])){
	 
         $name = mysqli_real_escape_string($conn,strip_tags($_POST['name']));	 
         $email =  mysqli_real_escape_string($conn,strip_tags($_POST['email']));	 
         $contact = mysqli_real_escape_string($conn,strip_tags($_POST['contact']));	 
         $state = mysqli_real_escape_string($conn,strip_tags($_POST['state']));	 
         $delivery_address = mysqli_real_escape_string($conn,strip_tags($_POST['delivery_address']));
         
         $order_ins_sql = "INSERT INTO orders (order_name,order_email,order_contact,order_state,order_delivery_address,
		 order_checkout_ref,order_total) VALUES ('$name','$email','$contact','$state','$delivery_address','$_SESSION[ref]','$_SESSION[grand_total]')";		 
	     
		 mysqli_query($conn,$order_ins_sql);
  }

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>shopping cart</title>
	 <link rel="stylesheet" href="css/bootstrap.css">
	 <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="style.css">
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script>
	       function ajax_func(){
			   xmlhttp = new XMLHttpRequest();
			   
			   xmlhttp.onreadystatechange = function(){
				   if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					   
					   document.getElementById('get_processed_data').innerHTML = xmlhttp.responseText;
				   }
			   }
			   
			   xmlhttp.open('GET','buy_process.php',true);
			   xmlhttp.send();
		   }
		   function del_func(chk_id){
			   //alert(chk_id);
			    xmlhttp.open('GET', 'buy_process.php?chk_del_id='+chk_id , true);
			   xmlhttp.send();
			   xml.http.onreadystatechange = function(){
				   if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					   document.getElementById('get_processed_data').innerHTML = xmlhttp.responseText;
				   }
				   
			   }
			  
		   }
		   function up_chk_quantity(chk_quantity,chk_id){
			   //alert(chk_quantity);
			         xmlhttp.open('GET', 'buy_process.php?up_chk_quantity='+chk_quantity +'&up_chk_id='+chk_id , true);
			         xmlhttp.send();
			   xmlhttp.onreadystatechange = function(){
				    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						 document.getElementById('get_processed_data').innerHTML = xmlhttp.responseText;
					}
			   }
		   }
	</script>
   
</head>
<body onload="ajax_func();">
	<?php include'includes/header.php'; ?>
	<div class="container">
	   <div class="page-header">
	         <h2 class="pull-left">Checkout</h2>
			 <div class="pull-right"><button class="btn btn-success" data-toggle="modal" 
			 data-target="#proceed_modal" data-backdrop="static"data-keyboard="false">Proceed</button></div>
			 <!--The proceed form's modal-->
			 <div id="proceed_modal"class="modal fade">
			     <div class="modal-dialog modal-lg">
				     <div class="modal-content">
					   <div class="modal-header">
					         <button class="close"data-dismiss="modal">&times;</button>
					   </div>
					   <div class="modal-body">
					      <form method="post">
						       <div class="form-group">
							        <label for="name">Name</label> 
									<input type="text" id="name"name="name" class="form-control"placeholder="Full name">
							   </div>
							   <div class="form-group">
							        <label for="email">Email Address</label> 
									<input type="email" id="email" name="email"class="form-control"placeholder="Email">
							   </div>
							   <div class="form-group">
							        <label for="contact">contact number</label> 
									<input type="text" id="contact" name="contact"class="form-control"placeholder="contact Number">
							   </div>
							   <div class="form-group">
							        <label for="state">State</label> 
									<input list="states" name="state" id="state" class="form-control">
									   <datalist id="states">
									      <option>washington</option>
									      <option>newyork</option>
									      <option>florida</option>
									      <option>delhi</option>
									      <option>origon</option>
									      <option>ohio</option>
									   </datalist>
							   </div>
							   <div class="form-group">
							        <label for="email">Delivery Address</label> 
									<textarea class="form-control" name="delivery_address">
									   
									</textarea>
							   </div>
							    <div class="form-group">
									<input type="submit" name="order_submit"class="btn btn-danger btn-block">
							   </div>
						  </form>
					   
					   </div>
					   <div class="modal-footer">
					     <button class="btn btn-default" data-dismiss="modal">close<button>
					   </div>
					 </div>
				 </div>
			 </div>
			 <div class="clearfix"></div>
	   </div>
	   <div class="panel panel-default">
	       <div class="panel-heading">Order Detail</div>
	       <div class="panel-body">
		      <table class="table">
			     <thead>
				       <th>s.no</th>
				       <th>item</th>
				       <th>qty</th>
				      
					   <th width="5%">delete</th>
					    <th>price</th>
				       <th class="text-right">total</th>
				       
				 </thead>
				    
				   <tbody id="get_processed_data">
				 <!--The buy process data--->
				      
						
				   </tbody>
			  </table>
			  <table class="table">
			    <thead>
				     <!-- <tr>
					      
					      <th class="text-center">order summary</th> 
					  </tr>  -->
				</thead>
			   
			  </table>
		   </div>
	   </div>
	</div>
	<br><br><br><br>
	<?php include'includes/footer.php'; ?>
</body>
</html>