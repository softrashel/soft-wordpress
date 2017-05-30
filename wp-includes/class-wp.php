<?php

class WP{

	public function __construct()
	{
		$query_vars = array();
		$query_vars['paged'] = ( isset($_GET['paged']) && intval($_GET['paged'])!=0 ) ? intval($_GET['paged']) : 1;
		//$query_vars['showposts'] = 10;

		$perpage = intval(get_option("post_per_page"));
		if( $perpage == 0 ){ $perpage = 10; }

		$query_vars['perpage'] = $perpage;

		if( isset($_GET['p']) && intval($_GET['p']) != 0 )
		{
			$query_vars['p'] = intval( $_GET['p'] );
			$query_vars['showposts'] = 1;
		}
		elseif( isset($_GET['cat']) && intval($_GET['cat']) != 0 )
		{
			$query_vars['cat'] = intval( $_GET['cat'] );
		}
		elseif( isset($_GET['s']) && $_GET['s'] != "" )
		{
			$query_vars['s'] = $_GET['s'];
		}
		else
		{
			//
		}


		global $wp_query;

		$wp_query = new WP_Query( $query_vars );
	}

}

?>