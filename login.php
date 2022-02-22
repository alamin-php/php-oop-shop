<?php include "inc/header.php"; ?>
<?php 
    if(Session::get("cusLogin") != false){
        header("Location:order.php");
    }
?>
<?php 
	if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["login"])){
        $customerLogin = $cus->customerLogin($_POST);
	}
?>

<?php 
	if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["createaccount"])){
        $customerRegister = $cus->customerRegister($_POST);
	}
?>
<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <?php 
                if(isset($customerLogin)){
                    echo $customerLogin;
                }
            ?>
            <form action="" method="post">
                <input name="email" type="text" placeholder="Email address">
                <input name="password" type="password" placeholder="Passwod">
                <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>

                    <div><input type="submit" class="btn-sub" name="login" value="Login"></div>

            </form>
        </div>
        <div class="register_account">
            <h3>Register New Account 			
				<?php 
				if(isset($customerRegister)){
					echo $customerRegister;
				}
				?>
			</h3>
            <form action="" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="name" placeholder="Name">
                                </div>

                                <div>
                                    <input type="text" name="city" placeholder="City">
                                </div>

                                <div>
                                    <input type="text" name="zipcode" placeholder="Zipcode">
                                </div>
                                <div>
                                    <input type="text" name="email" placeholder="Email address">
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" placeholder="Address">
                                </div>
                                <div>
                                    <input type="text" name="country" placeholder="Country">
                                </div>

                                <div>
                                    <input type="text" name="phone" placeholder="Phone Number">
                                </div>

                                <div>
                                    <input type="text" name="password" placeholder="Password">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="search">
                    <input type="submit" class="btn-sub" name="createaccount" value="Create Account">
                </div>
                <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.
                </p>
                <div class="clear"></div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
</div>
</div>
<?php include "inc/footer.php"; ?>