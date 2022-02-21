<?php include "inc/header.php"; ?>
<?php 
	if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["createaccount"])){
        $customerRegister = $cus->register($_POST);
	}
?>
<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <form action="hello" method="get" id="member">
                <input name="username" type="text" placeholder="Name">
                <input name="password" type="password" placeholder="Passwod">
            </form>
            <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
            <div class="buttons">
                <div><button class="grey">Sign In</button></div>
            </div>
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