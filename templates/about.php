<?
/*  Template Name:  About Page  */
get_header();
global $post;
?>

<section class="about-landing">
  <? include('partials/about-landing.php'); ?>
</section>

<div class="container">
  <div class="row">
    <div class="col-12">
      <? echo apply_filters('the_content', $post->post_content); ?>
    </div>
  </div>
</div>

<section class="home-needs-popover">
  <? require('partials/home-needs-popover.php'); ?>
</section>

<?
get_footer();
?>
