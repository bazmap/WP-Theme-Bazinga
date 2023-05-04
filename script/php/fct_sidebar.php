<?php
// Fichier contenant la définition des zones de widget

// Fonction de définition des zones de widget (sidebar)
function BazTh_sidebar_setup() {

	// Activation de la zone de widget dans les articles
	register_sidebar(
		array(
			'name'          => 'Sidebar des articles',
			'id'            => 'sidebar_post',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);

	// Activation des zones de widget dans le footer
	register_sidebar(
		array(
			'name'          => 'Zone de widget du footer (gauche)',
			'id'            => 'footer_left',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Zone de widget du footer (droite)',
			'id'            => 'footer_right',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);

}; // BazTh_sidebar_setup

// Lancement de la fonction
add_action( 'after_setup_theme', 'BazTh_sidebar_setup' );



// Taille des tags dans les nuages d'étiquettes
function BazTh_set_tag_cloud_sizes($args) {
	$defaults = array(
		'smallest' => 12,
		'default' => 15,
		'largest' => 20,
		'unit' => 'px'
	);
 
	$args = wp_parse_args( $defaults, $args );

	return $args;
}; // BazTh_set_tag_cloud_sizes

// Lancement de la fonction
add_filter('widget_tag_cloud_args','BazTh_set_tag_cloud_sizes');



?>