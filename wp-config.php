<?php

$file = str_replace( "\\", "/", __FILE__ );
$sitedir = dirname( $file );
$document_root =  $_SERVER['DOCUMENT_ROOT'];
$site_local_dir = str_replace( $document_root, "", $sitedir );
$site_url = "http://localhost/".$site_local_dir;

define( "SITE_URL", $site_url );

define( "DB_NAME", "wp_test" );
define( "DB_USER", "root" );
define( "DB_PASSWORD", "" );
define( "DB_HOST", "localhost" );

define( "ABSPATH", dirname( __FILE__ ) . "/" );

require( ABSPATH . "/wp-settings.php" );

?>