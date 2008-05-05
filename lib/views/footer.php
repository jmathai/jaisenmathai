    </div>
    <div id="sidebar">
      <ul>
        <li class="rss"><div><a href="http://feeds.feedburner.com/jaisenmathai" rel="alternate" type="application/rss+xml">Subscribe in a reader</a></div></li>
        <li>
          <?php echo getMemcache()->get('blog_recent'); ?>
        </li>
        <li>
          <?php echo getMemcache()->get('blog_popular'); ?>
        </li>
        <li>
          <h2>Twitter</h2>
          <?php @include $_SERVER['DOCUMENT_ROOT'] . '/../lib/views/twitter.txt'; ?>
        </li>
        <li>
          <h2>Work</h2>
          I'm currently working as an engineer at <a href="http://www.yahoo.com/" target="_blank"><img src="/images/yahoo_logo.gif" border="0" alt="Yahoo!" /></a> and living in Sunnyvale, CA.  
        </li>
        <!--
        <li>
          <h2>Blog</h2>
          <ul>
            <li></li>
            <li></li>
          </ul>
        </li>
        -->
        <li>
          <div id="custom-sidebar"></div>
        </li>
        <li>
          <h2>Extras</h2>
          <ul>
            <li><a href="http://gmpg.org/xfn/">XFN</a></li>
            <li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <br clear="left" />
  </div>
  <div id="content-top">
    <div id="content-bottom-left"></div>
    <div id="content-bottom-middle"></div>
    <div id="content-bottom-right"></div>
  </div>
  
  <div id="footer">
    <a href="/home">home</a> / 
    <a href="/resume">resume</a> / 
    <a href="/portfolio">portfolio</a> / 
    <a href="/code">code</a> / 
    <a href="/blog">blog</a> / 
    <a href="/contact">contact</a>
  </div>
  
  <div id="seo">
    About this site:
    <br/>
    This is my (Jaisen Mathai) personal site for potential employers who want to see my resume or portfolio.  
    My ideal job would be to work as a <strong>PHP developer</strong> on a large scale consumer website.  
    My experience is in using <strong>PHP</strong>, <strong>MySQL</strong>, <strong>Ajax</strong> and <strong>JSON</strong>.  
    I really enjoy creative brainstorming...taking a problem apart and narrowing 100 solutions down to the best one.
    <br/><br/>
    Thanks for stopping by.  Be sure to <a href="/contact">drop me a line</a>.
  </div>
  
  <script type="text/javascript" id="__PTG" src="http://www.photagious.com/js/api.js"></script>
  <script>
    el = document.createElement('script');
    el.type = 'text/javascript';
    el.src  = '/js/compress3.js|'+__jsInc.join('|');
    document.body.appendChild(el);
  </script>
  <script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
  <script type="text/javascript">
    _uacct = "UA-88708-4";
    urchinTracker();
  </script>  
</body>
</html>
