<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
  <link rel="alternate" type="application/rss+xml" title="Jaisen's Blog RSS Feed" href="http://feeds.feedburner.com/jaisenmathai" />
  <?php if(strstr($_SERVER['REQUEST_URI'], '/blog') !== false){ ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
  <?php } ?>
  <?php echo getCss(); ?>
  <link rel="shortcut icon"  href="/jm_logo.gif" type="image/x-icon" />
  <title>
  <?php if(!function_exists('bloginfo')){ ?>
    <?php echo $subtitle; ?>
  <?php }else if(is_single()){ ?>
    <?php the_title(); ?>
  <?php }else{ ?>
    <?php echo bloginfo('name'); ?>
  <?php } ?>
   :: Jaisen Mathai</title>
  <?php if(function_exists('is_single') && is_single()) { ?>
    <meta name="og:title" content="<?php the_title(); ?>"/>
    <meta name="og:type" content="article"/>
    <meta name="og:image" content="http://<?php echo $_SERVER['HTTP_HOST']; ?>/jm_logo.gif"/>
    <meta name="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REDIRECT_URL']; ?>"/>
    <meta name="og:site_name" content="Jaisen Mathai's Blog"/>
    <meta name="fb:app_id" content="140052122696614"/>
  <?php } ?>
  <meta name="description" content="Web developer/engineer.  Proficient with PHP, MySQL, Apache and Linux (LAMP) as well as JavaScript, dHTML, AJAX and JSON." />
  <meta name="keywords" content="Jaisen, Mathai, Jaisen Mathai, jmathai.com, Portfolio, Resume, PHP Developer, PHP, AJAX, JSON, MySQL, Linux, JavaScript, dHTML, LAMP, Frameworks, Mashups, Facebook, Amazon, Google, Yahoo, APIs, Yahoo Employee, Yahoo Engineer, Yahoo Resume" />
</head>

<body>
  <div id="header-banner"></div>
  <div id="header">
    <ul>
      <li><a href="/" title="Go Home" rel="me" id="sprite-nav" <?php if($_SERVER['REQUEST_URI'] == '/'){ ?>class="on"<?php } ?>>Home</a></li>
      <li><a href="/resume.html" title="View My Resume" id="sprite-nav" <?php if(strstr($_SERVER['REQUEST_URI'], '/resume')){ ?>class="on"<?php } ?>>Resume</a></li>
      <li><a href="/portfolio.html" title="View My Portfolio" id="sprite-nav" <?php if(strstr($_SERVER['REQUEST_URI'], '/portfolio')){ ?>class="on"<?php } ?>>Portfolio</a></li>
      <li><a href="/code.html" title="View My Work" id="sprite-nav" <?php if(strstr($_SERVER['REQUEST_URI'], '/code')){ ?>class="on"<?php } ?>>Code</a></li>
      <li><a href="/blog/" title="View My Blog" id="sprite-nav" <?php if(strstr($_SERVER['REQUEST_URI'], '/blog')){ ?>class="on"<?php } ?>>Blog</a></li>
      <li><a href="/contact.html" title="View My Contact Information" id="sprite-nav" <?php if(strstr($_SERVER['REQUEST_URI'], '/contact')){ ?>class="on"<?php } ?>>Contact</a></li>
    </ul>
  </div>
  <div id="content-top">
    <div id="content-top-left"></div>
    <div id="content-top-middle"></div>
    <div id="content-top-right"></div>
  </div>
  <div id="content">
    <h1><?php echo function_exists('bloginfo') ? bloginfo('name') : $subtitle; ?></h1>
    <div class="narrowcolumn">
