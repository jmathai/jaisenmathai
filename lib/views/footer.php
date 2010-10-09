      </div>
      <div id="right">
              
        <div class="sidemenu">  
          <ul>        
            <?php $redirectUrl = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : ''; ?>
            <?php if(preg_match('#^/blog/[a-zA-Z0-9_-]+#', $redirectUrl)) { ?>
              <?php $facebookInclude = true; ?>
              <li id="fb-like">
                <fb:like layout="button_count" width="140" font="lucida grande" href="<?php echo "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REDIRECT_URL']}"; ?>">
              </li>
            <?php } ?>
            <li><a href="http://github.com/jmathai" target="_blank">Watch me on Github</a></li>
            <li><a href="http://twitter.com/jmathai" target="_blank">Follow me on Twitter</a></li>
          </ul>
        </div>
              
        <div class="sidemenu">
          <h3>Work</h3>
          <ul>
            <li>I'm currently working as an engineer at <img src="/images/yahoo_logo-a.gif" border="0" alt="Yahoo!" class="plain" /> and living in Sunnyvale, CA.</li>
          </ul>
        </div>
        
        <div class="sidemenu">
          <h3>Articles</h3>
          <ul>
            <?php foreach(getArticles() as $article) { ?>
              <li><a href="/articles/<?php echo $article['file']; ?>"><?php echo $article['name']; ?></a></li>
            <?php } ?>
          </ul>
        </div>

        <div class="sidemenu">
          <h3>Twitter</h3>
          <ul>
            <li><?php echo twitify(file_get_contents(PATH_LIB . '/views/twitter.txt')); ?></li>
          </ul>
        </div>

  <!-- content end -->  
    </div> <!-- id="content" -->
  </div> <!-- id="content-outer" -->
    
  <!-- footer starts here -->  
  <div id="footer-outer" class="clear"><div id="footer-wrap">
    <div class="col-a">
      <h3>Image Gallery </h3>          
      <p class="thumbs">
        <a href="index.html"><img src="images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
        <a href="index.html"><img src="images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
        <a href="index.html"><img src="images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
        <a href="index.html"><img src="images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
        <a href="index.html"><img src="images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
        <a href="index.html"><img src="images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>  
        <a href="index.html"><img src="images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
        <a href="index.html"><img src="images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>        
      </p>  
      <h3>Something about images</h3>
      <p>Something more about images</p>      
    </div>
    
    <div class="col-a">
      <h3>Middle text</h3>
      <p>
        <strong>Middle bold</strong> <br />
        Middle text.
      </p>
        
      <div class="footer-list">
        <ul>        
          <li><a href="index.html">consequat molestie</a></li>
          <li><a href="index.html">sem justo</a></li>
          <li><a href="index.html">semper</a></li>
          <li><a href="index.html">magna sed purus</a></li>
          <li><a href="index.html">tincidunt</a></li>    
          <li><a href="index.html">consequat molestie</a></li>    
          <li><a href="index.html">magna sed purus</a></li>          
        </ul>
      </div>
        
    </div>    
  
    <div class="col-b">
    
      <h3>About</h3>      
      
      <p>
      <a href="index.html"><img src="images/gravatar.jpg" width="40" height="40" alt="firefox" class="float-left" /></a>
      Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
      Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu 
      posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum 
      odio, ac blandit ante orci ut diam.</p>
      
      <p>
      Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
      Cras id urna. <a href="index.html">Learn more...</a></p>      
      
    </div>    
  
  <!-- footer ends -->    
  </div></div>
  
  <!-- footer-bottom starts -->    
  <div id="footer-bottom">
    <div class="bottom-left">
      <p>
      &copy; 2010 <strong>Your Copyright Info Here</strong>&nbsp; &nbsp; &nbsp;
      <a href="http://www.bluewebtemplates.com/" title="Website Templates">website templates</a> by <a href="http://www.styleshout.com/">styleshout</a>
      </p>
    </div>
  
    <div class="bottom-right">
      <p>    
        <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | 
         <a href="http://validator.w3.org/check/referer">XHTML</a>  |      
        <a href="index.html">Home</a> |
        <a href="index.html">Sitemap</a> |
        <a href="index.html">RSS Feed</a>                
      </p>
    </div>
  <!-- footer-bottom ends -->    
  </div>
  
<!-- wrap ends here -->
</div>
<?php echo getJs(); ?>
<script src="/mustaches.js" type="text/javascript"></script>
<script>
  $(document).ready(function() {
    $("div#nav ul li a").click(function() {
      var el = this;
      var url = $(el).attr('href');
      var loc = location.href;
      if(loc.search("#") != -1)
        loc = loc.substr(0, loc.indexOf("#"));

      $("div#nav ul li.last").show();
      jm.click(url, loc);
      return false;
    });

    if(location.href.search("#") != -1) {
      jm.click(location.hash.substring(1), location.href.replace(location.hash, ""));
    }
    dp.SyntaxHighlighter.ClipboardSwf = '/swf/clipboard.swf';
    dp.SyntaxHighlighter.HighlightAll('code');
  });
</script>
</body>
</html>
