<?php

$wp_actions = array();

function add_action( $hook, $func_name )
{
	global $wp_actions;
	$wp_actions[$hook][] = $func_name;
}

function do_action( $hook )
{
	global $wp_actions;

	if( isset($wp_actions[$hook]) )
	{
		$functions = $wp_actions[$hook];

		foreach( $functions as $func )
		{
			$func();
		}
	}
}

/*Testing: function do_action( $hook )

function hello()
{
	echo "Hello<br>";
}

function hello_world()
{
	echo "Hello World<br>";
}

function hello_friends()
{
	echo "Hello Friends<br>";
}		

add_action( "Header", "hello" );
add_action( "Footer", "hello_world" );
add_action( "Footer", "hello_friends" );
echo "<pre>"; print_r( $wp_actions ); echo "</pre>";
do_action( "Footer" );*/

?>