<?php

require( dirname( __FILE__ ) . "/../wp-load.php" );

if( isset( $_POST['submit'] ) )
{
	//echo "submit";
	$name = ( isset( $_POST['name'] ) && $_POST['name'] != "" ) ? $_POST['name'] : "";
	$password = ( isset( $_POST['password'] ) && $_POST['password'] != "" ) ? $_POST['password'] : "";

	$iv_size = mcrypt_get_iv_size( MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC );
	$iv = mcrypt_create_iv( $iv_size, MCRYPT_RAND );

	$login = login( $name, $password, $iv );

	if( $login == true )
	{
		header("location:" . SITE_URL . "/wp-admin");exit;
	}
}

?>

<html>
<head>
	<title>WP Admin Test Page</title>
	<link rel="stylesheet" href="style.css">
</head>

<body style="background-color:#eee;">

	<div class="login_box">

		<div class="wp_login_logo"><a href="#"><img src="<?php echo SITE_URL; ?>/wp-admin/images/wp_logo.png"></a></div>

		<form action="" method="POST">

			<div>User Name or Email Address</div>
			<div><input class="login_input" name="name" type="text" value=""></div>

			<div>Password</div>
			<div><input class="login_input" name="password" type="password" value=""></div>

			<div style="float:right"><input class="draft_save_button" name="submit" type="submit" value="Login"></div>
			
		</form>

	</div>

</body>
</html>