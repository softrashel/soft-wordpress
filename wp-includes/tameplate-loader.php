<?php

if( is_single() )
{
	require( TAMEPLATEPATH . "/single.php" );
}
elseif( is_category() )
{
	require( TAMEPLATEPATH . "/category.php" );
}
else
{
	require( TAMEPLATEPATH . "/index.php" );
}

?>