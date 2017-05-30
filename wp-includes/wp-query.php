<?php

class WP_Query{

	public $p;
	public $cat;
	public $s;
	public $showposts = 0;
	public $perpage = 10;
	public $paged = 1;
	public $post_type = "post";
	public $post_status = "publish";
	public $post__in = Null;

	public $query_vars;


	public $is_home = false;
	public $is_single = false;
	public $is_category = false;
	public $is_search = false;

	public $query_posts = array();

	public $post_count = 0;

	public $found_post_count = 0;
	public $current_post_num = -1;


	public function __construct( $query_vars )
	{
		$this->query_vars = $query_vars;

		$this->query_vars_init();

		$this->query();
	}

	public function query_vars_init()
	{
		foreach( $this->query_vars as $key => $value )
		{
			$this->$key = $value;
		}

		if( $this->p )
		{
			$this->is_single = true;
		}
		elseif( $this->cat )
		{
			$this->is_category = true;
		}
		elseif( $this->s )
		{
			$this->is_search = true;
		}
		else
		{
			$this->is_home = true;
		}
		
	}//end function query_vars_init()

	public function query()
	{
		global $wpdb;

		$results = array();

		if( $this->p )
		{
			$sql = "SELECT * FROM wp_posts WHERE `ID`=" . $this->p;
			$sql_count = "SELECT COUNT(*) FROM wp_posts WHERE `ID`=" . $this->p;
		}
		else
		{
			if( $this->cat )
			{
				$sql = "SELECT wp_posts.* FROM wp_posts, wp_term_relationship WHERE wp_posts.ID=wp_term_relationship.post_id AND wp_term_relationship.term_id=".$this->cat;
				$sql_count = "SELECT COUNT(*) FROM wp_posts, wp_term_relationship WHERE wp_posts.ID=wp_term_relationship.post_id AND wp_term_relationship.term_id=".$this->cat;
			}
			else
			{
				$sql = "SELECT * FROM wp_posts WHERE 1=1";
				
				$sql_count = "SELECT COUNT(*) AS post_count FROM wp_posts WHERE 1=1";
			}

			$sql_part = " AND `post_status`='" . $this->post_status . "' AND `post_type`='" . $this->post_type . "'";

			$sql = $sql . $sql_part;
			$sql_count = $sql_count . $sql_part;
				
			if( is_array($this->post__in) )
			{
				$post_ids = implode( ",", $this->post__in );
				
				$sql = $sql . " AND `ID` IN(".$post_ids.")";
				$sql_count = $sql_count . " AND `ID` IN(".$post_ids.")";
			}

			if( $this->showposts > 0 )
			{
				$sql = $sql . " LIMIT " . $this->showposts;
			}
			elseif( $this->showposts != -1 )
			{
				$offset = ( $this->paged - 1 ) * $this->perpage;

				$sql = $sql . " LIMIT " . $this->perpage . " OFFSET " . $offset;
			}
		}
		
		$results = $wpdb->get_result( $sql );

		$this->post_count = $wpdb->get_var( $sql_count );
		//var_dump( $results );

		if( is_array( $results ) )
		{
			foreach( $results as $row )
			{
				$_post = new WP_Post;

				$_post->ID = $row['ID'];
				$_post->post_title = $row['post_title'];
				$_post->post_content = $row['post_content'];
				$_post->post_date = $row['post_date'];
				$_post->post_status = $row['post_status'];
				$_post->post_type = $row['post_type'];

				$this->query_posts[] = $_post;

			}//end foreach ($results as $row )

		}//end if( is_array( $results ) )

		$this->found_post_count = count( $this->query_posts );

		if( $this->found_post_count )
		{
			global $post;
			$post = $this->query_posts[0];
		}

	}//end function query()


	public function the_post()
	{
		global $post;

		$post = $this->query_posts[$this->current_post_num];
	}


	public function next_post()
	{
		if( $this->found_post_count != 0 && $this->current_post_num < $this->found_post_count )
		{
			$this->current_post_num++;
		}		
	}


	public function have_post()
	{
		$this->next_post();

		if( $this->current_post_num != -1 && $this->current_post_num < $this->found_post_count )
		{
			return true;
		}

		return false;
	}


}//end  WP_Query

?>