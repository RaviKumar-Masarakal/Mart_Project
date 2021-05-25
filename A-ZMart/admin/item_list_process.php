 <?php 
       //include "../includes/db.php";
$server="localhost";
$username="ravisharan";
$password="hello123";
$database="online_shopping";

 $conn= mysqli_connect($server,$username,$password,$database);
 
	   if(isset($_REQUEST['del_item_id'])){
		   $del_sql = "DELETE FROM items WHERE item_id = '$_REQUEST[del_item_id]' ";
		   mysqli_query($conn,$del_sql);
	   }
	
    if(isset($_REQUEST['up_item_id'])){
		
	   $item_title = mysqli_real_escape_string($conn,strip_tags($_REQUEST['item_title']));
	   $item_description =	mysqli_real_escape_string($conn, $_REQUEST['item_description']);
	   $item_category =	 mysqli_real_escape_string($conn,strip_tags($_REQUEST['item_category']));
	   $item_quantity =	 mysqli_real_escape_string($conn,strip_tags($_REQUEST['item_quantity']));
	   $item_cost =  mysqli_real_escape_string($conn,strip_tags($_REQUEST['item_cost']));
       $item_price =  mysqli_real_escape_string($conn,strip_tags($_REQUEST['item_price']));
	   $item_discount =  mysqli_real_escape_string($conn,strip_tags($_REQUEST['item_discount']));
	   $item_delivery =  mysqli_real_escape_string($conn,strip_tags($_REQUEST['item_delivery']));
	   
	   $item_id = $_REQUEST['up_item_id'];
	   
	           // $item_ins_sql = "INSERT INTO items (item_title,item_description,item_category,item_quantity,item_cost,
				//item_price,item_discount,item_delivery) VALUES('$item_title','$item_description',
				//'$item_category','$item_quantity','$item_cost','$item_price','$item_discount','$item_delivery')";
				
				$item_up_sql = "UPDATE items SET item_title = '$item_title',item_description = '$item_description' , item_category = '$item_category' , item_quantity = '$item_quantity',
				item_cost = '$item_cost' , item_price = '$item_price' , item_discount = '$item_discount', item_delivery = '$item_delivery' WHERE item_id = '$item_id' ";
				$item_up_run = mysqli_query($conn, $item_up_sql);
		
	 
		
	}  
 	
?>
 <table class="table table-bordered table-striped" >
		      <thead>
			        <tr class="item-head">
					       <th>s.no</th>
					       <th>Image</th>
					       <th>Item Table</th>
					       <th>Item Description</th>
					       <th>Item category</th>
					       <th>Item qty</th>
					       <th>Item cost</th>
						    <th>Item discount</th>
					       <th>Item price</th>
					      
					       <th>Item delivery</th>
						   <th>Actions</th>
					</tr>
			  </thead>
			  <tbody>
			   <?php
			        $c =1;
			         $sel_sql ="SELECT * FROM items";
					 $sel_run = mysqli_query($conn,$sel_sql);
					 while($rows = mysqli_fetch_assoc($sel_run)){
						 $discounted_price = $rows['item_price'] - $rows['item_discount'];
						 echo "
						  <tr>
					       <td>$c</td>
					       <td><img src='../$rows[item_image]' style='width:50px'></td>
					       <td>$rows[item_title]</td>
					       <td>";echo strip_tags($rows['item_description']); echo"</td>
					       <td>$rows[item_cat]</td>
						   <td>$rows[item_quantity]</td>
					       <td>$rows[item_cost]/=</td>
						   <td>$rows[item_discount]/=</td>
					       <td>$discounted_price($rows[item_price])/=</td>
					       
					       <td>$rows[item_delivery]/=</td>
						   <td>
						        <div class='dropdown'>
								        <button class='btn btn-success btn-red dropdown-toggle'data-toggle='dropdown'>
										Actions<span class='caret'></span></button>
										<ul class='dropdown-menu dropdown-menu-right'>
										      <li>
											  <a href='#edit_modal'data-toggle='modal' >Edit</a>
											 
											  </li> ";?>
						
										      <li><a href="javascript:;" onclick="del_item(<?php 
											  echo $rows['item_id'];?>);">Delete</a></li>
										<?php echo"</ul>
								</div>
								
										       <div class='modal fade' id='edit_modal'>
											      <div class='modal-dialog'>
												     <div class='modal-content'>
													         <div class='modal-header'>
						                                        <button class='close' data-dismiss='modal'>&times;</button>
								                                 <h4 class='modal-title'>EDIT Item</h4>
						                                    </div>
				                                           <div class='modal-body'>
						                                      <div id=form1>
						                                          
								                               <div class='form-group'>
								                                    <label>Item title</label>
									                                 <input type='text' id='item_title' value='$rows[item_title]' class='form-control'required>
								                                </div>
								                               <div class='form-group'>
								                                    <label>Item Description</label>
									                                <textarea class='form-control' id='item_description'  value='$rows[item_description]'required></textarea>
								                                </div>
								                               <div class='form-group'>
								                                       <label>Item Category</label>
									                                   <select class='form-control' id='item_category' required>
									                                      <option>select a category</option>  ";
									         
                                                 $cat_sql = " SELECT * FROM item_cat";
												 $cat_run = mysqli_query($conn,$cat_sql);
												 while( $cat_rows = mysqli_fetch_assoc($cat_run)){
													 $cat_name = ucwords($cat_rows['cat_name']);
													if($cat_rows['cat_slog'] == ''){
													
														  $cat_slog = $cat_rows['cat_name'];
													}
                                                    else{
														  $cat_slog = $cat_rows['cat_slog'];
													}													
													if($cat_slog == $rows['item_cat']){
														echo "<option selected value='$cat_slog'>$cat_name</option>";
													}else{
														
														echo"
													   <option value='$cat_slog'>$cat_name</option>
													    "; 
													} 
													 
													
												 }
										  
									           
								echo" </select>
								 </div>
								  <div class='form-group'>
								      <label>Item quantity</label>
									  <input type='number' class='form-control' id='item_quantity' value='$rows[item_quantity]'required>
								 </div>
								 <div class='form-group'>
								      <label>Item cost</label>
									  <input type='number' class='form-control' id='item_cost' value='$rows[item_cost]'required>
								 </div>
								 <div class='form-group'>
								      <label>Item price</label>
									  <input type='number' class='form-control' id='item_price' value='$rows[item_price]'required>
								 </div>
								 <div class='form-group'>
								      <label>Item Discount</label>
									  <input type='number' class='form-control' id='item_discount' value='$rows[item_discount]'required>
								 </div>
								 <div class='form-group'>
								      <label>Item Delivery</label>
									  <input type='number' class='form-control' id='item_delivery' value='$rows[item_delivery]'>
								 </div>
								 <div class='form-group'>
								      <input type='hidden' id='up_item_id' value= '$rows[item_id]'>"; ?>
									  <button class='btn btn-success btn-block'onclick="edit_item();">submit</button>
								 </div>
						  </div>
						</div>
				        <div class='modal-footer'>
						    <button class='btn btn-danger' data-dismiss='modal'>Close</button>
						</div>
		       </div>
			   </div>
						   
                </td>
					       
				</tr>
			    <?php
	
						 $c++;
					 }
			   ?>
			   
			       
			  </tbody>
		</table>
	