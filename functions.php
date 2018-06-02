<?
add_action( 'wp_enqueue_scripts', 'theme_enqueue_custom_scripts' ); 
function theme_enqueue_custom_scripts() {

  $theme_url = get_stylesheet_directory_uri();
  /*  Scripts  */
  wp_register_script( 'main-script',  $theme_url.'/script/main.js', array('jquery'), "1");
  wp_enqueue_script( 'main-script' );

  wp_register_script( 'popper',  $theme_url.'/script/popper.min.js', array('jquery'), "1");
  wp_enqueue_script( 'popper' );

  wp_register_script( 'bootstrap',  $theme_url.'/script/bootstrap.min.js', array('jquery'), "1");
  wp_enqueue_script( 'bootstrap' );

  wp_register_style('main', get_stylesheet_uri());
  wp_enqueue_style('main');

  //  Since were using jquery slim to make bootstrap happy
  // wp_deregister_script('jquery');

}

add_action('init', 'init_remove_support',100);
function init_remove_support(){
    $post_type = 'homepage_circles';
    remove_post_type_support( $post_type, 'editor');
}

register_nav_menus( array(
  'primary-menu' => __( 'Primary Navigation', 'bean' ),
  'mobile-menu'  => __( 'Mobile Navigation', 'bean' ),
));

function wpse_remove_edit_post_link( $link ) {
    return '';
}
add_filter('edit_post_link', 'wpse_remove_edit_post_link');


//  Add posts AJAX endpoint
//  
add_action( 'wp_ajax_get_resource_card_info', 'get_resource_card_info' );
add_action( 'wp_ajax_nopriv_get_resource_card_info', 'get_resource_card_info' );

function alphasort($a, $b) {
  return strcmp(strtolower($a['title']), strtolower($b['title']));
}

function get_resource_card_info() {
  $alpha = $_POST['alpha'];
  $cats = $_POST['cats'];
  $location = $_POST['location'];
  $tags = $_POST['tags'];

  $ret = array();

  if($cats === 'true') {
    $cats_array = array();
    foreach(get_categories() as $category) {
      $cats_array[$category->name] = array();
    }
  }

  $query_params['posts_per_page'] = -1;
  $query_params['post_type'] = 'resource';

  if($tags) {
    $query_params['tag__in'] =  $tags;
  }

  if($location) {
      $query_params['meta_query'] = array(
        array(
          'key' => 'location',
          'value' => $location,
          'compare' => 'LIKE'
        )
      );
    }

  query_posts($query_params);

  while(have_posts()) :
  
    the_post();

    // //  Check if this is in the selected location
    // if($location && strpos(strtolower(get_field('location')), $location) === false) {
    //   // echo $location . ' not in ' . get_field('location');
    // } else {
      // echo $location . ' in ' . get_field('location');
      $this_post = array(
        'id' => get_the_ID(),
        'title' => get_the_title(),
        'location' => get_field('location'),
        'category' => get_the_category()[0]->name,
        'website' => get_field('website'),
        'email' => get_field('email'),
        'content' => get_the_content(),
        'phone' => get_field('phone_number') ? get_field('phone_number') : '',
      );

      //  If the sort by categories flag is set, divide results into arrays
      //  Otherwise, put all posts into one array
      if($cats === 'true') {
        foreach(get_the_category() as $category) {
          array_push($cats_array[$category->name], $this_post);  
        }
      } else {
        array_push($ret, $this_post);
      }
    // }
  
  endwhile;

  //  If alphabetical is true, alphabetise
  if($alpha === 'true' && $cats === 'false') { 
    usort($ret, 'alphasort');
  } else if($alpha === 'true' && $cats === 'true') {
    foreach($cats_array as $key => $value) {
      usort($cats_array[$key], 'alphasort');
    }
  }

  if($cats === 'true') {
    echo json_encode($cats_array);
  } else {
    echo json_encode($ret);
  }

  wp_reset_query();

  die();
}

add_action( 'wp_ajax_get_single_resource_card', 'get_single_resource_card' );
add_action( 'wp_ajax_nopriv_get_single_resource_card', 'get_single_resource_card' );

function get_single_resource_card() {
  $id = $_POST['id'];

  $website = get_field('website', $id);
  $email = get_field('email', $id);
  $phone = get_field('phone', $id);

  $this_resource = get_post($id);

  $ret = '';

  $ret .= <<<EOT
  <div class="col-12 col-lg-5 resource-card">
    <h4>{$this_resource->post_title}</h4>
    <p>{$this_resource->post_content}</p>
    <div class="row">
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

  if($website) {
    $ret .= <<<EOT
      <div class="col-12 col-sm-6 website">
        <a target='_blank' href='$website'>
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

  die();
}

add_action( 'wp_ajax_get_tags_list', 'get_tags_list' );
add_action( 'wp_ajax_nopriv_get_tags_list', 'get_tags_list' );

function get_tags_list() {
  $tags = $_POST['tags'];
  $ret = '';

  $tags_arr = explode(',', $tags);

  foreach($tags_arr as $tag) {
    $term = get_term_by('name', $tag, 'post_tag');

    if($term) {
      $ret .= $term->term_id . ',';
    }
  }

  echo substr($ret, 0, -1);

  die();
}

function post_remove ()      //creating functions post_remove for removing menu item
{ 
   remove_menu_page('edit.php');
}

add_action('admin_menu', 'post_remove');  

/*
 * Recurring events in wp-admin: only display first (parent) occurrence in list of Events
 * (i.e. hide child recurring events)
 * 
 * From https://theeventscalendar.com/knowledgebase/hide-recurring-event-instances-in-admin/
 * - https://gist.github.com/cliffordp/81f23a207ab483c9e7c6d910f9b29c0a
 * 2016-07-04 Barry shared this snippet from a previous customer's own/shared customization
 * 
 */
class Events_Admin_List__Remove_Child_Events {
    public function __construct() {
        // Don't kick in unless we're on the edit.php screen
        add_action( 'load-edit.php', array( $this, 'setup' ) );
    }
    public function setup() {
        // Listen out for the main events query
        if ( 'tribe_events' === $GLOBALS[ 'typenow' ] )
            add_action( 'parse_query', array( $this, 'modify' ) );
    }
    function modify( WP_Query $query ) {
        // Run once, only for the main query
        if ( ! $query->is_main_query() ) return;
        remove_action( 'parse_query', array( $this, 'modify') );
        // Only return top level posts as a means of ignoring child posts
        $query->set( 'post_parent', 0 );
    }
}
new Events_Admin_List__Remove_Child_Events;
