      </div><!-- id="left" -->
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
            <li><a href="http://www.linkedin.com/in/jaisenmathai" target="_blank">View my LinkedIn profile</a></li>
          </ul>
        </div>
              
        <div class="sidemenu">
          <h3>Work</h3>
          <ul>
            <li>I'm bootstrapping an <a href="http://openphoto.me">open source photo service named OpenPhoto</a> and living in Sunnyvale, CA.</li>
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
      <h3>Photos</h3>          
      <p class="thumbs"></p>  
    </div>
  
    <div class="col-b">
    
      <h3>About</h3>      
      
      <p>
      <a href="/"><img src="http://www.gravatar.com/avatar/e4d1f099d40e3b453be3355349b90457?s=40" width="40" height="40" alt="firefox" class="float-left" /></a>
      I created this site to express my technical and creative sides. 
      Very little of my personal life is on this site (or on the Internet for that matter).
      I do, however, have a lot of involvement in various technology groups and advocate free open source software.
      Most of the code I write is available on <a href="http://github.com/jmathai">Github</a>.
      </p>
      <p>
      I'm also an entrepreneur having successfully launched a handful of companies and raising angel funding for one and selling another.
      I continue to invest a portion of my time pursuing ventures.
      </p>
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
        <a href="/">Home</a>
      </p>
    </div>
  <!-- footer-bottom ends -->    
  </div>
  
<!-- wrap ends here -->
</div><!-- id="wrap" -->
<?php echo getJs(); ?>
<script src="/mustaches.js" type="text/javascript"></script>
<script src="http://photos.jaisenmathai.com/js/api.js" id="__PTG"></script>
<script>
  var ptg;
  <?php if(PROD) { ?>
    var _gaq = _gaq || [];
  <?php } ?>
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
    
    if(typeof PTG == 'function')
    {
      ptg = new PTG("656ff15dffa1a18c53c94b242da917f9");
      jm.ptg.load();
    }
    jm.isProd(<?php echo json_encode(PROD); ?>);
    if(jm.isProd()) {
      _gaq.push(function() { var pageTracker = _gat._createTracker('UA-88708-4', 'jm'); });
      _gaq.push(['jm._trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    }
  });
</script>
<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
</body>
</html>
