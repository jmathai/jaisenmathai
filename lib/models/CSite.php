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

    public static function code()
    {
      $github = json_decode(trim(file_get_contents(EPICODE_VIEWS . '/github.json')), true);
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/code.html', 'title' => 'Code', 'subtitle' => 'PHP Developer / Code', 'github' => $github));
    }

    public static function codeEpisuite()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/epi-suite.html', 'title' => 'Code / EpiSuite', 'subtitle' => 'PHP Developer / Minimal Web Application Framework'));
    }
    
    public static function contact()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/contact.html', 'title' => 'Contact', 'subtitle' => 'PHP Developer / Contact'));
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
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/404.html', 'title' => '404 :: File Not Found', 'subtitle' => 'PHP Developer / Not Found'));
    }
    
    public static function home()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/home.html', 'title' => 'Home', 'subtitle' => 'PHP Developer / Home'));
    }

    public static function playgroundNotify()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/notify.html', 'title' => 'Playground', 'subtitle' => 'PHP Developer / Playground / Notify'));
    }
    
    public static function resume()
    {
      Epicode::display('template.php', array(
        'body' => EPICODE_VIEWS . '/resume.html', 
        'title' => 'Resume <a href="/Jaisen_Mathai_Resume.pdf" title="View PDF Version">
            <img src="/images/pdf_24x24.png" width="24" height="24" border="0" hspace="4" align="absmiddle" />
          </a>
          <a href="/resume/print" target="_blank" title="View Printable Version">
            <img src="/images/print_24x24.png" width="24" height="24" border="0" hspace="4" align="absmiddle" />
          </a>', 
        'subtitle' => 'PHP Developer / Resume'));
    }
    
    public static function resumeAscii()
    {
      Epicode::display('print.php', array('body' => EPICODE_VIEWS . '/resume-ascii.html'));
    }
    
    public static function resumeDetail()
    {
      Epicode::display('template.php', array(
        'body' => EPICODE_VIEWS . '/resume-detail.html', 
        'title' => 'Resume (Detail)', 
        'subtitle' => 'PHP Developer / Resume'));
    }
    
    public static function resumeDetailPrint()
    {
      Epicode::display('print.php', array('body' => EPICODE_VIEWS . '/resume-detail.html'));
    }
    
    public static function resumeDoc()
    {
      Epicode::display('print.php', array('body' => EPICODE_VIEWS . '/resume-doc.html'));
    }
    
    public static function resumePrint()
    {
      Epicode::display('print.php', array('body' => EPICODE_VIEWS . '/resume.html'));
    }

    public static function sampleClosure()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/sample-closure.html', 'title' => 'Javascript Closure Sample', 'subtitle' => 'Javascript Closure Sample'));
    }
    
    public static function sampleScroll()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/sample-scroll.html', 'title' => 'Javascript Auto Scroller Sample', 'subtitle' => 'Javascript Auto Scroller Sample'));
    }

    public static function stocks()
    {
      require_once PATH_MODEL . '/CStocks.php';
      $stockObj = CStocks::getInstance();
      $stocks = $stockObj->getPositions();
      $portfolios[] = $stocks;

      Epicode::display('print.php', array('body' => EPICODE_VIEWS . '/stocks.html', 'title' => 'Stock Ticker', 'subtitle' => 'Stock Ticker', 'portfolios' => $portfolios));
    }
    
    public static function portfolio()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/portfolio.html', 'title' => 'Portfolio', 'subtitle' => 'PHP Developer / Portfolio'));
    }
  }
?>
