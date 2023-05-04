<?php

// Liste des variables utilisées dans les feuilles de style CSS

$var_style = array (

	// Couleurs
		'[[main_color_theme]]' => get_theme_mod('BazTh_main_param_theme_main_color'),


	// Icones
		'[[default_main_menu_link_icon]]' => 'BazTh_ico BazTh_ico_link_light', //'fas fa-link',
		'[[default_post_icon]]' => 'BazTh_ico BazTh_ico_newspaper_light', //'far fa-file',
		'[[default_page_icon]]' => 'BazTh_ico BazTh_ico_page_light', //'far fa-file',
		'[[default_tag_icon]]' => 'BazTh_ico BazTh_ico_tags_light', //'fas fa-tag',
		'[[default_taxonomy_icon]]' => '[[default_tag_icon]]',
		'[[default_category_icon]]' => 'BazTh_ico BazTh_ico_folder_open_light', //'far fa-folder-open',
		'[[default_date_icon]]' => 'BazTh_ico BazTh_ico_calendar_light', //'far fa-calendar-alt',
		'[[default_accueil_icon]]' => 'BazTh_ico BazTh_ico_home_light', //'fas fa-home',
		'[[default_404_icon]]' => 'BazTh_ico BazTh_ico_angry_light', //'far fa-tired',
		'[[default_attachement_icon]]' => 'BazTh_ico BazTh_ico_archive_light', //'fas fa-archive',
		'[[default_author_icon]]' => 'BazTh_ico BazTh_ico_user_circle_light', //'far fa-user-circle',
		'[[default_search_icon]]' => 'BazTh_ico BazTh_ico_search', //'fas fa-search',
		'[[default_home_icon]]' => 'BazTh_ico BazTh_ico_folder_open_light', //'far fa-folder-open',
		'[[default_archive_icon]]' => 'BazTh_ico BazTh_ico_folder_open_light', //'far fa-folder-open',


	// Tailles mobiles
		/*
		x = largeur page

		x > 1086 px
			menu - text - toc
			text.flex-basis : 579px

		837 px < x < 1086 px
			toc
			menu - text
			text.flex-basis : 600px

		x < 837 px
			menu
			toc
			text
			text.flex-basis : 600px
		*/
		'[[screen_size_mobile]]' => '837px',
		'[[screen_size_tablet]]' => '1086px',
);



// Image header
if ( get_header_image() ) {
	$var_style['[[header_image]]'] = get_header_image();
}
else {
	$var_style['[[header_image]]'] = get_template_directory_uri()."/media/header_background.jpg";
}

?>