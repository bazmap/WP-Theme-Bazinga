<?php
// Fichier contenant les éléments pour gérer le customizer


function BazTh_customize_register( $wp_customize ) {

	// Panel "Personnalisation du thème"
	$wp_customize->add_panel(
		'BazTh_theme_perso_panel',
		array(
			'title' => 'Personnalisation du thème',
			'description' => 'Personnalisez le style du thème',
			'priority' => 81,
		)
	);



	// Section : Paramètres principaux
	$wp_customize->add_section(
		'BazTh_main_param_sct',
		array(
			'title' => 'Paramètres généraux',
			'priority' => 1,
			'capability' => 'edit_theme_options',
			'panel' => 'BazTh_theme_perso_panel',
		)
	);

	// Génération du css
	$wp_customize->add_setting(
		'BazTh_main_param_css_generation',
		array(
			'default' => false,
			'sanitize_callback' => 'themeslug_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'BazTh_main_param_css_generation',
		array(
			'section' => 'BazTh_main_param_sct',
			'settings' => 'BazTh_main_param_css_generation',
			'label' => 'Génération du CSS à chaque chargement de page (non recommandé)',
			'description' => 'Par défaut le CSS est généré lors de la sauvegarde des personnalisations du thème',
			'type' => 'checkbox',
		)
	);

	function themeslug_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

	// Couleur principale du thème
	$wp_customize->add_setting(
		'BazTh_main_param_theme_main_color',
		array(
			'default' => '#0090FF',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'BazTh_main_param_theme_main_color',
			array(
				'section' => 'BazTh_main_param_sct',
				'settings' => 'BazTh_main_param_theme_main_color',
				'label' => 'Couleur principale du thème',
			)
		)
	);

	// Génération du css
	$wp_customize->add_setting(
		'BazTh_main_param_copyright',
		array(
			'default' => '',
		)
	);

	$wp_customize->add_control(
		'BazTh_main_param_copyright',
		array(
			'section' => 'BazTh_main_param_sct',
			'settings' => 'BazTh_main_param_copyright',
			'label' => 'Mentions légales',
			'description' => 'Syntaxe HTML autorisée',
			'type' => 'textarea',
		)
	);

} //BazTh_customize_register


// Lancement de la fonction
add_action('customize_register','BazTh_customize_register');


?>