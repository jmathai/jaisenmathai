<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<head>
  <style type="text/css">
    @import url("/css/styles.css?1");
    @import url("/css/resume.css?1");
  </style>
  <title></title>
</head>

<body>
  <div id="header">
    <h1><?php echo $title; ?></h1>
    <a href="/">
      <img src="/images/tab_home.jpeg" width="102" height="46" border="0" />    
    </a>
    <a href="/resume">
      <img src="/images/tab_resume.jpeg" width="102" height="46" border="0" />    
    </a>
    <a href="/portfolio">
      <img src="/images/tab_portfolio.jpeg" width="102" height="46" border="0" />    
    </a>
    <a href="/contact">
      <img src="/images/tab_contact.jpeg" width="102" height="46" border="0" />    
    </a>
  </div>
  <div id="content-top"><img src="/images/content-top.gif"></div>
  <div id="content">
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
</body>

</html>
