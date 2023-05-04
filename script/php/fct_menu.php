<?php
// Fichier contenant la définition des menus


// Fonction de définition des menus
function BazTh_menu_setup() {

	// Activation du menu principal
	register_nav_menus(
		array(
			'menu_main'	=> 'Menu principal',
			'menu_superior'	=> 'Menu Supérieur',
		)
	);

}; // BazTh_menu_setup

// Lancement de la fonction
add_action( 'after_setup_theme', 'BazTh_menu_setup' );



// Fonctions supplémentaires

// Menu
// Contenu des objets "menu"
//foreach( $menu_items as $menu_item ){
	/*
	$menu_item[ID] = id de l'élément du menu
	$menu_item[title] = Nom d'afficahe de l'élément
	$menu_item[menu_item_parent] = id de l'élément parent (si élément parent)
	$menu_item[object_id] = id de l'artcile ou de la page
	$menu_item[object] = type d'objet (post/page/categorie...)
	$menu_item[type] = type (post-type/taxonomie...)
	$menu_item[type_label] = libellé du type
	$menu_item[url] = url de l'item
	$menu_item[target] = target de l'item
	$menu_item[attr_title] = attribut "title" de l'url
	$menu_item[description] = description de l'item
	$menu_item[classes] = array : classes rattachées à l'item
	*/
//}



// Modification des classes présentes dans les éléments "li" des menus
// Ajout du slug dans le cas des catégories, des articles et des pages
function BazTh_navigation_menu_li_class( $classes, $item, $args, $depth ) {

	if ( $item->type == 'post_type' ) {
		$classes[] = get_post( $item->object_id )->post_name ;
	}
	elseif ( $item->type == 'taxonomy' ) {
		$classes[] = get_term( $item->object_id )->slug ;
	}

	return $classes;

} // BazTh_navigation_menu_li_class

// Lancement de la fonction
add_filter( 'nav_menu_css_class' , 'BazTh_navigation_menu_li_class' , 10, 4 );



// Modification des classes présentes dans les élément "a" des menus
// Ajout du slug dans le cas des catégories, des articles et des pages ainsi que du type de page
// Ajout d'un code JS pour définir la couleur du hover directement dans l'article ou la page
function BazTh_navigation_menu_a_class( $atts, $item, $args, $depth ) {

	// Ajout de classes
	$atts['class'] = $item->type;
	$atts['class'] .= ' '.$item->object ;
	$atts['class'] .= ' '.$item->object_id ;

	if ( $item->type == 'post_type' ) {
		$atts['class'] .= ' '.get_post( $item->object_id )->post_name ;
	}
	elseif ( $item->type == 'taxonomy' ) {
		$atts['class'] .= ' '.get_term( $item->object_id )->slug ;
	}

	// Ajout de couleur de texte et de hover
	

	// Détection si ajout d'une couleur via le menu
	$class_color_perso = preg_grep("/has_color__[a-zA-Z0-9]*/", $item->classes);

	if ( $class_color_perso ) {
		preg_match("/has_color__([a-zA-Z0-9]*)/", $class_color_perso[0], $color_perso);

		if ( $color_perso[1] != '' ) {
			$atts['style'] = 'color:#'.$color_perso[1].';';
			$atts['onmouseover'] = 'this.style.backgroundColor=\'#'.$color_perso[1].'\'; this.style.color=\'#ffffff\'';
			$atts['onmouseout'] = 'this.style.backgroundColor=null; this.style.color=\'#'.$color_perso[1].'\'';
		}
	}
	// Cas des article et des pages
	elseif (
		$item->type == 'post_type' AND $item->object == 'page'
		OR $item->type == 'post_type' AND $item->object == 'post'
	) {
		if ( get_field( 'object_color_code', $item->object_id ) != '' ) {
			$atts['style'] = 'color:'.get_field( 'object_color_code', $item->object_id ).';';
			$atts['onmouseover'] = 'this.style.backgroundColor=\''.get_field( 'object_color_code', $item->object_id ).'\'; this.style.color=\'#ffffff\'';
			$atts['onmouseout'] = 'this.style.backgroundColor=null; this.style.color=\''.get_field( 'object_color_code', $item->object_id ).'\'';
		}
	}
	// Cas des taxonomies
	elseif (
		$item->type == 'taxonomy'
	) {
		if ( get_field( 'object_color_code', $item->object . '_' . $item->object_id ) != '' ) {
			$atts['style'] = 'color:'.get_field( 'object_color_code', $item->object . '_' . $item->object_id ).';';
			$atts['onmouseover'] = 'this.style.backgroundColor=\''.get_field( 'object_color_code', $item->object . '_' . $item->object_id ).'\'; this.style.color=\'#ffffff\'';
			$atts['onmouseout'] = 'this.style.backgroundColor=null; this.style.color=\''.get_field( 'object_color_code', $item->object . '_' . $item->object_id ).'\'';
		}
	}

	// Retour
	return $atts;

} // BazTh_navigation_menu_a_class

