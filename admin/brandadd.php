<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../classes/Brand.php");
?>
<?php 
    $br = new Brand();
	if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["register"])){
		$brandName = $_POST["brandName"];
        $addBrand = $br->addBrand($brandName);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
                <?php 
                    if(isset($addBrand)){
                        echo $addBrand;
                    }
                ?>
               <div class="block copyblock">
                 <form action="brandadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Enter Brand Name..." class="medium" />
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