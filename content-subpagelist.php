<?php
$subpages = get_pages(array('parent' => get_the_ID()));

if (!empty($subpages)){
  foreach ($subpages as $post){
    setup_postdata($post);
    ?>
    <h2>
      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
    </h2>
    <?php
    if (get_option('show_byline_on_posts')) :
    ?>
    <div class="author-info">
        <?php the_author(); ?>
        <p class="author-desc"> <small><?php the_author_meta(); ?></small></p>
    </div>
    <?php
    endif;
    the_excerpt();
  }
}
