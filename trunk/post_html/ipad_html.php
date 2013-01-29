<?php
function ipad_html($post)
{
	$prefiltered_html = ml_filters_get_filtered($post->post_content);

	$prefiltered_html = str_replace("\n","<p></p>",$prefiltered_html);
 	
	$html = str_get_html($prefiltered_html);	
	
	$img_tags = $html->find('img');
	$iframe_tags = $html->find('iframe');
	$object_tags = $html->find('object');
	$embed_tags = $html->find('embed');
	
	$tags = array_merge($img_tags,$iframe_tags,$object_tags,$embed_tags);
	$scripts = $html->find('script');
	//on center, with specific width and no height
	foreach($tags as $e)
	{
		//no width or height
		if(isset($e->width)) $e->width = null;
		if(isset($e->height)) $e->height = null;

		$e->style = "max-width:520px;margin-top:20px;margin-bottom:20px;";
		if($e->tag == "iframe" || $e->tag == "object" || $e->tag == "embed")
		{
			//should be a video
				$e->width = 500;
				$e->height = 300;
		}
		//center
		$e->outertext = "<center><div class=\"mobiloud_media\">" . $e->outertext . "</div></center><p></p>";
	}
		
	foreach($scripts as $s)
	{
		$s->outertext = ""; 
	}
	
	//JAVASCRIPT INCLUDES
	$header_js = "<script type=\"text/javascript\" src=\"".plugin_dir_url(__FILE__)."js/jquery.min.js\"></script>";

	$header_js .= "<script type=\"text/javascript\" src=\"".plugin_dir_url(__FILE__)."js/mobiloud.js\"></script>";
	//HEAD
	$header = "<head>".$header_js;
	
	$header .= "<meta name=\"viewport\" content=\"width=device-width; minimum-scale=1.0; maximum-scale=1.0;\" />";
	$header .= "<link rel=\"StyleSheet\" href=\"".plugin_dir_url(__FILE__)."css/ipad.css\" type=\"text/css\"  media=\"screen\">";

	$header .= "<link rel=\"StyleSheet\" href=\"".plugin_dir_url(__FILE__)."css/ipad_portrait.css\" type=\"text/css\"  media=\"screen\" id=\"orient_css\">";

	$header .= ml_filters_header($post->postID);

	$header .= "</head>";

	
	$init_html = "<html manifest=\"".plugin_dir_url(__FILE__+"../")."manifest.php\">".$header;
	
	$spaces = "<p>&nbsp;</p>";
	
	$title = "<h1 class='title' align='left'>".$post->post_title."</h1>";
	
	$title .= "<hr class='ml_hr'/>";
	$title .= "<p></p>";
	$title .= "<div class='author'>".get_author_name($post->post_author)."</div>";
	$title .= "<p></p>";
	$title .= "<div class='article_date'>".mysql2date('l j F Y',$post->post_date)."</div>";
	$title .= "<p></p>";
	$title .= "<hr class='ml_hr'/>";

	$title .= $spaces;

	
	
	return $init_html."<body><div id=\"content\">$spaces".$title.$html->save().$spaces."</div></body></html>";
}
?>