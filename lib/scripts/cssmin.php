<?php
/**
 * $Id: CSSMin.php 19 2007-11-26 10:00:49Z vladimir $
 * @package CSS_Minifier
 */

/**
 * Minimifies the CSS files by removing lots of unnecessary
 * stuff.
 *
 * Class description {@link http://www.vladimirated.com/web-development-minify-css-using-php-and-cssmin-class}
 *
 * To make this class work for PHP 4, simply remove the PHP 5
 * specific language, and also change the __toString() method
 * workaround.
 *
 * Usage: 
 *
 * <code>
 * <?php
 *
 *  $new_css = new CSSMin('#your_css { content: goes_here }');
 *
 * ?>
 * </code>
 *
 * If you want to see the compression statistics (initial size, 
 * vs minimified size, compression percentage), simply uncomment
 * the constructor's statistics specific code.
 *
 * <strong>November 25, 2007</strong>
 * <ul>
 *  <li>removes new lines</li>
 *  <li>removes starred (*) java/c++/php alike comments</li>
 *  <li>removes unnecesarry tabs</li>
 *  <li>converts colors like #ffbb55 to #fb5</li>
 * </ul>
 *
 * Some statistics I gathered:
 * -------------------------------------------------------------
 * | # | Initial size   | Final Size |  Compression |  Savings |
 * -------------------------------------------------------------
 * | 1 |  72.84 kb      |  61.75 kb  |    %15.22    | 11.09 kb |
 * -------------------------------------------------------------
 * | 2 |  40.34 kb      |  33.88 kb  |    %16.01    |  6.46 kb |
 * -------------------------------------------------------------
 * | 3 |  29.01 kb      |  23.44 kb  |    %19.02    |  5.57 kb |
 * -------------------------------------------------------------
 * | 4 |  11.57 kb      |   8.89 kb  |    %23.22    |  2.69 kb |
 * -------------------------------------------------------------
 * | 5 |   6.57 kb      |   4.64 kb  |    %29.46    |  1.94 kb |
 * -------------------------------------------------------------
 * | 6 |   5.21 kb      |   4.49 kb  |    %13.09    |  0.72 kb |
 * -------------------------------------------------------------
 * | 7 |   1.42 kb      |   1.31 kb  |     %7.75    |  0.11 kb |
 * -------------------------------------------------------------
 *
 * <ul>
 *  <li>(1) http://static.youtube.com/yt/css/base_all-vfl29474.css</li>
 *  <li>(2) http://static.technorati.com/x/static/css/technorati.css</li>
 *  <li>(3) http://c.skype.com/i_preairlift/css/main_v3.css</li>
 *  <li>(4) http://www.vladimirated.com/wp-content/themes/vladimirated/style.css</li>
 *  <li>(5) http://www.neogen.ro/includes/fp.css</li>
 *  <li>(6) http://s.wordpress.org/style/wp3.css?12</li>
 *  <li>(7) http://www.alistapart.com//css/home.css</li>
 * </ul>
 *
 * The MIT License
 * 
 * Copyright (c) 2007 Vladimir Ghetau
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package   CSS_Minifier
 * @author    Vladimir Ghetau <vladimir@pixeltomorrow.com>
 * @link      http://www.vladimirated.com
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 * @copyright Copyright (c) 2007 Vladimir Ghetau
 * @todo      Make sure that some inline comments written to 
 *            hack CSS layout, aren't removed.
 */
final class CSSMin {

  /**
   * The CSS content we need to minimify.
   * 
   * @access private
   * @var    string
   */
  private $css;

  /**
   * The new CSS content we'll return.
   * 
   * @access private
   * @var    string
   */
  private $new_css;


    /**
     * Class constructor.
     *
     * @param string $content The CSS content, ready to be 
     *                        minimified.
     * return  void
     * @access public
     */
    function __construct($content) {

            if (!$content || !is_string($content)) {

                return null;
            }

        $this->css      = trim($content);
        $this->removeRawSpaces();
        $this->cleanInlineCSS();
        $this->css = str_replace("\n", null, $this->css);
        
        // uncomment below to see compression stats!
        /********

        $new_css_s = strlen($this->css)/1024;
        $ini_css_s = strlen($content)/1024;
        $savings = $ini_css_s - $new_css_s;
        $perc = 100 - $new_css_s * 100 / $ini_css_s;
        echo "/**\r\n".
             " * Compression percentage: %". round($perc,2) ."\r\n".
             " * Initial size: ~". round($ini_css_s,2) ." kb\r\n".
             " * Minimified size: ~". round($new_css_s,2) ." kb\r\n".
             " * Savings: ~". round($savings,2) ." kb\r\n".
             ' *'.'/'. "\r\n";

        *******/

    }
    
    /**
     * Removes inline CSS elements that aren't required, 
     * like extra spaces, color colors simplified, etc.
     *
     * @access private
     * @return void
     */
    private function cleanInlineCSS() {

        $tr = array('/\\;\s/',
                    '/\s+\{\\s+/',
                    '/\\:\s+\\#/',
                    '/,\s+/i',
                    '/\\:\s+\\\'/i',
                    '/\\:\s+([0-9]+|[A-F]+)/i');
        $wr = array(';',
                    '{',
                    ':#',
                    ',',
                    ':\'',
                    ':$1');

        $this->css = preg_replace($tr, $wr, $this->css);
        $this->css = preg_replace_callback('/\\#(00|11|22|33|44|55|66|77|88|99|aa|bb|cc|dd|ee|ff){3}/i', array($this, "minifyColors") , $this->css);
    }
    
    /**
     * Changes the 6 characters double CSS colors, to 
     * 3 charaters sizes.
     *
     * @access private
     * @return string
     * @param  array   $color The color match to compress.
     */
    private function minifyColors($c) {
        
        $d = array();
        $d[0] = substr($c[0], 1, 1);
        $d[1] = substr($c[0], 3, 1);
        $d[2] = substr($c[1], 1);
        $color = $d[0] . $d[1] . $d[2];
        return '#'. $color;
    }

    /**
     * Corectly removes duplicate carriage returns, tabs, and 
     * spaces from a CSS file.
     *
     * @access private
     * @return void
     */
    private function removeRawSpaces() {

        $this->css = str_replace("\r\n", "\n", $this->css);

        $tr = array('/\/\*[\d\D]*?\*\/|\t+/',
                    '/\s+/',
                    '/\}\s+/');

        $wr = array(null,
                    ' ',
                    "}\n");

        $this->css = preg_replace($tr, $wr, $this->css);
    }

    /**
     * Returns the minified CSS content.
     *
     * @access public
     * @return string
     */
    function __toString() {
    
        return $this->css;
    }

}

?>