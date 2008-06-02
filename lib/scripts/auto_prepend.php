<?php
  $memcache = null;
  function getMemcache()
  {
    global $memcache;
    if($memcache === null)
    {
      $memcache = new Memcache();
      $memcache->connect('localhost');
    }

    return $memcache;
  }
?>
