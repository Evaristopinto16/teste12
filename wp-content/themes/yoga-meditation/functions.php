<?php
/**
 * Theme functions and definitions
 *
 * @package Yoga Meditation
 */ 

if ( ! function_exists( 'yoga_meditation_enqueue_styles' ) ) :
	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	function yoga_meditation_enqueue_styles() {
		wp_enqueue_style( 'yoga-studio-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'yoga-meditation-style', get_stylesheet_directory_uri() . '/style.css', array( 'yoga-studio-style-parent' ), '1.0.0' );
		// Theme Customize CSS.
		require get_parent_theme_file_path( 'inc/extra_customization.php' );
		wp_add_inline_style( 'yoga-meditation-style',$yoga_studio_custom_style );
	}
endif;
add_action( 'wp_enqueue_scripts', 'yoga_meditation_enqueue_styles', 99 );

function yoga_meditation_setup() {
	add_theme_support( 'align-wide' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'yoga-meditation-featured-image', 2000, 1200, true );
	add_image_size( 'yoga-meditation-thumbnail-avatar', 100, 100, true );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'yoga-meditation' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, and column width.
	*/
	add_editor_style( array( 'assets/css/editor-style.css', yoga_studio_fonts_url() ) );
}
add_action( 'after_setup_theme', 'yoga_meditation_setup' );

function yoga_meditation_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'yoga-meditation' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'yoga-meditation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'yoga-meditation' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'yoga-meditation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'yoga-meditation' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'yoga-meditation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'yoga-meditation' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'yoga-meditation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'yoga-meditation' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'yoga-meditation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'yoga-meditation' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'yoga-meditation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'yoga_meditation_widgets_init' );

function yoga_meditation_remove_my_action() {
    remove_action( 'admin_menu','yoga_studio_gettingstarted' );
    remove_action( 'after_setup_theme','yoga_studio_notice' );
}
add_action( 'init', 'yoga_meditation_remove_my_action');

function yoga_meditation_customize_register() {
  	global $wp_customize;

  	$wp_customize->remove_section( 'yoga_studio_pro' );	

	$wp_customize->remove_setting( 'yoga_studio_top_text' );
	$wp_customize->remove_control( 'yoga_studio_top_text' );

}
add_action( 'customize_register', 'yoga_meditation_customize_register', 11 );

function yoga_meditation_customize( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_stylesheet_directory_uri() ). '/assets/css/customizer.css');

	$wp_customize->add_section('yoga_meditation_pro', array(
		'title'    => __('UPGRADE YOGA PREMIUM', 'yoga-meditation'),
		'priority' => 1,
	));

	$wp_customize->add_setting('yoga_meditation_pro', array(
		'default'           => null,
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control(new Yoga_Meditation_Pro_Control($wp_customize, 'yoga_meditation_pro', array(
		'label'    => __('YOGA MEDITATION PREMIUM', 'yoga-meditation'),
		'section'  => 'yoga_meditation_pro',
		'settings' => 'yoga_meditation_pro',
		'priority' => 1,
	)));

    $wp_customize->add_setting('yoga_meditation_email',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('yoga_meditation_email',array(
		'label' => esc_html__('Add Email Address','yoga-meditation'),
		'section' => 'yoga_studio_top',
		'setting' => 'yoga_meditation_email',
		'type'    => 'text'
	));

	// About
	$wp_customize->add_section( 'yoga_meditation_about_section' , array(
    	'title'      => __( 'About Settings', 'yoga-meditation' ),
		'priority'   => 3,
	) );

	$args = array('numberposts' => -1); 
	$post_list = get_posts($args);
	$pst_sls[]= __('Select','yoga-meditation');
	foreach ($post_list as $key => $p_post) {
		$pst_sls[$p_post->ID]=$p_post->post_title;
	}

	$wp_customize->add_setting('yoga_meditation_about_post_setting',array(
		'sanitize_callback' => 'yoga_studio_sanitize_select',
	));
	$wp_customize->add_control('yoga_meditation_about_post_setting',array(
		'type'    => 'select',
		'choices' => $pst_sls,
		'label' => __('Select post','yoga-meditation'),
		'section' => 'yoga_meditation_about_section',
	));

	wp_reset_postdata();

}
add_action( 'customize_register', 'yoga_meditation_customize' );

function yoga_meditation_enqueue_comments_reply() {
  if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
    // Load comment-reply.js (into footer)
    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
  }
}
add_action(  'wp_enqueue_scripts', 'yoga_meditation_enqueue_comments_reply' );

define('YOGA_MEDITATION_PRO_LINK',__('https://www.ovationthemes.com/wordpress/Yogi-wordpress-theme/','yoga-meditation'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Yoga_Meditation_Pro_Control')):
    class Yoga_Meditation_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
            <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( YOGA_MEDITATION_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE YOGA PREMIUM','yoga-meditation');?> </a>
            </div>
            <div class="col-md">
                <img class="yoga_meditation_img_responsive " src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png">
            </div>
            <div class="col-md">
                <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('Yoga Meditation PREMIUM - Features', 'yoga-meditation'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'yoga-meditation');?> </li>
                    <li class="upsell-yoga_meditation"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'yoga-meditation');?> </li>
                </ul>
            </div>
            <div class="col-md upsell-btn upsell-btn-bottom">
                <a href="<?php echo esc_url( YOGA_MEDITATION_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE YOGA PREMIUM','yoga-meditation');?> </a>
            </div>
        </label>
    <?php } }
endif;