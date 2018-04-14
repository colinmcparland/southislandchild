<?
$querystr = 'posts_per_page=-1&post_type=homepage_circles';
query_posts($querystr);

while(have_posts()) :

  the_post();

  $text = get_field('text');
  $border = get_field('border_color');
  $background = get_field('background_color');
  $tags = get_field('resources_tag');
  $tags_formatted = '';
  $id = get_the_id();

  foreach($tags as $tag) {
    $tags_formatted .= $tag . ',';
  }

  $tags_formatted = substr($tags_formatted, 0, -1);

  echo <<<EOT
    <div class="col-12 col-sm-6 col-md-4 circle-container">
      <a href="/resources?tag=$tags_formatted&id=$id">
        <div class='circle' style="background-color: $background; border-color: $border;">
          $text
        </div>
      </a>
    </div>
EOT;

endwhile;
?>
