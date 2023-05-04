<?php
// Fichier contenant les éléments pour gérer le CSS et les styles du thème


// Fonction de récupération des fichiers CSS
function BazTh_get_theme_css($css_file_type) {

	// Lancement de la fonction
	if ( get_theme_mod('BazTh_main_param_css_generation') == 1 ) {
		BazTh_css_parser();
	}

	// Récupération des fichiers CSS
	$file['css_front'] = str_replace( get_template_directory().'/', '', (glob(get_template_directory()."/script/css/css_front_*.css"))[0] );
	$file['css_editor'] = str_replace( get_template_directory().'/', '', (glob(get_template_directory()."/script/css/css_editor_*.css"))[0] );

	if (
		empty( $file['css_front'] )
		|| empty( $file['css_editor'] )
	) {
		BazTh_css_parser();
		return BazTh_get_theme_css($css_file_type);
	}
	else {
		return $file[$css_file_type];
	}
} // BazTh_get_theme_css



// Fonction d'ajout des scripts nécessaires au thème dans l'éditeur
function BazTh_add_scripts_css_editor() {

	// Custom CSS pour Gutenberg
	add_theme_support( 'editor-styles' );
	// Ajout des feuille CSS dédiée
	add_editor_style( BazTh_get_theme_css('css_editor') );
	add_editor_style( "https://fonts.bunny.net/css?family=megrim:400|quicksand:300,400,500,600,700|source-code-pro:300,300i,400,400i,700");

} // BazTh_add_scripts_css_editor

add_action( 'after_setup_theme', 'BazTh_add_scripts_css_editor' );



// Fonction d'ajout des scripts nécessaires au thème en front
function BazTh_add_scripts_css_front() {
	// Déclaration du thème
	wp_enqueue_style( 'BazTh_CSS_style', get_stylesheet_uri() );

	// Normalisation des styles par défaut
	wp_enqueue_style( 'normalize-styles', "https://ressource.arthurbazin.com/librairie/normalize/v8.0.1/normalize.css");
	wp_enqueue_style( 'Bunny-font', "https://fonts.bunny.net/css?family=megrim:400|quicksand:300,400,500,600,700|source-code-pro:300,300i,400,400i,700", [], null);

	// Styles du thème
	wp_enqueue_style( 'BazTh_CSS_design', get_template_directory_uri() . '/' . BazTh_get_theme_css('css_front'), array(), '1.0', 'all');

} // BazTh_add_scripts_css_front

// Lancement de la fonction
add_action( 'wp_enqueue_scripts', 'BazTh_add_scripts_css_front' );



// Gestion du mode nuit au démarrage
function BazTh_darkmode_auto_activate( $classes ) {

	if (
		isset( $_COOKIE["darkmode"] )
		&& $_COOKIE["darkmode"] == 'true'
	) {
		$classes[] = 'darkmode';
	}

	return $classes;
} // BazTh_darkmode_auto_activate


// Lancement de al fonction
add_filter( 'body_class','BazTh_darkmode_auto_activate' );



