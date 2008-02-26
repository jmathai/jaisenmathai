<?php
/*
* Configuration array that sets up the application.
* Enviornment specific variables are handled by unique HTTP_HOST values.
* Global configuration items are stored as constants using all upper case and an _ to separate words.
* Non-global configuration files are stored in the $_ array.
*/
$_ = array();

$_['constMode'] = !isset($argv[1]) ? $_SERVER['HTTP_HOST'] : $argv[1];

switch($_['constMode'])
{
  case 'local.jaisenmathai.com':
    /*
    * Database connection properties
    */
    define('DB_TYPE', '');
    define('DB_HOST', '');
    define('DB_USER', '');
    define('DB_PASS', '');
    define('DB_NAME', '');
    
    /*
    * Filesystem paths relevant to the application
    */
    define('PATH_LIB', '/Users/jmathai/Y/jaisenmathai/trunk/lib');
    define('PATH_DOC', '/Users/jmathai/Y/jaisenmathai/trunk/html');
    break;
  case 'www.jaisenmathai.com':
    /*
    * Database connection properties
    */
    define('DB_TYPE', '');
    define('DB_HOST', '');
    define('DB_USER', '');
    define('DB_PASS', '');
    define('DB_NAME', '');
    
    /*
    * Filesystem paths relevant to the application
    */
    define('PATH_LIB', '/www/jaisenmathai.com/www/lib');
    define('PATH_DOC', '/www/jaisenmathai.com/www/html');
    break;
  case 'jaisenmathai.com':
    header('HTTP/1.1 301 Moved Permanently');
    header('Status: 301 Moved Permanently');
    header('Location: http://www.jaisenmathai.com' . $_SERVER['REQUEST_URI']);
    die();
    break;
  default:
    echo 'Invalid Request';
    die();
    break;
}

/*
* Filesystem paths relevant to the application
*/
define('PATH_MODEL', PATH_LIB . '/models');
define('PATH_VIEW', PATH_LIB . '/views');

/*
* Routes define url paths and a Class::method which handled the request.
* The path is the key and the value is an array with two indexes.
* The two indexes are Class and Method in that order.
* The application starts with the entire url path and traverses back until it 
  finds a match in $_['routes'].
* If no match is found it ends up displaying the '' route.
*/
$_['routes'] = array(
                ''                        => array('CSite', 'home'), // Required
                'about'                   => array('CSite', 'about'),
                'contact'                 => array('CSite', 'contact'),
                'code'                    => array('CSite', 'code'),
                'code/episuite'           => array('CSite', 'codeEpisuite'),
                'error/404'               => array('CSite', 'error404'),
                'portfolio'               => array('CSite', 'portfolio'),
                'resume'                  => array('CSite', 'resume'),
                'resume/detail'           => array('CSite', 'resumeDetail'),
                'resume/detail/print'     => array('CSite', 'resumeDetailPrint'),
                'resume/ascii'            => array('CSite', 'resumeAscii'),
                'resume/print'            => array('CSite', 'resumePrint'),
                'resume/doc'              => array('CSite', 'resumeDoc'),
                'sample/closure'          => array('CSite', 'sampleClosure'),
                'sample/scroll'           => array('CSite', 'sampleScroll'),
              );
?>
