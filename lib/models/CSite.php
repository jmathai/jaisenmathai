<?php
/*
* Class:        CSite
* Description:  Model
* Authors:      Jaisen Mathai <jaisen@jmathai.com>
*               Kevin Hornschemeier <kevin.hornschmeier@gmail.com>
*/

  class CSite
  {
    public static function contact()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/contact.html', 'title' => 'Contact', 'subtitle' => 'PHP Developer / Contact'));
    }
    
    public static function error404()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/404.html', 'title' => '404 :: File Not Found', 'subtitle' => 'PHP Developer / Not Found'));
    }
    
    public static function home()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/home.html', 'title' => 'Home', 'subtitle' => 'PHP Developer / Home'));
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
    
    public static function portfolio()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/portfolio.html', 'title' => 'Portfolio', 'subtitle' => 'PHP Developer / Portfolio'));
    }
  }
?>
