<?php

include( "header.php" );

include( "menuebar-left.php" );


$plugins_dir = ABSPATH."wp-content/plugins/";


if( isset($_POST['submit']) && $_POST['submit']!="" )
{
	$target_file = $plugins_dir . basename( $_FILES["upload"]["name"] );

	$upload_ok = 1;
	//Check if file already exists
	if( file_exists( $target_file ) )
	{
	    echo "Sorry, file already exists.";
	    $upload_ok = 0;
	}
	//Check if $upload_ok is set to 0 by an error
	if( $upload_ok != 0 )
	{
	    if( move_uploaded_file( $_FILES["upload"]["tmp_name"], $target_file ) )
	    {
	        echo "The file ". basename( $_FILES["upload"]["name"] ). " has been uploaded.";
	    }
	    else
	    {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
}


?>

			<div class="conteiner">

		        <div class="add_new_button">All Plugins<a href="?action=add_plugin">Upload Plugin</a></div>
		        
		        <?php
		        $display = "none";
		        if( isset($_GET['action']) && $_GET['action']=="add_plugin" )
		        {
		        	$display = "block";
		        }
		        ?>
		        <div style="display:<?php echo $display; ?>">
		        	<div class="add_new_plugin_headline">If you have a plugin in a .zip format, you may install it by uploading it here.</div>
			        <form class="add_new_plugin" method="POST" enctype="multipart/form-data">
			        	<input type="file" name="upload" id="upload">
			        	<input class="install_button" type="submit" name="submit" value="Install Now">
			        </form>
		        </div>

		        <div>
		        	<div class="best_plugins_list"><img src="<?php echo SITE_URL; ?>/wp-content/plugins/wp_logo.png"></div>
		        	<div class="best_plugins_list"><img src="<?php echo SITE_URL; ?>/wp-content/plugins/wp_logo.png"></div>
		        </div>

      		</div><!--end <div class="conteiner">-->

<?php include( "footer.php" ); ?>