<?
  $loc = array_key_exists('location', $_GET) ? $_GET['location'] : '';
  $tag = array_key_exists('tag', $_GET) ? $_GET['tag'] : '';
  $circle_id = array_key_exists('id', $_GET) ? $_GET['id'] : '';
  $circle = '';

  if($circle_id) {
    $circle = get_post($circle_id);
  }

?>

<div class="container">
  <? include('main-menu.php'); ?>
</div>

<div class="toggle-row">
  <div class="container">
    <div class="row">
    <?
      if($circle) {
        ?>
        <div class="col-12 tag-meta">
          <p>You are currently viewing resources related to the question: <em><? the_field('text', $circle->ID); ?></em></p> 
        </div>
        <div class="col-12 tag-meta">
          <p><a href='/resources'>Click here to view all resources &rsaquo;&rsaquo;</a></p>
        </div>
        <div class="col-auto tag-meta">
          
        </div>
        <?
      }
    ?>

    <?
      if($tag == -1) {
        ?>
        <div class="col-12 tag-meta">
          <p>There were no resources related to your query.</p> 
        </div>
        <?
      }
    ?>

      <div class="col-12">
        <p>Sort by</p>
      </div>

      <div class="dropdown">
        <button class="dropdown-toggle" type="button" id="location-dropdown-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?
          if($loc == 'victoria') {
            echo 'Victoria';
          } else if($loc == 'sooke') {
            echo 'Sooke/West Shore';
          } else if ($loc == 'peninsula') {
            echo 'Peninsula';
          } else {
            echo 'Location';
          }
          ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="location-dropdown-open">
          <a class="dropdown-item">All Locations</a>
          <a class="dropdown-item <? echo $loc == 'victoria' ? 'selected' : ''; ?>" id='victoria'>Victoria</a>
          <a class="dropdown-item <? echo $loc == 'sooke' ? 'selected' : ''; ?>" id='sooke'>Sooke/Westshore</a>
          <a class="dropdown-item <? echo $loc == 'peninsula' ? 'selected' : ''; ?>" id='peninsula'>Peninsula</a>
        </div>
      </div>

      <div class="resource-toggle alpha off">
        <p>Alphabetical</p>
        <span></span>
      </div>
      <div class="resource-toggle cats off">
        <p>Categories</p>
        <span></span>
      </div>
    </div>
  </div>
</div>

<div class="container cards">
  <div class="row justify-content-center cards">
  <?
    $query_params['posts_per_page'] = -1;
    $query_params['post_type'] = 'resource';

    if($loc) {
      $query_params['meta_query'] = array(
        array(
          'key' => 'location',
          'value' => $loc,
          'compare' => 'LIKE'
        )
      );
    }



    if($tag && $tag != -1) {
      $query_params['tag__in'] = $tag;

      //  If there are tags set in the URL, place a hidden div indicating it so JS can filter properly
      echo <<<EOT
        <div style='visibility: hidden; width: 0px; height: 0px;' class='url_tags' data-tags='$tag'></div>
EOT;
    }

    query_posts($query_params);
  
    while(have_posts()) :
      the_post();
      $id = get_the_id();
      $title = get_the_title();
      $desc = get_the_content();
      $email = get_field('email');
      $link = get_field('website');
      $files = get_field('files');
      $this_loc = get_field('location');
      $phone = get_field('phone_number');

      $ret = '';

      $ret .= <<<EOT
      <div class="col-12 col-lg-5 resource-card">
        <h4>$title</h4>
        <p>$desc</p>
        <div class="row card-meta">
EOT;
      
      if($email) {
        $ret .= <<<EOT
          <div class="col-12 email">
            <a href='#'>
              <img src="/wp-content/uploads/2018/02/South-Island-Child-envelope.png" alt="">
              $email
            </a>
          </div>
EOT;
      }

      if($link) {
        $ret .= <<<EOT
          <div class="col-12 col-sm-6 website">
            <a target='_blank' href='$link'>
              <img src="/wp-content/uploads/2018/02/South-Island-Child-web-link-icon.png" alt="">
              Visit website
            </a>
          </div>
EOT;
      }

      $ret .= <<<EOT
        <div class="col-12 col-sm-6">
          <a href="#" class='fave' data-id='$id'>
            <img src="/wp-content/uploads/2018/02/South-Island-Child-printer-icon.png" alt="">
            Save favourite resources to one single page to print
          </a>
        </div>
EOT;
      
      if($phone) {
        $ret .= <<<EOT
          <div class="col-12 col-sm-6">
            <a href="tel:$phone">
              <img class='phone-icon' src="/wp-content/uploads/2018/04/phone-icon-SIC.png" alt="">
              $phone
            </a>
          </div>
EOT;
      }

      $ret .= <<<EOT
        </div>
      </div>
EOT;

    echo $ret;

    endwhile;
  ?>

  <div class="cards-loading-overlay">
  <svg class="lds-spinner" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><g transform="rotate(0 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(30 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(60 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(90 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(120 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(150 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(180 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(210 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(240 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(270 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(300 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(330 50 50)">
  <rect x="48" y="23" rx="4.8" ry="2.3000000000000003" width="4" height="14" fill="#000000">
    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate>
  </rect>
</g></svg>
</div>
  </div>
</div>


