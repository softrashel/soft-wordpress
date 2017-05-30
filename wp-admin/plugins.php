<?php

include( "header.php" );

include( "menuebar-left.php" );


$plugins_dir = ABSPATH."wp-content/plugins/";

$files = scandir( $plugins_dir );
array_shift( $files );
array_shift( $files );

if( isset($_GET['action']) && $_GET['action']!="" && isset($_GET['plugin']) && $_GET['plugin']!="" )
{
	$action = $_GET['action'];
	$plugin = $_GET['plugin'];

	if( $action == "activate" )
	{
		activate_plugin( $plugin );
	}
	elseif( $action == "deactivate" )
	{
		deactivate_plugin( $plugin );
	}
}


?>

			<div class="conteiner">

		        <div class="add_new_button">All Plugins<a href="plugin-install.php">Add New</a></div>
		        
		        <!--div class="notice_space"></div-->

		          <div class="show_plugins">
		            <table>

		            <tr>
		                <td style="width:200px;">Plugin</td>
		                <td>Description</td>
		            </tr>

		            <?php
        			foreach( $files as $file )
        			{
	      			    if( strrpos( $file, ".php" ) !== false )
	      			    {
	      			    	$plugin_name = str_replace( ".php", "", $file );
	      			    ?>
	      			    <tr>
		                  	<td>
		                  		<div><?php echo ucfirst( $file ); ?></div>
		                  		<span>
			                      	<a href="?action=activate&plugin=<?php echo $plugin_name; ?>">Active</a>
			                      	<a href="?action=deactivate&plugin=<?php echo $plugin_name; ?>">Deactive</a>
			                      	<a href="#">Edit</a>
			                      	<a href="#">Delete</a>
			                    </span>
		                  	</td>
		                  	<td>.........</td>
	      			    </tr>
	      			    <?php

	      				}//end if( strrpos( $file, ".php" ) !== false )

        			}//end foreach( $result as $post_id => $value )
	        		?>

		            </table>
		          </div>

      		</div><!--end <div class="conteiner">-->

<?php include( "footer.php" ); ?>