<?php include "inc/header.php"; ?>
<?php 
    if(Session::get("cusLogin") == false){
        header("Location:login.php");
    }
?>
 <div class="main">
    <div class="content">
    <h2>Order Page</h2>
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include "inc/footer.php"; ?>