// Lancement de la fonction
add_filter( 'nav_menu_link_attributes' , 'BazTh_navigation_menu_a_class' , 10, 4 );



// Encapsulation des textes des liens dans un span
function BazTh_navigation_menu_span_title( $title, $item, $depth, $args ) {
	// Encapsulation des textes de menu
	$title = '<span class="menu_item_title">'.$title.'</span><span class="menu_item_sub_menu_toggle toggle_on">+</span><span class="menu_item_sub_menu_toggle toggle_off">-</span>';

	//print_r($item).print_r('<br><br>');
	return $title;

} // BazTh_navigation_menu_span_title

// Lancement de la fonction
add_filter( 'nav_menu_item_title' , 'BazTh_navigation_menu_span_title' , 10, 4 );



// Ajout d'une icone dans les items du menu
function BazTh_navigation_menu_icon( $title, $item, $depth, $args ) {
	// Ajout d'une icône devant les liens des menus

	// Détection si ajout d'une icone via le menu
	$classes_icon_perso = preg_grep("/has_ico__[a-zA-Z0-9_\-]*/", $item->classes);

	if ( $classes_icon_perso ) {
		$class_icon_perso = '';

		foreach ($classes_icon_perso as $classes_icon_perso_item) {
			preg_match("/has_ico__([a-zA-Z0-9_\-]*)/", $classes_icon_perso_item, $icon_perso);

			$class_icon_perso = $class_icon_perso . ' ' . $icon_perso[1];
		}

		$class = $class_icon_perso;
	}

	// Si lien vers l'accueil
	elseif ( $item->url == '/' ) {
		$class = BazTh_get_style_default_var('[[default_accueil_icon]]');
	}


	// Si lien vers une page
	elseif (
		$item->type == 'post_type'
		AND $item->object == 'page'

	) {
		// on récupère les champs personnalisés s'ils existent : class
		if ( get_field( 'object_icon_class', $item->object_id ) != '' ) {
			$class = get_field( 'object_icon_class', $item->object_id );
		}
		else {
			$class = BazTh_get_style_default_var('[[default_page_icon]]');
		}
	}


	// Si lien vers un article
	elseif (
		$item->type == 'post_type'
		AND $item->object == 'post'

	) {
		// on récupère les champs personnalisés s'ils existent : class
		if ( get_field( 'object_icon_class', $item->object_id ) != '' ) {
			$class = get_field( 'object_icon_class', $item->object_id );
		}
		else {
			$class = BazTh_get_style_default_var('[[default_post_icon]]');
		}
	}


	// Si lien vers une taxonomie (catégorie, étiquette)
	elseif (
		$item->type == 'taxonomy'
	) {
		// on récupère les champs personnalisés s'ils existent : class
		if ( get_field( 'object_icon_class', $item->object . '_' . $item->object_id ) != '' ) {
			$class = get_field( 'object_icon_class', $item->object . '_' . $item->object_id );
		}
		else {
			$class = BazTh_get_style_default_var('[[default_category_icon]]');
		}
	}
	// Icone par défaut
	else {
		$class = BazTh_get_style_default_var('[[default_main_menu_link_icon]]');
	}



	// Ajout de l'icone sur le texte
	if ( isset($class) and $class != '' ) {
		$title = '<i class="'.$class.'"></i>'.$title;
	}



	return $title;

} // BazTh_navigation_menu_icon

// Lancement de la fonction
add_filter( 'nav_menu_item_title' , 'BazTh_navigation_menu_icon' , 11, 4 );



/* Fonction :
	BazTh_print_menu($1)
Description :
	Fonction permettant d'afficher tous les éléments d'un menu
Paramètres :
	$1 : Emplacement du menu (location)
Retours :
	Les éléments du menu.
*/
function BazTh_print_menu($menu_location) {
	foreach( wp_get_nav_menu_items( wp_get_nav_menu_object( get_nav_menu_locations()[$menu_location] ) ) as $menu_item ){
		foreach ( $menu_item as $key => $property ) {
			print_r($key);
			print_r(' => ');
			print_r(
				$property
			);
			print_r('<br>');
		}
		print_r('<br><br>');
	}
} // BazTh_print_menu


?>