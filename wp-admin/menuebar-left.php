      <div class="left_sidebar">

        <div class="sidebar_main_manue home_link">
          <a href="<?php echo SITE_URL; ?>/wp-admin"><i class="fa fa-tachometer"></i>Dashboard</a>
          <div class="sidebar_sub_manue">
            <a href="<?php echo SITE_URL; ?>/wp-admin">Home</a>
            <a href="#">Updates</a>
          </div>
        </div>

        <div><a href="upload.php"><i class="fa fa-music" aria-hidden="true"></i>Media</a></div>

        <?php
        $all_post_type = get_post_type();
        foreach( $all_post_type as $key => $value )
        {
          $post_type_link = "";
          if( $key != "post" )
          {
            $post_type_link = "?post_type=".$key;
          }
          ?>
          <div class="sidebar_main_manue">
            <a href="edit-post.php<?php echo $post_type_link; ?>"><i class="fa fa-<?php echo $value['icon']; ?>"></i><?php echo $value['name']; ?></a>
            <div class="sidebar_sub_manue">
              <a href="edit-post.php<?php echo $post_type_link; ?>">All <?php echo $value['name']; ?></a>
              <a href="post-new.php<?php echo $post_type_link; ?>">Add New</a>
            </div>
          </div>
          <?php
        }
        ?>

        <div><a href="options.php"><i class="fa fa-cogs" aria-hidden="true"></i>Settings</a></div>
        <div><a href="#"><i class="fa fa-comment"></i>Comments</a></div>

        <div class="sidebar_main_manue">
          <a href="themes.php">Appearance</a>
          <div class="sidebar_sub_manue">
            <a href="themes.php">Themes</a>
          </div>
        </div>

        <div><a href="plugins.php"><i class="fa fa-plug"></i>Plugins</a></div>

        <?php
        foreach( $wp_admin_pages as $key => $value )
        {
          echo '<div><a href="admin.php?page='.$key.'">'.$value['title']."</a></div>";
        }
        ?>
      
      </div>