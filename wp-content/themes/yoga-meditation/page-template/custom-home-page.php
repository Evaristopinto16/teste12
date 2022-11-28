<?php
/**
 * Template Name: Custom Home Page
 */
get_header(); ?>

<main id="content">
  <?php if( get_theme_mod('yoga_studio_slider_arrows') != ''){ ?>
    <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <?php
          for ( $yoga_studio_i = 1; $yoga_studio_i <= 4; $yoga_studio_i++ ) {
            $yoga_studio_mod =  get_theme_mod( 'yoga_studio_post_setting' . $yoga_studio_i );
            if ( 'page-none-selected' != $yoga_studio_mod ) {
              $yoga_studio_slide_post[] = $yoga_studio_mod;
            }
          }
           if( !empty($yoga_studio_slide_post) ) :
          $yoga_studio_args = array(
            'post_type' =>array('post'),
            'post__in' => $yoga_studio_slide_post
          );
          $yoga_studio_query = new WP_Query( $yoga_studio_args );
          if ( $yoga_studio_query->have_posts() ) :
            $yoga_studio_i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php  while ( $yoga_studio_query->have_posts() ) : $yoga_studio_query->the_post(); ?>
          <div <?php if($yoga_studio_i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <div class="image-content">
              <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
              <div class="carousel-caption text-center">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
              </div>
            </div>
          </div>
          <?php $yoga_studio_i++; endwhile;
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon px-3 py-2" aria-hidden="true"><i class="fas fa-long-arrow-alt-left"></i></span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon px-3 py-2" aria-hidden="true"><i class="fas fa-long-arrow-alt-right"></i></span>
          </a>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php }?>

  <?php if( get_theme_mod('yoga_studio_services_section_title') != '' || get_theme_mod('yoga_studio_services_section_text') != '' || get_theme_mod('yoga_studio_category_setting') != ''){ ?>
    <section id="services-box" class="py-5">
      <div class="container">
        <h3 class="text-center mb-2"><?php echo esc_html( get_theme_mod( 'yoga_studio_services_section_title','') ); ?></h3>
        <p class="text-center mb-5"><?php echo esc_html( get_theme_mod( 'yoga_studio_services_section_text','') ); ?></p>
        <div class="row">
          <?php
            $yoga_studio_services_category=  get_theme_mod('yoga_studio_category_setting');if($yoga_studio_services_category){
            $yoga_studio_page_query = new WP_Query(array( 'category_name' => esc_html($yoga_studio_services_category ,'yoga-meditation')));?>
              <?php while( $yoga_studio_page_query->have_posts() ) : $yoga_studio_page_query->the_post(); ?>  
                <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="box mb-lg-5 mb-3 text-center">
                    <div class="img-box mb-3">
                      <?php the_post_thumbnail(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>"><h4><?php the_title();?></h4></a>
                  </div>
                </div>
              <?php endwhile;
            wp_reset_postdata();
          }?>
        </div>
      </div>
    </section>
  <?php }?>

  <?php if( get_theme_mod('yoga_meditation_about_post_setting') != '' ){ ?>
    <div class="about-box pb-5 text-center text-md-left text-sm-left">
      <div class="container">
        <div class="row">
          <?php
            $yoga_meditation_mod =  get_theme_mod( 'yoga_meditation_about_post_setting');
            if ( 'page-none-selected' != $yoga_meditation_mod ) {
              $yoga_meditation_about_post[] = $yoga_meditation_mod;
            }
            if( !empty($yoga_meditation_about_post) ) :
            $yoga_meditation_args = array(
              'post_type' =>array('post'),
              'post__in' => $yoga_meditation_about_post
            );
            $yoga_meditation_query = new WP_Query( $yoga_meditation_args );
            if ( $yoga_meditation_query->have_posts() ) :
          ?>
          <?php  while ( $yoga_meditation_query->have_posts() ) : $yoga_meditation_query->the_post(); ?>            
            <div class="col-lg-7 col-md-7 col-sm-7 align-self-center">
              <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
              <p><?php echo esc_html(wp_trim_words(get_the_content(),'100') );?></p>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 align-self-center">
              <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
            </div>
          <?php endwhile;
          wp_reset_postdata();?>
            <?php else : ?>
            <div class="no-postfound"></div>
            <?php endif;
          endif;?>
        </div>
      </div>
    </div>
  <?php }?>
</main>

<?php get_footer(); ?>