<?php

class WP_Option{

	private $options;//Store all options value where array keys are option names.

	public function get_all_options( $no_cash = false )
	{
		global $wpdb;

		if( is_array($this->options) && $no_cash == false )
		{
			return $this->options;
		}
		else
		{
			$sql = "SELECT option_name, option_value FROM wp_options";
			$result = $wpdb->get_result( $sql );

			foreach($result as $value)
			{
				$this->options[ $value['option_name'] ] = $value['option_value'];
			}
			//echo "<pre>"; print_r( $this->options ); echo "</pre>";exit;

			return $this->options;
		}

	}//end function get_all_options( $no_cash )

	public function get_option( $option_name )
	{
		$all_options = $this->get_all_options();

		if( isset( $all_options[$option_name] ) )
		{
			return $all_options[$option_name];
		}

		return Null;

	}//end function get_option( $option_name )

	public function update_option( $option_name, $option_value )
	{
		global $wpdb;

		$option_value_original = $option_value;
		$option_name_original = $option_name;

		$option_name = mysql_real_escape_string( $option_name );
		$option_value = mysql_real_escape_string( $option_value );

		$all_options = $this->get_all_options();

		if( isset( $all_options[$option_name_original] ) )
		{
			if( $all_options[$option_name_original] == $option_value_original ){ return false; }
			$sql = "UPDATE wp_options SET option_value='".$option_value."' WHERE option_name='".$option_name."'";
		}
		else
		{
			$sql = "INSERT INTO wp_options(option_name,option_value) VALUES ('".$option_name."','".$option_value."')";
		}

		$wpdb->query( $sql );

		$this->options[$option_name_original] = $option_value_original;

	}//end function update_option( $option_name, $option_value )

	public function get_themes_info()
	{
		$info_names = array( "Theme Name", "Author", "Description" );

		$themes_dir = ABSPATH."wp-content/themes/";

		$files = scandir( $themes_dir );
		array_shift( $files );
		array_shift( $files );

		foreach( $files as $folder )
		{
			$theme_dir_path = $themes_dir . $folder;

			if( file_exists( $theme_dir_path . "/style.css" ) )
			{
				$css_file_path = $theme_dir_path . "/style.css";

				$fp = fopen( $css_file_path, "r" );
				$css_fread = fread( $fp, filesize( $css_file_path ) );
				$css_fread = trim( $css_fread );
				fclose( $fp );

				$lines = explode( "\r\n", $css_fread );
				array_shift( $lines );

				$info_arr = array();

				foreach( $lines as $line )
				{
					$line = trim( $line );

					if( $line == "" ) { continue; }

					if( $line == "*/" ) { break; }

					foreach( $info_names as $name )
					{
						if( strpos( $line, $name.":" ) === 0 )
						{
							$info_arr[$name] = trim( str_replace( $name.":", "", $line ) );
							break;
						}
					}

				}//end foreach( $lines as $line )

				$themes_info[$folder] = $info_arr;

				//echo "<pre>"; print_r($themes_info); echo "</pre><hr>";

			}//end if( file_exists( $theme_dir_path . "/style.css" ) )

		}//end foreach( $files as $folder )

		return $themes_info;

	}//end function get_themes_info()



}//end class WP_Option


$wp_option = new WP_Option;


function get_all_options( $no_cash = false )
{
	global $wp_option;
	return $wp_option->get_all_options( $no_cash );
}

function get_option( $option_name )
{
	global $wp_option;
	return $wp_option->get_option( $option_name );
}

function update_option( $option_name, $option_value )
{
	global $wp_option;
	return $wp_option->update_option( $option_name, $option_value );
}

function get_themes_info()
{
	global $wp_option;
	return $wp_option->get_themes_info();
}
//$themes_info = get_themes_info();
//echo "<pre>"; print_r($themes_info); echo "</pre>";

?>