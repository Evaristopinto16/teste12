<?php 

	$yoga_studio_sticky_header = get_theme_mod('yoga_studio_sticky_header');

	$yoga_studio_custom_style= "";

	if($yoga_studio_sticky_header != true){

		$yoga_studio_custom_style .='.menu_header.fixed{';

			$yoga_studio_custom_style .='position: static;';
			
		$yoga_studio_custom_style .='}';
	}