<?php include "includes/db.php"; 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>online shopping</title>
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	 <link rel="stylesheet" href="style.css">
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
<body>
	  <?php include 'includes/header.php'; ?>
	   <div class="container">
	     <div class="row">
		  <?php
		          $sql = "SELECT * FROM items";
				  $run = mysqli_query($conn,$sql);
		while($rows = mysqli_fetch_assoc($run)){
					 
			$discounted_price = $rows['item_price']- $rows['item_discount'];
            $item_title = str_replace(' ','-',$rows['item_title']);			
		 echo"
		    <div class='col-md-3'>
			<div class='col-md-12 single-item nopadding'>
		            <div class='top'><img src='$rows[item_image]' class='img-responsive'></div>
					<div class='bottom'>
					      <div class='item-title'>
						      <h3 class='item_title'><a href='product.php?item_title=$item_title&item_id=$rows[item_id]'>$rows[item_title]</h3></a>
							 <div class='pull-right cutted-price text-muted'><del>$ $rows[item_price]/=</del></div>
							 <div class='clearfix'></div>
							 <div class='pull-right discounted-price'>$ $discounted_price/=</div>
							 
						  </div>
					</div>
			</div>
	        </div>";
			
        }		
	   ?>
	        </div>
		 </div>
	   <div class="clearfix"></div>
	   <?php include 'includes/footer.php'; ?>
</body>
</html>