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
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/contact.html', 'title' => 'Contact'));
    }
    
    public static function home()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/home.html', 'title' => 'Home'));
    }
    
    public static function resume()
    {
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/resume.html', 'title' => 'Resume'));
    }
    
    public static function resumeAscii()
    {
      Epicode::display('print.php', array('body' => EPICODE_VIEWS . '/resume-ascii.html'));
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
      Epicode::display('template.php', array('body' => EPICODE_VIEWS . '/portfolio.html', 'title' => 'Portfolio'));
    }
  }
?>
