<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<head>
  <style type="text/css">
    @import url("/css/resume.css?1");
  </style>
  <title>
    <?php if(!empty($title)) { ?>
      <?php echo $title; ?>
    <?php } else { ?>
      <?php echo bloginfo('name'); ?>
    <?php } ?>
    :: Jaisen Mathai  
  </title>
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
  
  <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
  </script>
  <script type="text/javascript">
    _uacct = "UA-88708-4";
    urchinTracker();
  </script>
</body>

</html>
