<?php

class wp_post_type{

	public $post_type = array();

	public function resister( $args )
	{
		if( !is_array( $args ) ) { return; }

		$slug = $args['slug'];
		$this->post_type[$slug] = $args;
	}


}//end class wp_post_type

$wp_post_type = new wp_post_type;


function resister_post_type( $args )
{
	global $wp_post_type;
	return $wp_post_type->resister( $args );
}

function get_post_type()
{
	global $wp_post_type;
	return $wp_post_type->post_type;
}


?>