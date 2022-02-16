<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';?>
<?php include '../classes/Brand.php';?>
<?php include '../classes/Product.php';?>

<?php 
    $product = new Product();
    if(!isset($_GET["editPdId"]) || $_GET["editPdId"] == NULL){
        echo "<script>window.location='productlist.php'</script>";
    }else{
        $id = $_GET["editPdId"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["update"])){
        $updateProduct = $product->updateProduct($_POST, $_FILES, $id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <?php 
            if(isset($updateProduct)){
                echo $updateProduct;
            }
        ?>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
             <?php 
                $getProductById = $product->getProductById($id);
                if($getProductById){
                    while($pdResult = $getProductById->fetch_assoc()){
                        
             ?>
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $pdResult['productName']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <?php 
                                $cat = new Category();
                                $getCat = $cat->readAllCat();
                            ?>
                            <option>Select Category</option>
                            <?php 
                                if($getCat){
                                    while($result = $getCat->fetch_assoc()){ 
                            ?>
                            <option value="<?php echo $result["catId"]; ?>" <?php if($pdResult['catId'] == $result['catId']){echo "selected";} ?>><?php echo $result["catName"]; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <?php 
                                $brand = new Brand();
                                $getBrand = $brand->readAllBrand();
                            ?>
                            <option>Select Brand</option>
                            <?php 
                                if($getBrand){
                                    while($result = $getBrand->fetch_assoc()){ 
                            ?>
                            <option value="<?php echo $result["brandId"]; ?>" <?php if($pdResult['brandId'] == $result['brandId']){echo "selected";} ?>><?php echo $result["brandName"]; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"><?php echo $pdResult['body']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $pdResult['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Product Image</label>
                    </td>
                    <td>
                        <img height="80px" width="120px" src="<?php echo $pdResult['image']; ?>" alt="" srcset="">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option value="0" <?php if($pdResult['type'] == '0'){echo "selected";} ?> >Featured</option>
                            <option value="1" <?php if($pdResult['type'] == '1'){echo "selected";} ?> >General</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


