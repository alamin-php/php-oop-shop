<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Category.php";?>
<?php 
	$cat = new Category();
	$result = $cat->readAllCat();
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;
							if($result){
								while($category = $result->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $category["catName"]; ?></td>
							<td><a href="catedit.php?catid=<?php echo $category['catId'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to DELETE?')" href="">Delete</a></td>
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

