<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<head>
  <style type="text/css">
    @import url("/css/styles.css?1");
    @import url("/css/resume.css?1");
  </style>
  <link rel="shortcut icon"  href="/jm_logo.gif" type="image/x-icon" />
  <title><?php echo $subtitle; ?> :: Jaisen Mathai</title>
  <meta name="description" content="Web developer/engineer.  Proficient with PHP, MySQL, Apache and Linux (LAMP) as well as JavaScript, dHTML, AJAX and JSON." />
  <meta name="keywords" content="Jaisen, Mathai, Jaisen Mathai, jmathai.com, Portfolio, Resume, PHP Developer, PHP, AJAX, JSON, MySQL, Linux, JavaScript, dHTML, LAMP, Frameworks, Mashups, Facebook, Amazon, Google, APIs" />
</head>

<body>
  <div id="header">
    <h1><?php echo $title; ?></h1>
    <a href="/" title="Go Home">
      <img src="/images/tab_home.jpeg" width="102" height="46" border="0" />    
    </a>
    <a href="/resume" title="View My Resume">
      <img src="/images/tab_resume.jpeg" width="102" height="46" border="0" />    
    </a>
    <a href="/portfolio" title="View My Portfolio">
      <img src="/images/tab_portfolio.jpeg" width="102" height="46" border="0" />    
    </a>
    <a href="/contact" title="View My Contact Information">
      <img src="/images/tab_contact.jpeg" width="102" height="46" border="0" />    
    </a>
  </div>
  <div id="content-top"><img src="/images/content-top.gif"></div>
  <div id="content">
    <h2><?php echo $subtitle; ?></h2>
    <?php
      if(is_file($body))
      {
        //EpiCode::insert($body);
        include $body;
      }
      else
      {
        echo $body;
      }
    ?>
  </div>
  <div id="content-top"><img src="/images/content-bottom.gif"></div>
  
  <div id="footer">
    <a href="/home">home</a> / 
    <a href="/resume">resume</a> / 
    <a href="/portfolio">portfolio</a> / 
    <a href="/contact">contact</a>
  </div>
  
  <div id="seo">
    About this site:
    <br/>
    This is my (Jaisen Mathai) personal site for potential employers who want to see my resume or portfolio.  
    My ideal job would be to work as a <strong>PHP developer</strong> on a large scale consumer website.  
    My experience is in using <strong>PHP</strong>, <strong>MySQL</strong>, <strong>Ajax</strong> and <strong>JSON</strong>.  
    I really enjoy creative brainstorming...taking a problem apart and narrowing 100 solutions down to the best one.
    <br/><br/>
    Thanks for stopping by.  Be sure to <a href="/contact">drop me a line</a>.
  </div>
  
  <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
  </script>
  <script type="text/javascript">
    _uacct = "UA-88708-4";
    urchinTracker();
  </script>
</body>

</html>
