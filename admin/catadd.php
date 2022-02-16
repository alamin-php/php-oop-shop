<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../classes/Category.php");
?>
<?php 
	$cat = new Category();
	if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["submit"])){
		$catName = $_POST["catName"];
		$addCategory = $cat->addCategory($catName);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
                    <?php 
                        if(isset($addCategory)){
                            echo $addCategory;
                        }
                    ?>
               <div class="block copyblock"> 
                 <form action="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>