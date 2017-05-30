<?php

/*=========================================
---------Theme related functions----------
=========================================*/

function get_tameplate_directory_url()
{
	$tameplate_url = SITE_URL."/wp-content/themes/".get_current_theme_name();

	return $tameplate_url;
}

function is_home()
{
	global $wp_query;
	return $wp_query->is_home;
}

function is_single()
{
	global $wp_query;
	return $wp_query->is_single;
}

function is_category()
{
	global $wp_query;
	return $wp_query->is_category;
}

function wp_title()
{
	if( is_home() )
	{
		echo get_bloginfo("name");
	}
	elseif( is_single() )
	{
		echo get_bloginfo("name")."--";
		the_title();
	}
}



function have_post()
{
	global $wp_query;

	return $wp_query->have_post();
}

function the_post()
{
	global $wp_query;

	$wp_query->the_post();
}

function the_title()
{
	global $post;

	echo $post->post_title;
}

function the_permalink()
{
	global $post;

	echo "?p=".$post->ID;
}

function get_the_content()
{
	global $post;

	return $post->post_content;
}

function the_content()
{
	global $post;

	echo $post->post_content;
}

function the_date()
{
	global $post;

	echo $post->post_date;
}



function delete_posts( $post_id )
{
	$post_id = intval( $post_id );

	if( $post_id == "" ) { return; }

	$sql = "DELETE FROM `wp_posts` WHERE `ID`=".$post_id;
	@mysql_query( $sql ) or die( mysql_error() );

	$sql_attr = "DELETE FROM `wp_term_relationship` WHERE `post_id`=".$post_id;
	@mysql_query( $sql_attr ) or die( mysql_error() );

}//end delete_posts( $post_id )



$wp_resistered_scripts = array(
		'jquery'	=> "jquery/jquery.js",
		'jscolor'	=> "jscolor/jscolor.js"
	);

$wp_enqueued_script = array();

function wp_enqueue_script( $script_name, $footer=false )
{
	global $wp_enqueued_script;
	global $wp_resistered_scripts;

	if( !isset($wp_enqueued_script[$script_name]) && isset($wp_resistered_scripts[$script_name]) )
	{
		$wp_enqueued_script[$script_name] = array("script_name"=>$script_name, "footer"=>$footer);
	}
}

function wp_load_enqueue_script( $footer=false )
{
	$script_dir_url = SITE_URL."/wp-includes/js/";

	global $wp_enqueued_script;

	global $wp_resistered_scripts;

	foreach( $wp_enqueued_script as $value )
	{
		if( $value["footer"] == $footer )
		{
			$script_file = $wp_resistered_scripts[$value["script_name"]];
			echo '<script src="'.$script_dir_url.$script_file.'"></script>';
		}
	}
}


$wp_resistered_styles = array(
		'font_awesome' => "font-awesome/css/font-awesome.min.css"
	);

$wp_enqueued_style = array();

function wp_enqueue_style( $style_name, $footer=false )
{
	global $wp_enqueued_style;
	global $wp_resistered_styles;

	if( !isset($wp_enqueued_style[$style_name]) && isset($wp_resistered_styles[$style_name]) )
	{
		$wp_enqueued_style[$style_name] = array("style_name"=>$style_name, "footer"=>$footer);
	}
}

function wp_load_enqueue_style( $footer=false )
{
	$style_dir_url = SITE_URL."/wp-includes/css/";

	global $wp_enqueued_style;
	global $wp_resistered_styles;

	foreach( $wp_enqueued_style as $value )
	{
		if( $value["footer"] == $footer )
		{
			$style_file = $wp_resistered_styles[$value["style_name"]];
			echo '<link rel="stylesheet" href="'.$style_dir_url.$style_file.'">';
		}
	}
}


/*=========================================
---------Admin related functions-----------
=========================================*/

session_start();

function login( $user_name, $user_password, $iv )
{
	$file = "data/user.txt";
	$fp = fopen( $file, "r" );
	$fread = fread( $fp, filesize( $file ) );
	fclose( $fp );

	//$fread like this: admin=123
	$user = explode( "=", $fread );
	//echo "<pre>"; print_r( $user ); echo "</pre>";
	//$user array like this: array( [0] => admin, [1] => 123 );

	if( ( strtolower( $user_name ) == strtolower( $user[0] ) ) && ( intval( $user_password ) == intval( $user[1] ) ) )
	{
		$_SESSION['wp_login'] = "yes";

		return true;
	}

	return false;

}//end login( $user_name, $user_password, $iv )

function is_user_logged_in()
{
	if( isset( $_SESSION["wp_login"] ) && $_SESSION["wp_login"]=="yes" )
	{
		return true;
	}

    return false;

}//end is_user_logged_in()



