<?php  
    /* 
	 Plugin Name: Insta.SHOW 
	 Plugin URI: http://freytag-film.com/
	 Description: Display your images from <a href="http://instagr.am/" target="_blank">Instagram</a> - <a href="http://freytag-film.com/" target="_blank>Written by Daniel Freytag</a>
	 Author: Daniel Freytag
	 Version: 1.2.1
	 Author URI: http://freytag-film.com/
	 */  
	 

	function dfy_SHOWinsta_admin() {  
		include('dfy_insta_admin.php');  
	}

	function dfy_ADDinsta_action() {  
		add_options_page("Insta.SHOW", "Insta.SHOW", 1, "insta.SHOW", "dfy_SHOWinsta_admin"); 
	//	add_option("dfy_InstaSHOW_user", "freytag", "", "no");
	//	add_option("dfy_InstaSHOW_userID", "1731242", "", "no");
	}
	
	// Settings Button on Plugins Panel
	function dfy_pluginspage_link($links, $file) {
		
		static $this_plugin;
		if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);
		
		if ( $file == $this_plugin ){
			$settings_link = '<a href="options-general.php?page=insta.SHOW">Settings</a>';
			array_unshift( $links, $settings_link );
		}
		
		return $links;
		
	}
	
	function dfy_GENERATEinsta_action() {
		
		$textsize = get_option("dfy_InstaSHOW_textsize");
		$imagesize = get_option("dfy_InstaSHOW_imagesize");
		$special = get_option("dfy_InstaSHOW_specialstyle");
		$imagescount = get_option("dfy_InstaSHOW_imagescount");
		$token = get_option("dfy_InstaSHOW_accesstoken");
		
		$user_data = file("https://api.instagram.com/v1/users/" . get_option("dfy_InstaSHOW_userID") . "/media/recent/?access_token=" . $token);
		$user_data = json_decode($user_data[0]);
		
		for($i=0;$i < $imagescount; $i++) {
			
			$images_url[$i] = $user_data->data[$i]->images->standard_resolution->url;
			$images_data[$i] = $user_data->data[$i]->caption->text;
		}
		include('style.php');
		$output = '<script src="' . plugins_url('/instashow/jquery-1.4.min.js', dirname(__FILE__)) . '" type="text/javascript" charset="utf-8"></script>
		<script src="' . plugins_url('/instashow/loopedslider.js', dirname(__FILE__)) . '" type="text/javascript" charset="utf-8"></script>
		<div id="insta_loopedSlider">
		<a href="#" class="instaprevious">previous</a>
		<a href="#" class="instanext">next</a>
		<div id="insta_wrap">
		<div class="insta_container">
		<div class="insta_slides">';
		for($k=0;$k < $imagescount; $k++) {
			$output .= '<div><img src="' . $images_url[$k] . '" width="' . $imagesize . '" height="' . $imagesize . '" title="' . $images_data[$k] . '"><br><insta_caption>' . $images_data[$k] . '</insta_caption></div>';
		}
		$output .= '</div>
		</div>
		</div>
		</div><script type="text/javascript" charset="utf-8">
		$(function(){
		// Option set as a global variable
		$.fn.loopedSlider.defaults.addPagination = false;
		$(\'#insta_loopedSlider\').loopedSlider();
	});
	</script>';
		
		return $output;
		
	} 
	function dfy_insta_update($content) {
		if (strlen(strstr($content,'[instagram]'))>0) {
			$instagram_content = dfy_GENERATEinsta_action();
			return str_replace('[instagram]', $instagram_content, $content);
		}
		return $content;
	}

	add_filter( 'plugin_action_links', 'dfy_pluginspage_link', 10, 2 );
	add_action('admin_menu', 'dfy_ADDinsta_action'); 
	add_filter('the_content', 'dfy_insta_update');

	







?>