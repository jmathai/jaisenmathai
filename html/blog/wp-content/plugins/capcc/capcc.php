<?php
/*
Plugin Name: CapCC
Plugin URI: http://fuctweb.com/2007/06/15/capcc/
Description: Adds CAPTCHA functionality to WordPress comments and register forms.
Author: Coice
Version: 1.0
Author URI: http://fuctweb.com/2007/06/15/capcc/
*/
define("CAPCC_VERSION" ,"1.0");

// install our table if needed
function capcc_install()
{
	global $wpdb;
	$table = $wpdb->prefix . "capcc";
	if($wpdb->get_var("SHOW TABLES LIKE '$table'")!=$table)
	{
		// create our table
		$query ="CREATE TABLE $table (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticks` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(32) NOT NULL DEFAULT '',
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `attempts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `hash` (`hash`)
);";

		require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
		dbDelta($query);
		update_option("CAPCC_SECRET",md5(uniqid(time())));
		add_option("CAPCC_VERSION",CAPCC_VERSION);
	}

}
function capcc_validateregister()
{
	global $wpdb,$errors,$user_ID;
	$settings =capcc_loadsettings();
		if($user_ID !="" && $settings['CAPCC_LOGIN_DISABLE']=="1")
		return true;
	$hash = $_POST['capcc_captchakey'];
	$text =$_POST['capcc_captcha'];
	$cap = new capcc_captcha($wpdb->dbh,$wpdb->prefix . "capcc",$settings);
	if ($cap->isValidHash($hash)==true)
	{
		if (strtolower($cap->getSecretKey($hash)) == strtolower($text))
		{
			$cap->setHashUsed($hash);
			return true;
		}
		else
			$errors['error']="<strong>ERROR</strong>: You must enter the correct letters you see.";
	}
	else
		$errors['error']="<strong>ERROR</strong>: The key you are attempting to use has expired.";
}

function capcc_validatecomment()
{
	global $wpdb,$errors,$user_ID;
	$settings =capcc_loadsettings();
	if($user_ID !="" && $settings['CAPCC_LOGIN_DISABLE']=="1")
		return true;
	$hash = $_POST['capcc_captchakey'];
	$text =$_POST['capcc_captcha'];
	$cap = new capcc_captcha($wpdb->dbh,$wpdb->prefix . "capcc",$settings);
	if ($cap->isValidHash($hash)==true)
	{
		if (strtolower($cap->getSecretKey($hash)) == strtolower($text))
		{
			$cap->setHashUsed($hash);
			return true;
		}
	}
	else
		wp_die("The key you are attempting to use has expired.<br />Go back, reload the page and try again.");
	wp_die("You did not enter the correct letters. Please go back and try again.");
	return false;
}

$path =explode("wp-content",__FILE__);
require_once($path[0].'wp-config.php');

function capcc_showform()
{
	global $wpdb,$user_ID;
	$settings=capcc_loadsettings();
	if($user_ID !="" && $settings['CAPCC_LOGIN_DISABLE']=="1")
		return;

	$cap = new capcc_captcha($wpdb->dbh,$wpdb->prefix . "capcc",$settings);
	if(time()>($settings['CAPCC_MAINTENANCE']*3600)+ $settings['CAPCC_LAST_MAINTENANCE'])
	{
		$cap->doMaintenance();
		update_option('CAPCC_LAST_MAINTENANCE',time());
	}

	$path =  $settings['CAPCC_PATH'];
	$key=$cap->generate_captcha();
	echo str_replace("%PATH%",$path,str_replace("%KEY%",$key,stripslashes($settings['CAPCC_FORM'])));
}


	if(isset($_GET['r']))
	{
		$cap = new capcc_captcha($wpdb->dbh,$wpdb->prefix . "capcc",capcc_loadsettings());
		if($cap->isValidHash($_GET['r'])==true)
			$cap->capcc_createimage($_GET['r']);
		else
			wp_die("Expired.");
	}




add_action('admin_menu', 'capcc_config_page');
function capcc_config_page()
{
if (function_exists('add_submenu_page'))
	add_submenu_page('plugins.php', __('CapCC Configuration'), __('CapCC Configuration'), 'manage_options', 'capcc-config', 'capcc_config');
}
function capcc_getoption($name,$default=false)
{
	$option = (string)get_option($name);
	if($option==="")
		return $default;
	return (string)$option;
}
function capcc_loadsettings()
{
	$settings = array();
	$settings['CAPCC_WIDTH']=	capcc_getoption("CAPCC_WIDTH",200);
	$settings['CAPCC_HEIGHT']=	capcc_getoption("CAPCC_HEIGHT",75);
	$settings['CAPCC_LINES']=	capcc_getoption("CAPCC_LINES",150);
	$settings['CAPCC_MODE']=    capcc_getoption("CAPCC_MODE",1);
	$settings['CAPCC_LETTER_COUNT']=    capcc_getoption("CAPCC_LETTER_COUNT",5);
	$settings['CAPCC_MAX_ATTEMPTS']=	capcc_getoption("CAPCC_MAX_ATTEMPTS",5);
	$settings['CAPCC_MAX_ERROR_ALLOWED']=	capcc_getoption("CAPCC_MAX_ERROR_ALLOWED",50);
	$settings['CAPCC_SECRET']=	capcc_getoption("CAPCC_SECRET","Something Secret");
	$settings['CAPCC_COLOR_BG']=	capcc_getoption("CAPCC_COLOR_BG","#FFFFFF");
	$settings['CAPCC_FONTSIZE']=	capcc_getoption("CAPCC_FONTSIZE",22);
	$settings['CAPCC_FONTFILE']=capcc_getoption("CAPCC_FONTFILE","arial.ttf");
	$settings['CAPCC_FORM']=capcc_getoption("CAPCC_FORM",'<p><input type="hidden" name="capcc_captchakey" value="%KEY%"><img src="%PATH%?r=%KEY%" alt="Captcha" /><br><input type="text" name="capcc_captcha"> Enter the letters you see above.</p>');
	$settings['CAPCC_PATH']=capcc_getoption("CAPCC_PATH","/wp-content/plugins/capcc/capcc.php");
	$settings['CAPCC_MAINTENANCE']= capcc_getoption("CAPCC_MAINTENANCE",24);
	$settings['CAPCC_LAST_MAINTENANCE']= capcc_getoption("CAPCC_LAST_MAINTENANCE",0);
	$settings['CAPCC_LOGIN_DISABLE']= capcc_getoption("CAPCC_LOGIN_DISABLE",2);


	return $settings;
}
function capcc_loaddefaults()
{
	$settings = array();
	$settings['CAPCC_WIDTH']=200;
	$settings['CAPCC_HEIGHT']=75;
	$settings['CAPCC_LINES']=150;
	$settings['CAPCC_MODE']=1;
	$settings['CAPCC_LOGIN_DISABLE']=2;
	$settings['CAPCC_LETTER_COUNT']=5;
	$settings['CAPCC_MAX_ATTEMPTS']=5;
	$settings['CAPCC_MAX_ERROR_ALLOWED']=50;
	$settings['CAPCC_SECRET']=capcc_getoption("CAPCC_SECRET","Something Secret");
	$settings['CAPCC_COLOR_BG']="#FFFFFF";
	$settings['CAPCC_FONTSIZE']=22;
	$settings['CAPCC_FONTFILE']="arial.ttf";
	$settings['CAPCC_FORM']='<p><input type="hidden" name="capcc_captchakey" value="%KEY%"><img src="%PATH%?r=%KEY%" alt="Captcha" /><br><input type="text" name="capcc_captcha"> Enter the letters you see above.</p>';
	$settings['CAPCC_PATH']="/wp-content/plugins/capcc/capcc.php";
	$settings['CAPCC_MAINTENANCE']=24;
	$settings['CAPCC_LAST_MAINTENANCE']=0;
	return $settings;
}
function capcc_savesettings($settings)
{
	while(current($settings))
	{
		update_option(key($settings),current($settings));
		next($settings);
	}
}
function capcc_displayfield($val,$settings)
{
	echo "name=\"$val\" value=\"{$settings[$val]}\"";
}
function capcc_config()
{
$settings = capcc_loadsettings();
if (!empty($_POST))
{
	if(preg_match('/restore default.*/i',strtolower($_POST['submit'])))
	{
		$settings=capcc_loaddefaults();
		capcc_savesettings($settings);
		?><div id="message" class="updated fade"><p><strong><?php _e('Default Settings Restored.') ?></strong></p></div><?php
	}
	else
	{

		reset($_POST);
		while(current($_POST))
		{
			if(preg_match('/CAPCC\_[A-Z]+/',key($_POST)))
			{
				if(strlen(trim(current($_POST)))>0)
					$settings[key($_POST)]=trim(current($_POST));
			}
			next($_POST);
		}
		if($_POST['CAPCC_LOGIN_DISABLE']=="1")
			$settings['CAPCC_LOGIN_DISABLE']="1";
		else
			$settings['CAPCC_LOGIN_DISABLE']="2";
		capcc_savesettings($settings);
		?><div id="message" class="updated fade"><p><strong><?php _e('Options Saved.') ?></strong></p></div><?php
	}
}

?>
<style type="text/css">
.capcctext
{
border: 1px black solid;
}
</style>
<div class="wrap">
<h2>CapCC Configuration</h2>
<div class="narrow">
<form action="" method="post" id="capcc-conf" style="width: 400px; ">
<table>
<tr>
<td colspan="2"><label for="CAPCC_MODE1"><input type="radio" id="CAPCC_MODE1" name="CAPCC_MODE" value="1"<?php if($settings['CAPCC_MODE']==1)echo' checked="checked"';?>> Display captcha in both comment and registration forms.</label></td>
</tr>
<tr>
<td colspan="2"><label for="CAPCC_MODE2"><input type="radio" id="CAPCC_MODE2" name="CAPCC_MODE" value="2"<?php if($settings['CAPCC_MODE']==2)echo' checked="checked"';?>> Display captcha only in comment form.</label></td>
</tr>
<tr>
<td colspan="2"><label for="CAPCC_MODE3"><input type="radio" id="CAPCC_MODE3" name="CAPCC_MODE" value="3"<?php if($settings['CAPCC_MODE']==3)echo' checked="checked"';?>> Display captcha only in registration form.</label></td>
</tr>

<tr>
<td colspan="2"><br /><label for="CAPCC_LOGIN_DISABLE"><input type="checkbox" id="CAPCC_LOGIN_DISABLE" name="CAPCC_LOGIN_DISABLE" value="1"<?php if($settings['CAPCC_LOGIN_DISABLE']=="1")echo' checked="checked"';?>> Disable captcha if logged in.</label></td>
</tr>
<tr>
<td colspan="2">
<hr />
</td>
</tr>
<tr>
<td>Secret Text:</td><td align="right"><input type="text" size="22" style="capcctext"<?php echo capcc_displayfield('CAPCC_SECRET',$settings)?>></td>
</tr>

<tr>
<td>Letter Amount:</td><td align="right"><input type="text" size="5" style="capcctext"<?php echo capcc_displayfield('CAPCC_LETTER_COUNT',$settings)?>></td>
</tr>

<tr>
<td>Aprox. Font Size:</td><td align="right"><input type="text" size="5" style="capcctext"<?php echo capcc_displayfield('CAPCC_FONTSIZE',$settings)?>></td>
</tr>

<tr>
<td>Max Lines:</td><td align="right"><input type="text" size="5" style="capcctext"<?php echo capcc_displayfield('CAPCC_LINES',$settings)?>></td>
</tr>

<tr>
<td>Background Color:</td><td align="right"><input type="text" size="8" style="capcctext"<?php echo capcc_displayfield('CAPCC_COLOR_BG',$settings)?>></td>
</tr>

<tr>
<td>Image Width:</td><td align="right"><input type="text" size="5" style="capcctext"<?php echo capcc_displayfield('CAPCC_WIDTH',$settings)?>></td>
</tr>

<tr>
<td>Image Height:</td><td align="right"><input type="text" size="5" style="capcctext"<?php echo capcc_displayfield('CAPCC_HEIGHT',$settings)?>></td>
</tr>

<tr>
<td>Font Filename:</td><td align="right"><input type="text" style="capcctext"<?php echo capcc_displayfield('CAPCC_FONTFILE',$settings)?>></td>
</tr>

<tr>
<td>Maximum Attempts:</td><td align="right"><input type="text" size="5" style="capcctext"<?php echo capcc_displayfield('CAPCC_MAX_ATTEMPTS',$settings)?>></td>
</tr>




<tr>
<td>Max Key Creation Attempts:</td><td align="right"><input type="text" size="5" style="capcctext"<?php echo capcc_displayfield('CAPCC_MAX_ERROR_ALLOWED',$settings)?>></td>
</tr>

<tr>
<td>File Path:</td><td align="right"><input type="text" size="25" style="capcctext"<?php echo capcc_displayfield('CAPCC_PATH',$settings)?>></td>
</tr>


<tr>
<td>Maintenance (Hours):</td><td align="right"><input type="text" style="capcctext"<?php echo capcc_displayfield('CAPCC_MAINTENANCE',$settings)?>></td>
</tr>


<tr>
<td colspan="2">Display Form (use %PATH% and %KEY% as variables):</td>
</tr>
<tr>
<td colspan="2"><textarea style="capcctext" cols="50" rows="5" name="CAPCC_FORM"><?php echo htmlentities(stripslashes($settings['CAPCC_FORM']));?></textarea></td>
</tr>
</table>
	<p class="submit"><input type="submit" name="submit" value="<?php _e('Restore Defaults &raquo;'); ?>" />&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="<?php _e('Update Options &raquo;'); ?>" /></p>
</form>
</div>
</div>
<?php
}
class capcc_captcha
{
	var $m_db;
	var $m_table;
	function capcc_captcha($db,$table,$settings)
	{
		$this->m_db=$db;
		$this->m_table=$table;
		while(current($settings))
		{
			if(!defined(key($settings)))
				define(key($settings),current($settings));
			next($settings);
		}
	}
	function doMaintenance()
	{
		$q="DELETE FROM $this->m_table WHERE `ticks`<".(time()- (CAPCC_MAINTENANCE* 3600));
		mysql_query($q,$this->m_db);
	}
	function generate_captcha($MAX_ERROR=1)
	{
	  $hash=$this->createHash(mt_rand(25,32));
	  $q="INSERT INTO $this->m_table (`ticks`,`hash`,`used`) VALUES ('". time()."','$hash',0)";
	  if (mysql_query($q,$this->m_db)===false)
	  {
		//failed to insert for whatever reason
		$MAX_ERROR++;
		if ($MAX_ERROR>CAPCC_MAX_ERROR_ALLOWED)
			return false;
		else
		  return $this->generate_captcha($MAX_ERROR);
	  }
	  else
		return $hash;
	}

	function getSecretKey($hash)
	{
	  $secret =CAPCC_SECRET;
	  $hash=md5($secret . $hash);
	  $key="";
	  $pass=substr($hash,0,(CAPCC_LETTER_COUNT*2));
	  for ($x=0;$x<CAPCC_LETTER_COUNT;$x++)
	  {
		$var=substr($pass,$x*2,2);
		$txt="abcdefghijklmnopqrstuvwxyz";
		$ct=fmod(hexdec($var),26);
		$key.=substr($txt,$ct,1);
	  }
	  return $key;
	}

	function setHashUsed($hash)
	{
	  $hash=  mysql_real_escape_string($hash);
	  $q = "UPDATE $this->m_table SET `used`=1 WHERE `hash`='$hash'";
	  mysql_query($q,$this->m_db);
	}

	function createHash($MAX_LEN)
	{
	  $acceptedChars = 'azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789';
	  $max = strlen($acceptedChars)-1;
	  $password = "";
	  for($i=0; $i < $MAX_LEN; $i++)
		 $password .= $acceptedChars{mt_rand(0, $max)};
	  return $password;
	}


	function isValidHash($hash)
	{
	  $q="SELECT * FROM $this->m_table WHERE `hash`='$hash' AND `used`=0 AND `attempts`<". CAPCC_MAX_ATTEMPTS;
	  $res=mysql_query($q,$this->m_db);
	  $row=mysql_fetch_assoc($res);
	  if($row['id']>0)
	  {
		$q="UPDATE $this->m_table SET `attempts`=`attempts`+1 WHERE `id`=". $row['id'];
		mysql_query($q,$this->m_db);
		return true;
	  }
	  else
		return false;
	}


	function getRGB($hex)
	{
		$hex= trim($hex,"#");
		$rgb = array('red'=>0,'green'=>0,'blue'=>0);
		$rgb['red']=hexdec($hex[0].$hex[1]);
		$rgb['green']=hexdec($hex[2].$hex[3]);
		$rgb['blue']=hexdec($hex[4].$hex[5]);
		return $rgb;
	}
	function capcc_createimage($r)
	{
		if($r==false)
			die("Error");
		header("Expires: Mon, 1 Jan 2000 01:23:45 GMT");
		header("Pragma: no-cache");
		header("Cache-Control: no-cache, no-store, must-revalidate, pre-check=0, post-check=0");

		$img = imagecreatetruecolor(CAPCC_WIDTH,CAPCC_HEIGHT);
		$CAP_BG = $this->getRGB(CAPCC_COLOR_BG);
		$bgcolor = imagecolorallocate($img,$CAP_BG['red'],$CAP_BG['green'],$CAP_BG['blue']);

		imagefilledrectangle($img,0,0,CAPCC_WIDTH,CAPCC_HEIGHT,$bgcolor);

		$color = imagecolorallocate($img,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
		$black = imagecolorallocate ($img, 0,0,0);

		$text = $this->getSecretKey($r);

		$font = CAPCC_FONTFILE;

		for($i=0;$i<CAPCC_LINES;$i++)
		{
			$line1x = mt_rand(0,CAPCC_WIDTH);
			$line2x = mt_rand(0,CAPCC_WIDTH);
			$line1y = mt_rand(0,CAPCC_HEIGHT);
			$line2y = mt_rand(0,CAPCC_HEIGHT);

			$tempcolor = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(100,255));
			imageline($img,$line1x,$line1y,$line2x,$line2y,$tempcolor);
		}


		$font_abstracta = mt_rand(CAPCC_FONTSIZE*1.4,CAPCC_FONTSIZE*2);
		$font_abstractb = mt_rand(CAPCC_FONTSIZE*1.4,CAPCC_FONTSIZE*2);
		$font_size = mt_rand((int)(CAPCC_FONTSIZE*0.90),(int)(CAPCC_FONTSIZE*1.10));
		for($i = 0; $i<strlen($text);$i++)
		{
			imagecolordeallocate($img,$bgcolor);
			imagecolordeallocate($img,$color);

			$bgcolor= imagecolorallocate($img,$CAP_BG['red'],$CAP_BG['green'],$CAP_BG['blue']);
			$color = imagecolorallocate($img,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));

			$font_line = mt_rand(-7,7);
			$font_angle = mt_rand(-30,30);

			if(mt_rand(1,3)==2)
				$text[$i]=strtoupper($text[$i]);

			if($text[$i]=="l")
				$text[$i]="L";

			if($text[$i]=="I")
				$text[$i]="i";

			imagettftext($img,$font_size,$font_angle,$font_abstracta +2 + ($i*CAPCC_FONTSIZE),$font_abstractb + 2 + $font_line,$bgcolor,$font,$text[$i]);
			imagettftext($img,$font_size,$font_angle,$font_abstracta + ($i*CAPCC_FONTSIZE),$font_abstractb + 2 + $font_line,$color,$font,$text[$i]);
		}

		for ($i=0;$i<(CAPCC_LINES/15);$i++)
		{
			$line1x = mt_rand(0,CAPCC_WIDTH);
			$line2x = mt_rand(0,CAPCC_WIDTH);
			$line1y = mt_rand(0,CAPCC_HEIGHT);
			$line2y = mt_rand(0,CAPCC_HEIGHT);

			$tempcolor = imagecolorallocate($img,mt_rand(100,255),mt_rand(100,255),mt_rand(100,255));
			imageline($img,$line1x,$line1y,$line2x,$line2y,$tempcolor);
		}
		$this->spitImage($img);
		imagedestroy($img);
	}
	function spitImage($img)
	{
		if(function_exists('imagepng'))
		{
			header("Content-Type: image/png");
			imagepng($img);
		}
		elseif(function_exists('imagegif'))
		{
			header("Content-Type: image/gif");
			imagegif($img);
		}
		elseif(function_exists('imagejpeg'))
		{
			header("Content-Type: image/jpeg");
			imagejpeg($img);
		}
		else
		{
			die(); // no image support
		}
	}
}

if(function_exists('add_action'))
{
	$capcc_settings= capcc_loadsettings();
	add_action('activate_capcc/capcc.php', 'capcc_install');
	switch($capcc_settings['CAPCC_MODE'])
	{
		case "1":
			add_action('register_form','capcc_showform');
			add_action('register_post','capcc_validateregister');
			add_action('comment_form','capcc_showform');
			add_action('pre_comment_approved','capcc_validatecomment');
		break;
		case "2":
			add_action('comment_form','capcc_showform');
			add_action('pre_comment_approved','capcc_validatecomment');
		break;
		case "3":
			add_action('register_form','capcc_showform');
			add_action('register_post','capcc_validateregister');
		break;
	}
}

?>
