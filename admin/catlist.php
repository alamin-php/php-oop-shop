<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../classes/Category.php");
?>

<?php 
	$cat = new Category();

	if(isset($_GET["delcat"])){
		$id = $_GET["delcat"];
		$delCat = $cat->delCatById($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">  
					<?php 
						if(isset($delCat)){
							echo $delCat;
						}
					?>     
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
							$result = $cat->readAllCat();
							if($result){
								while($category = $result->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $category["catName"]; ?></td>
							<td><a href="catedit.php?catid=<?php echo $category['catId'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to DELETE?')" href="?delcat=<?php echo $category['catId'] ?>">Delete</a></td>
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

