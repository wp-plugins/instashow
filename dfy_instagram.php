<?php  
    /* 
	 Plugin Name: InstaSHOW 
	 Plugin URI: http://freytag-film.com/
	 Description: Display your images from Instagram
	 Author: Daniel Freytag - http://freytag-film.com/
	 Version: 0.9 
	 Author URI: http://freytag-film.com/
	 */  
	 

	function dfy_SHOWinsta_admin() {  
		include('dfy_insta_admin.php');  
	}

	function dfy_ADDinsta_action() {  
		add_options_page("InstaSHOW", "InstaSHOW", 1, "instaSHOW", "dfy_SHOWinsta_admin"); 
	//	add_option("dfy_InstaSHOW_user", "freytag", "", "no");
	//	add_option("dfy_InstaSHOW_userID", "1731242", "", "no");
	}
	
	function dfy_GENERATEinsta_action() {
		
		$width = get_option("dfy_InstaSHOW_boxwidth");
		$height = get_option("dfy_InstaSHOW_boxheight");
		$imagesize = get_option("dfy_InstaSHOW_imagesize");
		$special = get_option("dfy_InstaSHOW_specialstyle");
		
	//	$user_data = file("https://api.instagram.com/v1/users/1731242/media/recent/?access_token=1731242.f59def8.8aff0efd7c45420581c07adcb1dc61f3");
		$user_data = file("https://api.instagram.com/v1/users/" . get_option("dfy_InstaSHOW_userID") . "/media/recent/?access_token=1731242.f59def8.8aff0efd7c45420581c07adcb1dc61f3");
		$user_data = json_decode($user_data[0]);
		//		echo "<pre>";
		//	print_r($user_data);
		//		echo "</pre>";
		
		for($i=0;$i < 14; $i++) {
			$images_url[$i] = $user_data->data[$i]->images->low_resolution->url;
			$images_data[$i] = $user_data->data[$i]->caption->text;
		}
		
		$output = '<div style="overflow: auto; height: ' . $height . '; width: ' . $width . '; ' . $special . ' "><table style="padding: 0; margin: 0;"><tr>';
		for($k=0;$k < 14; $k++) {
			$output .= '<td><img src="' . $images_url[$k] . '" width="' . $imagesize . '" height="' . $imagesize . '" title="' . $images_data[$k] . '"></td>';
		}
		$output .= '</tr><tr>';
		for($k=0;$k < 14; $k++) {
			$output .= '<td>' . $images_data[$k] . '</td>';
		}
		$output .= '</tr></table></div>';
		
		return $output;
		
	} 
	
	
	function dfy_insta_update($content) {
		$instagram_content = dfy_GENERATEinsta_action();
		return str_replace('[instagram]', $instagram_content, $content);
	}


	add_action('admin_menu', 'dfy_ADDinsta_action'); 
	add_filter('the_content', 'dfy_insta_update');

	







?>