<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<head>
  <style type="text/css">
    @import url("/css/styles.css?1");
    @import url("/css/resume.css?1");
  </style>
  
  <?php if(strstr($_SERVER['REQUEST_URI'], '/blog') !== false){ ?>
    <style type="text/css">
      @import url("/blog/wp-content/themes/default/style.css?1");
    </style>
    <script type="text/javascript" src="/js/prototype.lite.js"></script>
    <script type="text/javascript" id="__PTG" src="http://www.photagious.com/js/api.js"></script>
    <script src="/js/FancyZoom.js" type="text/javascript"></script>
    <script src="/js/FancyZoomHTML.js" type="text/javascript"></script>
  <?php } ?>
  
  <link rel="shortcut icon"  href="/jm_logo.gif" type="image/x-icon" />
  <title><?php echo function_exists('bloginfo') ? bloginfo('name') : $subtitle; ?> :: Jaisen Mathai</title>
  <meta name="description" content="Web developer/engineer.  Proficient with PHP, MySQL, Apache and Linux (LAMP) as well as JavaScript, dHTML, AJAX and JSON." />
  <meta name="keywords" content="Jaisen, Mathai, Jaisen Mathai, jmathai.com, Portfolio, Resume, PHP Developer, PHP, AJAX, JSON, MySQL, Linux, JavaScript, dHTML, LAMP, Frameworks, Mashups, Facebook, Amazon, Google, APIs" />
</head>

<body>
  <div id="header-banner"></div>
  <div id="header">
    <a href="/" title="Go Home">
      <img src="/images/tab_home.jpeg" width="102" height="46" border="0" />    
    </a>
    <a href="/resume" title="View My Resume">
      <img src="/images/tab_resume.jpeg" width="102" height="46" border="0" />    
    </a>
    <a href="/portfolio" title="View My Portfolio">
      <img src="/images/tab_portfolio.jpeg" width="102" height="46" border="0" />    
    </a>
    <a href="/code" title="View My Work">
      <img src="/images/tab_code.jpeg" width="102" height="46" border="0" />    
    </a>
    <a href="/blog" title="View My Blog">
      <img src="/images/tab_blog.jpeg" width="102" height="46" border="0" />    
    </a>
    <a href="/contact" title="View My Contact Information">
      <img src="/images/tab_contact.jpeg" width="102" height="46" border="0" />    
    </a>
  </div>
  <div id="content-top"><img src="/images/content-top.gif"></div>
  <div id="content">
    <h2><?php echo function_exists('bloginfo') ? bloginfo('name') : $subtitle; ?></h2>
