<?php

require( dirname( __FILE__ ) . "/../wp-load.php" );

if( !is_user_logged_in() )
{
  header( "location:login.php" );exit;
}

//=================== Post ready for Save ===================//
global $wpdb;

if( isset( $_POST['submit'] ) || isset( $_POST['draft'] ) )
{
  if( isset( $_POST['submit'] ) ) { $status = "publish"; }
  elseif( isset( $_POST['draft'] ) ) { $status = "draft"; }

  $date = date( "Y-m-d H:i:s" );
  $post_id = ( isset( $_POST['id'] ) && $_POST['id'] != "" ) ? $_POST['id'] : 0;
  $title = ( isset( $_POST['title'] ) && $_POST['title'] != "" ) ? $_POST['title'] : "";
  $content = ( isset( $_POST['content'] ) && $_POST['content'] != "" ) ? $_POST['content'] : "";

  $info_arr['ID'] = $post_id;
  $info_arr['post_title'] = $title;
  $info_arr['post_content'] = $content;
  $info_arr['post_date'] = $date;
  $info_arr['post_status'] = $status;

  $info_arr['post_type'] = "post";
  
  if( isset($_GET['post_type']) )
  {
    $info_arr['post_type'] = $_GET['post_type'];
  }

  $meta_input = array();

  $n = 0;
  foreach( $_POST['meta_key'] as $value )
  {
    $n++;
    $value = trim($value);

    if( $value == "" ){ continue; }

    $meta_key = $value;
    $meta_value = $_POST['meta_value'][$n-1];

    $meta_input[$meta_key] = $meta_value;
  }

  $info_arr['meta_input'] = $meta_input;

  $tax_input = array();

  $taxonomies = get_taxonomies();

  foreach( $taxonomies as $taxonomy )
  {
    $term_id = ( isset( $_POST[ $taxonomy['slug'] ] ) && $_POST[ $taxonomy['slug'] ] != "" ) ? $_POST [$taxonomy['slug'] ] : 0;

    $tax_input[ $taxonomy['slug'] ] = $term_id;

  }//end foreach( $taxonomies as $taxonomy )

  $info_arr['tax_input'] = $tax_input;

  $post_id = wp_insert_post( $info_arr );

  if( $post_id ){ header( "location:post-new.php?action=edit&id=".$post_id );exit; }

}//end if( isset( $_POST['submit'] ) || isset( $_POST['draft'] ) )


//=================== Current Post ready for Update ===================//

$current_post_id = 0;
$current_post_title = "";
$current_post_content = "";

$current_custom_fields = array();                    
$current_meta_key = "";
$current_meta_value = "";

$current_attributes = array();
$current_relship_term_id = "";

if( isset( $_GET["action"] ) && $_GET["action"]=="edit" )
{
  if( isset( $_GET["id"] ) && $_GET["id"]!="" )
  {
    $current_post_id = $_GET["id"];

    $sql = "SELECT * FROM wp_posts WHERE `ID`=".$current_post_id;
    $edit_post = $wpdb->get_row( $sql );
    //echo "<pre>"; print_r( $edit_post ); echo "</pre>";

    $current_post_title = ( isset( $edit_post['post_title'] ) && $edit_post['post_title']!="" ) ? $edit_post['post_title'] : "";
    $current_post_content = ( isset( $edit_post['post_content'] ) && $edit_post['post_content']!="" ) ? $edit_post['post_content'] : "";


    $current_custom_fields = get_post_customs( $current_post_id );


    $tax_sql = "SELECT * FROM `wp_term_relationship` WHERE `post_id`=".$current_post_id;
    $current_attributes = $wpdb->get_result( $tax_sql );
    //echo "<pre>"; print_r( $current_attributes ); echo "</pre>";

    foreach( $current_attributes as $value )
    {      
      $current_term_ids[] = $value['term_id'];
    }
    
  }//end if( isset( $_GET["id"] ) && $_GET["id"]!="" )

}//end if( isset( $_GET["action"] ) && $_GET["action"]=="edit" )

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Page</title>
	<link rel="stylesheet" href="style.css">
  <?php wp_head_admin(); ?>
</head>

<body>
  <div id="wrapper">

    <div class="action_bar_area">

      <div class="action_bar_left">

        <a class="wp_logo" href="#"><i class="fa fa-wordpress"></i></a>
        <a class="home_logo" href="<?php echo SITE_URL; ?>"><i class="fa fa-home fa-lg"></i>softRashel</a>
        <a href="#"><i class="fa fa-refresh"></i>4</a>
        <a href="#"><i class="fa fa-comment"></i>0</a>
        <a href="#">+New</a>

      </div>

      <div class="action_bar_right">
        
        <a href="#">Rashel, admin<img src="images/admin.png"></a>
        <a href="logout.php" class="sign_button">Logout</a>

      </div>

      <div style="clear:both"></div>

    </div><!--end <div class="action_bar_area"> -->

    <div class="main">      