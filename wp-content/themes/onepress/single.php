<?php include( "header.php" ); ?>

		<div class="container">

			<div class="content">

			<?php

				while( have_post() ) : the_post();
				    ?>
				    <div class="display_posts">

				        <h1><?php the_title(); ?></h1>
				        <p><?php the_date(); ?></p>
				        <p><?php the_content(); ?></p>

				    </div>
				    <?php

				endwhile;

			?>

			</div>

			<?php include( "sidebar.php" ); ?>

			<div style="clear:both"></div>
			
		</div>

<?php include( "footer.php" ); ?>