function add_script_admin_head()
{
	?>
	<script>
	    tinymce.init({
	     	selector:'.my_tinymce',
	     	plugins : 'advlist autolink link lists table charmap print preview media image textcolor'
	   	});
	</script>
  <?php

}//end function add_script_admin_head()

add_action( "wp_admin_head", "add_script_admin_head" );


$wp_resistered_scripts_admin = array(
		'jquery'	=> "jquery/jquery.js",
		'tinymce'	=> "tinymce/tinymce.min.js",
		'jscolor'	=> "jscolor/jscolor.js"
	);

$wp_enqueued_script_admin = array();

function wp_enqueue_script_admin( $script_name, $footer=false )
{
	global $wp_enqueued_script_admin;
	global $wp_resistered_scripts_admin;

	if( !isset($wp_enqueued_script_admin[$script_name]) && isset($wp_resistered_scripts_admin[$script_name]) )
	{
		$wp_enqueued_script_admin[$script_name] = array("script_name"=>$script_name, "footer"=>$footer);
	}

}//end function wp_enqueue_script_admin( $script_name, $footer=false )

function wp_load_enqueue_script_admin( $footer=false )
{
	$script_dir_url = SITE_URL."/wp-includes/js/";

	global $wp_enqueued_script_admin;

	global $wp_resistered_scripts_admin;

	foreach( $wp_enqueued_script_admin as $value )
	{
		if( $value["footer"] == $footer )
		{
			$script_file = $wp_resistered_scripts_admin[$value["script_name"]];
			echo '<script src="'.$script_dir_url.$script_file.'"></script>';
		}
	}

}//end function wp_load_enqueue_script_admin( $footer=false )


$wp_resistered_styles_admin = array(
		'font_awesome' => "font-awesome/css/font-awesome.min.css"
	);

$wp_enqueued_style_admin = array();

function wp_enqueue_style_admin( $style_name, $footer=false )
{
	global $wp_enqueued_style_admin;
	global $wp_resistered_styles_admin;

	if( !isset($wp_enqueued_style_admin[$style_name]) && isset($wp_resistered_styles_admin[$style_name]) )
	{
		$wp_enqueued_style_admin[$style_name] = array("style_name"=>$style_name, "footer"=>$footer);
	}

}//end function wp_enqueue_style_admin( $style_name, $footer=false )

function wp_load_enqueue_style_admin( $footer=false )
{
	$style_dir_url = SITE_URL."/wp-includes/css/";

	global $wp_enqueued_style_admin;
	global $wp_resistered_styles_admin;

	foreach( $wp_enqueued_style_admin as $value )
	{
		if( $value["footer"] == $footer )
		{
			$style_file = $wp_resistered_styles_admin[$value["style_name"]];
			echo '<link rel="stylesheet" href="'.$style_dir_url.$style_file.'">';
		}
	}

}//end function wp_load_enqueue_style_admin( $footer=false )


wp_enqueue_style_admin( "font_awesome" );
wp_enqueue_script_admin( "tinymce" );
wp_enqueue_script_admin( "jquery" );
wp_enqueue_script_admin( "jscolor", true );

function wp_head_admin()
{
	wp_load_enqueue_style_admin();
	wp_load_enqueue_script_admin();
	do_action( "wp_admin_head" );
}

function wp_footer_admin()
{
	wp_load_enqueue_style_admin( true );
	wp_load_enqueue_script_admin( true );
}



function update_post_meta( $post_id, $meta_key, $meta_value )
{
	global $wpdb;

	$post_id = intval($post_id);
	$meta_key = trim($meta_key);

	if( !$post_id ){ return null; }
	if( $meta_key == "" ){ return null; }

	$meta_key = mysql_real_escape_string($meta_key);
	$meta_value = mysql_real_escape_string($meta_value);

	$check_sql = "SELECT `meta_id` FROM `wp_postmeta` WHERE `post_id`=".$post_id." AND `meta_key`='".$meta_key."'";
	$meta_id = $wpdb->get_var($check_sql);

	if( $meta_id )
	{
		$sql = "UPDATE `wp_postmeta` SET `meta_value`='".$meta_value."' WHERE `meta_id`=".$meta_id;
	}
	else
	{
		$sql = "INSERT INTO `wp_postmeta`(`post_id`, `meta_key`, `meta_value`) VALUES (".$post_id.",'".$meta_key."','".$meta_value."')";
	}

	$wpdb->query($sql);

}//end function update_post_meta( $post_id, $meta_key, $meta_value )
update_post_meta( 18, "Image", "http://..." );


