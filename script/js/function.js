// Fonctions JS
// jQuery étant en mode noConflict, on réassigne le dollar pour plus de simplicité
var $j = jQuery.noConflict();
// On aurait pu englober le contenu des fonctions dans
// 		jQuery(function($){
// 		})



// Fonction de récupération des cookies
function BazTh_get_cookie(cookie_name) {
	var cookieContent = document.cookie
			.split('; ')
			.find(row => row.startsWith(cookie_name));

	if ( cookieContent ) {
		return cookieContent.split('=')[1];
	}
	else {
		return false;
	}
};



// Loading screen
function BazTh_hide_loading_screen() {

	if ( BazTh_get_cookie('loading_screen') == "yes" ) {
		var time_delay = 200;
	}
	else {
		var time_delay = 500;
	}

	// On utilise un timeout pour ralentir l'utilisateur
	setTimeout(function(){
		$j("body").removeClass("loading");
	}, time_delay );

	setTimeout(function(){
		$j(".loading_screen").css('display', 'none');
	}, time_delay + 300 );

	// On ajoute un cookie pour se rappeler qu'il est déjà venu
	document.cookie = "loading_screen=yes; path=/; samesite=strict";

}

// Le loading_screen est caché après que la page soit chargée
$j(window).on("load", function(){
	BazTh_hide_loading_screen();
});

// Le loading_screen est caché après quelques secondes
setTimeout(function(){
	BazTh_hide_loading_screen();
}, 1000 * 5 );



// Tea time
// Ouverture / fermeture
$j(".header_right .tea_time_button, .menu_main .button_mobile .tea_time_button").on("click", function(){
	$j(".tea_time").fadeIn( 300 );
});
$j(".footer .footer_middle").on("click", function(){
	$j(".tea_time").fadeIn( 300 );
});
$j(".tea_time .tea_time_close").on("click", function(){
	$j(".tea_time").fadeOut( 300 );
});



// Repli du menu principal par l'utilisateur
$j(".menu_main a.menu_main_compress").on("click", function(e){
	// Si le menu est ouvert (classe="collapsed" absente)
	if( !$j(".menu_main").hasClass("collapsed") ){
		// On repli tous les sous menu ouverts
		$j(".menu_main li.menu-item-has-children.sub_level_open > ul").slideToggle("200");
		$j(".menu_main li.menu-item-has-children.sub_level_open").removeClass("sub_level_open");
		// On ajoute la classe de fermeture
		$j(".menu_main").addClass("collapsed");
		// Indication que c'est l'utilisateur qui l'a choisi
		$j(".menu_main").addClass("user_defined");
	}
	// Sinon : le menu est replié (classe="collapsed")
	else {
		// On retire la classe de fermeture
		$j(".menu_main").removeClass("collapsed");
		// Indication que c'est l'utilisateur qui l'a choisi
		$j(".menu_main").addClass("user_defined");
	}

	// On retire la mention user_defined au bout de 30 secondes
	setTimeout(function(){
		$j(".menu_main").removeClass("user_defined");
	}, 30000);

});



// Fonction de gestion de repli du menu en mode mobile
$j(".header a.menu_main_compress_mobile").on("click", function(e){
	// Si le menu est replié (classe="mobile_uncollapsed" absente)
	if( !$j(".menu_main").hasClass("mobile_uncollapsed") ){
		// On ajoute la classe d'ouverture sur tous les objets concernés
		$j(".menu_main").addClass("mobile_uncollapsed");
		$j(".header").addClass("mobile_uncollapsed");
	}
	else {
		$j(".menu_main").removeClass("mobile_uncollapsed");
		$j(".header").removeClass("mobile_uncollapsed");
	}

});



// Déploiement des sous-menu dans le menu principal
$j(".menu_main li.menu-item-has-children > a").on("click", ".menu_item_sub_menu_toggle", function(e){

	// On désactive le lien si on clique sur le bouton de déploiement
	e.preventDefault();

	// On récupère le li parent du bouton
	var target_li_obj = $j(e.target).closest("li");
	// Si l'objet ne possède pas la classe d'ouverture
	if ( !target_li_obj.hasClass("sub_level_open") ){
		// On ajoute la classe d'ouverture
		target_li_obj.addClass("sub_level_open");
	}
	else {
		// On retire la classe d'ouverture
		target_li_obj.removeClass("sub_level_open");
	}

	// On dépli l'objet
	var target_li_child_obj = target_li_obj.children("ul");
	target_li_child_obj.slideToggle("200");
});




