<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../classes/Adminlogin.php");
?>
<?php 
	$al = new Adminlogin();
	if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["login"])){
		$adminUser = $_POST["adminUser"];
		$adminPass = md5($_POST["adminPass"]);

		$loginCheck = $al->adminLogin($adminUser, $adminPass);
	}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<span style="color: red; font-size: 18px;">
		<?php 
			if(isset($loginCheck)){
				echo $loginCheck;
			}
		?>

		</span>
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password" name="adminPass"/>
			</div>
			<div>
				<input type="submit" name="login" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">www.eshop.com.bd</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>