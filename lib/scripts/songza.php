<?php
  /*
   * Songza api interface
   */
  chdir(dirname(__FILE__));
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'http://api.songza.com/1.0/feed/jmathai.json');
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($ch);
  curl_close($ch);
  $arr  = json_decode($json, 1);
  $out = array();
  foreach($arr['songs'] as $count => $song){
    $out[] = $song;
    if($count == 5)
      break;
  }
  $json = json_encode($out);

  file_put_contents('../views/songza.json', $json);
?>