// Fonctions liées au mode d'affichage des articles dans les archives
function BazTh_archive_change_display(){
	// En fonction du style actuel on inverse

	// Dans le cas du style "square"
	if( $j(".main .content.archive").hasClass("display_square") ) {
		// On change la classe de l'élément content
		$j(".main .content.archive").removeClass("display_square");
		$j(".main .content.archive").addClass("display_list");

		// On modifie les boutons
		$j(".main .title_page .page_option.style_display i.display_square").removeClass("active");
		$j(".main .title_page .page_option.style_display i.display_list").addClass("active");

		// On ajoute un cookie pour conserver la mise en forme
		document.cookie = "archive_style_display=display_list; max-age=32140800; path=/; samesite=strict";
	}
	// Dans le cas du style "list"
	else if ( $j(".main .content.archive").hasClass("display_list") ) {
		// On change la classe de l'élément content
		$j(".main .content.archive").removeClass("display_list");
		$j(".main .content.archive").addClass("display_square");

		// On modifie les boutons
		$j(".main .title_page .page_option.style_display i.display_list").removeClass("active");
		$j(".main .title_page .page_option.style_display i.display_square").addClass("active");

		// On ajoute un cookie pour conserver la mise en forme
		document.cookie = "archive_style_display=display_square; max-age=32140800; path=/; samesite=strict";
	}
}

// Action boutons du mode d'affichage des articles
$j(".main .title_page .page_option.style_display i").on("click", function(e){

	// Si on clique sur l'icone active
	if ( $j(this).hasClass("active") ){
		// On ne fait rien
		return false;
	}
	else {
		// On lance le changement
		BazTh_archive_change_display();
	}
});

// On check les cookies lors du démarrage pour modifier le style d'affichage des listes de post
// Lors du démarrage
$j( document ).on("ready",
	function() {

		if ( !$j(".main .content.archive").hasClass("frontpage") ){
			if ( BazTh_get_cookie('archive_style_display') ){
				if ( !$j(".main .content.archive").hasClass(BazTh_get_cookie('archive_style_display')) ){
					// On lance le changement
					BazTh_archive_change_display();
				}
			}
		}
	}
);




// Darkmode : bouton d'activation
$j(".header .header_right .light_button, .menu_main .button_mobile .light_button").on("click", function(e){

	// Si le body n'est pas en mode darkmode, on l'active
	if ( $j("body").hasClass("darkmode") ){
		// On retire la classe
		$j("body").removeClass("darkmode");

		// On change le titre du bouton
		$j(".header .header_right .light_button").attr('title', "Afficher le mode nuit");

		// On ajoute un cookie pour conserver la mise en forme
		document.cookie = "darkmode=false; max-age=32140800; path=/; samesite=strict";
	}
	else {
		// On ajoute la classe
		$j("body").addClass("darkmode");

		// On change le titre du bouton
		$j(".header .header_right .light_button").attr('title', "Afficher le mode jour");

		// On ajoute un cookie pour conserver la mise en forme
		document.cookie = "darkmode=true; max-age=32140800; path=/; samesite=strict";
	}
});




// Fonctions liées à une modification de la page (resize, scroll)

// Déploiement du menu principal lors d'un resize mobile
function BazTh_menu_main_mobile_uncollapse(){
	// Si la largeur de la fenetre est inférieur ou égale à 837 px
	if ( window.innerWidth <= 837 ) {
		// On déplis le menu
		$j(".menu_main").removeClass( "collapsed" );
	}
}



// Fonction de mise en forme lors du défilement dans les articles et les pages


// Hauteurs

// Hauteur totale des éléments de .main
function BazTh_main_total_height(){

	var total_height = 0;

	$j(".main").children().each( function() {
		// Hauteur totale
		total_height = total_height + $j(this).outerHeight();
	})

	return total_height;
}

// Hauteur totale avant l'élément .content
function BazTh_before_content_height(){

	var before_content = true;
	var before_content_height = 0;

	$j(".main").children().each( function() {
		// Avant ou après "content"
		if ( $j( this ).hasClass( "content" ) ) {
			before_content = false;
		}

		// calcul de la hauteur avant le content
		if ( before_content ) {
			before_content_height = before_content_height + $j( this ).outerHeight();
		}
	})

	return before_content_height;
}

