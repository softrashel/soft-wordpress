<?php

include( "header.php" );

include( "menuebar-left.php" );

if( isset($_POST['submit_meta']) )
{
  foreach( $_POST as $key => $value )
  {
    if( $key != "submit_meta" )
    {
      update_option( $key, $value );
    }
  }
  //echo "<pre>"; print_r($_POST); echo "</pre>";
}

//Get All Theme Folders for Select Active Theme
/*$dir = ABSPATH."/wp-content/themes/";
$files = scandir($dir);
array_shift($files);
array_shift($files);

$theme_files = array();
foreach( $files as $file )
{
  $theme_files[$file] = ucfirst($file);
}*/

$themes_info = get_themes_info();
//echo "<pre>"; print_r($themes_info); echo "</pre>";

$option_fields = array(
      array(
        "name"        => "site_name",
        "text"        => "Site Name",
        "description" => "",
        "default"     => "my wordpress",
        "type"        => "text"
        ),
      array(
        "name"        => "tag_line",
        "text"        => "Tag Line",
        "description" => "In a few words, explain what this site is about.",
        "default"     => "my wordpress",
        "type"        => "text"
        ),
      array(
        "name"        => "post_per_page",
        "text"        => "Post Per Page",
        "description" => "",
        "default"     => 4,
        "type"        => "text"
        ),
      array(
        "name"        => "site_theme",
        "text"        => "Active Theme",
        "description" => "",
        "default"     => "",
        "type"        => "select",
        "options"     => $themes_info
        ),
      array(
        "name"        => "active_plugins",
        "text"        => "Active Plugins",
        "description" => "",
        "default"     => "",
        "type"        => "text"
        )
  );


?>


<style type="text/css">
  .jscolor{
    width: 130px;
  }
</style>
      
      <div class="conteiner">

        <div style="font-size:24px;">All Settings</div>

        <!--div class="notice_space"></div-->

        <div class="content">

      		<form action="" method="POST" class="all_settings">
      			<table>

              <?php
              foreach( $option_fields as $field )
              {
                ?>

                <tr>
                  <td><a href="#"><?php echo $field['text']; ?></a></td>
                  <td>
                    <?php
                    switch( $field['type'] )
                    {
                      case 'text':
                      {
                        ?>
                        <input class="option_input" type="text" name="<?php echo $field['name']; ?>" value="<?php echo get_option($field['name']); ?>" placeholder="Type here...">
                        <?php
                        break;
                      }
                      case 'select':
                      {
                        ?>
                        <select class="option_input" style="width:150px" name="<?php echo $field['name']; ?>">
                          <?php
                          foreach( $field['options'] as $theme_folder => $theme_info )
                          {
                            $select = "";
                            $current_folder = get_option( $field['name'] );
                            if( $theme_folder == $current_folder ){ $select = " selected"; }
                            echo '<option value="'.$theme_folder.'"'.$select.'>'.$theme_info['Theme Name'].'</option>';
                          }
                          ?>
                        </select>
                        <?php
                        break;
                      }//end case 'select'

                    }//end switch( $field['type'] )
                    ?>
                  </td>
                </tr>

                <?php
              }//end foreach( $option_fields as $field )
              ?>

              <tr>
                <td><input class="draft_save_button" type="submit" name="submit_meta" value="Save Changes"></td>
              </tr>

      		  </table>
          </form>

        </div><!--end <div class="content">-->

      </div><!--end <div class="conteiner">-->

<?php include( "footer.php" ); ?>