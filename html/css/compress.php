<?php
  header('Content-Type: text/css');
  ini_set('include_path', '.');
  ini_set('open_basedir', dirname(__FILE__));
  require '../../lib/config.php';
  require '../../lib/scripts/cssmin.php';

  if(!empty($_GET['__args__']))
  {
    $hash = md5($_SERVER['REQUEST_URI']);

    $files = (array)explode('|',$_GET['__args__']);
    foreach($files as $file)
    {
      $validDir = dirname($_SERVER['SCRIPT_FILENAME']);
      if(file_exists($fullPath = $validDir . '/' . $file) && strpos(dirname($fullPath), $validDir) === 0)
      {
        $tmp = new CSSMin(file_get_contents($file));
        $cache .= $tmp->getCss() . "\n";
      }
    }

    file_put_contents(PATH_DOC . "/css/static/{$hash}.css", "/* Cache of {$_SERVER['REQUEST_URI']} */\n{$cache}");
    echo $cache;
  }
?>
