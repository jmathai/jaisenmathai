<?php
  ob_start('ob_gzhandler');
  include_once './config.php';
  include_once PATH_LIB . '/EpiCode.php';
  
  if(EpiCode::getRoute($_GET['__route__'], $_['routes']) === false)
  {
    if(isset($_['routes']['error/404']))
    {
      header('Location: /error/404');
    }
    else
    {
      echo 'Malformed url??';
    }
  }
?>
