        </div><!-- id="left" -->
      </div> <!-- id="content" -->
    </div> <!-- id="content-wrap" -->
  </div> <!-- id="content-outer" -->
</div> <!-- wrap ends here -->
<script>
  <?php if(PROD) { ?>
    var _gaq = _gaq || [];
    _gaq.push(function() { var pageTracker = _gat._createTracker('UA-88708-4', 'jm'); });
    _gaq.push(['jm._trackPageview']);
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  <?php } ?>
</script>
</body>
</html>