// Hauteur totale après l'élément .content
function BazTh_after_content_height(){
	// Si la largeur de la fenetre est superieur à 837 px (= hors affichage mobile)
	if ( window.innerWidth > 837 ) {
		return BazTh_main_total_height() - BazTh_before_content_height() - $j(".content").outerHeight();
	}
	else {
		return BazTh_main_total_height() - BazTh_before_content_height() - $j(".content").outerHeight() - $j(".header").outerHeight();
	}
}



// Défilement

// Hauteur totale de défilement
function BazTh_total_scroll_height(){
	// Si la largeur de la fenetre est superieur à 837 px (= hors affichage mobile)
	if ( window.innerWidth > 837 ) {
		// hauteur totale moins hauteur visible
		return BazTh_main_total_height() - $j(".main").height();
	}
	else {
		// hauteur totale moins hauteur visible
		return BazTh_main_total_height() - $j( window ).height();
	}
}

// Hauteur de défilement actuel
function BazTh_current_scroll_height(){
	// Si la largeur de la fenetre est superieur à 837 px (= hors affichage mobile)
	if ( window.innerWidth > 837 ) {
		return $j(".main").scrollTop();
	}
	else {
		return $j(window).scrollTop();
	}
}

// Pourcentage de défilement du texte
function BazTh_current_scroll_percent(){
	// Le texte est contenu dans l'élément ".content"
	var percent_defil =  ( ( BazTh_current_scroll_height() - BazTh_before_content_height() ) / ( BazTh_total_scroll_height() - BazTh_before_content_height() - BazTh_after_content_height() ) ) * 100;

	if ( percent_defil < 0 ) {
		return 0;
	}
	else if ( percent_defil > 100 ) {
		return 100;
	}
	else {
		return percent_defil;
	}
}



// Gestion de la bar de progression dans les articles
function BazTh_def_scroll_progress() {
	// Conteneur
	// Affichage uniquement si
	//		Le texte touche le sommet de la fenêtre
	//		Ou, la fin du texte + 60px apparait
	/*
	console.log('---');

	console.log('window : '+$j( window ).height());
	console.log('BazTh_main_total_height : '+BazTh_main_total_height());
	console.log('BazTh_after_content_height : '+BazTh_after_content_height());
	console.log('BazTh_before_content_height : '+BazTh_before_content_height());
	console.log(' ');
	console.log('BazTh_total_scroll_height : '+BazTh_total_scroll_height());
	console.log(' ');
	console.log('BazTh_current_scroll_height : '+BazTh_current_scroll_height());
	console.log('BazTh_current_scroll_percent : '+BazTh_current_scroll_percent());
	*/

	if ( BazTh_current_scroll_height() > BazTh_before_content_height()
	&& BazTh_current_scroll_height() < ( BazTh_total_scroll_height() - BazTh_after_content_height() + 60 ) ) {
		$j(".scroll_progress").css('opacity', '1');
		$j(".scroll_progress").css('display', '');
	} else if ( BazTh_current_scroll_height() < BazTh_before_content_height() ) {
		$j(".scroll_progress").css('display', 'none');
	}
	else {
		$j(".scroll_progress").css('opacity', '0');
		$j(".scroll_progress").css('display', '');
	}

	// Largeur du conteneur = largeur du contenu de la page
	$j(".scroll_progress").width($j(".content").outerWidth());



	// Progress bar
	// Largeur
	$j(".progress_bar").width(BazTh_current_scroll_percent()+"%")



	// Valeur
	// Position de l'indicateur
	$j(".progress_value").css('right',(100 - BazTh_current_scroll_percent())+"%");

	// Texte affiché
	$j(".progress_value").text(Math.round(BazTh_current_scroll_percent())+"%");

	// Affichage de l'indicateur
	if ( BazTh_current_scroll_percent() > 3 && BazTh_current_scroll_percent() < 99 ) {
		$j(".progress_value").css('opacity', '1');
	} else {
		$j(".progress_value").css('opacity', '0');
	}
}



