<?php

include( "header.php" );

include( "menuebar-left.php" );


?>

<style type="text/css">
  .jscolor{
    width: 130px;
  }
</style>

			<div class="conteiner">

				<div>
					<?php
					if( isset($_GET['page']) && $_GET['page']!="" )
					{
						$page = $_GET['page'];
						if( isset( $wp_admin_pages[$page] ) )
						{
							$function = $wp_admin_pages[$page]["function"];
							$function();
						}
					}
					?>
				</div>

      		</div><!--end <div class="conteiner">-->

<?php include( "footer.php" ); ?>