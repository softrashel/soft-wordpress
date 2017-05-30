<?php include( "header.php" ); ?>
	
	<div id="fh5co-main">

		<div class="container">

			<div class="row">

		        <div id="fh5co-board" data-columns>

					<?php

					while( have_post() ) : the_post();
					    
					    $img_url = get_post_meta($post->ID, "Image");
					    ?>
			        	<div class="item">
			        		<div class="animate-box">
				        		<a class="image-popup fh5co-board-img" href="<?php echo $img_url; ?>"><img src="<?php echo $img_url; ?>" alt="HTML5 Bootstrap Template"></a>
				        		<div class="fh5co-desc"><?php echo my_truncate_text( get_the_content(), 200 ); ?></div>
			        		</div>
			        	</div>
					    <?php

					endwhile;

					?>

		        </div>

        	</div>

       </div>

	</div>

<?php include( "footer.php" ); ?>