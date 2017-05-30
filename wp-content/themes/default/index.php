<?php include( "header.php" ); ?>

		<div class="container">

			<div class="content">

				<?php

				while( have_post() ) : the_post();
				    
				    $img_url = get_post_meta($post->ID, "Image");
				    ?>
				    <div class="display_posts posts_lists">

				        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

				        <p>Published on <?php the_date(); ?></p>
				        <img src="<?php echo $img_url; ?>">
				        <p><?php echo my_truncate_text( get_the_content(), 200 ); ?></p>
				        <div class="read_more_button"><a href="<?php the_permalink(); ?>">Read More</a></div>

				    </div>
				    <?php

				endwhile;

				?>

			</div>

			<?php include( "sidebar.php" ); ?>

			<div style="clear:both"></div>
			
		</div>

		<div style="text-align:center;"><?php paginition( $wp_query->post_count, $wp_query->perpage, $wp_query->paged ); ?></div>

<?php include( "footer.php" ); ?>