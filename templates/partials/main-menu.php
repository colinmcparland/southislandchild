<div class="row justify-content-center align-items-start">
  <div class="col-6 col-md-4">
    <a href="/">
      <div class="logo">
        <video src="/wp-content/uploads/2018/04/Intro-comp.mp4" class='intro' muted playsinline poster="http://dummyimage.com/320x240/ffffff/fff"></video>
        <video src="/wp-content/uploads/2018/04/Loop_Small-1.mp4" class='loop' loop muted playsinline poster="http://dummyimage.com/320x240/ffffff/fff"></video>
      </div>
    </a>
  </div>
  <div class="col-12 col-md-8 menu">
    <div class="row justify-content-end">

      <?
      foreach( wp_get_nav_menu_items(2) as $menu_item ) :
        $title = $menu_item->title;
        $link = $menu_item->url;
        $class = $menu_item->classes[0];
        echo <<<EOT
          <div class='col-4 col-lg-auto $class'><a href='$link'>$title</a></div>
EOT;

      endforeach;
      ?>
    </div>
  </div>
</div>