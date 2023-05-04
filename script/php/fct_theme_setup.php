<?php
// Fichier de paramétrage du thème


// Taille maximale des éléments dont la taille est basée sur le contenu
if ( ! isset( $content_width ) ) {
	$content_width = 800;
};



// Fonction de définition des paramètres du thème
function BazTh_setup() {

	// Activation des traductions
	load_theme_textdomain( 'BazTh', get_template_directory() . '/languages' );

	// Activation des vignettes de post
	add_theme_support( 'post-thumbnails' );

	// Activation des liens de flux RSS dans le <head>
	add_theme_support( 'automatic-feed-links' );

	// Gestion des titre par WordPress
	add_theme_support( 'title-tag' );

	// Gestion de l'image d'en-tête
	$defaults_header_image = array(
		'default-image'          => '',
		'width'                  => 1980,
		'height'                 => 80,
		'flex-height'            => true,
		'flex-width'             => true,
		'uploads'                => true,
		'random-default'         => false,
		'header-text'            => false,
		'default-text-color'     => '',
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $defaults_header_image );

	// Activation du HTML5 pour les éléments
	$html5_defaults = array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
		'style',
		'script'
	);
	add_theme_support( 'html5', $html5_defaults );

	// Suppression de la bar d'administration
	show_admin_bar(false);

}; // BazTh_setup

// Lancement de la fonction
add_action( 'after_setup_theme', 'BazTh_setup' );



function BazTh_add_scripts_js() {
	// JS
	wp_enqueue_script( 'BazTh_JS', get_template_directory_uri() . '/script/js/function.js', array ( 'jquery' ), 1.2, true);
} // BazTh_add_scripts_js

// Lancement de la fonction
add_action( 'wp_enqueue_scripts', 'BazTh_add_scripts_js' );



// Asynchronisme des scripts JS
function BazTh_defer_script( $url, $handle ){

	// On ne change rien si l'utilisateur est connecté (pour ne pas casser l'administration)
	if (
		!is_user_logged_in()
		&& strpos( $url, '.js' ) !== FALSE
		&& strpos( $url, 'jquery.js' ) === FALSE
	){
		return str_replace( ' src', ' defer src', $url );
	}

	return $url;
}

// Lancement de la fonction
// Non utilisé pour le moment car bloc enlighter sur mobile
//add_filter( 'script_loader_tag', 'BazTh_defer_script', 10, 2 );


// Custom de l'administration
function BazTh_admin_custom() {

	// Modification des palettes
	$color_palette_default = array(

		array( 'name' => 'Bleu dodger', 	'slug' => 'bleu-dodger', 		'color' => '#0090FF'),	// rgb(0, 144, 255)
		array( 'name' => 'Violet électric', 'slug' => 'violet-electric', 	'color' => '#9000FF'),	// rgb(144, 0, 255)
		array( 'name' => 'Violet foncé', 	'slug' => 'violet-fonce', 		'color' => '#240B36'),	// rgb(36, 11, 54)
		array( 'name' => 'Orange', 			'slug' => 'orange', 			'color' => '#FF9000'),	// rgb(255, 144, 0)
		array( 'name' => 'Rose', 			'slug' => 'rose', 				'color' => '#FF0090'),	// rgb(255, 0, 144)
		array( 'name' => 'Rouge', 			'slug' => 'rouge', 				'color' => '#FF1E1E'),	// rgb(255, 30, 30)
		array( 'name' => 'Rouge rosé', 		'slug' => 'rouge-rose', 		'color' => '#C31432'),	// rgb(195, 20, 50)
		array( 'name' => 'Vert jaune', 		'slug' => 'vert-jaune', 		'color' => '#90FF00'),	// rgb(144, 255, 0)
		array( 'name' => 'Vert clair', 		'slug' => 'vert-clair', 		'color' => '#00FF90'),	// rgb(0, 255, 144)
		array( 'name' => 'Vert foncé', 		'slug' => 'vert-fonce', 		'color' => '#007070'),	// rgb (0, 112, 112)
		array( 'name' => 'Noir', 			'slug' => 'noir', 				'color' => '#000000'),	// rgb(0, 0, 0)
		array( 'name' => 'Gris très clair', 'slug' => 'gris-tres-clair', 	'color' => '#F0F0FF'),	// rgb(240, 240, 255)
		array( 'name' => 'Gris clair', 		'slug' => 'gris-clair', 		'color' => '#D2D2DC'),	// rgb (210, 210, 220)
		array( 'name' => 'Gris moyen', 		'slug' => 'gris-moyen', 		'color' => '#808092'),	// rgb (128, 128, 146)
		array( 'name' => 'Gris fonc2', 		'slug' => 'gris-fonce', 		'color' => '#24232D'),	// rgb (36, 35, 45)
	);
	add_theme_support( 'editor-color-palette', $color_palette_default );

	// Activation du thème sombre
	add_theme_support( 'dark-editor-style' );

} // BazTh_admin_custom

