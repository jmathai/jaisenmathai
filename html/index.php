<?php
  include_once './config.php';
  include_once PATH_LIB . '/EpiCode.php';
  
  
  if(EpiCode::getRoute($_GET['__route__'], $_['routes']) === false)
  {
    echo 'Malformed url??';
  }
?>
