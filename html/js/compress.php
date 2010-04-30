<?php
  header('Content-Type: text/javascript');
  ini_set('include_path', '.');
  require '../../lib/config.php';
  require '../../lib/scripts/jsmin.php';
  
  if(!empty($_GET['__args__']))
  {
    $hash = md5($_SERVER['REQUEST_URI']);

    $files = (array)explode('|',$_GET['__args__']);
    $baseDir = dirname(__FILE__);
    foreach($files as $file)
    {
      $fullPath = $baseDir . '/' . $file;
      if(file_exists($fullPath) && validCacheInclude(__FILE__, $fullPath, '.js'))
      {
        $cache .= JSMin::minify(file_get_contents($fullPath)) . "\n";
      }
    }

    file_put_contents(PATH_DOC . "/js/static/{$hash}.js", "/* Cache of {$_SERVER['REQUEST_URI']} */\n{$cache}");
    echo $cache;
  }
?>
