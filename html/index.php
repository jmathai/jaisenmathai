<?php
  include_once './config.php';
  include_once PATH_LIB . '/scripts/auto_prepend.php';
  include_once PATH_CLASS . '/EpiCode.php';
  include_once PATH_CLASS . '/CSite.php';
  include_once PATH_CLASS . '/Mustache.php';
  include_once PATH_CLASS . '/Mobile_Detect.php';
  $route = isset($_GET['__route__']) ? $_GET['__route__'] : '';
  if(EpiCode::getRoute($route, $_['routes']) === false)
  {
    if(isset($_['routes']['error/404']))
    {
      header('Location: /error/404');
    }
    else
    {
      echo 'Malformed url?';
    }
  }
?>
