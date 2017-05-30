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

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Google Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/icomoon.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/magnific-popup.css">
	<!-- Salvattore -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/salvattore.css">
	<!-- Theme Style -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.css">
	<!-- Modernizr JS -->
	<script src="<?php bloginfo('template_url'); ?>/js/modernizr-2.6.2.min.js"></script>

    <?php wp_head(); ?>

</head>

<body>

		<div id="fh5co-offcanvass">
		<a href="#" class="fh5co-offcanvass-close js-fh5co-offcanvass-close">Menu <i class="icon-cross"></i> </a>
		<h1 class="fh5co-logo"><a class="navbar-brand" href="index.html"><?php bloginfo("name"); ?></a></h1>
		<ul>
			<li class="active"><a href="<?php echo SITE_URL; ?>">Home</a></li>
			<li><a href="?p=5">About</a></li>
			<li><a href="pricing.html">Pricing</a></li>
			<li><a href="contact.html">Contact</a></li>
		</ul>
		<h3 class="fh5co-lead">Connect with us</h3>
		<p class="fh5co-social-icons">
			<a href="<?php echo get_option("twitter_link"); ?>"><i class="icon-twitter"></i></a>
			<a href="<?php echo get_option("fb_link"); ?>"><i class="icon-facebook"></i></a>
			<a href="#"><i class="icon-instagram"></i></a>
			<a href="#"><i class="icon-dribbble"></i></a>
			<a href="#"><i class="icon-youtube"></i></a>
		</p>
	</div>
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="#" class="fh5co-menu-btn js-fh5co-menu-btn">Menu <i class="icon-menu"></i></a>
					<a class="navbar-brand" style="color:#<?php echo get_option("hydrogen_site_name_color"); ?>" href="index.html"><?php bloginfo("name"); ?></a>		
				</div>
			</div>
		</div>
	</header>
	<!-- END .header -->