add_action( 'after_setup_theme', 'BazTh_admin_custom' );



// Favicon
function style_favicon() {
	?>
	<link rel="icon" type="image/png" sizes="16x16" href="<?php print(get_template_directory_uri()); ?>/media/favicon_16.png" >
	<link rel="icon" type="image/png" sizes="32x32" href="<?php print(get_template_directory_uri()); ?>/media/favicon_32.png" >
	<link rel="icon" type="image/png" sizes="64x64" href="<?php print(get_template_directory_uri()); ?>/media/favicon_64.png" >
	<link rel="icon" type="image/png" sizes="72x72" href="<?php print(get_template_directory_uri()); ?>/media/favicon_72.png" >
	<link rel="icon" type="image/png" sizes="96x96" href="<?php print(get_template_directory_uri()); ?>/media/favicon_96.png" >
	<link rel="icon" type="image/png" sizes="128x128" href="<?php print(get_template_directory_uri()); ?>/media/favicon_128.png" >
	<link rel="icon" type="image/png" sizes="256x256" href="<?php print(get_template_directory_uri()); ?>/media/favicon_256.png" >
	<link rel="apple-touch-icon" sizes="72x72" href="<?php print(get_template_directory_uri()); ?>/media/favicon_72.png" >
	<link rel="apple-touch-icon" sizes="96x96" href="<?php print(get_template_directory_uri()); ?>/media/favicon_96.png" >
	<link rel="apple-touch-icon" sizes="128x128" href="<?php print(get_template_directory_uri()); ?>/media/favicon_128.png" >
	<link rel="apple-touch-icon" sizes="256x256" href="<?php print(get_template_directory_uri()); ?>/media/favicon_256.png" >
	<?php
}
add_action('wp_head', 'style_favicon');


function style_admin_favicon() {
	?>
	<link rel="icon" type="image/png" href="<?php print(get_template_directory_uri()); ?>/media/favicon_admin_64.png" >
	<link rel="icon" type="image/png" sizes="64x64" href="<?php print(get_template_directory_uri()); ?>/media/favicon_admin_64.png" >
	<link rel="icon" type="image/png" sizes="256x256" href="<?php print(get_template_directory_uri()); ?>/media/favicon_admin_256.png" >
	<?php
}
add_action('login_head', 'style_admin_favicon');
add_action('admin_head', 'style_admin_favicon');



// Page de login
// Logo
function style_login() {
	?>
		<style type="text/css">
			#login h1 a,
			.login h1 a {
				height: 180px;
				width: 180px;

				border-radius: 10px;

				background-color: <?php print(BazTh_get_style_default_var( '[[main_color_theme]]' )); ?>;
				background-image: url("<?php print(get_template_directory_uri()); ?>/media/logo.svg");
				background-size: 180px 180px;
				background-repeat: no-repeat;
			}

			.language-switcher {
				display: none;
			}
		</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'style_login' );

// Lien du logo
function logo_login_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'logo_login_url' );


function logo_login_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertext', 'logo_login_url_title' );



// Dashboard
// Modification du logo
function admin_wordpress_logo() {
	?>
		<style type="text/css">
			#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
				background-color: <?php print(BazTh_get_style_default_var( '[[main_color_theme]]' )); ?>;
				background-image: url("<?php print(get_template_directory_uri()); ?>/media/logo.svg") !important;
				background-size: 20px 20px;
				background-position: 0 0;
				color:rgba(0, 0, 0, 0);
			}

			#wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
				background-position: 0 0;
			}
		</style>
	<?php
}

//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'admin_wordpress_logo');




?>