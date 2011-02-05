<!DOCTYPE html>
<html>
<head>
  <?php echo getCssMobile(); ?>
  <?php echo getJsMobile(); ?>
  <script src="/js/jquery.mobile.min.js"></script>
  <title><?php echo $title; ?> :: Jaisen Mathai</title>
</head>

<body>
<div data-role="page">
  <div data-role="header">
    <h1 id="logo-text"><a href="/" title="">Hacker::getInstance('Jaisen Mathai', '<?php echo $title; ?>')</a></h1>
    <ul data-role="listview">
      <li><a href="/" title="Go Home" rel="me">Home</a></li>
      <li><a href="/resume.html" title="View My Resume">Resume</a></li>
      <li><a href="/portfolio.html" title="View My Portfolio">Portfolio</a></li>
      <li><a href="/code.html" title="View My Work">Code</a></li>
      <li><a href="/articles.html" title="View My Articles">Articles</a></li>
      <li><a href="/contact.html" title="View My Contact Information">Contact</a></li>
    </ul>    
  </div>

  <div data-role="content">
