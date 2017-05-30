<?php

include( "header.php" );

include( "menuebar-left.php" );

$args = array();
$my_wp_query = new WP_Query( $args );


//item send to delete_posts():
if( isset( $_GET["action"] ) && $_GET["action"]=="delete" )
{
  if( isset( $_GET["id"] ) && $_GET["id"]!="" )
  {
    $id = $_GET["id"];
    
    delete_posts( $id );
    //echo "delete success";
  }
}

?>

      <div class="conteiner">

        <div class="add_new_button">Posts<a href="<?php echo SITE_URL; ?>/wp-admin/post-new.php">Add New</a></div>

        <!--div class="notice_space"></div-->

        <div class="content">

          <div class="show_all_posts_as_table">
            <table>

              <tr class="even" style="font-size:16px;">

                <td style="width:500px;"><a href="#">Title</a></td>
                <td>Author</td>
                <td>Category</td>
                <td>Tags</td>
                <td>Pages</td>
                <td>Comments</td>
                <td><a href="#">Date</a></td>

              </tr>

              <?php

              $num = 0;

        			foreach( $my_wp_query->query_posts as $post )
        			{
                $num++;
                $class = "odd";
                if( $num % 2 == 0)
                {
                  $class = "even";
                }
      			    ?>
      			    <tr class="<?php echo $class; ?>">

    			        <td>
                    <div class="all_posts_title_list"><a href="?p=<?php echo $post->ID; ?>"><?php echo ucfirst( $post->post_title ); ?></a></div>
                    <span>
                      <a href="<?php echo SITE_URL; ?>/wp-admin/post-new.php?action=edit&id=<?php echo intval( $post->ID ); ?>">Edit</a>
                      <a href="?action=delete&id=<?php echo intval( $post->ID ); ?>">Delete</a>
                    </span>
                  </td>
                  <td>Admin</td>
                  <td>Uncategorised</td>
                  <td>__</td>
                  <td>Test Page</td>
                  <td>__</td>
                  <td><?php echo ucfirst($post->post_status) ."<br>". $post->post_date; ?></td>

      			    </tr>
      			    <?php

        			}//end foreach( $result as $post_id => $value )

        		  ?>

            </table>
          </div>

        </div><!--end <div class="content"> -->

      </div><!--end <div class="conteiner"> -->

<?php include( "footer.php" ); ?>