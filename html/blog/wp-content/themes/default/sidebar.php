	<div id="sidebar">
		<ul>
      <li>
        <div id="custom-sidebar"></div>
      </li>
      <li>
        <ul>
					<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
					<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
				</ul>
			</li>
		</ul>
	</div>

  <?php if(strstr($_SERVER['REQUEST_URI'], '/blog') !== false){ ?>
    <script src="/js/blog-ptg.js" type="text/javascript"></script>
  <?php } ?>
