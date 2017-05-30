<?php

if( !is_user_logged_in() )
{
  header( "location:".SITE_URL."/wp-admin/login.php" );exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
    <?php wp_head(); ?>
</head>

<body>
	<div id="wrapper">
		
		<div class="action_bar">
			<a class="wp_logo" href="#"><i class="fa fa-wordpress"></i></a>
			<a href="<?php echo SITE_URL; ?>/wp-admin"><i class="fa fa-tachometer"></i>softRashel</a>
			<a href="#"><i class="fa fa-paint-brush"></i>customize</a>
			<a href="#"><i class="fa fa-refresh"></i>4</a>
			<a href="#"><i class="fa fa-comment"></i>0</a>
			<a href="#">+New</a>
			<a href="#"><i class="fa fa-pencil"></i>Edit Category</a>
		</div>

		<div class="header">

			<div class="top_header_area">
				<div class="top_header">
					<a href="#"><i class="fa fa-user"></i>My Account</a>
					<a href="<?php echo SITE_URL; ?>/wp-admin/logout.php"><i class="fa fa-sign-out"></i>Logout</a>
				</div>
			</div>

			<div class="main_header">
				<h1 style="color:#<?php echo get_option("site_name_color"); ?>"><?php bloginfo("name"); ?></h1>
				<p style="color:#<?php echo get_option("tagline_color"); ?>"><?php bloginfo("description"); ?></p>
			</div>

			<div class="header_add_style" style="color:#<?php echo get_option("tagline_color"); ?>">
				<?php do_action( "after_header" ); ?>
			</div>

			<div class="menubar_area">
				<div class="menubar">
					<a href="<?php echo SITE_URL; ?>">Home</a>
					<a href="#">Blog</a>
					<a href="#">Sample Page</a>
					<a href="#">Markup</a>
					<a href="#">About The Tests</a>
				</div>
			</div>

		</div>