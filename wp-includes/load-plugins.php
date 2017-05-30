<?php

function activate_plugin( $plugin_name )
{
	$plugins = get_option( "active_plugins" );

	if( $plugins == "" ){ $lines = array(); }
	else{ $lines = explode( ",", $plugins ); }

	$check = in_array( $plugin_name, $lines );

	if( $check === False )
	{
		$lines[] = $plugin_name;

		if( $lines[0] == $plugin_name )
		{
			$new_plugins = $plugin_name;
		}
		else
		{
			$new_plugins = implode( ",", $lines );
		}

		update_option( "active_plugins", $new_plugins );
	}

}//end activate_plugin( $plugin_name )

function deactivate_plugin( $plugin_name )
{
	$new_arr = array();

	$plugins = get_option( "active_plugins" );

	$lines = explode( ",", $plugins );

	foreach( $lines as $line )
	{
		if( $line != $plugin_name )
		{
			$new_arr[] = $line;
		}
	}

	$new_plugins = implode( ",", $new_arr );

	update_option( "active_plugins", $new_plugins );

}//end deactivate_plugin( $plugin_name )


//Includes Plugins:
$plugins_dir = ABSPATH."wp-content/plugins/";

$plugins = get_option( "active_plugins" );
$files = explode( ",", $plugins );

foreach( $files as $file )
{
	if( file_exists($plugins_dir.$file.".php") )
	{
		require( $plugins_dir.$file.".php" );
	}
}


?>