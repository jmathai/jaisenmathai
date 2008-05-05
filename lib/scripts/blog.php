<?php
  include '../../html/blog/wp-config.php';
  
  $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
  $dbh = new PDO($dsn, DB_USER, DB_PASSWORD);

  $recentSql = 'SELECT * FROM wp_posts WHERE post_status = :status ORDER BY post_date DESC LIMIT 3';
  $recentSth = $dbh->prepare($recentSql);
  $recentSth->execute(array(':status' => 'publish'));

  $popularSql= 'SELECT * FROM wp_posts WHERE post_status = :status ORDER BY comment_count DESC LIMIT 3';
  $popularSth= $dbh->prepare($popularSql);
  $popularSth->execute(array(':status' => 'publish'));

  /*
  $commentSql= 'SELECT * FROM wp_comments WHERE comment_approved = :status ORDER BY comment_date DESC LIMIT 3';
  $commentSth= $dbh->prepare($commentSql);
  $commentSth->execute(array(':status' => 1));
  */

  $recentPosts = '<h2>Recent Blog Posts</h2><ul>';
  while($post = $recentSth->fetch(PDO::FETCH_ASSOC))
  {
    $recentPosts .= '<li><a href="' . get_permalink($post['ID']) . '">' . $post['post_title'] . '</a></li>';
  }
  $recentPosts .= '</ul>';

  $popularPosts = '<h2>Popular Blog Posts</h2><ul>';
  while($post = $popularSth->fetch(PDO::FETCH_ASSOC))
  {
    $popularPosts .= '<li><a href="' . get_permalink($post['ID']) . '">' . $post['post_title'] . '</a> (' . $post['comment_count'] . ' comments)</li>';
  }
  $popularPosts .= '</ul>';

  $memcache = new Memcache();
  $memcache->connect('localhost');
  $memcache->set('blog_recent', $recentPosts, MEMCACHE_COMPRESSED);
  $memcache->set('blog_popular', $popularPosts, MEMCACHE_COMPRESSED);
?>
