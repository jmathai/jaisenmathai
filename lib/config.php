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
    define('DB_TYPE', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'socialbib');
    
    /*
    * Filesystem paths relevant to the application
    */
    define('PATH_LIB', '/home/jmathai/enc/svn/jaisenmathai/trunk/lib');
    define('PATH_DOC', '/home/jmathai/enc/svn/jaisenmathai/trunk/html');
    break;
  case 'www.socialbib.com':
    /*
    * Database connection properties
    */
    define('DB_TYPE', 'mysql');
    define('DB_HOST', 'internal-db.s24600.gridserver.com');
    define('DB_USER', 'db24600');
    define('DB_PASS', 'rAMiGlY2');
    define('DB_NAME', 'db24600_socialbib');
    
    /*
    * Filesystem paths relevant to the application
    */
    define('PATH_LIB', '/home/24600/users/.home/domains/socialbib.com/lib');
    define('PATH_DOC', '/home/24600/users/.home/domains/socialbib.com/html');
    break;
  case 'socialbib.com':
    header('HTTP/1.1 301 Moved Permanently');
    header('Status: 301 Moved Permanently');
    header('Location: http://www.socialbib.com' . $_SERVER['REQUEST_URI']);
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
define('PATH_TEMPLATE', PATH_LIB . '/templates');

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
                'resume'                  => array('CSite', 'resume'),
                'resume/ascii'            => array('CSite', 'resumeAscii'),
                'resume/print'            => array('CSite', 'resumePrint'),
                'portfolio'               => array('CSite', 'portfolio')
              );
?>
