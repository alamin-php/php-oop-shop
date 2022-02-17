<?php include "inc/header.php"; ?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
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
								$getPro =  $ct->getCartProduct();
								if($getPro){
									while($result = $getPro->fetch_assoc()){
										$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result["productName"]; ?></td>
								<td><img src="admin/<?php echo $result["image"]; ?>" alt=""/></td>
								<td>Tk. <?php echo $result["price"]; ?></td>
								<td>
									<form action="" method="post">
										<input type="number" name="quantity" value="<?php echo $result["quantity"]; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>Tk. 40000</td>
								<td><a href="">X</a></td>
							</tr>
							<?php }} ?>

						</table>
						<table style="float:right;text-align:left;" width="45%">
							<tr>
								<th>Sub Total : </th>
								<td>TK. 210000</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>TK. 31500</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>TK. 241500 </td>
							</tr>
					   </table>
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