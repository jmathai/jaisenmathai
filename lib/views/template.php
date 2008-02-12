<?php
  include PATH_VIEW . '/header.php';
  
  if(is_file($body))
  {
    //EpiCode::insert($body);
    include $body;
  }
  else
  {
    echo $body;
  }
  
  include PATH_VIEW . '/footer.php';
?>
