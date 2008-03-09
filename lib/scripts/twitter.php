<?php
  /*
   * Twitter api interface
   */
  chdir(dirname(__FILE__));
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'http://twitter.com/users/show/jmathai.json');
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_USERPWD, 'jmathai:jmathai');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $twitterStatus = json_decode(curl_exec($ch), true);
  curl_close($ch);

  file_put_contents('../views/twitter.txt', $twitterStatus['status']['text'] . ' <em> at ' . date('h:i \o\n l, M jS', strtotime($twitterStatus['status']['created_at'])) . '</em>');
?>
