<?php
/**
 * Template part for displaying the header branding section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oceanly
 */

$oceanly_show_site_title_desc_wrap = Oceanly\Helpers::show_site_title_or_tagline();
$oceanly_site_branding_class       = $oceanly_show_site_title_desc_wrap ? '' : ' site-branding--no-title-tagline';
?>

<div class="site-header-branding">
	<div class="site-branding-wrap c-wrap">

		<div class="<?php echo esc_attr( 'site-branding site-branding--sm-' . Oceanly\Helpers::branding_alignment_sm() . ' site-branding--md-' . Oceanly\Helpers::branding_alignment_md() . ' site-branding--sm-logo-' . Oceanly\Helpers::logo_alignment_sm() . ' site-branding--md-logo-' . Oceanly\Helpers::logo_alignment_md() . ' site-branding--sm-logo-size-' . Oceanly\Helpers::logo_size_sm() . ' site-branding--md-logo-size-' . Oceanly\Helpers::logo_size_md() . ' site-branding--lg-logo-size-' . Oceanly\Helpers::logo_size_lg() . $oceanly_site_branding_class ); ?>">
			<?php
			the_custom_logo();

			if ( $oceanly_show_site_title_desc_wrap ) {
				?>
			<div class="site-title-desc-wrap">
				<?php
				if ( Oceanly\Helpers::show_site_title() ) {
					if ( is_front_page() && is_home() ) {
						?>
						<h1 class="<?php echo esc_attr( 'site-title site-title--sm-size-' . Oceanly\Helpers::site_title_size_sm() . ' site-title--md-size-' . Oceanly\Helpers::site_title_size_md() ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					} else {
						?>
						<p class="<?php echo esc_attr( 'site-title site-title--sm-size-' . Oceanly\Helpers::site_title_size_sm() . ' site-title--md-size-' . Oceanly\Helpers::site_title_size_md() ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					}
				}

				if ( Oceanly\Helpers::show_site_tagline() ) {
					?>
					<p class="<?php echo esc_attr( 'site-description site-desc--sm-size-' . Oceanly\Helpers::site_tagline_size_sm() . ' site-desc--md-size-' . Oceanly\Helpers::site_tagline_size_md() ); ?>"><?php bloginfo( 'description' ); ?></p>
					<?php
				}
				?>
			</div><!-- .site-title-desc-wrap -->
				<?php
			}
			?>
		</div><!-- .site-branding -->

	</div><!-- .site-branding-wrap -->
</div><!-- .site-header-branding -->
