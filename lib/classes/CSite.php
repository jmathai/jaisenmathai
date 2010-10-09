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
      Epicode::display('header.php', self::articlesView());
      echo M()->render(EpiCode::get('template.php'), self::articlesView(), getPartials());
      Epicode::display('footer.php');  
    }

    public static function articlesAjax()
    {
      echo EpiCode::json(self::articlesView());
    }

    private static function articlesView()
    {
      $articles = getArticles();
      return array('body' => M()->render(EpiCode::get('articles.html'), array('articles' => $articles)), 'title' => 'Articles', 'articles' => $articles);
    }

    public static function code()
    {
      Epicode::display('header.php', self::codeView());
      echo M()->render(EpiCode::get('template.php'), self::codeView(), getPartials());
      Epicode::display('footer.php');  
    }

    public static function codeAjax()
    {
      echo EpiCode::json(self::codeView());
    }

    private static function codeView()
    {
      return array('body' => EpiCode::get('code.html'), 'title' => 'Code', 'github' => json_decode(trim(file_get_contents(EPICODE_VIEWS . '/github.json')), true));
    }
    
    public static function contact()
    {
      $view = self::contactView();
      Epicode::display('header.php', self::contactView());
      echo M()->render(EpiCode::get('template.php'), $view, getPartials());
      Epicode::display('footer.php');  
      //Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/contact.html', 'title' => 'Contact', 'subtitle' => 'Hacker::getInstance() / Contact'));
    }

    public static function contactAjax()
    {
      echo EpiCode::json(self::contactView());
    }

    private static function contactView()
    {
      return array('body' => EpiCode::get('contact.html'), 'title' => 'Contact');
    }

    public static function emptyAjax()
    {
      echo EpiCode::json(array());
    }

    public static function error301()
    {
      if(strstr($_SERVER['REQUEST_URI'], '?'))
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
      Epicode::display('header.php', self::homeView());
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
      $view = self::resumeView();
      Epicode::display('header.php', self::resumeView());
      echo M()->render(EpiCode::get('template.php'), $view, getPartials());
      Epicode::display('footer.php');  
    }

    public static function resumeAjax()
    {
      echo EpiCode::json(self::resumeView());
    }

    private static function resumeView()
    {
        return array('body' => EpiCode::get('resume.html'), 'title' => 'Resume');
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
      $view = self::portfolioView();
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
      return array('body' => EpiCode::get('portfolio.html'), 'title' => 'Portfolio');
    }
  }
?>
