<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<head>
  <style type="text/css">
    @import url("/css/resume.css?1");
  </style>
  <title></title>
</head>

<body>
  <div>
    <?php
      if(is_file($body))
      {
        //EpiCode::insert($body);
        include $body;
      }
      else
      {
        echo $body;
      }
    ?>
  </div>
</body>

</html>
