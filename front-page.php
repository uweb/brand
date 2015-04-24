<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>

  <div class="uw-hero-image" <?php if ( has_post_thumbnail() ) : ?>style="background-image: url( <?php uw_thumbnail_url(); ?>)" <?php endif; ?> >

  <div class="container">
    <?php the_content() ?>
  </div>

  </div>



<div class="uw-body-wrap">

  <div class="container uw-body expanding" style='background-color:inherit'>

    <div class="row">

      <div class="col-md-12 uw-content expanding-inner" role='main'>


       <h2 class="uw-site-title"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><?php bloginfo(); ?></a></h2>


        <div class="uw-body-copy">
          <h2>Resources</h2>

            <?php
            $category_ids = array(3, 9, 23, 24, 18, 13, 12, 4); //change these as needed
            foreach ($category_ids as $term_id ) :
              $category = get_category($term_id);
              if (!empty($category)):
              ?>
              <div class="elment <?php if ($category->category_count == '0') { ?>empty <?php } ?>element-<?php echo $category->category_nicename ?>">
                <a href="<?php echo get_category_link( $term_id ) ?>" title="<?php echo esc_attr($category->name) ?>">
                  <?php echo $category->name ?>
                  <p><?php echo $category->category_description; ?></p>
                </a>
              </div>


              <?php
              endif;
            endforeach;

            //following is for non-featured categories that need to be exposed
            $id_string = implode(',', $category_ids);
            $categories_more = get_categories( array( 'hide_empty' => false , 'exclude' => $id_string ) ) ;
            foreach ($categories_more as $category ) :
              if (!empty($category)):
              ?>
              <div class="elment hidden <?php if ($category->category_count == '0') { ?>empty <?php } ?>element-<?php echo $category->category_nicename ?>">
                <a href="<?php echo get_category_link( $category->term_id ) ?>" title="<?php echo esc_attr($category->name) ?>">
                  <?php echo $category->name ?>
                  <p><?php echo $category->category_description; ?></p>
                </a>
              </div>


              <?php
              endif;
            endforeach;
            ?>

        </div>
      </div>
    </div>
    <div class='row'>
      <div class='col-md-12 more'>
        <a id='see_more' class="uw-btn btn-go btn-sm" href="#">See more</a>
      </div>
    </div>

  </div>

</div>

<?php endwhile; ?>

<div class="search-box">
  <div class="container">
     <div class="row">
       <div class="col-md-8 col-md-offset-2">
          <?php get_search_form(); ?>
          <div id="brand-results"></div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
