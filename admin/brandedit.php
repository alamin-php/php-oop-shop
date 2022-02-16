<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../classes/Brand.php");
?>
<?php
    if(!isset($_GET["brandid"]) || $_GET["brandid"] == NULL){
        echo "<script>window.location='brandlist.php'</script>";
    }else{
        $id = $_GET["brandid"];
    }
	$br = new Brand();
	if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["update"])){
		$brandName = $_POST["brandName"];
		$updateBrand = $br->updateBrand($brandName, $id);
	}
?>
<?php 
    $getBrand = $br->getBrandById($id);
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
                    <?php 
                        if(isset($updateBrand)){
                            echo $updateBrand;
                        }
                    ?>
               <div class="block copyblock"> 
                 <form action="" method="post">
                     <?php 
                        if($getBrand){
                            while($result = $getBrand->fetch_assoc()){
                                
                     ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="update" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    <?php } ?>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>