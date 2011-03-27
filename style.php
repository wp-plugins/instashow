<?php 
	
	$textsize = get_option("dfy_InstaSHOW_textsize");
	$imagesize = get_option("dfy_InstaSHOW_imagesize");
	$special = get_option("dfy_InstaSHOW_specialstyle");
	
?>

<style type="text/css">
.insta_container { 
	width:<?php echo($imagesize); ?>px;
	height:<?php echo($imagesize+($imagesize/2)); ?>px;
	overflow:hidden; 
	position:relative; 
	cursor:pointer;
	margin-left:45px;
}

.insta_slides {
	position:absolute; 
	top:0; 
	left:0; 
	width:<?php echo($imagesize); ?>px;
	height:<?php echo($imagesize); ?>px;
}

.insta_slides > div { 
	position:absolute; 
	top:27px;
	width:<?php echo($imagesize+10); ?>px;
	display:none;
}

#insta_loopedSlider { 
	margin:0 auto; 
	width:<?php echo($imagesize+90); ?>px;
	height:<?php echo($imagesize); ?>px;
	position:relative; 
	clear:both; 
}

#insta_wrap { 
	margin:0 auto; 
	width:<?php echo($imagesize+90); ?>px;
	height:<?php echo($imagesize); ?>px;
	position:relative; 
	clear:both; 
	top: -<?php echo(($imagesize/5)-40); ?>px;
}

.instaprevious {
	background-image:url(<?php echo(plugins_url('/instashow/prev.png', dirname(__FILE__))); ?>);
	height:40px;
	width:40px;
	display: block;
	z-index: 99;
	text-indent: -9999px;
	float:left;
	position: relative;
	top: <?php echo(($imagesize/4)+50); ?>px;
}

.instaprevious:hover {
	background-image:url(<?php echo(plugins_url('/instashow/prev.png', dirname(__FILE__))); ?>);
	background-position: 0 -40px;
}

a.instanext {
	background-image:url(<?php echo(plugins_url('/instashow/next.png', dirname(__FILE__))); ?>);
	height:40px;
	width:40px;
	z-index: 99;
	display: block;
	text-indent: -9999px;
	float: right;
	position: relative;
	top: <?php echo(($imagesize/4)+50); ?>px;
}

a.instanext:hover {
	background-image:url(<?php echo(plugins_url('/instashow/next.png', dirname(__FILE__))); ?>);
	background-position: 0 -40px;
}

insta_caption {
	font-size: <?php echo $textsize; ?>;
}
</style>