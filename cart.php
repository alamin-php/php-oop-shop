<?php include "inc/header.php"; ?>
<?php 
	if(isset($_GET["delId"])){
		$delId = $_GET["delId"];
		$delProduct = $ct->delProductByCart($delId);
	}
	if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["submit"])){
		$cartId = $_POST["cartId"];
		$quantity = $_POST["quantity"];
		$updateCart = $ct->updateCart($quantity, $cartId);
		if($quantity <= 0){
			$delProduct = $ct->delProductByCart($cartId);
		}
	}
?>
<?php 
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=alamin' />";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
					<?php 
						if(isset($updateCart)){
							echo $updateCart;
						}
						if(isset($delProduct)){
							echo $delProduct;
						}
					?>
						<table class="tblone">
							<tr>
								<th width="10%">SL</th>
								<th width="15%">Product Name</th>
								<th width="10%">Image</th>
								<th width="10%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								$i=0;
								$sum = 0;
								$getPro =  $ct->getCartProduct();
								if($getPro){
									while($result = $getPro->fetch_assoc()){
										$i++;
							?>
							<tr>
								<?php 
									$chCart = $ct->checkCartTable();
									if($chCart){
								?>
								<td><?php echo $i; ?></td>
								<td><?php echo $result["productName"]; ?></td>
								<td><img src="admin/<?php echo $result["image"]; ?>" alt=""/></td>
								<td><?php echo $result["price"]; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result["cartId"]; ?>"/>
										<input type="number" name="quantity" value="<?php echo $result["quantity"]; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>
									$ <?php 
										$total = $result["price"] * $result["quantity"];
										echo $total;
									?>
								</td>
								<td><a onclick="return confirm('Are your sure to delete?')"; href="?delId=<?php echo $result['cartId']; ?>">X</a></td>
							</tr>
							
							<?php 
							$chCart = $ct->checkCartTable();
							if($chCart){
								$sum = $sum + $total;
								Session::set("sum", $sum);
							}
							?>
							<?php }} ?>

						</table>
						
						<table style="float:right;text-align:left;" width="45%">
							<tr>
								<th>Sub Total : </th>
								<td>$ <?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php 
										$vat = $sum * 0.1;
										$gtotal = $sum + $vat;
										echo $gtotal;
									?>
								</td>
							</tr>
					   </table>
					   <?php }else{echo "Cart Empty! Please Shop Now !";} ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include "inc/footer.php"; ?>