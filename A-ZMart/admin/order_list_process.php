 <?php 
        //include "../includes/db.php";
$server="localhost";
$username="ravisharan";
$password="hello123";
$database="online_shopping";

 $conn= mysqli_connect($server,$username,$password,$database);
 
 if(isset($_REQUEST['order_status'])){
	 $up_sql = "UPDATE orders SET order_status ='$_REQUEST[order_status]' WHERE order_id ='$_REQUEST[order_id]' ";
	 $up_run = mysqli_query($conn,$up_sql);
 }
 if(isset($_REQUEST['order_return_status'])){
	 $up_sql = "UPDATE orders SET order_return_status ='$_REQUEST[order_return_status]' WHERE order_id ='$_REQUEST[order_id]' ";
	 $up_run = mysqli_query($conn,$up_sql);
 }
 
 ?>
 <table class="table table-bordered table-striped">
		        <thead>
				      <tr class="item-head">
					       <th>s.no</th>
					       <th>Buyer Name</th>
					       <th>Buyer Email</th>
					       <th>Buyer contact</th>
					       <th>Buyer state</th>
					       <th>Buyer Delivery address</th>
					       <th>order ref</th>
					       <th class="text-right">total payment</th>
					       <th>order status</th>
					       <th class="text-center">Return status</th>
					  </tr>
				</thead>
				<tbody>
				 <?php
				        $sql = "SELECT * FROM orders";
						$run =mysqli_query($conn,$sql);
						$c =1;
				while($rows = mysqli_fetch_assoc($run)){
					if($rows['order_status'] == 0){
						$status_btn_class='btn-warning';
						$status_btn_value ='pending';
					}
					else{
						 $status_btn_class='btn-success';
						$status_btn_value ='sent';
					}
					if($rows['order_return_status'] ==0){
						$return_btn_class='btn-danger';
						$return_btn_value ='Returned';
					}
					else{
						$return_btn_class='btn-primary';
						$return_btn_value ='No return';
					}
					echo "
						<tr>
					        <td>$c</td>
					        <td>$rows[order_name]</td>
					        <td>$rows[order_email]</td>
					        <td>$rows[order_contact]</td>
					        <td>$rows[order_state]</td>
					        <td>$rows[order_delivery_address]</td>
					        <td>
							<button class='btn btn-info 'data-toggle='modal' 
							data-target='#order_chk_modal$rows[order_id]'>$rows[order_checkout_ref]</button>
							<div class='modal fade' id='order_chk_modal$rows[order_id]'>
							     <div class='modal-dialog'>
							         <div class='modal-content'>
									      <div class='modal-header'>header</div>
										  <div class='modal-body'>
										        <table class='table'>
												      <thead>
													          <tr>
															       <th>s.no</th>
															       <th>Item</th>
															       <th>Qty</th>
															       <th class='text-right'>Price</th>
															       <th class='text-right'>Sub total</th>
															  </tr>
													  </thead>
												       <tbody>";
													   
													   //$chk_sql = "SELECT * FROM checkout WHERE chk_ref = '$rows[order_checkout_ref]'";
													   
													   $chk_sql = "SELECT * FROM checkout c JOIN items i ON c.chk_item = i.item_id 
													   WHERE c.chk_ref = '$rows[order_checkout_ref]'";
													  
													   $chk_run = mysqli_query($conn, $chk_sql);
													   $c =1;
													   while($chk_rows = mysqli_fetch_assoc($chk_run)){
														   if($chk_rows['item_title']==''){
															   $item_title = 'sorry data deleted';
														   }
														   else{
															    $item_title = $chk_rows['item_title'];
														   }
														   $total = $chk_rows['chk_quantity'] * $chk_rows['item_price'];
														   
														  echo" 
														    <tr>
																        <td>$c</td>
																        <td>$item_title</td>
																        <td>$chk_rows[chk_quantity]</td>
																        <td class='text-right'>$chk_rows[item_price]/=</td>
																        <td class='text-right'>$total/=</td>
																</tr>";
																$c++;
													   }
													   
													echo"           
													   </tbody>
												</table>
												<table class='table'>
												      <thead>
													       <tr>
														         <th colspan='2' class='text-center'>Order Summary</th>
														   </tr>
													  </thead>
													  <tbody>
													         <tr>
															       <td>Grand Total</td>
															       <td class='text-right'>$rows[order_total]/=</td>
															 </tr>
													  </tbody>
												</table>
										  </div>
										  <div class='modal-footer'>footer</div>
									 </div>
								</div>
							</div>
							</td>
					        <td class='text-right'>$rows[order_total]</td>"; ?>
				       <td class='text-center'><button onclick="order_status(
				       <?php echo $rows['order_status'].','.$rows['order_id'] ?>);" class='btn  btn-block btn-sm 
					  <?php echo $status_btn_class;?>'><?php echo $status_btn_value; ?></button></td>
							
					    <td class="text-center"><button onclick="return_status(
						<?php echo $rows['order_return_status'].','.$rows['order_id'] ?>);" class='btn btn-primary btn-sm 
						<?php echo $return_btn_class;?>'>
						<?php echo $return_btn_value; ?></button></td>
						
					 </tr>
						<?php
							$c++;
						}
				 
				 ?>
				    
				</tbody>
</table>