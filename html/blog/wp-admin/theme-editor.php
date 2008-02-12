<?php
require_once('admin.php');

$title = __("Edit Themes");
$parent_file = 'themes.php';

wp_reset_vars(array('action', 'redirect', 'profile', 'error', 'warning', 'a', 'file', 'theme'));

$themes = get_themes();

if (empty($theme)) {
	$theme = get_current_theme();
} else {
	$theme = stripslashes($theme);
 }


if ( ! isset($themes[$theme]) )
	wp_die(__('The requested theme does not exist.'));

$allowed_files = array_merge($themes[$theme]['Stylesheet Files'], $themes[$theme]['Template Files']);

if (empty($file)) {
	$file = $allowed_files[0];
}

$file = validate_file_to_edit($file, $allowed_files);
$real_file = get_real_file_to_edit($file);

$file_show = basename( $file );

switch($action) {

case 'update':

	check_admin_referer('edit-theme_' . $file . $theme);

	if ( !current_user_can('edit_themes') )
		wp_die('<p>'.__('You do not have sufficient permissions to edit templates for this blog.').'</p>');

	$newcontent = stripslashes($_POST['newcontent']);
	$theme = urlencode($theme);
	if (is_writeable($real_file)) {
		$f = fopen($real_file, 'w+');
		fwrite($f, $newcontent);
		fclose($f);
		$location = "theme-editor.php?file=$file&theme=$theme&a=te";
	} else {
		$location = "theme-editor.php?file=$file&theme=$theme";
	}

	$location = wp_kses_no_null($location);
	$strip = array('%0d', '%0a');
	$location = str_replace($strip, '', $location);
	header("Location: $location");
	exit();

break;

default:

	if ( !current_user_can('edit_themes') )
		wp_die('<p>'.__('You do not have sufficient permissions to edit themes for this blog.').'</p>');

	require_once('admin-header.php');

	update_recently_edited($file);

	if (!is_file($real_file))
		$error = 1;

	if (!$error && filesize($real_file) > 0) {
		$f = fopen($real_file, 'r');
		$content = fread($f, filesize($real_file));
		$content = htmlspecialchars($content);
	}

	?>
<?php if (isset($_GET['a'])) : ?>
 <div id="message" class="updated fade"><p><?php _e('File edited successfully.') ?></p></div>
<?php endif; ?>
 <div class="wrap">
	<form name="theme" action="theme-editor.php" method="post">
		<?php _e('Select theme to edit:') ?>
		<select name="theme" id="theme">
	<?php
		foreach ($themes as $a_theme) {
		$theme_name = $a_theme['Name'];
		if ($theme_name == $theme) $selected = " selected='selected'";
		else $selected = '';
		$theme_name = attribute_escape($theme_name);
		echo "\n\t<option value=\"$theme_name\" $selected>$theme_name</option>";
	}
?>
 </select>
 <input type="submit" name="Submit" value="<?php _e('Select &raquo;') ?>" class="button" />
 </form>
 </div>

 <div class="wrap">
  <?php
	if ( is_writeable($real_file) ) {
		echo '<h2>' . sprintf(__('Editing <code>%s</code>'), $file_show) . '</h2>';
	} else {
		echo '<h2>' . sprintf(__('Browsing <code>%s</code>'), $file_show) . '</h2>';
	}
	?>
	<div id="templateside">
	<h3><?php printf(__("<strong>'%s'</strong> theme files"), $theme) ?></h3>

<?php
if ($allowed_files) :
?>
	<ul>
<?php foreach($allowed_files as $allowed_file) : ?>
		 <li><a href="theme-editor.php?file=<?php echo "$allowed_file"; ?>&amp;theme=<?php echo urlencode($theme) ?>"><?php echo get_file_description($allowed_file); ?></a></li>
<?php endforeach; ?>
	</ul>
<?php endif; ?>
</div>
	<?php
	if (!$error) {
	?>
	<form name="template" id="template" action="theme-editor.php" method="post">
	<?php wp_nonce_field('edit-theme_' . $file . $theme) ?>
		 <div><textarea cols="70" rows="25" name="newcontent" id="newcontent" tabindex="1"><?php echo $content ?></textarea>
		 <input type="hidden" name="action" value="update" />
		 <input type="hidden" name="file" value="<?php echo $file ?>" />
		 <input type="hidden" name="theme" value="<?php echo $theme ?>" />
		 </div>
<?php if ( is_writeable($real_file) ) : ?>
	<p class="submit">
<?php
	echo "<input type='submit' name='submit' value='	" . __('Update File &raquo;') . "' tabindex='2' />";
?>
</p>
<?php else : ?>
<p><em><?php _e('If this file were writable you could edit it.'); ?></em></p>
<?php endif; ?>
	</form>
	<?php
	} else {
		echo '<div class="error"><p>' . __('Oops, no such file exists! Double check the name and try again, merci.') . '</p></div>';
	}
	?>
<div class="clear"> &nbsp; </div>
</div>
<?php
break;
}

include("admin-footer.php") ?>
