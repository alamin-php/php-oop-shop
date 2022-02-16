<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../helpers/Format.php';?>
<?php include '../classes/Category.php';?>
<?php include '../classes/Brand.php';?>
<?php include '../classes/Product.php';?>

<?php 
    $pd = new Product();
    $fm = new Format();
    if(isset($_GET["delPdId"])){
        $id = $_GET["delPdId"];
		$delProduct = $pd->deleteProductById($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
		<?php 
			if(isset($delProduct)){
				echo "<span class='success'>Product Deleted Successfylly !</span>";
			}
		?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i=0;
					$getPd = $pd->getAllProduct();
					if($getPd){
						while($result = $getPd->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><a href="productview.php?viewPdId=<?php echo $result['productId']; ?>"><?php echo $result["productName"]; ?></a></td>
					<td><?php echo $result["catName"]; ?></td>
					<td><?php echo $result["brandName"]; ?></td>
					<td><?php echo $fm->textShorten($result["body"], 50); ?></td>
					<td><?php echo $result["price"]; ?></td>
					<td><img height="40px" width="60px" src="<?php echo $result["image"]; ?>" alt="" srcset=""></td>
					<td>
						<?php 
							if($result["type"] == "0"){
								echo "Featured";
							}
							if($result["type"] == "1"){
								echo "General";
							}
						?>
					</td>
					<td><a href="productview.php?viewPdId=<?php echo $result['productId']; ?>">View</a> || <a href="">Edit</a> || <a onclick="return confirm('Are you sure to delete?')"; href="?delPdId=<?php echo $result['productId']; ?>">Delete</a></td>
				</tr>
				<?php } ?>
				<?php } ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
