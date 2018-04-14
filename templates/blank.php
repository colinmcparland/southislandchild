<?
/*  Template Name: Blank Page  */
?>

<?php get_header(); ?>
<? global $post; ?>
<div class="container single-page">
  <? include('partials/main-menu.php'); ?>
  <div class="row single-page-content">
    <div class="col-12">
      <? echo apply_filters('the_content', $post->post_content); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>