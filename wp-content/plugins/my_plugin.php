<?php

function my_ad()
{
	echo get_option( "my_plugin_header_text" );
}
add_action( "after_header", "my_ad" );


function my_text()
{
	echo '<div style="border-bottom:1px solid #ddd;"></div>';
}
add_action( "after_single_custom_field", "my_text" );


add_menue_page( "My Plugins", "myplugins", "my_plugin_page" );

function my_plugin_page()
{
	if( isset($_POST['submit']) && $_POST['submit']!="" )
	{
		update_option( "my_plugin_header_text", $_POST['my_plugin_header_text'] );
	}
	?>
	<div>
		<form action="" method="POST">
			<table>
				<tr>
					<td>Site Header Ad :</td>
					<td><input class="option_input" type="text" name="my_plugin_header_text" value="<?php echo get_option( "my_plugin_header_text" ); ?>"></td>
				</tr>
				<tr>
					<td><input class="draft_save_button" type="submit" name="submit" value="Save Changes"></td>
				</tr>
			</table>
		</form>
	</div>
	<?php
}


?>