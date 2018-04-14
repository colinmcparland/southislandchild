<?php
/**
 * Month View Template
 * The wrapper template for month view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month.php
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

<div class="container events-month">

<div class="row justify-content-center">
  <div class="col-10 message">
    South Island Child has all sorts of groups for caregivers and kids every week.  Most are free, and all are welcoming and inclusive of all people. We’ve put together these listings with the help of various groups. We’ve done our best to stay up to date, but it can be a good idea to confirm times before you show up.
  </div>
</div>
<?
// Tribe Bar
tribe_get_template_part( 'modules/bar' );

//  Replacement bar with custom styling
include(get_template_directory() . '/templates/partials/events-bar.php');

// Main Events Content
tribe_get_template_part( 'month/content' );

?>
</div>
<?

do_action( 'tribe_events_after_template' );