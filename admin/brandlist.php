<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Brand.php";?>

<?php 
	$br = new Brand();
	if(isset($_GET['delbrand'])){
		$id = $_GET['delbrand'];
		$deleteBrand = $br->delBrandById($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
				<?php 
					if(isset($deleteBrand)){
						echo $deleteBrand;
					}
				?>
                <div class="block">    
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;
							$result = $br->readAllBrand();
							if($result){
								while($brand = $result->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $brand["brandName"]; ?></td>
							<td><a href="brandedit.php?brandid=<?php echo $brand['brandId'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to DELETE?')" href="?delbrand=<?php echo $brand['brandId'] ?>">Delete</a></td>
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

