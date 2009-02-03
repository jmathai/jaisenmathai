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

  function validCacheInclude($parent, $child, $ext)
  {
    $extLen = -1 * (int)strlen($ext);
    //return file_exists($child) && dirname(realpath($parent)) == dirname(realpath($child)) && substr($child, $extLen) == $ext;
    return substr($child, $extLen) == $ext;
  }

  define('CACHE_JS', '/js/compress-aab.js|prototype.lite.js|javascript.js|blog-ptg.js|FancyZoom.js|FancyZoomHTML.js|shCore.js|shBrushCss.js|shBrushJscript.js|shBrushPhp.js|shBrushBash.js');
  function getJs()
  {
    $url = CACHE_JS;
    $hash = md5($url);
    $relativePath = "/js/static/{$hash}.js";
    if(file_exists(PATH_DOC . $relativePath))
      $url = 'http://' . HOST_SCRIPT . $relativePath;

    $retval = '<script type="text/javascript" src="' . $url . '"></script>';
    return $retval;
  }

  define('CACHE_CSS', '/css/compress-aab.css|styles.css|resume.css|style.css|SyntaxHighlighter.css');
  function getCss()
  {
    $url = CACHE_CSS;
    $hash = md5($url);
    $relativePath = "/css/static/{$hash}.css";
    if(file_exists(PATH_DOC . $relativePath))
      $url = 'http://' . HOST_MEDIA . $relativePath;

    $retval = '<style type="text/css"> @import url("' . $url . '"); </style>';
    return $retval;
  }
?>