// Positionnement du sidebar
// La sidebar suit la navigation de l'utilisateur
function BazTh_current_sidebar_position(){
	// Si la largeur de la fenetre est superieur à 1086 px (sinon la sidebar est placée au dessus)
	if ( window.innerWidth > 1086 ) {
		// Tant qu'on a pas scrollé sous l'intro
		if ( BazTh_current_scroll_height() <= BazTh_before_content_height() ) {
			$j(".sidebar").css('margin-top', 0);
		}
		// Lorsqu'on scroll au dela de la taille de : contenu + l'intro - sidebar - 40 (marges)
		else if ( BazTh_current_scroll_height() >= ( BazTh_before_content_height() + $j(".content").outerHeight() - $j(".sidebar").outerHeight() - 40 ) ) {
			$j(".sidebar").css('margin-top', $j(".content").outerHeight() - $j(".sidebar").outerHeight() - 40 );
		}
		// Lorsqu'on défile dans le texte
		else {
			$j(".sidebar").css('margin-top', BazTh_current_scroll_height() - BazTh_before_content_height() );
		}
	}
	else {
		$j(".sidebar").css('margin-top', '0');
	}
}



// Action pour replier le menu principal
function BazTh_menu_main_auto_collapse(){
	// Si la largeur de la fenetre est superieur à 837 px (= hors affichage mobile)
	if ( window.innerWidth > 837 ) {
		// Si la taille totale de défilement est 1.5x supérieur à la taille de .main
		if (
			$j(".content").outerHeight() > ( $j(".main").outerHeight() * 1.5 )
			&&  !$j(".menu_main").hasClass( "user_defined" )
		) {
			// Lorsqu'on voit le contenu de l'élément .title_page
			// Ou lorsque le défilement atteint le contenu après l'élément .content + 100px
			if (
				BazTh_current_scroll_height() < $j(".title_page").outerHeight()
				|| BazTh_current_scroll_height() > ( BazTh_total_scroll_height() - BazTh_after_content_height() + 100 )
			) {
				// On déplis le menu
				$j(".menu_main").removeClass( "collapsed" );
			}
			// Lorsqu'on est après le titre
			// Et avant 90% de .content (cas de la marche arrière dans la lecture)
			else if (
				BazTh_current_scroll_height() >= $j(".title_page").outerHeight()
				&& BazTh_current_scroll_height() <= ( BazTh_total_scroll_height() - BazTh_after_content_height() - ($j(".content").outerHeight() * 0.1) )
			) {
				// On repli tous les sous menu ouverts
				$j(".menu_main li.menu-item-has-children.sub_level_open > ul").slideToggle("200");
				$j(".menu_main li.menu-item-has-children.sub_level_open").removeClass("sub_level_open");
				// On replis le menu
				$j(".menu_main").addClass( "collapsed" );
			}
		}
	}
}



// Lancement des actions

// Partout
// Lors du resize
$j(window).resize(
	function() {
		BazTh_menu_main_mobile_uncollapse();
	}
);

// Sur les pages
if (
	$j('.content.page').length > 0
	) {
	// Lors du démarrage
	$j( document ).ready(
		function() {
			BazTh_menu_main_auto_collapse();
		}
	);

	// Lors du scroll
	$j("html, body, .main").scroll(
		function() {
			BazTh_menu_main_auto_collapse();
		}
	);

	// Lors du resize
	$j(window).resize(
		function() {
			BazTh_menu_main_auto_collapse();
		}
	);
}

// Sur les articles
if (
	$j('.content.single').length > 0
	) {
	// Lors du démarrage
	$j( document ).ready(
		function() {
			BazTh_def_scroll_progress();
			BazTh_current_sidebar_position();
			BazTh_menu_main_auto_collapse();
		}
	);

	// Lors du scroll
	// main : desktop
	$j('.main').scroll(
		function() {
			BazTh_def_scroll_progress();
			BazTh_current_sidebar_position();
			BazTh_menu_main_auto_collapse();
		}
	);
	// window : mobile
	$j(window).scroll(
		function() {
			BazTh_def_scroll_progress();
			BazTh_current_sidebar_position();
			BazTh_menu_main_auto_collapse();
		}
	);

	// Lors du resize
	$j(window).resize(
		function() {
			BazTh_def_scroll_progress();
			BazTh_current_sidebar_position();
			BazTh_menu_main_auto_collapse();
		}
	);
}


