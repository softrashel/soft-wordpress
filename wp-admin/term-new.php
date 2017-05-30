<?php

//=================== Term ready for Save ===================//
global $wpdb;

if( isset( $_POST['save_term'] ) )
{
  $term = array();

  $name = ( isset( $_POST['name'] ) && $_POST['name'] != "" ) ? $_POST['name'] : "any";
  $name = str_replace( ";", "", $name );
  $name = str_replace( "=", "", $name );

  if( $name != "" )
  {
    $slug = strtolower( str_replace( " ", "-", $name ) );

    $term['id'] = ( isset( $_POST['id'] ) && $_POST['id'] != "" ) ? $_POST['id'] : 0;
    $term['name'] = $name;
    $term['slug'] = $slug;
    $term['taxonomy'] = ( isset( $_POST['taxonomy'] ) && $_POST['taxonomy'] != "" )? $_POST['taxonomy'] : "any";
    $term['count'] = 0;

    $sql = "INSERT INTO `wp_terms`(`name`, `slug`, `taxonomy`, `count`) VALUES ('".$term['name']."','".$term['slug']."','".$term['taxonomy']."','".$term['count']."')";
    $wpdb->query( $sql );
  }
}

//=================== Current Term ready for Update ===================//

if( isset( $_GET["action"] ) && $_GET["action"]=="edit" )
{
  if( isset( $_GET["term_id"] ) && $_GET["term_id"]!="" )
  {
    $id = $_GET["term_id"];
    $sql = "SELECT * FROM wp_terms WHERE `ID`=".$id;
    $result = $wpdb->query( $sql );

    $edit_term = mysql_fetch_assoc( $result );
    //echo "<pre>"; print_r( $edit_term ); echo "</pre>";
  }
}

$current_term_id = isset( $edit_term['ID'] ) ? $edit_term['ID'] : 0;
$current_term_name = isset( $edit_term['name'] ) ? $edit_term['name'] : "";
$current_term_slug = isset( $edit_term['slug'] ) ? $edit_term['slug'] : "";
$current_term_taxonomy = isset( $edit_term['taxonomy'] ) ? $edit_term['taxonomy'] : "";

?>

            <div class="add_taxonomy_area" style="margin-top:60px; padding-bottom: 30px;">
            
              <form action="" method="POST"><!--start Term form-->

                <?php

                $all_taxonomies = get_taxonomies();
                //echo "<pre>"; print_r( $all_taxonomies ); echo "</pre><hr>";

                foreach( $all_taxonomies as $taxonomy )
                {
                  $select = "";
                  if( $current_term_taxonomy == $taxonomy['slug'] ) { $select = " selected"; }

                  echo '<div class="taxonomy_title" style=" border:none;"><input type="checkbox" name="taxonomy" value="' . $taxonomy['slug'] . '"' . $select . ' style="cursor:pointer">+Add New ' . $taxonomy['name'] . '</div>';

                  echo '<input class="select_taxonomy" style="margin: -10px 10px 30px;" type="text" name="name" value="" placeholder="Type ' . $taxonomy['name'] .'...">';
                }

                ?>

                <input type="hidden" name="id"  value="<?php echo $current_term_id; ?>">

                <input class="save_draft_button" style="margin-top:-10px;" type="submit" name="save_term" value="Save">

              </form><!--end Term form-->

            </div><!--end <div class="add_taxonomy_area"> -->