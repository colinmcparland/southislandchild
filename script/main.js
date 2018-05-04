(function($) {

  function populateResourceCards(data) {

    $('.resource-card, .cards h2').remove();

    data = JSON.parse(data);

    var keys = Object.keys(data);

    //  Handle categories
    if($('.cats').hasClass('on')) {
      for(var i = 0; i < keys.length; i++) {
        let thiskey = keys[i];
        if(data[thiskey].length > 0) {
          $('.cards > .row').append('<div class="col-12 offset-1"><h2>' + thiskey + '</h2></div>') 
        }
        for(var j = 0; j < data[thiskey].length; j++) {
          var thisdata = data[thiskey][j];
          var newCard = ' \
          <div class="col-12 col-lg-5 resource-card">\
            <h4>' + thisdata.title + '</h4>\
            <p>' + thisdata.content + '</p>\
            <div class="row">';

          if(thisdata.email) {
            newCard += '<div class="col-12 mail">\
            <a href="#">\
              <img src="/wp-content/uploads/2018/02/South-Island-Child-envelope.png" alt="">\
              ' + thisdata.email + '\
            </a>\
          </div>';
          }

          if(thisdata.website) {
            newCard += '<div class="col-12 col-sm-6 website">\
                <a target="_blank" href="' + thisdata.website + '">\
                  <img src="/wp-content/uploads/2018/02/South-Island-Child-web-link-icon.png" alt="">\
                  Visit website\
                </a>\
              </div>';
          }

          newCard += '<div class="col-12 col-sm-6"><a class="fave" data-id="' + thisdata.id + '" href="#">\
            <img src="/wp-content/uploads/2018/02/South-Island-Child-printer-icon.png" alt="">\
            Save favourite resources to one single page to print\
          </a></div>';

          if(thisdata.phone) {
            newCard += '<div class="col-12 col-sm-6">\
                <a href="tel:"' + thisdata.phone + '">\
                  <img class="phone-icon" src="/wp-content/uploads/2018/04/phone-icon-SIC.png" alt="">\
                  ' + thisdata.phone + '\
                </a>\
              </div>';
          }

          newCard += '</div></div>';

          $('.cards > .row').append(newCard);
        }
      }
    }

    for(var i = 0; i < data.length; i++) {
          var newCard = ' \
          <div class="col-12 col-lg-5 resource-card">\
            <h4>' + data[i].title + '</h4>\
            <p>' + data[i].content + '</p>\
            <div class="row">';

          if(data[i].email) {
            newCard += '<div class="col-12 mail">\
            <a href="#">\
              <img src="/wp-content/uploads/2018/02/South-Island-Child-envelope.png" alt="">\
              ' + data[i].email + '\
            </a>\
          </div>';
          }

          if(data[i].website) {
            newCard += '<div class="col-12 col-sm-6 website">\
                <a target="_blank" href="' + data[i].website + '">\
                  <img src="/wp-content/uploads/2018/02/South-Island-Child-web-link-icon.png" alt="">\
                  Visit website\
                </a>\
              </div>';
          }

          newCard += '<div class="col-12 col-sm-6"><a class="fave" href="#" data-id="' + data[i].id + '">\
            <img src="/wp-content/uploads/2018/02/South-Island-Child-printer-icon.png" alt="">\
            Save favourite resources to one single page to print\
          </a></div>';

          if(data[i].phone) {
            newCard += '<div class="col-12 col-sm-6">\
                <a href="tel:"' + data[i].phone + '">\
                  <img class="phone-icon" src="/wp-content/uploads/2018/04/phone-icon-SIC.png" alt="">\
                  ' + data[i].phone + '\
                </a>\
              </div>';
          }

          newCard += '</div></div>';

      $('.cards > .row').append(newCard);
    }
  }

  function adjustCircleHeight() {
    var circle = $('.home-needs-popover .circle');

    if (circle.length) {
      $('.home-needs-popover .circle').css('height', circle.outerWidth());

    var circle = $('.home-needs .circle');
      $('.home-needs .circle').css('height', circle.outerWidth());
    }
  }


  function showHomeNeedsPopover() {
    $('.home-needs-popover').fadeIn(function()  {
      $('.home-needs-popover').css('display', 'flex');
    });
  }

  function closeHomeNeedsPopover() {
    $('.home-needs-popover').fadeOut();
  }

  function handleToggleClick(target) {
    target.toggleClass('on off');
  }

  function getPosts(alpha, cats, location, tags) {
    return $.ajax({
      url: '/wp-admin/admin-ajax.php',
      method: 'POST',
      data: {
        action: 'get_resource_card_info',
        alpha: alpha,
        cats: cats,
        location: location,
        tags: tags
      }
    });
  }

  function getSingleResourceCard(id) {
    return $.ajax({
      url: '/wp-admin/admin-ajax.php',
      method: 'POST',
      data: {
        id: id,
        action: 'get_single_resource_card',
      }
    });
  }

  function highlightMenuItem() {
    if($('#tribe-events').length) {
      $('.menu .events').addClass('active');
    }
    else if($('.about-landing').length) {
      $('.menu .about').addClass('active');
    }
    else if($('.resource-card').length) {
      $('.menu .all-programmes').addClass('active');
    }
  }

  function adjustNumberParagraphHeights() {
    var paragraphs = $('.home-instructions .steps p');
    var h = 0;

    $(paragraphs).each(function() {
      if($(this).outerHeight() > h) {
        h = $(this).outerHeight();
      }
    });

    paragraphs.css('height', h);
  }

  function logoVideoListener() {
    $('video:not(.loop)').on('ended', function() {

      $('video:not(.loop)').css('display', 'none');
      $('.loop').css('display', 'block');
      $('video.loop').get(0).play();
    });
  }

  function updatePrintOutMessage(id) {

    if(id == undefined) {
      $.each(localStorage, function(key, value) {
        if(key.indexOf('resource-') > -1) {
          var id = key.split('-')[1];
          $('.resource-card').each(function()  {
            if($(this).find('.fave').data('id') == id) {
              $(this).find('.fave').html('<img src="/wp-content/uploads/2018/02/South-Island-Child-printer-icon.png" alt="">Remove this resource from printing');
            }
          })
        }
      })  
    } else {

      if(localStorage['resource-' + id]) {
        $('.fave').each(function() {
          if($(this).data('id') == id) {
            $(this).html('<img src="/wp-content/uploads/2018/02/South-Island-Child-printer-icon.png" alt="">Remove this resource from printing');
          }
        })
      } else {
        $('.fave').each(function() {
          if($(this).data('id') == id) {
            $(this).html('<img src="/wp-content/uploads/2018/02/South-Island-Child-printer-icon.png" alt="">Save favourite resources to one single page to print');

          }
        })
      }
    }
  }



  $(document).ready(function()  {
    adjustCircleHeight();
    highlightMenuItem();
    logoVideoListener();
    updatePrintOutMessage();



    $('.header-search, .instruction-search').on('submit', function(e) {
      $('html, body').css('cursor', 'wait');
      e.preventDefault();
      var content = $(this).find('input').val();
      content = content.replace(/\W+/g,",");

      console.log(content);

      $.ajax({
        url: '/wp-admin/admin-ajax.php',
        method: 'POST',
        data: {
          action: 'get_tags_list',
          tags: content
        }
      }).done(function(data) { 
        if(data == '') {
          data = -1;
        }
        
        location.href = location.origin + '/resources?tag=' + data;
      });

    })

    window.addEventListener('load', function() {

      adjustNumberParagraphHeights();
      
      if($('video.intro').length) {
        $('video.intro').get(0).play();
        setTimeout(function() {
          $('.loading-overlay').fadeOut();
          $('html, body').scrollTop(0);
        }, 500);
      } else {
        $('.loading-overlay').css('display', 'none');
      }
    });

    $(document).on('click', '.fave', function(e) {
      console.log('click');
      e.preventDefault();
      var id = $(this).data('id');
      var flag = 0;

      $.each(localStorage, function(key, val) {
        if(key.indexOf('resource-') > -1) {
          var this_id = key.split('-')[1];
          if(this_id == id) {
            localStorage.removeItem('resource-' + this_id);
            updatePrintOutMessage(id);
            flag = 1;
          }
        }
      });

      if(flag == 0) {
        getSingleResourceCard(id).done(function(data) {
          localStorage.setItem('resource-' + id, data.toString());
          updatePrintOutMessage(id);
        })
      }

    })

    // if(localStorage.getItem('date') != null) {
    //   $('.custom-event-bar-month').val(localStorage.getItem('date'));
    // }

    // if(localStorage.getItem('loc') != null) {
    //   $('.custom-event-bar-location').val(localStorage.getItem('loc'));
    // }

    $('.all-programmes').on('click', function() {
      showHomeNeedsPopover();
      adjustCircleHeight();
    });

    $('.home-needs-popover .close').on('click', function()  {
      closeHomeNeedsPopover();
    })

    $('.resource-toggle span').on('click', function(e) {
      handleToggleClick($(this).parent());
    })

    $('.dropdown a').on('click', function() {
      $(this).parent().prev().text($(this).text());
      $('.dropdown a').removeClass('selected');
      $(this).addClass('selected');
    })

    $('.dropdown a, .resource-toggle span').on('click', function() {
      $('.cards .cards-loading-overlay').fadeIn().css('display', 'flex');
      getPosts($('.alpha').hasClass('on'), $('.cats').hasClass('on'), $('.dropdown .selected').attr('id'), $('.url_tags').data('tags'))
        .done(function(data)  {
          populateResourceCards(data);
          $('.cards .cards-loading-overlay').fadeOut();
          updatePrintOutMessage();
        });
    })

    $('.scrollto').click(function() {
      var area = $(this).attr('id').split('-');
      area.shift();
      area = area.join('-');
      var top = $('.'+area).offset().top;
      $('html, body').animate({
        scrollTop: top
      }, 1000);
    });


    $('.custom-event-bar-month').on('change', function()  {
      console.log('change');
      var selectedDate = $(this)[0].value;
      console.log(selectedDate);
      //  Update datepicker
      $("#tribe-bar-date").bootstrapDatepicker('setDate', new Date(selectedDate));
      // localStorage.setItem('date', $(this)[0].value);
      $('.tribe-bar-submit input').trigger('click');
    })

    // $('.custom-event-bar-month').on('blur', function()  {
    //   $('#tribe-bar-date').val($(this)[0].value);
    //   localStorage.setItem('date', $(this)[0].value);
    //   $('.tribe-bar-submit input').click();
    // })

    $('.custom-event-bar-location').on('change', function()  {
      $('#tribe-bar-geoloc').val($(this)[0].value);
      // localStorage.setItem('loc', $(this)[0].value);
      $('.tribe-bar-submit input').trigger('click');
    })

    // $('.custom-event-bar-location').on('blur', function()  {
    //   console.log('blur');
    //   $('#tribe-bar-geoloc').val($(this)[0].value);
    //   localStorage.setItem('loc', $(this)[0].value);
    //   $('.tribe-bar-submit input').trigger('click');
    // })

    $(document).on('click', '.mail a', function(e) {
      e.preventDefault();
      var text = $(this).text();

      var input = '<input class="copy-input" style="position: absolute; left: -9999px;" />';

      $(this).append(input);

      $('.copy-input').val(text).focus().select();

      document.execCommand('copy');

      $('.alert').text('Email copied to clipboard.');

      $('.alert-container').fadeIn();

      setTimeout(function() {
        $('.alert-container').fadeOut();
      }, 5000);
    })
    

  });


})(jQuery);