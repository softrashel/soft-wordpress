<?php

class WPDB{
	
	public $dbname;
	public $hostname;
	public $username;
	public $password;

	public $last_error = "";

	public $conection;

	public function __construct( $dbname, $username, $password, $hostname )
	{
		$this->dbname = $dbname;
		$this->username = $username;
		$this->password = $password;
		$this->hostname = $hostname;

		$this->creat_conection();
	}

	private function creat_conection()
	{
		$con = @mysql_connect( $this->hostname, $this->username, $this->password );

		if( !$con )
		{
		    die( 'Could not connect: ' . mysql_error() );
		}
		else
		{
			$this->conection = $con;
		}

		$db_selected = mysql_select_db( $this->dbname, $con );

		if( !$db_selected )
		{
		    die( 'Can\'t use foo : ' . mysql_error() );
		}
	}//end function creat_conection()

	public function query( $sql )
	{
		return mysql_query( $sql );
	}

	/*Note:
	start function get_result( $sql, $first_column_as_key=false )
	This function use for get all Posts.
	Example:
	$sql = "SELECT * FROM wp_posts";
	$result = $wpdb->get_result( $sql );
	Like this : array(
				    [0] => array(
				            ['ID'] => 9,
				            ['post_title'] => 'Test Post',
				            ['post_content'] => "Hello World...",
				            [post_status] => "Publish"
				        ),
				    [1] => array(
				            ['ID'] => 13,
				            ['post_title'] => "Test Post-2",
				            ['post_content'] => "Hello World...",
				            ['post_status'] => "Draft"
				        )
				);
	But if this function is get_result( $sql, true ),
	then the array keys will be ids. */

	public function get_result( $sql, $first_column_as_key=false )
	{
		$results = array();
		$q = mysql_query( $sql );

		if( $q == false )
		{
			$this->last_error = mysql_error();
			return false;
		}
		else
		{
			$this->last_error = "";
			$first_column = "";

			while( $row = mysql_fetch_assoc( $q ) )
			{
				if( $first_column == "" )
				{
					foreach( $row as $key => $value )
					{
						$first_column = $key;break;
					}
				}
				if( $first_column_as_key )
				{
					$results[ $row[$first_column] ] = $row;
				}
				else
				{
					$results[] = $row;
				}
			}
		}

		return $results;

	}//end function get_result( $sql, $first_column_as_key=false )

	/*Note:
	start function get_row( $sql )
	This function use for get first row all of the declared item's.
	Example-1:
	$sql = "SELECT * FROM wp_posts WHERE `id`=20";
	$result = $wpdb->get_row( $sql );
	Like this: array(
				  ['ID'] => 9,
		          ['post_title'] => 'Test Post',
		          ['post_content'] => "Hello World...",
		          [post_status] => "Publish"
				)
	Example-2:
	$sql = "SELECT `post_title`, `post_content` FROM wp_posts WHERE `id`=20";
	$result = $wpdb->get_row( $sql );
	Like this: array(
				  ['post_title'] => "Test Post"
				); */

	public function get_row( $sql )
	{
		$results = $this->get_result( $sql );
		if( $results === false )
		{
			return $results;
		}
		else
		{
			if( count($results) )
			{
				return $results[0];
			}
			else
			{
				return array();
			}
		}

	}//end function get_row( $sql )

	/*Note:
	start function get_var( $sql )
	This function use for get first item all of the declared item's.
	Example:
	$sql = "SELECT `post_title`, `post_content` FROM wp_posts WHERE `id`=10";
	$result = $wpdb->get_var( $sql );
	echo "<pre>"; print_r($result); echo "</pre>";
	Like this: "Test Post" */

	public function get_var( $sql )
	{
		$row = $this->get_row( $sql );
		
		if( $row === false )
		{
			return $row;
		}
		else
		{
			if( count($row) )
			{
				foreach ($row as $key => $value)
				{
					return $value;
				}				
			}
			else
			{
				return null;
			}
		}
		
	}//end function get_var( $sql )

}//end class WPDB

$wpdb = new WPDB( DB_NAME, DB_USER, DB_PASSWORD, DB_HOST );


?>