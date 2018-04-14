<?php
/**
 * Day View Template
 * The wrapper template for day view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>
<section class="home-needs-popover">
  <? require(get_template_directory() . '/templates/partials/home-needs-popover.php'); ?>
</section>
<div class='container events-menu'>
<?
include(get_template_directory() . '/templates/partials/main-menu.php'); 
?>
</div>
<div class="container">
<?

do_action( 'tribe_events_before_template' );
?>

<!-- Tribe Bar -->
<?php tribe_get_template_part( 'modules/bar' ); ?>

<!-- Main Events Content -->
<?php tribe_get_template_part( 'day/content' ) ?>

</div>
<div class="tribe-clear"></div>

<?php
do_action( 'tribe_events_after_template' );
