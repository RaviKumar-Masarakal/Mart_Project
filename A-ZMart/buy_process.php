 <?php session_start();
 //include 'includes/db.php';
$server="localhost";
$username="ravisharan";
$password="hello123";
$database="online_shopping";

 $conn = mysqli_connect($server,$username,$password,$database);

 
 if(isset($_REQUEST['chk_del_id'])){
   $chk_del_sql = " DELETE FROM checkout WHERE chk_id = '$_REQUEST[chk_del_id]' ";
   $chk_del_run = mysqli_query( $conn , $chk_del_sql);
 
 }
if(isset($_REQUEST['up_chk_quantity'])){
	$up_chk_qty_sql = "UPDATE checkout SET chk_quantity = '$_REQUEST[up_chk_quantity]' WHERE chk_id = '$_REQUEST[up_chk_id]'";
	$up_chk_qty_run = mysqli_query($conn,$up_chk_qty_sql);
} 
                     $c = 1;
					 $total = 0;
					 $delivery_charges = 0;
				     // $chk_sel_sql = "SELECT * FROM checkout WHERE chk_ref = '$_SESSION[ref]'";
				      $chk_sel_sql = "SELECT * FROM checkout c JOIN items i ON c.chk_item = i.item_id WHERE chk_ref = '$_SESSION[ref]'";
					  $chk_sel_run = mysqli_query($conn,$chk_sel_sql);
					  while($chk_sel_rows = mysqli_fetch_assoc($chk_sel_run)){
						   $discounted_price = $chk_sel_rows['item_price'] - $chk_sel_rows['item_discount'];
						    $sub_total = $discounted_price * $chk_sel_rows['chk_quantity'];
							$total += $sub_total;
							$delivery_charges += $chk_sel_rows['item_delivery'];
						   echo"
						      <tr>
						      <td>$c</td>
						      <td >$chk_sel_rows[item_title]</td>";  ?>
						      <td ><input type='number' style='width:50px' onblur= "up_chk_quantity(this.value,'<?php echo $chk_sel_rows['chk_id']; ?>');"
							  value='<?php echo $chk_sel_rows['chk_quantity']; ?>'></td>
							  
	
						      
							<td ><button class='btn btn-danger' onclick = "del_func(<?php echo $chk_sel_rows['chk_id'];?>);">delete</button></td>
						      
					<?php 
             					echo " <td ><b>$discounted_price/=</b></td>
							       <td class='text-right'><b>$sub_total/=</b></td>
						      
						        </tr> ";
						          $c++;  
						        
					  }
					  $_SESSION['grand_total'] = $total + $delivery_charges;
					  echo "
		        
				  </tbody>
				   <table class='table'>
				     <thead>
					        <tr>
							      <th class='text-center'colspan='2'><h3>Order Summary</h3></th>
							</tr>
					 </thead>
				    <tbody>
				    <tr>
				      <td>total</td>
				      <td class='text-right'><b>$ $total/=</b></td>
					</tr>
					<tr>
				      <td>delivery charges</td>
				      <td class='text-right'><b>$delivery_charges</b></td>
					</tr>
					<tr>
					     <td>Grand Total</td>
					     <td class='text-right'><b>$_SESSION[grand_total]=/</b></td>
				    </tr>
				  </tbody>
			     </table>
					     ";
					  
?>
				      