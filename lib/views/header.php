<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<head>
  <script>
    __jsInc = [];
    __jsInc.push('prototype.lite.js');
    __jsInc.push('javascript.js');
    __jsInc.push('blog-ptg.js');
    __jsInc.push('FancyZoom.js');
    __jsInc.push('FancyZoomHTML.js');
  </script>
  <?php if(strstr($_SERVER['REQUEST_URI'], '/blog') !== false){ ?>
    <script>
      __jsInc.push('shCore.js');
      __jsInc.push('shBrushCss.js');
      __jsInc.push('shBrushJScript.js');
      __jsInc.push('shBrushPhp.js');
    </script>
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
  <?php } ?>
  <link rel="stylesheet" type="text/css" href="/css/compress5.css|styles.css|resume.css|style.css|SyntaxHighlighter.css" />
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
  <meta name="keywords" content="Jaisen, Mathai, Jaisen Mathai, jmathai.com, Portfolio, Resume, PHP Developer, PHP, AJAX, JSON, MySQL, Linux, JavaScript, dHTML, LAMP, Frameworks, Mashups, Facebook, Amazon, Google, Yahoo, APIs, Yahoo Employee, Yahoo Engineer, Yahoo Resume" />
</head>

<body>
  <div id="header-banner"></div>
  <div id="header">
    <ul>
      <li><a href="/" title="Go Home" rel="me" id="sprite-nav" <?php if($_SERVER['REQUEST_URI'] == '/'){ ?>class="on"<?php } ?>>Home</a></li>
      <li><a href="/resume.html" title="View My Resume" id="sprite-nav" <?php if(strstr($_SERVER['REQUEST_URI'], '/resume')){ ?>class="on"<?php } ?>>Resume</a></li>
      <li><a href="/portfolio.html" title="View My Portfolio" id="sprite-nav" <?php if($_SERVER['REQUEST_URI'] == '/portfolio'){ ?>class="on"<?php } ?>>Portfolio</a></li>
      <li><a href="/code.html" title="View My Work" id="sprite-nav" <?php if($_SERVER['REQUEST_URI'] == '/code'){ ?>class="on"<?php } ?>>Code</a></li>
      <li><a href="/blog/" title="View My Blog" id="sprite-nav" <?php if(strstr($_SERVER['REQUEST_URI'], '/blog')){ ?>class="on"<?php } ?>>Blog</a></li>
      <li><a href="/contact.html" title="View My Contact Information" id="sprite-nav" <?php if($_SERVER['REQUEST_URI'] == '/contact'){ ?>class="on"<?php } ?>>Contact</a></li>
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
