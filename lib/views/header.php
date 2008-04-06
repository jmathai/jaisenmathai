<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<head>
  <script>
    __jsInc = [];
    __jsInc.push('prototype.lite.js');
    __jsInc.push('javascript.js');
  </script>
  <?php if(strstr($_SERVER['REQUEST_URI'], '/blog') !== false){ ?>
    <script>
      __jsInc.push('FancyZoom.js');
      __jsInc.push('FancyZoomHTML.js');
    </script>
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
  <?php } ?>
  <link rel="stylesheet" type="text/css" href="/css/compress4.css|styles.css|resume.css|style.css" />
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
  <meta name="description" content="Web developer/engineer.  Proficient with PHP, MySQL, Apache and Linux (LAMP) as well as JavaScript, dHTML, AJAX and JSON." />
  <meta name="keywords" content="Jaisen, Mathai, Jaisen Mathai, jmathai.com, Portfolio, Resume, PHP Developer, PHP, AJAX, JSON, MySQL, Linux, JavaScript, dHTML, LAMP, Frameworks, Mashups, Facebook, Amazon, Google, APIs" />
</head>

<body>
  <div id="header-banner"></div>
  <div id="header">
    <ul>
      <li><a href="/" title="Go Home" rel="me" id="nav-home" <?php if($_SERVER['REQUEST_URI'] == '/'){ ?>class="on"<?php } ?>>Home</a></li>
      <li><a href="/resume" title="View My Resume" id="nav-resume" <?php if(strstr($_SERVER['REQUEST_URI'], '/resume')){ ?>class="on"<?php } ?>>Resume</a></li>
      <li><a href="/portfolio" title="View My Portfolio" id="nav-portfolio" <?php if($_SERVER['REQUEST_URI'] == '/portfolio'){ ?>class="on"<?php } ?>>Portfolio</a></li>
      <li><a href="/code" title="View My Work" id="nav-code" <?php if(strstr($_SERVER['REQUEST_URI'], '/code')){ ?>class="on"<?php } ?>>Code</a></li>
      <li><a href="/blog" title="View My Blog" id="nav-blog" <?php if(strstr($_SERVER['REQUEST_URI'], '/blog')){ ?>class="on"<?php } ?>>Blog</a></li>
      <li><a href="/contact" title="View My Contact Information" id="nav-contact" <?php if($_SERVER['REQUEST_URI'] == '/contact'){ ?>class="on"<?php } ?>>Contact</a></li>
    </ul>
  </div>
  <div id="content-top">
    <div id="content-top-left"></div>
    <div id="content-top-middle"></div>
    <div id="content-top-right"></div>
  </div>
  <div id="content">
    <h1><?php echo function_exists('bloginfo') ? bloginfo('name') : $subtitle; ?></h1>
