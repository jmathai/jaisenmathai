<?php
ob_start('ob_gzhandler');
/* Short and sweet */
define('WP_USE_THEMES', true);
$subtitle = '';
require('./wp-blog-header.php');
?>