function get_post_customs( $post_id )
{
	global $wpdb;

	$new_custom_fields = array();

	$sql = "SELECT * FROM `wp_postmeta` WHERE `post_id`=".$post_id;
	$custom_fields = $wpdb->get_result( $sql );

	foreach( $custom_fields as $value )
	{
		$new_custom_fields[ $value['meta_key'] ] = $value['meta_value'];
	}

	return $new_custom_fields;
	
}//end function get_post_customs( $post_id )


function get_post_meta( $post_id, $meta_key )
{
	global $wpdb;

	$sql = "SELECT `meta_value` FROM wp_postmeta WHERE `post_id`=".$post_id." AND `meta_key`='".$meta_key."'";
	
	return $wpdb->get_var($sql);

}//end function get_post_meta( $post_id, $meta_key )


function get_all_meta_keys()
{
	$sql = "SELECT distinct(meta_key) FROM `wp_postmeta`";

	global $wpdb;
	$result = $wpdb->get_result($sql);
	$meta_values = array();
	foreach( $result as $array )
	{
		$meta_values[] = $array ['meta_key'];
	}
	//echo "<pre>"; print_r($meta_values); echo "</pre>";

	return $meta_values;

}//end function get_all_meta_keys()


//start function wp_parse_args( $args, $defaults )

/*$defaults = array(
	'type' => 'post',
	'before' => "<p>",
	'after' => "</p> \n",
	'echo' => TRUE
	);

$args = array(
	'type' => 'page',
	'test' => 'test_args'
	);

$results = array(
	'type' => 'page',
	'before' => "<p>",
	'after' => "</p> \n",
	'echo' => TRUE,
	'test' => 'test_args'
	);*/

function wp_parse_args( $args, $defaults )
{
	$results = array();
	foreach( $defaults as $key => $value )
	{
		if( isset( $args[$key] ) )
		{
			$results[$key] = $args[$key];
			unset( $args[$key] );
		}
		else
		{
			$results[$key] = $value;
		}
	}

	foreach( $args as $key => $value )
	{
		$results[$key] = $value;
	}

	return $results;
}
//$result = wp_parse_args( $args, $defaults );
//echo "<pre>"; print_r($result); echo "</pre>";
//end function wp_parse_args( $args, $defaults )


function wp_insert_post( $postarr )
{
  global $wpdb;

  //echo "<pre>"; print_r($postarr); echo "</pre>";

  $defaults = array(
  'ID'          => 0,
  'post_title'  => "",
  'post_content'=> "",
  'post_type'   => "post",
  'post_date'   => date( "Y-m-d H:i:s" ),
  'post_status' => "publish",
  'tax_input'   => array(),
  'meta_input'  => array()
  );

  $postarr = wp_parse_args( $postarr, $defaults );

  if( $postarr['post_title'] == "" ) { return false; }

  $post_id 	= intval($postarr['ID']);
  $title 	= mysql_real_escape_string($postarr['post_title']);
  $content 	= mysql_real_escape_string($postarr['post_content']);
  $date 	= mysql_real_escape_string($postarr['post_date']);
  $status 	= mysql_real_escape_string($postarr['post_status']);
  $type 	= mysql_real_escape_string($postarr['post_type']);


  if( $post_id )
  {
    $sql = "UPDATE `wp_posts` SET `post_title`='".$title."', `post_content`='".$content."', `post_date`='".$date."', `post_status`='".$status."'' WHERE `ID`=".$post_id;
    $result = $wpdb->query( $sql );
  }
  else
  {
    $sql = "INSERT INTO `wp_posts`( `post_title`, `post_content`, `post_date`, `post_status`, `post_type` ) VALUES ( '".$title."', '".$content."', '".$date."', '".$status."', '".$type."' )";
    $result = $wpdb->query( $sql );
    $post_id = mysql_insert_id();
  }


  if( $post_id )
  {
    foreach( $postarr['meta_input'] as $meta_key => $meta_value )
    {
      update_post_meta( $post_id, $meta_key, $meta_value );
    }    
  }


  $result = $wpdb->get_result( "SELECT * FROM `wp_term_relationship` WHERE `post_id`=".$post_id );

  foreach( $result as $row )
  {
    decrease_term_count( $row['term_id'] );
  }

  $del_sql = "DELETE FROM `wp_term_relationship` WHERE `post_id`=".$post_id;
  $wpdb->query( $del_sql );

  foreach( $postarr['tax_input'] as $tax_slug => $term_id )
  {
    if( $term_id == 0 ){ continue; }   
      
    $sql = "INSERT INTO `wp_term_relationship`( `post_id`, `term_id` ) VALUES ( ".$post_id.", ".$term_id." )";

    $wpdb->query( $sql );

    increase_term_count( $term_id );
  }

  return $post_id;

}//end function wp_insert_post( $postarr )


?>