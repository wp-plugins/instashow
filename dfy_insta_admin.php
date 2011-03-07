

<h2>Welcome to InstaSHOW by <a href="http://freytag-film.com" target="_blank">Daniel Freytag</a></h2>
<div class="updated inline below-h2"><p><b>Please note:</b> This is just version 1.0, so please accept it, whether there are some bugs and report them to <a href="mailto:bug@freytag-film.com">bug@freytag-film.com</a> ;-)</p></div>
<br>

<?php
	
	if($_POST['user'] OR $_POST['userID'] OR $_POST['imagescount']) {
		if($_POST['user'] == "" OR $_POST['imagescount'] == "" OR $_POST['textsize'] == "" OR $_POST['imagesize'] == "") {
			echo '<div class="updated inline below-h2"><p>Please go back and fill out all fields!! <a href="javascript:history.back()"><i>Go back[Link]</i></a></p></div><br><br>';
			
		} else {
			
			$user_data = file("https://api.instagram.com/v1/users/search?q=" . $_POST['user'] . "&access_token=1731242.f59def8.8aff0efd7c45420581c07adcb1dc61f3");
			$user_data = json_decode($user_data[0]);
			//		echo "<pre>";
			//	print_r($user_data);
			//		echo "</pre>";
			$userID = $user_data->data[0]->id;
			
			update_option("dfy_InstaSHOW_user", $_POST['user']);
			update_option("dfy_InstaSHOW_userID", $userID);
			update_option("dfy_InstaSHOW_imagescount", $_POST['imagescount']);
			update_option("dfy_InstaSHOW_textsize", $_POST['textsize']);
			update_option("dfy_InstaSHOW_imagesize", $_POST['imagesize']);
			update_option("dfy_InstaSHOW_specialstyle", $_POST['specialstyle']);
			echo '<h3>Updated successfully!</h3>';
			
		}
	} 
	$imagescount = get_option("dfy_InstaSHOW_imagescount");
		echo '
		
		<table width="100%"><tr><td width="50%" valign="top"><form method="post">
		
		
		<table>
		<tr><td width="160">Instagram username:<br><br><br><br><br></td>
			<td><label><input name="user" type="text" size="30" maxlength="30" value="' . get_option("dfy_InstaSHOW_user") . '"><br>
				<small>Just enter your Instagram username, which you want to use with this plugin.</small></label><br><br>
				<hr color="dddddd" size="1"><br></td></tr>
	
	
		<tr><td width="160">Your ID:<br><br><br><br><br></td>
			<td><label><input type="text" size="30" maxlength="30" value="' . get_option("dfy_InstaSHOW_userID") . '" readonly><br>
				<small>You can\'t know you Instagram ID, the plugin will search!</small></label><br><br>
				<hr color="dddddd" size="1"><br></td></tr>
	
	
		<tr><td>Number of images:<br><br><br><br><br></td>
			<td><label><select name="imagescount">
				<option value="1"'; if($imagescount == "1") { echo ' selected="selected" ';} echo '>&nbsp;&nbsp;1 picture</option>
				<option value="2"'; if($imagescount == "2") { echo ' selected="selected" ';} echo '>&nbsp;&nbsp;2 pictures</option>
				<option value="3"'; if($imagescount == "3") { echo ' selected="selected" ';} echo '>&nbsp;&nbsp;3 pictures</option>
				<option value="4"'; if($imagescount == "4") { echo ' selected="selected" ';} echo '>&nbsp;&nbsp;4 pictures</option>
				<option value="5"'; if($imagescount == "5") { echo ' selected="selected" ';} echo '>&nbsp;&nbsp;5 pictures</option>
				<option value="6"'; if($imagescount == "6") { echo ' selected="selected" ';} echo '>&nbsp;&nbsp;6 pictures</option>
				<option value="7"'; if($imagescount == "7") { echo ' selected="selected" ';} echo '>&nbsp;&nbsp;7 pictures</option>
				<option value="8"'; if($imagescount == "8") { echo ' selected="selected" ';} echo '>&nbsp;&nbsp;8 pictures</option>
				<option value="9"'; if($imagescount == "9") { echo ' selected="selected" ';} echo '>&nbsp;&nbsp;9 pictures</option>
				<option value="10"'; if($imagescount == "10") { echo ' selected="selected" ';} echo '>10 pictures</option>
				<option value="11"'; if($imagescount == "11") { echo ' selected="selected" ';} echo '>11 pictures</option>
				<option value="12"'; if($imagescount == "12") { echo ' selected="selected" ';} echo '>12 pictures</option>
				<option value="13"'; if($imagescount == "13") { echo ' selected="selected" ';} echo '>13 pictures</option>
				<option value="14"'; if($imagescount == "14") { echo ' selected="selected" ';} echo '14 pictures</option>
				</select><br>
				<small>Select how many images you want to display.</small></label><br><br>
				<hr color="dddddd" size="1"><br></td></tr>
	
	
		<tr><td width="160">Text Size:<br><br><br><br><br></td>
			<td><label><input name="textsize" type="text" size="30" maxlength="30" value="' . get_option("dfy_InstaSHOW_textsize") . '"><br>
	<small>Enter a size for the displayed text.<br>This <b>must</b> either be <code>&nbsp;%&nbsp;</code>, <code>&nbsp;em&nbsp;</code> or <code>&nbsp;px&nbsp;</code>.</small></label><br><br>
				<hr color="dddddd" size="1"><br></td></tr>
	
		<tr><td width="160">Image Size:<br><br><br><br><br></td>
			<td><label><input name="imagesize" type="text" size="30" maxlength="30" value="' . get_option("dfy_InstaSHOW_imagesize") . '"><br>
				<small>Enter an image size of maximum 612px.<br><b>Don\'t</b> use <code>&nbsp;px&nbsp;</code>, <code>&nbsp;em&nbsp;</code> or <code>&nbsp;%&nbsp;</code></small></label><br><br>
				<hr color="dddddd" size="1"><br></td></tr>
	
		<tr><td width="160">Additional Style Attributes:<br><br><br><br><br><br></td>
			<td><label><input name="specialstyle" type="text" size="30" maxlength="30" value="' . get_option("dfy_InstaSHOW_specialstyle") . '"><br>
	<small><u>Warning:</u> Only for advanced users!<br>Enter additional style tags for the <code>&#060;div&#062;</code> tag.</small></label><br><br>
				<hr color="dddddd" size="1"><br></td></tr>
	
	
		
	
		<tr><td></td><td><input type="submit" name="Submit" class="button-primary" value=" Save changes "><br><br></td></tr></table>
		
		</form></td><td valign="top">
	
			<h3>Installation</h3>
	<ol style="margin-left: 60px;">
		<li>Upload the folder to the <code>/wp-content/plugins/</code> directory</li>
		<li>Activate the plugin through the <code>\'Plugins\'</code> menu in WordPress</li>
		<li>Select <code>insta.SHOW</code> from the settings menu</li>
		<li>Enter your username, etc.</li>
		<li>Place <code>[instagram]</code> in any post or page.</li>
		<li>Done!</li>
	</ol><br><br>
	
	<h3>Demo:</h3>
	<div style="width: 450px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd;"> ' . dfy_GENERATEinsta_action() . '</div>
	
		</td></tr></table>';
	
	
	
	echo '';
	
	
	
	
	
	
	
	
	
	
	
	?>