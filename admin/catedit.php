<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../classes/Category.php");
?>
<?php
    if(!isset($_GET["catid"]) || $_GET["catid"] == NULL){
        echo "<script>window.location='catlist.php'</script>";
    }else{
        $id = $_GET["catid"];
    }
	$cat = new Category();
	if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["update"])){
		$catName = $_POST["catName"];
		$updateCategory = $cat->updateCategory($catName, $id);
	}
?>
<?php 
    $getCat = $cat->getCatById($id);
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
                    <?php 
                        if(isset($updateCategory)){
                            echo $updateCategory;
                        }
                    ?>
               <div class="block copyblock"> 
                 <form action="" method="post">
                     <?php 
                        if($getCat){
                            while($result = $getCat->fetch_assoc()){
                                
                     ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']; ?>" class="medium" />
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