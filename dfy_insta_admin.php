

<h2>Welcome to InstaSHOW</h2>
<br><br>

<?php
	
// Check whether we need to update or not - user+token
	if(isset($_POST['username']) OR isset($_POST['userID']) OR isset($_POST['imagescount'])) {
		
	// User +token
		if(isset($_POST['username']) AND isset($_POST['password'])) {
			
	//ID Request with Xauth from v1.2+
			$Curl_Session = curl_init('https://api.instagram.com/oauth/access_token');
			curl_setopt ($Curl_Session, CURLOPT_POST, 1);
			curl_setopt ($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=" . $_POST['username'] . "&password=" . $_POST['password'] . "&grant_type=password&client_id=9adbe6c48df041edb5ee006ed7a1cac2&client_secret=3bba5eefc58a4092bb49f56c85ddb037");
			$keycode = curl_exec ($Curl_Session);
			curl_close ($Curl_Session);
			
	// Decode output
			$keycode = json_decode($keycode);
			
	// Error detection
			if(($keycode->error_message) != "") { echo "<div class='updated inline below-h2'><p>" . $keycode->error_message . "!</p></div>";} else {
		
	// Output for dev. reasons:	
		//	echo "<pre>";
		//	print_r(($keycode));
		//	echo "</pre>";
			
	// fetch ID+Token!! (important)
			$userID = $keycode->user->id;
			$token = $keycode->access_token;
			
	// save to DB 1
			update_option("dfy_InstaSHOW_userID", $userID);
			update_option("dfy_InstaSHOW_accesstoken", $token);
				
				echo "<div class='updated inline below-h2'><p>Username and Password were successfully saved!</p></div>";
			} }
			
		if($_POST['username'] == "") {
			if(($_POST['imagescount'] == "" OR $_POST['textsize'] == "" OR $_POST['imagesize'] == "")) {
				echo '<div class="updated inline below-h2"><p>Please go back and fill out all fields!! <a href="javascript:history.back()"><i>Go back[Link]</i></a></p></div><br><br>';
				
			} else {
				if(!isset($keycode->message)) {
	// save to DB
			update_option("dfy_InstaSHOW_user", $_POST['user']);
			update_option("dfy_InstaSHOW_imagescount", $_POST['imagescount']);
			update_option("dfy_InstaSHOW_textsize", $_POST['textsize']);
			update_option("dfy_InstaSHOW_imagesize", $_POST['imagesize']);
			update_option("dfy_InstaSHOW_specialstyle", $_POST['specialstyle']);
	
	// Thank user
			echo '<div class="updated inline below-h2"><p><b>Thank you!</b></p></div>';
				} }	} }
	
	// local var
			$imagescount = get_option("dfy_InstaSHOW_imagescount");	
	
	
	echo'<table width="100%"><tr><td width="550" valign="top"><form method="post">
		
		
		<div style="border: 1px #999 solid; padding: 20px; margin: 20px;"><table>
		<tr><td width="160">Set your <b>Instagram</b> username<br>and password ONCE:<br><br><br><br></td>
			<td><input name="username" type="text" size="30" maxlength="30" value="' . get_option("dfy_InstaSHOW_user") . '"><br>
						<input name="password" type="password" size="30" maxlength="30"><br>
				<small>Just enter your Instagram username and password, <br>which you want to use with this plugin.</small><br></td></tr>
		
		<tr><td></td><td><input type="submit" name="Submit" class="button-primary" value=" Save this username + password! "><br></td></tr></table></div>
		</form><form method="post">
	
	<div style="border: 1px #999 solid; padding: 20px; margin: 20px;"><table><tr><td width="160" valign="top">Number of images:<br><br><br><br><br></td>
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
	<small><u>Warning:</u> Only for advanced users!<br>Enter additional style tags for the <code>&#060;div&#062;</code> tag.</small></label><br><br></td></tr>
	
		<tr><td></td><td><input type="submit" name="Submit" class="button-primary" value=" Save these style settings! "><br><br></td></tr></table></div>
		
		</form></td><td valign="top">
	
		<div style="width: 450px; border: 1px #999 solid; padding: 20px; margin: 20px;">	<h3>Installation</h3>
	<ol style="margin-left: 60px;">
		<li>Upload the folder to the <code>/wp-content/plugins/</code> directory</li>
		<li>Activate the plugin through the <code>\'Plugins\'</code> menu in WordPress</li>
		<li>Select <code>insta.SHOW</code> from the settings menu</li>
		<li>Enter your username, etc.</li>
		<li>Place <code>[instagram]</code> in any post or page.</li>
		<li>Done!</li>
	</ol><br>
	
	Please also <a href="https://flattr.com/thing/156350/instaSHOW" target="_Blank">donate</a> to the author: <a href="http://flattr.com/thing/156350/instaSHOW" target="_blank">
	<img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a></div>
	
	
	
	<div style="width: 450px; border-top: 1px solid #999; border-left: 1px solid #999; padding: 20px; margin: 20px;"><h3>Demo:</h3> ' . dfy_GENERATEinsta_action() . '<br><br><br><br><br></div>
	
		</td></tr></table>';
	
	
	
	echo '';
	
	
	
	
	
	
	
	
	
	
	
	?>