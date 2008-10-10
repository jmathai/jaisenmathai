<?php
  $memcache = null;
  function getMemcache()
  {
    global $memcache;
    if($memcache === null)
    {
      $memcache = new Memcache();
      $memcache->connect('localhost', 11211);
    }

    return $memcache;
  }

  define('CACHE_JS', '/js/compress-aaa.js|prototype.lite.js|javascript.js|blog-ptg.js|FancyZoom.js|FancyZoomHTML.js|shCore.js|shBrushCss.js|shBrushJscript.js|shBrushPhp.js|shBrushBash.js');
  function getJs()
  {
    $url = CACHE_JS;
    $hash = md5($url);
    $relativePath = "/js/static/{$hash}.js";
    if(file_exists(PATH_DOC . $relativePath))
      $url = $relativePath;

    $retval = '<script type="text/javascript" src="' . $url . '"></script>';
    return $retval;
  }

  define('CACHE_CSS', '/css/compress-aaa.css|styles.css|resume.css|style.css|SyntaxHighlighter.css');
  function getCss()
  {
    $url = CACHE_CSS;
    $hash = md5($url);
    $relativePath = "/css/static/{$hash}.css";
    if(file_exists(PATH_DOC . $relativePath))
      $url = $relativePath;

    $retval = '<style type="text/css"> @import url("' . $url . '"); </style>';
    return $retval;
  }
?>
