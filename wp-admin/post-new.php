<?php

include( "header.php" );

include( "menuebar-left.php" );

$post_type = "post";
if( isset($_GET['post_type']) )
{
  $post_type = $_GET['post_type'];
}

?>

      <div class="conteiner">

        <div style="font-size:24px;">Add New <?php echo ucfirst($post_type); ?></div>

        <!--div class="notice_space"></div-->

        <div class="content">

          <div class="add_new_post">

            <form action="" method="POST"><!--start Post form-->

            	<input type="hidden" name="id" value="<?php echo $current_post_id; ?>">

              <input class="input_post_title" type="text" name="title" value="<?php echo $current_post_title; ?>" placeholder="Enter title here...">

              <textarea class="my_tinymce post_content" type="text" name="content" value="" placeholder="type content..."><?php echo $current_post_content; ?></textarea>

            
            <div class="add_custom_field">

              <div>Custom Fields</div>
              <div style="color:#444;">Add New Custom Field :</div>

              <div style="background-color:#eee; border:1px solid #ddd;">

                <div style="width:777px; background-color:#ddd; text-align:center;">

                  <div style="width:280px; float:left; padding:5px 0;">Name</div>

                  <div style="width:485px; float:left; padding:5px 0;">Value</div>

                  <div style="clear:both"></div>

                </div>

                <div style="padding:10px;">

                  <?php

                  $all_meta_keys = get_all_meta_keys();

                  //echo "<pre>"; print_r( $current_custom_fields ); echo "</pre>";

                  foreach( $current_custom_fields as $current_meta_key => $current_meta_value )
                  {
                  
                    ?>

                    <div>
                      <select style="width:280px; height:30px;" name="meta_key[]">
                        <option value="">--Select--</option>
                        <?php
                        foreach( $all_meta_keys as $meta_key )
                        {
                          $select = "";
                          if( $current_meta_key == $meta_key ){ $select = " selected"; }
                          echo '<option value="'.$meta_key.'"'.$select.'>'.$meta_key.'</option>';
                        }
                        ?>
                      <select>
                      <textarea type="text" name="meta_value[]" value=""><?php echo $current_meta_value; ?></textarea>
                    </div>

                    <?php

                    do_action( "after_single_custom_field" );

                  }
                  ?>

                  <div>
                    <select style="width:280px; height:30px;" name="meta_key[]">
                      <option value="">--Select--</option>
                      <?php
                      foreach( $all_meta_keys as $meta_key )
                      {
                        echo '<option value="'.$meta_key.'">'.$meta_key.'</option>';
                      }
                      ?>
                    <select>
                    <textarea type="text" name="meta_value[]" value=""></textarea>
                  </div>

                  <div><span onclick="add_meta_field()" id="add_meta_button" class="enter_new_button">Enter new</span></div>
                  <div><input onclick="add_meta_field_select()" id="add_meta_button_select" class="optional_button draft_button" type="button" name="add_custom" value="Add Custom Field"></div>

                </div>

              </div>

            </div>

          </div><!--end <div class="add_new_post"> -->

          <div class="right_sidebar">

            <div style="padding:10px; background-color:#fff; border:1px solid #ddd; border-bottom:none;"><b>Publish</b></div>

            <div style="padding:10px; background-color:#fff; border:1px solid #ddd;">

              <input class="optional_button draft_button" type="submit" name="draft" value="Save Draft">

              <a class="optional_button preview_button" href="#">Preview</a>

              <div>Status: <b>Published </b><a class="edit_button" href="#">Edit</a></div>
              <div>Visibility: <b>Public </b><a class="edit_button" href="#">Edit</a></div>
              <div>Publish <b>immediately </b><a class="edit_button" href="#">Edit</a></div>

            </div>

            <div style="height:50px; margin-bottom:20px; border:1px solid #ddd; border-top:none;">
              <input class="save_draft_button" type="submit" name="submit" value="Publish">
            </div>

            <?php

            $taxonomies = get_taxonomies();
            //echo "<pre>"; print_r( $taxonomies ); echo "</pre>";exit;
            foreach( $taxonomies as $taxonomy )
            {
              ?>

              <div class="add_taxonomy_area">

                <?php

                $terms = get_taxonomy_terms( $taxonomy['slug'] );
       
                echo '<div class="taxonomy_title">' . $taxonomy['name'] . '</div>';
                echo '<select class="select_taxonomy" name="' . $taxonomy['slug'] . '">';

                  echo '<option value="0">Slect ' . $taxonomy['name'] . '...</option>';

                foreach( $terms as $term )
                {
                  $select = "";
                  if( in_array( $term['ID'], $current_term_ids ) ) { $select = " selected"; }

                  echo '<option value="' . $term['ID'] . '"' . $select . '>' . $term['name'] . '</option>';
                }

                echo '</select>';

                ?>

              </div><!--end <div class="add_taxonomy_area"> -->

              <?php
            }

            ?>
              
            </form><!--end Post form-->            

            <?php include( "term-new.php" ); ?>

          </div>

          <div style="clear:both"></div>

        </div><!--end <div class="content"> -->

      </div><!--end <div class="conteiner"> -->

      <script type="text/javascript">
        function add_meta_field_select()
        {
          var html = '<div><select style="width:280px; height:30px;" name="meta_key[]">';
                      html+= '<option value="">--Select--</option>';
                      <?php                      
                      foreach( $all_meta_keys as $meta_key )
                      {
                        echo 'html+= \'<option value="'.$meta_key.'">'.$meta_key.'</option>\';'; echo "\r\n";
                      }
                      ?>
                    html+= '<select><textarea type="text" name="meta_value[]" value=""></textarea></div>';
          jQuery("#add_meta_button_select").parent().before(html);
        }
        function add_meta_field()
        {
          var html = '<div><input style="width:280px;" type="text" name="meta_key[]" value=""><textarea type="text" name="meta_value[]" value=""></textarea></div>';
          jQuery("#add_meta_button").parent().before(html);
        }
      </script>

<?php include( "footer.php" ); ?>