<?php

include( "header.php" );

include( "menuebar-left.php" );

$themes_info = get_themes_info();


if( isset($_GET['site_theme']) && $_GET['site_theme']!="" )
{
	update_option( "site_theme", $_GET['site_theme'] );
}


?>

			<div class="conteiner">

		        <div class="add_new_button">All Themes<a href="#">Add New</a></div>

		        <!--div class="notice_space"></div-->

				<?php
				foreach( $themes_info as $theme_folder => $theme_info )
				{
					$img_url = SITE_URL."/wp-content/themes/".$theme_folder."/screenshot.png";
					//echo "<pre>"; print_r($img_url); echo "</pre>";
					?>
					<div class="theme_banner">
						<div><img src="<?php echo $img_url; ?>"><a class="theme_details" href="#">Theme Details</a></div>
						<div>
							<a class="theme_title" href="#"><?php echo $theme_info['Theme Name']; ?></a>
							<a class="theme_buttons theme_preview_button" href="#">Live Preview</a>
							<a class="theme_buttons theme_active_button" href="?site_theme=<?php echo $theme_folder; ?>">Active</a>
						</div>
					</div>
					<?php
				}
				?>

      		</div><!--end <div class="conteiner">-->

<?php include( "footer.php" ); ?>