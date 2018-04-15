<?
/*  Template Name: Printout  */

get_header();

?>

<style>
#header {
  display: none;
}

.fave {
  display: none;
}

.printout-cards {
  padding-top: 50px;
}
</style>

<div class="container">
  <div class="row printout-cards">
  </div>
</div>

<script>

(function($) {
  var count = 0;
  $.each(localStorage, function(key, value) {
    count++;
    if(key.indexOf('resource-') > -1) {
      $('.printout-cards').append(value);
    }
  });

  if(count === 0) {
    $('.printout-cards').append("<h2>You haven't saved any resources yet.  Click the printer icon on a resource card to save it to this page, where you can print them all at once.</h2><img style='display: block; margin-top: 25px;' src='/wp-content/uploads/2018/04/fave.png' /><a style='display: block; margin-top: 25px; width: 100%;' href='" + document.referrer + "'><h2>Go back ></h2></a>");
  }

  $('.website').each(function() {
    var link = $(this).find('a').attr('href');
    $(this).find('a').text(link).prepend('<img src="/wp-content/uploads/2018/02/South-Island-Child-web-link-icon.png" alt="">');
    $(this).removeClass('col-sm-6').css('margin-bottom', '15px').css('margin-top', '5px');
  });

})(jQuery);

</script>

