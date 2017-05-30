<?php

define( "WPINC", "wp-includes" );

require( ABSPATH . WPINC . "/actions.php" );
require( ABSPATH . WPINC . "/wp-db.php" );
require( ABSPATH . WPINC . "/class-wp-option.php" );

$theme_name = get_option("site_theme");

function get_current_theme_name()
{
	global $theme_name;

	return $theme_name;
}

define( "TAMEPLATEPATH", ABSPATH."wp-content/themes/".get_current_theme_name() );

require( ABSPATH . WPINC . "/class-taxonomy.php" );
require( ABSPATH . WPINC . "/class-wp-post-type.php" );
require( ABSPATH . WPINC . "/setup.php" );
require( ABSPATH . WPINC . "/functions.php" );
require( ABSPATH . WPINC . "/template-tags.php" );
require( ABSPATH . WPINC . "/post.php" );
require( ABSPATH . WPINC . "/wp-query.php" );
require( ABSPATH . WPINC . "/class-wp.php" );
require( ABSPATH . WPINC . "/admin-pages.php" );

if( file_exists( TAMEPLATEPATH . "/functions.php" ) )
{
	require( TAMEPLATEPATH . "/functions.php" );
}

require( ABSPATH . WPINC . "/load-plugins.php" );


?>