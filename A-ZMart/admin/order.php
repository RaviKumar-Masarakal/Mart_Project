<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>order| Admin panel | Online Shopping</title>
	  <link rel="stylesheet" href="../css/bootstrap.css">
   	 <link rel="stylesheet" href="../css/font-awesome.css">
	 <link rel="stylesheet" href="../admin-style.css">
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script>
	          function get_order_list(){
				 
				xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function()	{
					if(xmlhttp.readyState ==4 && xmlhttp.status == 200){
						document.getElementById('get_order_list_data').innerHTML = xmlhttp.responseText;
					}
					
				}
                xmlhttp.open('GET','order_list_process.php',true);
                xmlhttp.send();				
			 }
			 
			 
			 function order_status(order_status,order_id){
				 if(order_status == 1){
					 order_status = 0;
				 }else{
					 order_status =1;
				 }
				 
				 xmlhttp.onreadystatechange = function() {
					if(xmlhttp.readyState ==4 && xmlhttp.status == 200){
						document.getElementById('get_order_list_data').innerHTML = xmlhttp.responseText;
					}
					
				}
				xmlhttp.open('GET','order_list_process.php?order_status='+order_status+'&order_id='+order_id,true);
                xmlhttp.send();	
			 }
			 function return_status(order_return_status,order_id){
				  if(order_return_status == 1){
					 order_return_status = 0;
				 }else{
					 order_return_status = 1;
				 }
				 xmlhttp.onreadystatechange = function() {
					if(xmlhttp.readyState ==4 && xmlhttp.status == 200){
						document.getElementById('get_order_list_data').innerHTML = xmlhttp.responseText;
					}
					
				}
				xmlhttp.open('GET','order_list_process.php?order_return_status='+order_return_status+'&order_id='+order_id,true);
                xmlhttp.send();	 
			 }
	</script>
</head>
<body onload="get_order_list();">
	 <?php include 'includes/header.php';  ?>
	      <div class="container">
		     <div id="get_order_list_data">
			        <!---getting  ordered data here-->
			 </div>
		  </div>
	 <?php include 'includes/footer.php';  ?>
	 
</body>
</html>