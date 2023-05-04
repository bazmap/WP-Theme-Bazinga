<?php
// Gestion du contenu selon le type de page

// Initialisation
	// Titre
	$title_class = '';
	$title_style_color = '';
	$title_icon = '';
	$title_text = wp_title('',false);
	$title_button = '';

	// Template à utiliser
	$template_part = 'archive.php';



// Page d'accueil
if ( $wp_query->is_front_page() ) {
	// Titre
	$title_icon = BazTh_get_style_default_var('[[default_accueil_icon]]');
	$title_text = 'Accueil';

	// Contenu
	if ( $wp_query->is_home() ) {
		// conf : derniers articles
		$title_button = 'list';

		$query_post = $wp_query;
		$template_part = 'archive.php';
	}
	else {
		// conf : page statique
		$template_part = 'frontpage.php';
	}
}
// Page et articles
elseif (
	$wp_query->is_single()
	OR $wp_query->is_page() ) {
	// Titre
	$title_text= get_the_title();

	if ( get_field( 'object_color_code' ) != '' ) {
		$title_style_color = 'style="background-color: '.get_field( 'object_color_code' ).';"';
	}

	if ( current_user_can( 'edit_posts' ) ) {
		$title_button = 'edit';
	}

	// Article
	if ( $wp_query->is_single() ) {
		if ( get_field( 'object_icon_class' ) != '' ) {
			$title_icon = get_field( 'object_icon_class' );
		}
		else {
			$title_icon = BazTh_get_style_default_var('[[default_post_icon]]');
		}

		// Contenu
		$template_part = 'single.php';
	}
	// Page
	else {
		if ( get_field( 'object_icon_class' ) != '' ) {
			$title_icon = get_field( 'object_icon_class' );
		}
		else {
			$title_icon = BazTh_get_style_default_var('[[default_page_icon]]');
		}

		// Contenu
		$template_part = 'page.php';
	}

}
// Page de listing d'articles
elseif (
	$wp_query->is_home()
	OR $wp_query->is_archive() //Category, Tag, other Taxonomy Term, custom post type archive, Author and Date-based
	OR $wp_query->is_search()
	) {
	$title_button = 'list';

	// Blog
	if ( $wp_query->is_home() ) {
		$title_text = wp_title('',false);

		if ( get_field( 'object_icon_class' ) != '' ) {
			$title_icon = get_field( 'object_icon_class' );
		}
		else {
			$title_icon = BazTh_get_style_default_var('[[default_home_icon]]');
		}

		if ( get_field( 'object_color_code' ) != '' ) {
			$title_style_color = 'style="background-color: '.get_field( 'object_color_code' ).';"';
		}
	}
	// Catégorie
	elseif ( $wp_query->is_category() ) {
		$title_text = 'Catégorie '.get_queried_object()->name;

		$title_class = ' '.get_queried_object()->slug;

		if ( get_field( 'object_icon_class', get_queried_object() ) != '' ) {
			$title_icon = get_field( 'object_icon_class', get_queried_object() );
		}
		else {
			$title_icon = BazTh_get_style_default_var('[[default_category_icon]]');
		}

		if ( get_field( 'object_color_code', get_queried_object() ) != '' ) {
			$title_style_color = 'style="background-color: '.get_field( 'object_color_code', get_queried_object()).';"';
		}
	}
	// Etiquette
	elseif ( $wp_query->is_tag() ) {
		$title_text = 'Tag '.get_queried_object()->name;

		$title_class = ' tag '.get_queried_object()->slug;

		if ( get_field( 'object_icon_class', get_queried_object() ) != '' ) {
			$title_icon = get_field( 'object_icon_class', get_queried_object() );
		}
		else {
			$title_icon = BazTh_get_style_default_var('[[default_tag_icon]]');
		}

		if ( get_field( 'object_color_code', get_queried_object() ) != '' ) {
			$title_style_color = 'style="background-color: '.get_field( 'object_color_code', get_queried_object()).';"';
		}
	}
	// Taxonomie
	elseif ( $wp_query->is_tax() ) {
		$title_text = 'Taxonomie '.get_queried_object()->name;

		$title_class = ' taxonomy '.get_queried_object()->slug;

		if ( get_field( 'object_icon_class', get_queried_object() ) != '' ) {
			$title_icon = get_field( 'object_icon_class', get_queried_object() );
		}
		else {
			$title_icon = BazTh_get_style_default_var('[[default_taxonomy_icon]]');
		}

		if ( get_field( 'object_color_code', get_queried_object() ) != '' ) {
			$title_style_color = 'style="background-color: '.get_field( 'object_color_code', get_queried_object()).';"';
		}
	}
	// Date
	elseif ( $wp_query->is_date() ) {
		$title_icon = BazTh_get_style_default_var('[[default_date_icon]]');
		$mois_long = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

		if ( is_year() ) {
			$title_text= 'Articles de '.get_query_var('year');
		}
		elseif ( is_month() ) {

			$title_text= 'Articles de '.$mois_long[get_query_var('monthnum')-1].' '.get_query_var('year');
		}
		elseif ( is_day() ) {
			$title_text= 'Articles du '.get_query_var('day').' '.$mois_long[get_query_var('monthnum')-1].' '.get_query_var('year');
		}
	}
	// Auteur
	elseif ( $wp_query->is_author() ) {
		$author_info = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));

		$title_icon = BazTh_get_style_default_var('[[default_author_icon]]');

		$title_text = 'Articles rédigés par '.$author_info->display_name;
	}
	// Recherches
	elseif ( $wp_query->is_search() ) {
		$title_icon = BazTh_get_style_default_var('[[default_search_icon]]');

		$title_text= 'Résultats de recherche pour : '.get_search_query();
	}

	// Contenu
	$query_post = $wp_query;
	$template_part = 'archive.php';
}
// Erreur 404
elseif ( $wp_query->is_404() ) {
	// Titre
	$title_text= 'Oups, petit problème...';
	$title_icon = BazTh_get_style_default_var('[[default_404_icon]]');

	// Contenu
	$template_part = '404.php';
}



// Ajout d'une icone dans le titre
if ( $title_icon != '' ) {
	$title_icon = '<i class="'.$title_icon.'"></i> ';
}



// Ajout des boutons dans le titre
if ( $title_button == 'list' ) {
	$title_button = '<span class="page_option style_display"><i title="Afficher les articles au sous forme de carte" class="BazTh_ico BazTh_ico_block_square display_square active"></i><i title="Afficher les articles au sous forme de liste" class="BazTh_ico BazTh_ico_block_list display_list"></i></span>';
}
elseif ( $title_button == 'edit' ) {
	$title_button = '<span class="page_option"><a target="_blank" class="edit_post" href="'.get_edit_post_link().'" ><i class="BazTh_ico BazTh_ico_gear"></i> Modifier</a></span>';
}

?>

<div class="title_page <?php print($title_class); ?>" <?php print($title_style_color); ?>>
	<?php echo $title_icon.'<h1>'.$title_text.'</h1>'.$title_button; ?>
</div><!-- .title_page -->

<?php
	require_once($template_part);
?>