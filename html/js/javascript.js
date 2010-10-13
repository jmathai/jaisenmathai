var jm = (function() {
  var rand = parseInt(Math.random()*10);
  var tpls = {};
  $("div#nav ul li").each(function(i, el){
    var a = $(el).children().filter("a");
    if($(a).attr("tpl"))
      tpls[$(a).attr("href")] = $(a).attr("tpl");
  });
  var tpls = {"/":"home","/resume.html":"resume","/portfolio.html":"portfolio","/code.html":"code","/articles.html":"articles","/contact.html":"contact"};
  //var _ptg = new PTG("656ff15dffa1a18c53c94b242da917f9");
  return {
    typer: function()
      {
        if(status == 1 && pos == str1.length)
        {
          wait = 100;
          status = 2;
        }
        else
        if(status == 2 && pos == cpos)
        {
          current = str2;
          wait = 200;
          status = 3;
        }
        else
        if(status == 3 && pos == str2.length)
        {
          status = 4;
        }

        switch(status)
        {
          case 1:
            pos++;
            break;
          case 2:
            pos--;
            break;
          case 3:
            pos++;
            break;
        }
        
        if(status < 4) // kill recursion once typing is done
        {
          document.getElementById('header-banner').innerHTML = current.substring(0,pos).replace(relt,'&lt;').replace(regt,'&gt;');
          setTimeout(start,wait);
        }
      },
      typeHeader: function() {
        switch(rand)
        {
          case 0:
          case 5:
            var str1 = '<'+'?php echo "Welcome to my page!"; ?'+'>';
            var str2 = "<"+"?php echo 'Welcome to my page!'; ?"+">";
            var cpos = 11;
            break;
          case 1:
          case 6:
            var str1 = "<"+"?php $bool = $status == false; ?"+">";
            var str2 = "<"+"?php $bool = $status === false; ?"+">";
            var cpos = 23;
            break;
          case 2:
          case 7:
            var str1 = "<"+"?php $obj = new Object(); $obj->method(); ?"+">";
            var str2 = "<"+"?php Object::method(); ?"+">";
            var cpos = 8;
            break;
          case 3:
          case 8:
            var str1 = "<"+"?php if(preg_match('/^start/', $subject)){ ?"+">";
            var str2 = "<"+"?php if(strncmp($subject, 'start', 5) == 0){ ?"+">";
            var cpos = 9;
            break;
          case 4:
          case 9:
            var str1 = "<"+"?php if(strlen($string) < 10){ ?"+">";
            var str2 = "<"+"?php if(!isset($string{10})){ ?"+">";
            var cpos = 9;
            break;
        }

        var pos = 0;
        var wait= 200;
        var current = str1;
        var status = 1;
        var relt = /\</g;
        var regt = /\>/g;
        start();
      },
      ptg: {
        load: function(){
          var limit = 45;
          $.getJSON('http://photos.jaisenmathai.com/api/json?action=image.search&privacy=1&tags=favorites&limit='+limit+'&offset=0&order=dateTaken&callback=?&authenticationKey=656ff15dffa1a18c53c94b242da917f9', function(data) {
            var photoGroup = $("#footer-outer p.thumbs");
            $.each(data, function(i, photo) {
              if(photo.name == null){ photo.name = 'This photo has no title.'; }
              var lsrc = ptg.html.customImageLockSrc(photo.thumbnailPath, photo.key, photo.width, photo.height, 800, 600);
              var tsrc = ptg.html.customImageSrc(photo.thumbnailPath, photo.key, 40, 40)
              $(photoGroup).append('<a href="'+lsrc+'" title="'+photo.name+'" target="_blank"><img src="'+tsrc+'" width="40" height="40"></a>');
              if(i == (limit-1))
                setupZoom();
            });
          });
        },
        render: function(response){
          var p, i;
          for(i in response) {
            p = response[i];
            console.log(p.thumbnailPath);
          }
        }
      },
      click: function(ident, loc) {
        var tplIndex, tpl;
        if(ident.search("http://") == 0)
          tplIndex = ident.substring(url.indexOf("/", 7));
        else
          tplIndex = ident;
        tpl = tpls[tplIndex];

        if(ident == '/') { // home
          ajax = '/ajax.json';
        } else {
          ajax = ident.replace('.html', '/ajax.json');
        }

        // fetch view
        $.get(ajax, {}, function(response) {
          if(_gaq != undefined)
            _gaq.push(['jm._trackPageview', ident]);
          var body = Mustache.to_html(templates[tpl], response, partials);
          if(response['featured-title']) {
            var featured = Mustache.to_html(partials['featured'], response, partials);
            $("div#featured-div").html(featured);
          } else {
            $("div#featured-div").html('');
          }

          //update body
          $("div#left").html(body);
          // update title
          $("span#header-title").html(response.title);
          // update qr code
          $("div#header-image").attr("class", "default").addClass(tpl);        
          // update url
          location.href = loc + '#' + ident;
          // hide loader
          $("div#nav ul li.last").hide();
          // code highlight
          dp.SyntaxHighlighter.HighlightAll('code');
        }, 'json');
      }
  };
})();
