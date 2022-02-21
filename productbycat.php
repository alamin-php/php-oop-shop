<?php include "inc/header.php"; ?>
<?php 
	if(!isset($_GET["catId"]) || $_GET['catId'] == NULL){
		echo "<script>window.location='index.php'</script>";
	}else{
		$id = $_GET['catId'];
	}
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Iphone</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php 
			 	$getProduct = $pd->getProductByCat($id);
				 if($getProduct){
					 while($result = $getProduct->fetch_assoc()){ 
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $result['productId'] ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result["productName"]; ?></h2>
					 <p><?php echo $fm->textShorten($result["body"], 100); ?></p>
					 <p><span class="price">$<?php echo $result["price"]; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php } ?>
				<?php }else{
					?>
						<p>Product of this category are not available!</p>
					<?php
				} ?>

			</div>

	
	
    </div>
 </div>
</div>
<?php include "inc/footer.php"; ?>