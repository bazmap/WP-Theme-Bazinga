<div class="content archive display_square <?php echo $class_sup; ?> ">
	<?php if ( $query_post->have_posts() ) : while ( $query_post->have_posts() ) : $query_post->the_post(); ?>

		<div class="card_item" title="<?php BazTh_trim_text(the_title('','',false), 100); ?>" onclick="window.location.href='<?php echo esc_url( wp_get_shortlink() ) ?>'">

			<div class="card_img" <?php if ( wp_get_attachment_image_src(get_post_thumbnail_id(),'large') ) : ?> style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(),'large')[0]; ?>);" <?php endif ?> ></div>

			<div class="card_info">
				<div class="card_title"><?php BazTh_trim_text(the_title('','',false), 100); ?></div>
				<div class="card_excerpt"><?php BazTh_trim_text(get_the_excerpt(), 300); ?></div>
			</div><!-- .card_info -->

			<div class="card_tags">
				<?php
					$categories = get_the_terms( false, 'category' );
					$output = '';
					if ( ! empty( $categories ) ) {
						foreach( $categories as $category ) {

							if ( get_field( 'object_color_code', 'category_' . $category->term_id ) != '' ) {
								/* Style par défaut */
								$spec_style = 'style="color:'.get_field( 'object_color_code', 'category_' . $category->term_id ).'; border-color:'.get_field( 'object_color_code', 'category_' . $category->term_id ).'"';
								/* OnMouseOver */
								$spec_mouseover = 'onmouseover="this.style.color=\'#ffffff\'; this.style.backgroundColor=\''.get_field( 'object_color_code', 'category_' . $category->term_id ).'\'"';
								/* OnMouseOut */
								$spec_mouseout = 'onmouseout="this.style.color=\''.get_field( 'object_color_code', 'category_' . $category->term_id ).'\'; this.style.boderColor=\''.get_field( 'object_color_code', 'category_' . $category->term_id ).'\'; this.style.backgroundColor=null"';
							}
							else {
								$spec_style = '';
								$spec_mouseover = '';
								$spec_mouseout = '';
							}

							$output .= '<a
								class="tags tag_category '.esc_attr($category->slug).'"
								href="' . esc_url( get_term_link( $category->term_id ) ) . '"
								alt="Voir tous les posts de la catégorie"'
								.$spec_style
								.$spec_mouseover
								.$spec_mouseout.
								'>' . esc_html( $category->name ) . '</a>';
						}
						echo $output;
					}

					$tags = get_the_terms( false, 'post_tag' );
					$output = '';
					if ( ! empty( $tags ) ) {
						foreach( $tags as $tag ) {

							if ( get_field( 'object_color_code', 'post_tag_' . $tag->term_id ) != '' ) {
								/* Style par défaut */
								$spec_style = 'style="color:'.get_field( 'object_color_code', 'post_tag_' . $tag->term_id ).'; border-color:'.get_field( 'object_color_code', 'post_tag_' . $tag->term_id ).'"';
								/* OnMouseOver */
								$spec_mouseover = 'onmouseover="this.style.color=\'#ffffff\'; this.style.backgroundColor=\''.get_field( 'object_color_code', 'post_tag_' . $tag->term_id ).'\'"';
								/* OnMouseOut */
								$spec_mouseout = 'onmouseout="this.style.color=\''.get_field( 'object_color_code', 'post_tag_' . $tag->term_id ).'\'; this.style.boderColor=\''.get_field( 'object_color_code', 'post_tag_' . $tag->term_id ).'\'; this.style.backgroundColor=null"';
							}
							else {
								$spec_style = '';
								$spec_mouseover = '';
								$spec_mouseout = '';
							}

							$output .= '<a
								class="tags tag_tag '.esc_attr($tag->slug).'"
								href="' . esc_url( get_term_link( $tag->term_id ) ) . '"
								alt="Voir tous les posts avec cette étiquette"'
								.$spec_style
								.$spec_mouseover
								.$spec_mouseout.
								'>' . esc_html( $tag->name ) . '</a>';
						}
						echo $output;
					}
				?>
			</div><!-- .card_tags -->

			<div class="card_detail display_square">
				<div class="card_level"><i class="BazTh_ico BazTh_ico_tachometer"></i>Difficulté <b><?php ( get_field( 'expert_level' ) ? print(get_field( 'expert_level' ).'/5') : print('inconnue') ); ?></b></div>
				<div class="card_time"><span class="full">Temps de lecture</span><span class="short">Tps de lect.</span> <b><?php ( get_field( 'read_time' ) ? print(get_field( 'read_time' ).' min') : print('inconnu') ); ?></b> <i class="BazTh_ico BazTh_ico_stopwatch_light"></i></div>
				<div class="card_autor"><i class="BazTh_ico BazTh_ico_user_circle_light"></i> Par <b><a title="Lister les articles de <?php the_author(); ?>" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></b></div>
				<div class="card_date">
					Le <b>
						<a title="Lister les articles du <?php the_time('j F Y'); ?>" href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('j') ); ?>"><?php the_time('j'); ?> </a>
						<a title="Lister les articles de <?php the_time('F Y'); ?>" href="<?php echo get_month_link( get_the_time('Y'), get_the_time('m') ); ?>"><?php the_time('F'); ?> </a>
						<a title="Lister les articles de l'année <?php the_time('Y'); ?>" href="<?php echo get_year_link( get_the_time('Y') ); ?>"><?php the_time('Y'); ?></a>
					</b> <i class="BazTh_ico BazTh_ico_calendar_day_light"></i>
				</div>
			</div><!-- .card_detail.display_square -->

			<div class="card_detail display_list">
				<div class="card_level">Difficulté <b><?php ( get_field( 'expert_level' ) ? print(get_field( 'expert_level' ).'/5') : print('inconnue') ); ?></b><i class="BazTh_ico BazTh_ico_tachometer"></i></div>
				<div class="card_time"><span class="full">Temps de lecture</span><span class="short">Tps de lect.</span> <b><?php ( get_field( 'read_time' ) ? print(get_field( 'read_time' ).' min') : print('inconnu') ); ?></b> <i class="BazTh_ico BazTh_ico_stopwatch_light"></i></div>
				<div class="card_autor">Par <b><a title="Lister les articles de <?php the_author(); ?>" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></b> <i class="BazTh_ico BazTh_ico_user_circle_light"></i></div>
				<div class="card_date">
					Le <b>
						<a title="Lister les articles du <?php the_time('j F Y'); ?>" href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('j') ); ?>"><?php the_time('j'); ?> </a>
						<a title="Lister les articles de <?php the_time('F Y'); ?>" href="<?php echo get_month_link( get_the_time('Y'), get_the_time('m') ); ?>"><?php the_time('F'); ?> </a>
						<a title="Lister les articles de l'année <?php the_time('Y'); ?>" href="<?php echo get_year_link( get_the_time('Y') ); ?>"><?php the_time('Y'); ?></a>
					</b> <i class="BazTh_ico BazTh_ico_calendar_day_light"></i>
				</div>
			</div><!-- .card_detail.display_list -->

		</div><!-- .card_item -->

	<?php endwhile; else : ?>

		<div class="card_item">
			<p>Aucun article n'a été trouvé</p>
		</div><!-- .card_item -->

	<?php endif; ?>

	<?php if ( $wp_query->max_num_pages > 1 ) : ?>

		<div class="pagination">

			<?php
				global $wp_query;

				$big = 999999999; // need an unlikely integer

				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages,
					'mid_size' => 1,
					'prev_text' => '<span class="arrow">« </span><span class="text full">Précédent</span><span class="text short">Préc.</span>',
					'next_text' => '<span class="text full">Suivant</span><span class="text short">Suiv.</span><span class="arrow"> »</span>',
				) );
			?>

		</div><!-- .pagination -->

	<?php endif; ?>

</div><!-- .content -->