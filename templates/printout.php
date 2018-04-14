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
  $.each(localStorage, function(key, value) {
    if(key.indexOf('resource-') > -1) {
      $('.printout-cards').append(value);
    }
  });

  $('.website').each(function() {
    var link = $(this).find('a').attr('href');
    $(this).find('a').text(link).prepend('<img src="/wp-content/uploads/2018/02/South-Island-Child-web-link-icon.png" alt="">');
    $(this).removeClass('col-sm-6').css('margin-bottom', '15px').css('margin-top', '5px');
  });

})(jQuery);

</script>

