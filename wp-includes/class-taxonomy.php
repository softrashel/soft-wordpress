<?php

class taxonomy{

	/*$taxonomies array like this:
	array(
		category=>array(
				name=>Category,
				slug=>category
				),
		Tag=>array(
			name=>Tag,
			slug=>post_tag
		),
	);
	*/
	public $taxonomies = array();

	/*
	$args = array(
				"name"=>"Category",
				"slug"=>"category"
				);
	*/
	public function resister( $args )
	{
		if( !is_array( $args ) ) { return; }

		$slug = $args['slug'];
		$this->taxonomies[$slug] = $args;
	}

	public function get_all_terms()
	{
		$result = mysql_query( "SELECT * FROM wp_terms" );

		$all_terms = array();

		while( $row = mysql_fetch_assoc( $result ) )
		{
			$all_terms[ $row['ID'] ] = $row;
		}

		return $all_terms;
	}

	public function get_taxonomy_terms( $taxonomy_slug )
	{
		$taxonomy_slug = @mysql_real_escape_string( $taxonomy_slug );
		
		$sql = "SELECT * FROM wp_terms WHERE `taxonomy`='" . $taxonomy_slug . "'";
		$all_terms = @mysql_query( $sql ) or die( mysql_error() );

		$desired_terms = array();

		while( $row = mysql_fetch_assoc( $all_terms ) )
		{
			$desired_terms[] = $row;
		}

		return $desired_terms;
	}

	public function increase_term_count( $term_id )
	{
		$term_id = intval($term_id);

		if( $term_id == "" ) { return; }

		$sql = "UPDATE `wp_terms` SET `count`=`count`+1 WHERE `ID`=".$term_id;
		@mysql_query( $sql ) or die( mysql_error() );

		/*$result = mysql_query( "SELECT * FROM term WHERE `ID`=".$term_id );

		if( mysql_num_rows( $result ) == 0 )
		{
		    echo "No rows found, nothing to print so am exiting";exit;
		}

		$row = mysql_fetch_assoc( $result );

		$new_count = $row['count'] + 1;*/
	}

	public function decrease_term_count( $term_id )
	{
		$term_id = intval($term_id);

		if( $term_id == "" ) { return; }

		$sql = "UPDATE `wp_terms` SET `count`=`count`-1 WHERE `ID`=".$term_id;
		@mysql_query( $sql ) or die( mysql_error() );
	}

	public function delete_term( $term_id )
	{
		$term_id = intval( $term_id );

		if( $term_id == "" ) { return; }

		$sql = "DELETE FROM `wp_terms` WHERE `ID`=".$term_id;
		@mysql_query( $sql ) or die( mysql_error() );
	}

}//end class taxonomy

$taxonomy_obj = new taxonomy;

function resister_taxonomy( $args )
{
	global $taxonomy_obj;
	$taxonomy_obj->resister( $args );
}

function get_taxonomies()
{
	global $taxonomy_obj;
	return $taxonomy_obj->taxonomies;
}

function get_all_terms()
{
	global $taxonomy_obj;
	return $taxonomy_obj->get_all_terms();
}

function get_taxonomy_terms( $taxonomy_slug )
{
	global $taxonomy_obj;
	return $taxonomy_obj->get_taxonomy_terms( $taxonomy_slug );
}
//echo "<pre>"; print_r( get_taxonomy_terms( 'list' ) ); echo "</pre>";

function increase_term_count( $term_id )
{
	global $taxonomy_obj;
	return $taxonomy_obj->increase_term_count( $term_id );
}

function decrease_term_count( $term_id )
{
	global $taxonomy_obj;
	return $taxonomy_obj->decrease_term_count( $term_id );
}

function delete_term( $term_id )
{
	global $taxonomy_obj;
	return $taxonomy_obj->delete_term( $term_id );
}

?>