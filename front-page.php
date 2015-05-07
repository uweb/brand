<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>

  <div class="uw-hero-image" <?php if ( has_post_thumbnail() ) : ?>style="background-image: url( <?php uw_thumbnail_url(); ?>)" <?php endif; ?> >

  <div class="container">
    <h1><?php the_title();?></h1>
    <div class="udub-slant"></div>
    <p>
    <?php echo apply_filters('the_content', $post->post_excerpt); ?>
    </p>
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
            $page_slugs = array('logos', 'colors', 'fonts', 'downloads'); //insert page slugs
            foreach ($page_slugs as $slug ) :
              $page = get_page_by_path($slug);
              if (!empty($page)):
              ?>
              <div class="elment element-<?php echo $slug ?>">
                <a href="<?php echo get_permalink($page->ID) ?>" title="<?php echo esc_attr($page->post_title) ?>">
                  <?php echo $page->post_title ?>
                  <p><?php echo get_post_meta($page->ID, 'preview', true) ?></p>
                </a>
              </div>


              <?php
              endif;
            endforeach;
            ?>

        </div>
      </div>
    </div>

    <div id='home-content' class="row">
      <?php the_content(); ?>
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
