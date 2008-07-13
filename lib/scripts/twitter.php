<?php
  /*
   * Twitter api interface
   */
  chdir(dirname(__FILE__));
  
  $ch = curl_init();
  // Centos sucks - curl_setopt($ch, CURLOPT_URL, 'http://twitter.com/users/show/jmathai.json');
  curl_setopt($ch, CURLOPT_URL, 'http://twitter.com/users/show/jmathai.xml');
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_USERPWD, 'jmathai:jmathai');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $xmlObj = new SimpleXML(curl_exec($ch));
  curl_close($ch);

  $text = (string)$xmlObj->status->text;
  $date = (string)$xmlObj->status->created_at;

  file_put_contents('../views/twitter.txt', $text . ' <em> at ' . date('h:i \o\n l, M jS', strtotime($date)) . '</em>');
?>
