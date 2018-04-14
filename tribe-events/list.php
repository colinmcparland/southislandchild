<?php
/**
 * List View Template
 * The wrapper template for a list of events. This includes the Past Events and Upcoming Events views
 * as well as those same views filtered to a specific category.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

do_action( 'tribe_events_before_template' );

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

	<!-- Tribe Bar -->
<?php tribe_get_template_part( 'modules/bar' ); ?>

	<!-- Main Events Content -->
<?php tribe_get_template_part( 'list/content' ); ?>

  </div>
	<div class="tribe-clear"></div>

<?php
do_action( 'tribe_events_after_template' );
