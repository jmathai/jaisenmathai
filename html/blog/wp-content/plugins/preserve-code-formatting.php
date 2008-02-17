<?php
/*
Plugin Name: Preserve Code Formatting
Version: 0.9
Plugin URI: http://www.coffee2code.com/wp-plugins/
Author: Scott Reilly
Author URI: http://www.coffee2code.com
Description: Preserve formatting for text within &lt;code> and &lt;pre> tags (other tags can be defined as well).  Helps to preserve code indentation, multiple spaces, prevents WP's fancification of text (ie. ensures quotes don't become curly, etc).

=>> Visit the plugin's homepage for more information and latest updates  <<=


Installation:

1. Download the file http://www.coffee2code.com/wp-plugins/preserve-code-formatting.zip and unzip it into your 
wp-content/plugins/ directory.
-OR-
Copy and paste the contents of http://www.coffee2code.com/wp-plugins/preserve-code-formatting.phps into a file 
called preserve-code-formatting.php, and put that file into your wp-content/plugins/ directory.

2. Optional: There are two settings in preserve-code-formatting.php file that you can customize:
 a. in the function c2c_preserve_code_formatting(), if you want other HTML (in addition to 'code' and 'pre') to be processed by this function, add them
    to the $tags array:
    $tags = array('code', 'pre');
 b. in the function c2c_prep_code(), if you do NOT wish for this plugin to help preserve spacing/indentation in the 'code'/'pre'/etc tags, then set
    $use_nbsp_for_spaces to be 'false'.
    If you decide to do this, you can still preserve code formatting via CSS.  Here's a snippet of what I use:
    
    code, pre {
	white-space: pre;
    }
    
3. Activate the plugin from your WordPress admin 'Plugins' page.


Notes:

Bascially, you can just paste code into 'code', 'pre', and/or other tags you additionally specify and this plugin will:
* prevent all "wptexturization" of text (i.e. single- and double-quotes will not become curly; "--" and "---" will not become en dash and em dash, 
respectively; "..." will not become a horizontal ellipsis, etc)
* optionally preserve multiple spaces (including indentations) (for the most part, that is; it changes 2+ consecutive "\n" to "\n\n" and "\t" to "  ")

Keep these things in mind:
* ALL embedded HTML tags and HTML entities will be rendered as text to browsers, appearing exactly as you wrote them (including any <br />).
* By default this plugin filters both 'the_content' (post contents), 'the_excerpt' (post excerpts), and 'get_comment_text'.

Example:
A post containing this within <code></code>:
$wpdb->query("
        INSERT INTO $tablepostmeta
        (post_id,meta_key,meta_value)
        VALUES ('$post_id','link','$extended')
");

Would, with this plugin enabled, look in a browser pretty much how it does above, instead of like:
$wpdb->query("
INSERT INTO $tablepostmeta
(post_id,meta_key,meta_value)
VALUES ('$post_id','link','$extended')
");

*/

/*
Copyright (c) 2004-2005 by Scott Reilly (aka coffee2code)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation 
files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, 
modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the 
Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR
IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

function c2c_prep_code( $text ) {
	$use_nbsp_for_spaces = true;
	
	$text = preg_replace("/(\r\n|\n|\r)/", "\n", $text);
	$text = preg_replace("/\n\n+/", "\n\n", $text);
	$text = str_replace(array("&#36&;", "&#39&;"), array("$", "'"), $text);
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\t", '  ', $text);
	if ($use_nbsp_for_spaces)  $text = str_replace('  ', '&nbsp;&nbsp;', $text);
	// Change other special characters before wptexturize() gets to them
	$text = c2c_anti_wptexturize($text);
	$text = nl2br($text);
	return $text;
} //end c2c_prep_code()

// This short-circuits wptexturize process by making ASCII substitutions before wptexturize sees the text
function c2c_anti_wptexturize( $text ) {
	$text = str_replace('---', '&#45;&#45;-', $text);
	$text = str_replace('--', '&#45;-', $text);
	$text = str_replace('...', '&#46;..', $text);
	$text = str_replace('``', '&#96;`', $text);

	// This is a hack, look at this more later. It works pretty well though.
	$cockney = array("'tain't","'twere","'twas","'tis","'twill","'til","'bout","'nuff","'round");
	$cockneyreplace = array("&#39;tain&#39;t","&#39;twere","&#39;twas","&#39;tis","&#39;twill","&#39;til","&#39;bout","&#39;nuff","&#39;round");
	$text = str_replace($cockney, $cockneyreplace, $text);

	$text = preg_replace("/'s/", '&#39;s', $text);
	$text = preg_replace("/'(\d\d(?:&#8217;|')?s)/", "&#39;$1", $text);
	$text = preg_replace('/(\s|\A|")\'/', '$1&#39;', $text);
	$text = preg_replace('/(\d+)"/', '$1&quot;', $text);
	$text = preg_replace("/(\d+)'/", '$1&#39;', $text);
	$text = preg_replace("/(\S)'([^'\s])/", "$1&#39;$2", $text);
	$text = preg_replace('/(\s|\A)"(?!\s)/', '$1&quot;$2', $text);
	$text = preg_replace('/"(\s|\S|\Z)/', '&quot;$1', $text);
	$text = preg_replace("/'([\s.]|\Z)/", '&#39;$1', $text);
	$text = preg_replace("/ \(tm\)/i", ' &#40;tm)', $text);
	$text = str_replace("''", '&#39;&#39;', $text);

	$text = preg_replace('/(d+)x(\d+)/', "$1&#120;$2", $text);
	
	$text = str_replace("\n\n", "\n&nbsp;\n", $text);
	return $text;
} //end c2c_anti_wptexturize()

function c2c_preserve_code_formatting( $text ) {
	$text = str_replace(array('$', "'"), array('&#36&;', '&#39&;'), $text);
	$tags = array('code', 'pre');
	foreach ($tags as $tag) {
		$text = preg_replace(
			"^(<$tag>)\n?([\S|\s]*?)\n?(</$tag>)^ie",
			"'<$tag>' . c2c_prep_code(\"$2\") . '</$tag>'",
			$text
		);
	}
	$text = str_replace(array('&#36&;', '&#39&;'), array('$', "'"), $text);
	return $text;
} //end c2c_preserve_code_formatting()


add_filter('the_content', 'c2c_preserve_code_formatting', 9);
add_filter('the_excerpt', 'c2c_preserve_code_formatting', 9);
// Comment out this next line if you don't want to allow preserve code formatting for comments.
add_filter('get_comment_text', 'c2c_preserve_code_formatting', 9);

?>
