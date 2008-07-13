<?php
  header('Content-Type: text/css');
  ini_set('include_path', '.');
  require '../../lib/scripts/cssmin.php';
  
  if(!empty($_GET['__args__']))
  {
    if($cache = getMemcache()->get($_GET['__args__']))
    {
      echo '/* Memcached */';
      echo $cache;
      return;
    }

    $files = (array)explode('|',$_GET['__args__']);
    foreach($files as $file)
    {
      if(file_exists(dirname($_SERVER['SCRIPT_FILENAME']) . '/' . $file) && strstr($file, '..') === false)
      {
        $tmp = new CSSMin(file_get_contents($file)) . "\n";
        $cache .= $tmp->getCss();
      }
    }

    getMemcache()->set($_GET['__args__'], $cache, MEMCACHE_COMPRESSED, 0);
    echo $cache;
  }
?>
