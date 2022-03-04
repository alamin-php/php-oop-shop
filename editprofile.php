<?php include "inc/header.php"; ?>
<?php 
    if(Session::get("cusLogin") == false){
        header("Location:login.php");
    }
?>
<?php 
    $cusId = Session::get("cusId");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
        $updateCustomer = $cus->updateCustomer($_POST, $cusId);
    }
?>
<style>
    .tblone{width: 550px; margin: 0 auto; border: 2px solid #ddd;}
    .tblone tr td{text-align: justify;}
    .tblone tr td input[type="text"]{width: 400px; padding: 8px 5px;}
    .tblone tr td input[type="submit"]{padding: 8px 5px;}
</style>
 <div class="main">
    <div class="content">
        <?php 
            $id = Session::get('cusId');
            $getData = $cus->getCustomerData($id);
            if($getData){
                while($result = $getData->fetch_assoc()){
        ?>

        <?php 
            if(isset($updateCustomer)){
                echo $updateCustomer;
            }
        ?>
        <form action="" method="post">
        <table class="tblone">
            <tr>
                <td colspan="3">Profile Update</td>
                
            </tr>
            <tr>
                <td width="20%">Name</td>
                <td width="5%">:</td>
                <td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
            </tr>
            <tr>
                <td>City</td>
                <td>:</td>
                <td><input type="text" name="city" value="<?php echo $result['city'] ?>"></td>
            </tr>
            <tr>
                <td>Zipcode</td>
                <td>:</td>
                <td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"></td>
            </tr>
            <tr>
                <td>Country</td>
                <td>:</td>
                <td><input type="text" name="country" value="<?php echo $result['country'] ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Update">
                </td>
            </tr>
        </table>
        </form>
        <?php } ?>
        <?php } ?>
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include "inc/footer.php"; ?>