<?php include( "header.php" ); ?>

			<div class="container">

				<div class="content">

					<?php

					//echo "<pre>"; print_r($wp_query->query_posts); echo "</pre>";exit;

					foreach( $wp_query->query_posts as $post )
					{
					    if( $post->post_status != "Draft" )
					    {
						    ?>
						    <div class="display_posts posts_lists">

						        <h1><a href="?p=<?php echo $post->ID; ?>"><?php echo ucfirst( $post->post_title ); ?></a></h1>

						        <p><?php echo $post->post_status." on ".$post->post_date; ?></p>
						        <p><?php echo my_truncate_text( $post->post_content, 200 ); ?></p>
						        <div class="read_more_button"><a href="?p=<?php echo $post->ID; ?>">Read More</a></div>

						    </div>
						    <?php
						}//end if( $post->post_status != "Draft" )

					}//end foreach( $result as $post_id => $value )

					?>

				</div>

				<?php include( "sidebar.php" ); ?>

			<div style="clear:both"></div>
			
		</div>

<?php

include( "footer.php" );

?>