<?php include "inc/header.php"; ?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>All Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
	<?php 
		$products = $pd->getAllProduct();
		if($products){
			while($result = $products->fetch_assoc()){
	?>
            <div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $result['productId'] ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result["productName"]; ?></h2>
					 <p><span class="price">$<?php echo $result["price"]; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php } ?>
			<?php } ?>
        </div>
        
    </div>
</div>
</div>
<?php include "inc/footer.php"; ?>