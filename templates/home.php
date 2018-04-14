<?
/*  Template Name:  Homepage  */
get_header();

?>

<section class='home-landing'>
  <? require('partials/home-landing.php'); ?>
</section>

<section class="home-instructions">
  <? require('partials/home-instructions.php'); ?>
</section>

<section class="home-needs">
  <? require('partials/home-needs.php'); ?>
</section>

<section class="home-needs-popover">
  <? require('partials/home-needs-popover.php'); ?>
</section>

<?
get_footer();
?>