 <nav class="navbar navbar-inverse">
	        <div class="container-fluid">
			      <div class="navbar-header">
				       <a href="" class="navbar-brand">online shopping</a>
				  </div>
				  <div> 
				        <ul class="nav navbar-nav">
						      <li><a href="#">home</a></li>
							  
							  <?php
                                  $cat_sql = "SELECT * FROM item_cat";
								  $cat_run = mysqli_query($conn,$cat_sql);
								  while($cat_rows = mysqli_fetch_assoc($cat_run)){
									    $cat_name = ucwords($cat_rows['cat_name']);
										if($cat_rows['cat_slog']==''){
											$cat_slog = $cat_rows['cat_name'];
										}
										else
											 $cat_slog = $cat_rows['cat_slog'];
									  echo " <li><a href='category.php?category=$cat_slog'>$cat_name</a></li>";
								  }
							  ?>
						     
						      
						</ul>
				        <ul class="nav navbar-nav navbar-right">
						<li><a href="#">Logout</a><li>
						</ul>
				  </div>
			</div>
	   </nav>