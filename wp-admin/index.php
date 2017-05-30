<?php

include( "header.php" );

include( "menuebar-left.php" );

?>

      <div class="conteiner">

        <div style="font-size:24px;">Dashboard</div>

        <!--div class="notice_space"></div-->

        <div class="content">

          <div class="dashboard_left_part">

            <div class="overview"></div>

            <div class="post_update_overview"></div>
            
          </div>

          <div class="dashboard_right_part">

            <div class="add_new_draft_sibling" style="font-weight:bold; border-bottom:none;">Quick Draft</div>

            <div class="add_new_draft">

            	<form action="" method="POST">

            		<input type="hidden" name="id" value="<?php echo $current_post_id; ?>">

                <input class="draft_input_title" type="text" name="title" value="<?php echo $current_post_title; ?>" placeholder="Title...">

                <textarea type="text" name="content" value="<?php echo $current_post_content; ?>" placeholder="Whats on your mind?..."></textarea>

                <input class="draft_save_button" type="submit" name="draft" value="Save Draft">
            		
            	</form>

            </div><!--end <div class="add_new_draft"> -->

            <div class="add_new_draft_sibling" style="border-top:none;">
              <div>Drafts</div>
              <div><a href="#">(Post Title)</a> 07-05-2017</div>
              <div>Rashel</div>
            </div>

            <div class="wp_news_space"></div>

          </div>

          <div style="clear:both"></div>

        </div><!--end <div class="content"> -->

      </div><!--end <div class="conteiner"> -->

<?php include( "footer.php" ); ?>