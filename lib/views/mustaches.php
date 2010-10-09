var templates = {
  home : <?php echo EpiCode::json(EpiCode::get('home.html')); ?>,
  resume : <?php echo EpiCode::json(EpiCode::get('resume.html')); ?>,
  portfolio : <?php echo EpiCode::json(EpiCode::get('portfolio.html')); ?>,
  code : <?php echo EpiCode::json(EpiCode::get('code.html')); ?>,
  articles : <?php echo EpiCode::json(EpiCode::get('articles.html')); ?>,
  contact : <?php echo EpiCode::json(EpiCode::get('contact.html')); ?>,
  about: <?php echo EpiCode::json(EpiCode::get('about.html')); ?>
}
var partials = <?php echo EpiCode::json(getPartials()); ?>;
