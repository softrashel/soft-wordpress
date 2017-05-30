<?php

function get_bloginfo( $show )
{
	$show = trim($show);
	if( $show == "" ){ return ""; }

	switch( $show )
	{
		case 'name':
		{
			$value = get_option("site_name");
			break;
		}
		case 'url':
		{
			$value = SITE_URL;
			break;
		}
		case 'description':
		{
			$value = get_option("tag_line");
			break;
		}
		case 'template_url':
		{
			$value = get_tameplate_directory_url();
			break;
		}		
		default:
		{
			$value = "";
			break;
		}
	}

	return $value;
}

function bloginfo( $show )
{
	echo get_bloginfo( $show );
}


function wp_head()
{
	wp_load_enqueue_style();
	wp_load_enqueue_script();
	do_action( "wp_head" );
}

function wp_footer()
{
	wp_load_enqueue_style( true );
	wp_load_enqueue_script( true );
	do_action( "wp_footer" );
}

?>