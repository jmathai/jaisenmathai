<?php

/* Functions missing from older PHP versions */


/* Added in PHP 4.2.0 */

if (!function_exists('floatval')) {
	function floatval($string) {
		return ((float) $string);
	}
}

if (!function_exists('is_a')) {
	function is_a($object, $class) {
		// by Aidan Lister <aidan@php.net>
		if (get_class($object) == strtolower($class)) {
			return true;
		} else {
			return is_subclass_of($object, $class);
		}
	}
}

if (!function_exists('ob_clean')) {
	function ob_clean() {
		// by Aidan Lister <aidan@php.net>
		if (@ob_end_clean()) {
			return ob_start();
		}
		return false;
	}
}


/* Added in PHP 4.3.0 */

function printr($var, $do_not_echo = false) {
	// from php.net/print_r user contributed notes
	ob_start();
	print_r($var);
	$code =  htmlentities(ob_get_contents());
	ob_clean();
	if (!$do_not_echo) {
		echo "<pre>$code</pre>";
	}
	ob_end_clean();
	return $code;
}

/* compatibility with PHP versions older than 4.3 */
if ( !function_exists('file_get_contents') ) {
	function file_get_contents( $file ) {
		$file = file($file);
		return !$file ? false : implode('', $file);
	}
}

if (!defined('CASE_LOWER')) {
		define('CASE_LOWER', 0);
}

if (!defined('CASE_UPPER')) {
		define('CASE_UPPER', 1);
}


/**
 * Replace array_change_key_case()
 *
 * @category    PHP
 * @package     PHP_Compat
 * @link        http://php.net/function.array_change_key_case
 * @author      Stephan Schmidt <schst@php.net>
 * @author      Aidan Lister <aidan@php.net>
 * @version     $Revision: 6070 $
 * @since       PHP 4.2.0
 * @require     PHP 4.0.0 (user_error)
 */
if (!function_exists('array_change_key_case')) {
		function array_change_key_case($input, $case = CASE_LOWER)
		{
				if (!is_array($input)) {
						user_error('array_change_key_case(): The argument should be an array',
								E_USER_WARNING);
						return false;
				}

				$output   = array ();
				$keys     = array_keys($input);
				$casefunc = ($case == CASE_LOWER) ? 'strtolower' : 'strtoupper';

				foreach ($keys as $key) {
						$output[$casefunc($key)] = $input[$key];
				}

				return $output;
		}
}

if (!function_exists('http_build_query')) {
	function http_build_query($data, $prefix=null, $sep=null) {
		return _http_build_query($data, $prefix, $sep);
	}
}

// from php.net (modified by Mark Jaquith to behave like the native PHP5 function)
function _http_build_query($data, $prefix=null, $sep=null, $key='', $urlencode=true) {
	$ret = array();

	foreach ( (array) $data as $k => $v ) {
		if ( $urlencode)
			$k = urlencode($k);
		if ( is_int($k) && $prefix != null )
			$k = $prefix.$k;
		if ( !empty($key) )
			$k = $key . '%5B' . $k . '%5D';
		if ( $v === NULL )
			continue;
		elseif ( $v === FALSE )
			$v = '0';

		if ( is_array($v) || is_object($v) )
			array_push($ret,_http_build_query($v, '', $sep, $k, $urlencode));
		elseif ( $urlencode )
			array_push($ret, $k.'='.urlencode($v));
		else
			array_push($ret, $k.'='.$v);
	}

	if ( NULL === $sep )
		$sep = ini_get('arg_separator.output');

	return implode($sep, $ret);
}

if ( !function_exists('_') ) {
	function _($string) {
		return $string;
	}
}

// Added in PHP 5.0
if (!function_exists('stripos')) {
	function stripos($haystack, $needle, $offset = 0) {
		return strpos(strtolower($haystack), strtolower($needle), $offset);
	}
}

?>
