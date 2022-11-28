<?php
/**
 * The header for our theme
 *
 * @subpackage Yoga Meditation
 * @since 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
	    do_action( 'wp_body_open' );
	}
?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'yoga-meditation' ); ?></a>
	<?php if( get_theme_mod('yoga_studio_theme_loader','') != ''){ ?>
		<div class="preloader">
			<div class="load">
			  <hr/><hr/><hr/><hr/>
			</div>
		</div>
	<?php }?>
	<div id="page" class="site">
		<div id="header">
			<div class="wrap_figure">
				<div class="top_bar py-2 text-center text-lg-left text-md-left">
					<div class="container">
						<div class="row">
							<div class="col-lg-9 col-md-9 align-self-center">
								<?php if( get_theme_mod('yoga_meditation_email') != '' ){ ?>
									<span><i class="fas fa-envelope mr-3"></i><?php echo esc_html(get_theme_mod('yoga_meditation_email','')); ?></span>
								<?php }?>
								<?php if( get_theme_mod('yoga_studio_phone') != ''){ ?>
									<span class="ml-md-4"><i class="fas fa-phone mr-3"></i><?php echo esc_html(get_theme_mod('yoga_studio_phone','')); ?></span>
								<?php }?>
								<?php if( get_theme_mod('yoga_studio_address') != ''){ ?>
									<span class="ml-md-4"><i class="fas fa-map-marker-alt mr-3"></i><?php echo esc_html(get_theme_mod('yoga_studio_address','')); ?></span>
								<?php }?>
							</div>
							<div class="col-lg-3 col-md-3 align-self-center">
								<div class="links text-center text-lg-right text-md-right">
									<?php if( get_theme_mod('yoga_studio_linkdin') != ''){ ?>
										<a href="<?php echo esc_url(get_theme_mod('yoga_studio_linkdin','')); ?>"><i class="fab fa-linkedin-in mr-2"></i></a>
									<?php }?>
									<?php if( get_theme_mod('yoga_studio_instagram') != ''){ ?>
										<a href="<?php echo esc_url(get_theme_mod('yoga_studio_instagram','')); ?>"><i class="fab fa-instagram mr-2"></i></a>
									<?php }?>
									<?php if( get_theme_mod('yoga_studio_facebook') != ''){ ?>
										<a href="<?php echo esc_url(get_theme_mod('yoga_studio_facebook','')); ?>"><i class="fab fa-facebook-f mr-2"></i></a>
									<?php }?>
									<?php if( get_theme_mod('yoga_studio_pintrest') != ''){ ?>
										<a href="<?php echo esc_url(get_theme_mod('yoga_studio_pintrest','')); ?>"><i class="fab fa-pinterest-p mr-2"></i></a>
									<?php }?>
									<?php if( get_theme_mod('yoga_studio_youtube') != ''){ ?>
										<a href="<?php echo esc_url(get_theme_mod('yoga_studio_youtube','')); ?>"><i class="fab fa-youtube mr-2"></i></a>
									<?php }?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="menu_header py-3">
					<div class="container">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-6 col-12 align-self-center">
								<div class="logo text-center text-md-left text-sm-left py-3 py-md-0">
							        <?php if ( has_custom_logo() ) : ?>
					            		<?php the_custom_logo(); ?>
						            <?php endif; ?>
					              	<?php $yoga_studio_blog_info = get_bloginfo( 'name' ); ?>
						                <?php if ( ! empty( $yoga_studio_blog_info ) ) : ?>
						                  	<?php if ( is_front_page() && is_home() ) : ?>
						                    	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						                  	<?php else : ?>
					                      		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					                  		<?php endif; ?>
						                <?php endif; ?>
						                <?php
					                  		$yoga_studio_description = get_bloginfo( 'description', 'display' );
						                  	if ( $yoga_studio_description || is_customize_preview() ) :
						                ?>
					                  	<p class="site-description">
					                    	<?php echo esc_html($yoga_studio_description); ?>
					                  	</p>
					              	<?php endif; ?>
							    </div>
							</div>
							<div class="col-lg-7 col-md-6 col-sm-3 col-6 align-self-center">
								<?php if(has_nav_menu('primary')){?>
									<div class="toggle-menu gb_menu">
										<button onclick="yoga_studio_gb_Menu_open()" class="gb_toggle p-2"><i class="fas fa-ellipsis-h"></i><p class="mb-0"><?php esc_html_e('Menu','yoga-meditation'); ?></p></button>
									</div>
								<?php }?>
				   				<?php get_template_part('template-parts/navigation/navigation'); ?>
							</div>
							<div class="col-lg-2 col-md-3 col-sm-3 col-6 align-self-center">								
								<?php if( get_theme_mod('yoga_studio_button_text') != '' || get_theme_mod('yoga_studio_button_link') != ''){ ?>
									<div class="top_btn">
										<a href="<?php echo esc_url(get_theme_mod('yoga_studio_button_link','')); ?>"><?php echo esc_html(get_theme_mod('yoga_studio_button_text','')); ?></a>
									</div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>