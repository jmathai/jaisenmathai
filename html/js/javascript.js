function typeHeader()
{
  var rand = parseInt(Math.random()*10);
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

  var start = function()
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

      document.getElementById('header-banner').innerHTML = current.substring(0,pos).replace(relt,'&lt;').replace(regt,'&gt;');
      setTimeout(start,wait);
    }

  start();
}

typeHeader();
