<?php

function my_truncate_text( $text , $number_of_characters , $remove_word_if_break = true , $extra_text = "..." )
{
	$text_length = strlen( $text ) ;

	if( $text_length <= $number_of_characters )
	{
		return $text;
	}

	if( $remove_word_if_break == false )
	{
		$new_text = substr( $text, 0, $number_of_characters );

		return $new_text.$extra_text ;	
	}
	else
	{		
		$new_text = "";
		$words = explode( " ", $text );
		$new_text_len = 0;

		foreach(  $words as $word )
		{
			$wn = strlen( $word ) ;

			if( ( $new_text_len + $wn +1 ) <= $number_of_characters  ) 
			{				
				$new_text.= " ".$word;
				$new_text_len = $new_text_len+$wn+1;
			}
			else
			{
				break;	
			}

		}//end foreach(  $words as $word )

		return $new_text.$extra_text;

	}//end else

}//end function my_truncate_text( $text , $number_of_characters )


function paginition( $total_record, $per_page, $current_page )
{
	$total_page = ceil( $total_record / $per_page );

	$first = 1;
	$prev = $current_page - 1;
	$next = $current_page + 1;
	$last = $total_page;
	$show_prev = false;
	$show_next = false;
	$first_or_last = false;

	if( $current_page > 1 ){ $show_prev = true; }
	if( $current_page < $last ){ $show_next = true; }

	$start = $current_page - 4;

	if( $start < 1 ){ $start = 1; }

	$end = $start + 9;
	$end = min( $end, $last );

	if( ($end - $start ) != 9 ) { $start = $end - 9; }
	if( $start < 1 ){ $start = 1; }

	if( ( $end - $start ) == 9 ){ $first_or_last = true; }

	?>

	<div id="pagenav">
		<ul>
			<?php
			if( $show_prev )
			{ 	
				if( $first_or_last && ( $first != $start ) )
				{
					echo '<li><a href="?paged='.$first.'">First</a></li>';
				}
				echo '<li><a href="?paged='.$prev.'">&laquo; Prev</a></li>';
			}
			for( $i=$start; $i<=$end; $i++ )
			{
				if( $i == $current_page )
				{
					echo '<li class="active">'.$i."</li>";
				}
				else
				{
					echo '<li><a href="?paged='.$i.'">'.$i.'</a></li>';
				}
			}
			if( $show_next )
			{
				if( $first_or_last && ( $last != $end ) )
				{
					echo '<li><a href="?paged='.$last.'">Last</a></li>';
				}
				echo '<li><a href="?paged='.$next.'">Next &raquo;</a></li>';
			}
			?>
		</ul>
	</div><!--end <div id="pagenav">-->

<?php

}//end function paginition( $total_record, $per_page, $current_page )



wp_enqueue_style( "font_awesome" );


add_menue_page( "Theme Options", "theme_options", "my_theme_options_page" );

function my_theme_options_page()
{
	if( isset($_POST['submit_opt']) )
	{
	  foreach( $_POST as $key => $value )
	  {
	    if( $key != "submit_opt" )
	    {
	      update_option( $key, $value );
	    }
	  }
	  //echo "<pre>"; print_r($_POST); echo "</pre>";
	}
	?>
	<form action="" method="POST">
		<table>
			<tr>
				<td>Select Header Color :</td>
				<td><input class="option_input jscolor" type="text" readonly name="site_name_color" value="<?php echo get_option("site_name_color"); ?>"></td>
			</tr>
			<tr>
				<td>Select Tag Line Color :</td>
				<td><input class="option_input jscolor" type="text" readonly name="tagline_color" value="<?php echo get_option("tagline_color"); ?>"></td>
			</tr>
			<tr>
				<td><input class="draft_save_button" type="submit" name="submit_opt" value="Save Changes"></td>
			</tr>
		</table>
	</form>
	<?php
}


?>