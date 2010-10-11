<?php
/*
* Class:        CSite
* Description:  Model
* Authors:      Jaisen Mathai <jaisen@jmathai.com>
*               Kevin Hornschemeier <kevin.hornschmeier@gmail.com>
*/

  class CSite
  {
    private static $memcache = null;

    public static function articles()
    {
      $view = array('body' => M()->render(EpiCode::get('articles.html'), array('articles' => getArticles())));
      $view = array_merge($view, self::articlesView());
      Epicode::display('header.php', $view);
      echo M()->render(EpiCode::get('template.php'), $view, getPartials());
      Epicode::display('footer.php');  
    }

    public static function articlesAjax()
    {
      echo EpiCode::json(self::articlesView());
    }

    private static function articlesView()
    {
      return array('title' => 'Articles', 'articles' => getArticles());
    }

    public static function articleDetail()
    {
      $view = self::articlesView();
      if(stristr($_SERVER['REDIRECT_URL'], '..') === false && file_exists(PATH_VIEW . $_SERVER['REDIRECT_URL']))
      {
        $view['body'] = EpiCode::get(substr($_SERVER['REDIRECT_URL'], 1));
        Epicode::display('header.php', $view);
        echo M()->render(EpiCode::get('template.php'), $view, getPartials());
        Epicode::display('footer.php');  
      }
      else
      {
        EpiCode::redirect('/articles.html');
      }
    }

    public static function code()
    {
      $view = array('body' => M()->render(EpiCode::get('code.html'), self::codeView()));
      $view = array_merge($view, self::codeView());
      Epicode::display('header.php', $view);
      echo M()->render(EpiCode::get('template.php'), $view, getPartials());
      Epicode::display('footer.php');  
    }

    public static function codeAjax()
    {
      echo EpiCode::json(self::codeView());
    }

    private static function codeView()
    {
      $github = json_decode(trim(file_get_contents(EPICODE_VIEWS . '/github.json')), true);
      return array('title' => 'Code', 'ghCommits' => $github['commits'], 'ghWatchers' => $github['info']['watchers'], 'ghForks' => $github['info']['forks'], 'ghIssues' => $github['info']['issues']);
    }
    
    public static function contact()
    {
      $view = array('body' => EpiCode::get('contact.html'));
      $view = array_merge($view, self::contactView());
      Epicode::display('header.php', $view);
      echo M()->render(EpiCode::get('template.php'), $view, getPartials());
      Epicode::display('footer.php');  
    }

    public static function contactAjax()
    {
      echo EpiCode::json(self::contactView());
    }

    private static function contactView()
    {
      return array('title' => 'Contact');
    }

    public static function emptyAjax()
    {
      echo EpiCode::json(array());
    }

    public static function error301()
    {
      if(strstr($_SERVER['REDIRECT_URL'], '/blog/'))
      {
        if(stristr($_SERVER['REDIRECT_URL'], 'asynchronous-parallel-http-requests-using-php-multi_curl'))
          $newUrl = '/articles/php-curl-asynchronous.html';
        elseif(stristr($_SERVER['REDIRECT_URL'], 'how-to-quickly-integrate-with-twitters-oauth-api-using-php'))
          $newUrl = '/articles/twitter-php-oauth.html';
        elseif(stristr($_SERVER['REDIRECT_URL'], 'letting-your-users-sign-in-with-twitter-with-oauth'))
          $newUrl = '/articles/twitter-php-sign-in.html';
        else
          $newUrl = '/articles.html';
      }
      elseif(strstr($_SERVER['REQUEST_URI'], '?'))
      {
        $newUrl = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?')) . '.html';
      }
      else
      {
        $newUrl = $_SERVER['REQUEST_URI'] . '.html';
      }
      header('HTTP/1.1 301 Moved Permanently');
      header("Location: {$newUrl}");
      die();
    }
    
    public static function error404()
    {
      header('HTTP/1.0 404 Not Found');
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/404.html', 'title' => '404 :: File Not Found', 'subtitle' => 'Hacker::getInstance() / Not Found'));
    }
    
    public static function home()
    {
      $view = array('body' => EpiCode::get('home.html'));
      $view = array_merge($view, self::homeView());
      Epicode::display('header.php', $view);
      echo M()->render(EpiCode::get('template.php'), $view, getPartials());
      Epicode::display('footer.php');
    }

    public static function homeAjax()
    {
      echo EpiCode::json(self::homeView());
    }

    private static function homeView()
    {
      return array('title' => 'Home', 'featured-title' => 'A little about myself', 'featured-content' => EpiCode::get('about.html'), 'featured-image-src' => '/images/headshot.jpg');
    }

    public static function mustaches()
    {
      EpiCode::display('mustaches.php');
    }

    public static function playgroundNotify()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/notify.html', 'title' => 'Playground', 'subtitle' => 'Hacker::getInstance() / Playground / Notify'));
    }
    
    public static function resume()
    {
      $view = array('body' => EpiCode::get('resume.html'));
      $view = array_merge($view, $view);
      Epicode::display('header.php', $view);
      echo M()->render(EpiCode::get('template.php'), $view, getPartials());
      Epicode::display('footer.php');  
    }

    public static function resumeAjax()
    {
      echo EpiCode::json(self::resumeView());
    }

    private static function resumeView()
    {
        return array('title' => 'Resume');
    }
    
    public static function resumeAscii()
    {
      Epicode::display('print.php', array('body' => EPICODE_VIEWS . '/resume-ascii.html'));
    }
    
    public static function resumePrint()
    {
      Epicode::display('print.php', array('body' => EPICODE_VIEWS . '/resume-print.html', 'title' => 'Resume'));
    }
    
    public static function portfolio()
    {
      $view = array('body' => EpiCode::get('portfolio.html'));
      $view = array_merge($view, self::portfolioView());
      Epicode::display('header.php', array('title' => 'Portfolio', 'subtitle' => 'Hacker::getInstance() / Portfolio'));
      echo M()->render(EpiCode::get('template.php'), $view, getPartials());
      Epicode::display('footer.php');  
    }

    public static function portfolioAjax()
    {
      echo EpiCode::json(self::portfolioView());
    }

    private static function portfolioView()
    {
      return array('title' => 'Portfolio');
    }
  }