/* Fonction :
	BazTh_css_parser()
Description :
	Fonction permettant de fusionner les fichiers css pour limiter le nombre d'appel CSS.
	Le traitement inclu un parse pour remplacer les variables utilisées.
Paramètres :
	Aucun
Retours :
	Aucun
*/
function BazTh_css_parser() {

	// Définition de la date de génération du fichier
	$datetime = new DateTime( "now", new DateTimeZone( 'Europe/Paris' ) );

	// Création de l'entête
	$css_front = '/* Style CSS en front */'."\r\n";
	$css_front .= '/* Date et heure de génération du fichier : '.$datetime->format('d.m.Y, H:i:s').' */'."\r\n"."\r\n";

	$css_editor = '/* Style CSS de l\'éditeur de post */'."\r\n";
	$css_editor .= '/* Date et heure de génération du fichier : '.$datetime->format('d.m.Y, H:i:s').' */'."\r\n"."\r\n";

	// Récupération et fusion des fichiers CSS
	// Pour chaque fichier dans le répertoire CSS
	// Création d'un tableau pour stocker les fichier
	$files = array();
	$dir = new FilesystemIterator(get_template_directory().'/script/css');

	// Association des objets  au tableau
	foreach ($dir as $file) {
		$basename = $file -> getBasename();

		$files[$basename]['pathname'] = $file -> getPathname();
		$files[$basename]['extension'] = $file -> getExtension();
	}

	// Tri du tableau selon les clés
	ksort($files);

	foreach ( $files as $file => $property ) {
		if (
			// S'il possède l'extension CSS
			$property['extension'] == 'css'
			// Si le fichier n'est pas un fichier finalisé
			&& !preg_match('/^css_.*$/', $file)
			// Si le fichier n'est pas un fichier de sauvegarde
			&& !preg_match('/^.*_old.css$/', $file)
			&& !preg_match('/^.*copy.css$/', $file)
		) {
			if (
				// Si le fichier est destiné à l'éditeur
				preg_match('/^0.*$/', $file)
				OR preg_match('/^editor_.*$/', $file)
			) {
				$css_editor .= '/* Fichier CSS : ' . $file . ' */'."\r\n";
				$css_editor .= file_get_contents( $property['pathname'] )."\r\n"."\r\n";
				$css_editor .= '/* *********************************************************************************************************************************** */'."\r\n"."\r\n"."\r\n";
			}

			if (
				// Si le fichier est destiné à l'éditeur
				preg_match('/^0.*$/', $file)
				OR preg_match('/^1.*$/', $file)
			) {
				$css_front .= '/* Fichier CSS : ' . $file . ' */'."\r\n";
				$css_front .= file_get_contents( $property['pathname'] )."\r\n"."\r\n";
				$css_front .= '/* *********************************************************************************************************************************** */'."\r\n"."\r\n"."\r\n";
			}
		}
	}

	// Récupération des variables utilisées dans les fichiers CSS
	$var_style = BazTh_get_style_default_var();

	// Nettoyage des variables (récursivité)
	foreach ( $var_style as $variable => $value ) {
		$var_style[$variable] = BazTh_style_variable_sanitizer( $value, $var_style );
	}


	// Remplacement des variables dans le CSS
	foreach ( $var_style as $code => $value ) {
		$css_front = str_replace('"'.$code.'"', $value, $css_front);
		$css_editor = str_replace('"'.$code.'"', $value, $css_editor);
	}


	// Nettoyage en cas de loupé
	if ( !$css_front OR !is_string( $css_front ) ) {
		$css_front = '';
	}
	if ( !$css_editor OR !is_string( $css_editor ) ) {
		$css_editor = '';
	}


	// Gestion des fichiers
		// Suppression des fichiers
		array_map('unlink', glob(get_template_directory()."/script/css/css_front_*.css"));
		array_map('unlink', glob(get_template_directory()."/script/css/css_editor_*.css"));

		// Ecriture des fichier CSS
		file_put_contents(get_template_directory().'/script/css/css_front_'.$datetime->format('d-m-Y_H-i-s').'.css', $css_front);
		file_put_contents(get_template_directory().'/script/css/css_editor_'.$datetime->format('d-m-Y_H-i-s').'.css', $css_editor);

} //BazTh_css_parser

// Recréation des fichier CSS après sauvegarde du thème
add_action( 'customize_save_after', 'BazTh_css_parser' );



// Fonction de nettoyage des variables CSS
function BazTh_style_variable_sanitizer( $value, $array ) {

	if ( array_key_exists( $value, $array) ){
		$return = BazTh_style_variable_sanitizer( $array[$value], $array );
	}
	else {
		$return = $value;
	}

	return $return;

} //BazTh_style_variable_sanitizer



// Récupération des variables de style
function BazTh_get_style_default_var( $key=null ) {

	// Récupération des variables utilisées dans les fichiers CSS
	require(get_template_directory().'/script/php/var_style.php');

	if ( $key ) {
		return $var_style[$key];
	}
	else {
		return $var_style;
	}

} //BazTh_get_style_default_var




?>