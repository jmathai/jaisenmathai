<?php
  ob_start('ob_gzhandler');
  ini_set('include_path', '.');
  
  if(!empty($_GET['__args__']))
  {
    $content = '';

    $files = (array)explode('|',$_GET['__args__']);
    foreach($files as $file)
    {
      if(file_exists($file) && strstr($file, '..') === false)
      {
        $content .= file_get_contents($file) . "\n";
      }
    }

    header('Content-Type: text/css');
    echo $content;
  }
?>
