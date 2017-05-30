<?php

resister_taxonomy(
			array(
				"name"=>"Category",
				"slug"=>"category"
				)
			);

resister_taxonomy(
			array(
				"name"=>"Tag",
				"slug"=>"post_tag"
				)
			);

//echo "<pre>"; print_r( get_taxonomies() ); echo "</pre>";


resister_post_type(
			array(
				"name"	=> "Posts",
				"slug"	=> "post",
				"icon"	=> "thumb-tack"
				)
			);

resister_post_type(
			array(
				"name"	=> "Pages",
				"slug"	=> "page",
				"icon"	=> "sticky-note"
				)
			);

/*resister_post_type(
			array(
				"name"	=> "Blogs",
				"slug"	=> "blog",
				"icon"	=> ""
				)
			);*/

//echo "<pre>"; print_r( get_post_type() ); echo "</pre>";


?>