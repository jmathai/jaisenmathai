<?php
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';
include 'header.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);

echo '<h1>An example of using "Sign in with Twitter" with OAuth</h1>
<p><a href="' . $twitterObj->getAuthenticateUrl() . '"><img src="http://apiwiki.twitter.com/f/1240335298/Sign-in-with-Twitter-lighter.png" border="0" width="153" height="24"></a></p>';
include 'footer.php';
?>

