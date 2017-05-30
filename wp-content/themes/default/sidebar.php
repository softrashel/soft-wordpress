			<div class="sidebar">

				<div class="display_tax">

					<?php

					$taxonomies = get_taxonomies();
					//echo "<pre>"; print_r( $taxonomies ); echo "</pre>";exit;
					foreach( $taxonomies as $taxonomy )
					{
					  $terms = get_taxonomy_terms( $taxonomy['slug'] );
					  //echo "<pre>"; print_r( $terms ); echo "</pre>";exit;

					  echo '<h3>' . $taxonomy['name'] . '</h3>';

					  foreach( $terms as $term )
					  {
					    echo '<h5><a href="?cat=">' . $term['name'] . '</a></h5>';
					  }

					}//end foreach( $taxonomies as $taxonomy )

					?>					

				</div>

				<?php
				if( !is_home() )
				{
					?>
					<div class="display_tax">
						
						<h3>Recent Posts</h3>

						<?php

						$args = array(
								//'cat'		=>8,
							  	'showposts'	=>6,
							  	//'post__in' 	=> array( 8, 10 )
							  );
						$my_wp_query = new WP_Query( $args );

						while( $my_wp_query->have_post() ) : $my_wp_query->the_post();
						    
						    ?>
						    <div><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
						    <?php

						endwhile;

						?>

					</div>
					<?php
				}
				?>

			</div><!--end <div class="sidebar">-->