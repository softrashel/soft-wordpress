<?php

$wp_admin_pages = array();

function add_menue_page( $title, $slug, $funtion )
{
	global $wp_admin_pages;

	$wp_admin_pages[$slug] = array( "title"=>$title, "slug"=>$slug, "function"=>$funtion );
}

?>