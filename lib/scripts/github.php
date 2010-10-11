<?php
  $gUrl = 'http://github.com/api/v2/json';
  $repoUrl = "{$gUrl}/repos/show/jmathai/twitter-async";
  $commitsUrl = "{$gUrl}/commits/list/jmathai/twitter-async/master";
  $ch = curl_init($repoUrl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $repoJson = curl_exec($ch);
  curl_close($ch);
  $ch = curl_init($commitsUrl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $commitsJson = curl_exec($ch);
  $repo = json_decode($repoJson, 1);
  $repo = $repo['repository'];
  $commits = json_decode($commitsJson, 1);
  if(empty($repo) || empty($commits['commits']))
    die();

  $out = array();
  $out['info'] = array(
    'watchers' => $repo['watchers'],
    'issues' => $repo['open_issues'],
    'forks' => $repo['forks']
  );
  $out['commits'] = array();
  foreach($commits['commits'] as $cnt => $commit)
  {
    if($cnt > 4)
      break;

    $out['commits'][] = array(
      'message' => $commit['message'],
      'name' => $commit['author']['name'],
      'email' => $commit['author']['email'],
      'time' => strtotime($commit['committed_date']),
      'timefmt' => date('F j, Y \a\t g:i a', strtotime($commit['committed_date']))
    );
  }

  file_put_contents('../views/github.json', json_encode($out));
?>
