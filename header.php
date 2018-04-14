<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title><? echo get_bloginfo('title'); ?> | <? echo get_bloginfo('description'); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="loading-overlay">
  <video src='/wp-content/uploads/2018/04/Loop_Small-1.mp4' autoplay loop muted playsinline poster="https://dummyimage.com/320x240/ffffff/fff"></video>
  <h2>Loading...</h2>
</div>
<div class="wrapper">
<header id="header" role="banner">
<div class="container alert-container">
  <div class="row justify-content-center">
    <div class="col-auto alert alert-info">
      
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row align-items-center">
    <div class="col-lg-2 col-md-3 col-6 order-3 order-md-2 order-lg-1">
      <a href='mailto:joanne@snplace.org'>
        <img src="/wp-content/uploads/2018/02/South-Island-Child-envelope.png" alt="Email for help" />
        Email for help
      </a>
    </div>
    <div class="col-lg-5 col-12 order-1 order-md-1 order-lg-2 message">
      Virtual home of the Sooke/Westshore, Victoria and Peninsula Early Years Centres 
    </div>
    <div class="col-lg-2 col-md-6 col-12 order-2 order-md-3 order-lg-3">
      <form class='header-search'>
        <img style="margin-right: 15px;" src="/wp-content/uploads/2018/02/search.png" alt="Search Submit" /> 
        <input type="text" name="search" placeholder='Search website'>
        <input type="submit" hidden name="search-submit" />
      </form>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-6 print order-4 order-md-4 order-lg-4">
      <a target="_blank" href='/print'>
        Print saved resources
        <img src='/wp-content/uploads/2018/02/South-Island-Child-printer-icon.png' alt="Print saved resources" />
      </a>
    </div>
  </div>
</div>
</header>