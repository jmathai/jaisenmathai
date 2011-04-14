  <div id="featured-div">
    {{#featured-title}}
      {{>featured}}
    {{/featured-title}}
  </div>
  <!-- content -->
  <div id="content-outer" class="clear">
    <div id="content-wrap">
      <div id="content">
        <div id="left">      
          {{#body}}
            {{{body}}}
          {{/body}}
          <!--
            <div class="entry">
            <h3><?php echo function_exists('bloginfo') ? bloginfo('name') : $subtitle; ?></h3>
            </div>
          -->
