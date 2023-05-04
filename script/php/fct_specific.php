<?php
// Fichier contenant des fonctions utilisables n'importe où


/* Fonction :
	BazTh_trim_text($1,$2,$3)
Description :
	Fonction permettant d'élaguer un texte selon un nombre de charactères défini.
	Si le texte contient moins de caractère que le nombre requis pour découpé, le texte est renvoyé tel quel.
Paramètres :
	$1 : Texte à élaguer
	$2 : Nombre de caractère à conserver (par défaut 55)
	$3 : Valeur ajoutée à la fin du texte élagué (par défaut '...')
Retours :
	Le texte élagué.
*/
function BazTh_trim_text($text, $length = 55, $end_char = '...'){
	if ( strlen($text) > $length ) {
		$length_end = strlen($end_char);
		echo substr($text, 0, $length - $length_end).$end_char;
	}
	else {
		echo $text;
	}
} // BazTh_trim_text



/* Fonction :
	BazTh_page_info()
Description :
	Fonction permettant de récupérer le type de page
Paramètres :
	Aucun
Retours :
	Le type de page
*/
function BazTh_page_info() {
	global $wp_query;

	$page_info['type'] = '';

	$page_info['type'] .= $wp_query->is_singular() ? 'singular/' : '';
		$page_info['type'] .= $wp_query->is_single() ? 'single/' : '';
			$page_info['type'] .= $wp_query->is_attachment() ? 'attachement/' : '';
		$page_info['type'] .= $wp_query->is_page() ? 'page/' : '';
	$page_info['type'] .= $wp_query->is_front_page() ? 'front/' : '';
		$page_info['type'] .= $wp_query->is_home() ? 'home/' : '';
	$page_info['type'] .= $wp_query->is_404() ? '404/' : '';
	$page_info['type'] .= $wp_query->is_search() ? 'search/' : '';
	$page_info['type'] .= $wp_query->is_archive() ? 'archive/' : '';
		$page_info['type'] .= $wp_query->is_author() ? 'author/' : '';
		$page_info['type'] .= $wp_query->is_category() ? 'category/' : '';
		$page_info['type'] .= $wp_query->is_tag() ? 'tag/' : '';
		$page_info['type'] .= $wp_query->is_tax() ? 'taxonomy/' : '';
		$page_info['type'] .= $wp_query->is_date() ? 'date/' : '';
			$page_info['type'] .= $wp_query->is_year() ? 'year/' : '';
			$page_info['type'] .= $wp_query->is_month() ? 'month/' : '';
			$page_info['type'] .= $wp_query->is_day() ? 'day/' : '';

	$page_info['type'] = substr($page_info['type'],0,-1);
	
	return $page_info;
} // BazTh_page_info


?>