<?php
  ob_start('ob_gzhandler');
  ini_set('include_path', '.');
  header('Content-Type: text/javascript');
  
  if(!empty($_GET['__args__']))
  {
    $files = (array)explode('|',$_GET['__args__']);
    foreach($files as $file)
    {
      if(file_exists(dirname($_SERVER['SCRIPT_FILENAME']) . '/' . $file) && strstr($file, '..') === false)
      {
        readfile($file);
        echo "\n";
      }
    }
  }
?>
