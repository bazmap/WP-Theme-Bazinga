<!DOCTYPE html>
<html <?php language_attributes(); ?> >
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class('loading'); ?> >

		<?php require_once('template_part/loading_screen.php'); ?>

		<?php require_once('template_part/tea_time.php'); ?>

		<div class="header">
			<div class="header_left">
				<span class="title_main"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?></span>
			</div> <!-- .header_left -->

			<div class="header_right">
				<div class="light_button" title="<?php
						if (
							isset( $_COOKIE["darkmode"] )
							&& $_COOKIE["darkmode"] == 'true'
						) {
							echo 'Afficher le mode jour';
						}
						else {
							echo 'Afficher le mode nuit';
						}
					?>">
					<div class="moon">
						<div class="planet"></div>
						<div class="craters">
							<div class="crater"></div>
							<div class="crater"></div>
							<div class="crater"></div>
							<div class="crater"></div>
							<div class="crater"></div>
							<div class="crater"></div>
						</div>
					</div>
					<div class="sun">
						<div class="planet shadow"></div>
						<div class="planet"></div>
						<div class="rays">
							<div class="ray"></div>
							<div class="ray"></div>
							<div class="ray"></div>
							<div class="ray"></div>
							<div class="ray"></div>
							<div class="ray"></div>
							<div class="ray"></div>
							<div class="ray"></div>
						</div>
						<div class="craters">
							<div class="crater"></div>
							<div class="crater"></div>
							<div class="crater"></div>
						</div>
					</div>
				</div>
				<div title="Besoin d'une pause ?" class="tea_time_button">
					<i class="BazTh_ico BazTh_ico_mug"></i>
					<i class="BazTh_ico BazTh_ico_mug_reverse"></i>
				</div>
				<form id="searchform" class="search-form" method="get" action="<?php echo home_url('/'); ?>">
					<input type="text" class="search-field" name="s" aria-label="Vous cherchez quelque chose ?" placeholder="Vous cherchez quelque chose ?" value="<?php the_search_query(); ?>">
					<span class="bar"></span>
					<button class="search-submit" type="submit" form="searchform" value="Submit"><i class="fas fa-arrow-right"></i></button>
				</form>
				<?php
					wp_nav_menu( array( 'theme_location'  => 'menu_superior', 'container_class' => 'menu_superior_header') );
				?>
				<a class="menu_main_compress_mobile"><i class="BazTh_ico BazTh_ico_menu_block"></i><i class="BazTh_ico BazTh_ico_cross"></i></a>
			</div><!-- .header_right -->
		</div><!-- .header -->

		<div class="body">
			<div class="menu_main">
				<div class="button_mobile">
					<div class="light_button">
						<div class="moon" title="Afficher le mode nuit" >
							<div class="planet"></div>
							<div class="craters">
								<div class="crater"></div>
								<div class="crater"></div>
								<div class="crater"></div>
								<div class="crater"></div>
								<div class="crater"></div>
								<div class="crater"></div>
							</div>
						</div>
						<div class="sun" title="Afficher le mode jour" >
							<div class="planet shadow"></div>
							<div class="planet shadow"></div>
							<div class="planet"></div>
							<div class="rays">
								<div class="ray"></div>
								<div class="ray"></div>
								<div class="ray"></div>
								<div class="ray"></div>
								<div class="ray"></div>
								<div class="ray"></div>
								<div class="ray"></div>
								<div class="ray"></div>
							</div>
							<div class="craters">
								<div class="crater"></div>
								<div class="crater"></div>
								<div class="crater"></div>
							</div>
						</div>
					</div>
					<div title="Besoin d'une pause ?" class="tea_time_button">
						<i class="BazTh_ico BazTh_ico_mug"></i>
						<i class="BazTh_ico BazTh_ico_mug_reverse"></i>
					</div>
				</div>
				<form id="searchform_mobile" class="search-form_mobile" method="get" action="<?php echo home_url('/'); ?>">
					<input type="text" class="search-field_mobile" name="s" aria-label="Vous cherchez quelque chose ?" placeholder="Vous cherchez quelque chose ?" value="<?php the_search_query(); ?>">
					<button class="search-submit_mobile" type="submit" form="searchform_mobile" value="Submit"><i class="BazTh_ico BazTh_ico_search"></i></button>
				</form>
				<?php
					wp_nav_menu( array( 'theme_location' => 'menu_main' ) );
				?>
				<?php
					wp_nav_menu( array( 'theme_location' => 'menu_superior', 'container_class' => 'menu_superior_mobile') );
				?>
				<a class="menu_main_compress separator separator_up"><i class="BazTh_ico BazTh_ico_chevron_right_light"></i><span class="menu_item_title">Replier</span></a>
			</div><!-- .menu_main -->

			<div class="main">

				<?php require_once('template_part/main_content.php'); ?>

				<div class="footer">
					<div class="footer_widget footer_left">
						<?php //dynamic_sidebar( 'footer_left' ); ?>
						<h2>L'auteur</h2>
						<div class="author">
							<div class="author_img">
								<img src="/wp-content/uploads/Photo-261x300.jpg" alt="Arthur Bazin himself">
							</div>
							<div class="author_info">
								<p><b>Arthur Bazin</b></p>
								<p>🗺 Expert SIG (PostgreSQL/PostGIS - GDAL/OGR - GEO)<br>
									🏆 Certifié FME Professionnal<br>
									👨‍💻 Programmeur (PL/PGSQL - Python - PHP - JS)</p>
								<p>💼 <a href="https://www.business-geografic.com/fr/" target="_blank">Business Geografic</a> - <a href="https://www.cirilgroup.com/fr/" target="_blank">Ciril GROUP</a></p>
								<p>
									<a class="button" href="https://blog.arthurbazin.com/contact"><i class="BazTh_ico BazTh_ico_enveloppe_light" style="vertical-align: bottom;"></i> Contactez-moi</a>
									<a class="button" href="https://www.linkedin.com/in/arthurbazin/" target="_blank"><i class="BazTh_ico BazTh_ico_linkedin-square" style="vertical-align: bottom;"></i> LinkedIn</a>
								</p>
							</div>
						</div>
					</div>
					<div class="footer_widget footer_middle">
						<h2>Un thé ?</h2>
						<p>Vous appréciez ces articles ? Soutenez-mon travail en cliquant ici.</p>
						<div class="tea_time_animation_cup">
							<div class="vapor">
								<div class="cloud"></div>
								<div class="cloud"></div>
								<div class="cloud"></div>
								<div class="cloud"></div>
								<div class="cloud"></div>
								<div class="cloud"></div>
								<div class="cloud"></div>
								<div class="cloud"></div>
								<div class="cloud"></div>
								<div class="cloud"></div>
							</div>
							<div class="cup">
								<div class="handle">
								</div>
							</div>
						</div>
					</div>
					<div class="footer_widget footer_right">
						<?php //dynamic_sidebar( 'footer_right' ); ?>
						<h2>A propos</h2>
						<p>Ce blog est une compilation de tips (astuces) et de tuto (tutoriels) sur l'informatique rédigés au fil du temps lors de l'approfondissement de mes connaissances en informatique.</p>
						<p>A l'origine, l'idée était de pouvoir centraliser des informations sur les sujets en lien avec mes projets pro. et perso. pour les retrouver plus facilement. Maintenant, le but est de partager cette connaissance avec le plus grand nombre pour que chacun puisse en bénéficier.</p>
						<p>Profitez-en !</p>
					</div>
					<div class="footer_copyright">
						<?php //echo get_theme_mod('BazTh_main_param_copyright'); ?>
						Made with <i class="BazTh_ico BazTh_ico_heart_light"></i> in <i class="BazTh_ico BazTh_ico_savoie"></i> by Arthur Bazin | <a href="https://www.linkedin.com/in/arthurbazin/" target="_blank"><i class="BazTh_ico BazTh_ico_id_card_light"></i></a> | <a href="<?php echo get_privacy_policy_url() ?>" >Mentions légales</a>
					</div>
				</div>

				<?php if ( $wp_query->is_single() ) : ?>

					<div class="scroll_progress">
						<div class="progress_bar" id="scroll_bar"></div>
						<div class="progress_value" id="scroll_value">50%</div>
					</div>

				<?php endif ?>
			</div><!-- .main -->
		</div><!-- .body -->
		<?php wp_footer(); ?>
	</body>
</html>
