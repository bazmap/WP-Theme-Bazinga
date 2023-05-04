<?php
// Bazingas Theme - Function file


// Fichiers spécifiques de paramétrage
require_once('script/php/fct_theme_setup.php');
require_once('script/php/fct_menu.php');
require_once('script/php/fct_sidebar.php');
require_once('script/php/fct_customizer.php');
require_once('script/php/fct_style.php');
require_once('script/php/fct_specific.php');

// Retrait de WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

?>