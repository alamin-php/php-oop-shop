<?php include "inc/header.php"; ?>
<?php 
    if(Session::get("cusLogin") == false){
        header("Location:login.php");
    }
?>
<style>
    .tblone{width: 550px; margin: 0 auto; border: 2px solid #ddd;}
    .tblone tr td{text-align: justify;}
</style>
 <div class="main">
    <div class="content">
        <?php 
            $id = Session::get('cusId');
            $getData = $cus->getCustomerData($id);
            if($getData){
                while($result = $getData->fetch_assoc()){
        ?>
        <table class="tblone">
            <tr>
                <td width="20%">Name</td>
                <td width="5%">:</td>
                <td><?php echo $result['name'] ?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td><?php echo $result['phone'] ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $result['email'] ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><?php echo $result['address'] ?></td>
            </tr>
            <tr>
                <td>City</td>
                <td>:</td>
                <td><?php echo $result['city'] ?></td>
            </tr>
            <tr>
                <td>Zipcode</td>
                <td>:</td>
                <td><?php echo $result['zipcode'] ?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td>:</td>
                <td><?php echo $result['country'] ?></td>
            </tr>
        </table>
        <?php } ?>
        <?php } ?>
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include "inc/footer.php"; ?>