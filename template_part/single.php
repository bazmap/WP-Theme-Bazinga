<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="article_meta" >
	<div class="meta_background" <?php if ( wp_get_attachment_image_src(get_post_thumbnail_id(),'large') ) : ?> style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(),'large')[0]; ?>);" <?php endif ?>></div>
	<div class="meta">
		<div class="meta_text">
			Rédigé par <b><a title="Lister les articles de <?php the_author(); ?>" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></b> et publié le
				<b>
					<a title="Lister les articles du <?php the_time('j F Y'); ?>" href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('j') ); ?>"><?php the_time('j'); ?> </a>
					<a title="Lister les articles de <?php the_time('F Y'); ?>" href="<?php echo get_month_link( get_the_time('Y'), get_the_time('m') ); ?>"><?php the_time('F'); ?> </a>
					<a title="Lister les articles de l'année <?php the_time('Y'); ?>" href="<?php echo get_year_link( get_the_time('Y') ); ?>"><?php the_time('Y'); ?></a>
				</b><br>
			Temps de lecture <?php ( get_field( 'read_time' ) ? print('d\'environ <b>'.get_field( 'read_time' ).' min') : print('<b>inconnu</b>') ); ?></b><br>
			Niveau d'expertise : <b><?php ( get_field( 'expert_level' ) ? print(get_field( 'expert_level' ).'/5') : print('inconnu') ); ?></b>
		</div><!-- .meta_text -->
	</div><!-- .meta -->
	<div class="categories">
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
		?>
	</div><!-- .categories -->
	<div class="tags">
	<?php
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
	</div><!-- .tags -->
</div><!-- .article_info -->
<div class="content single">

	<div id="<?php the_ID(); ?>" class="text">
		<?php the_content(); ?>
		<br>
		<h4 class="no_num">Cet article vous a plu ?</h4>
		<p>
			N'hésitez pas à le partager, il interessera surement certains de vos contacts.
		</p>
		<div class="social_bar">
			<a class="social_button" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode_deep(esc_url( get_permalink())); ?>&title=<?php the_title(); ?>&source=blog.arthurbazin.com"  style="background-color:#2767b1;"><i class="fab fa-linkedin-in"></i><span class="social_brand">Partagez</span></a>
			<a class="social_button" target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&amp;url=<?php echo esc_url( get_permalink()); ?>"  style="background-color:#1da1f2;"><i class="fab fa-twitter"></i><span class="social_brand">Tweetez</span></a>
			<a class="social_button" target="_blank" href="https://www.facebook.com/share.php?u=<?php echo esc_url( get_permalink()); ?>"  style="background-color:#1877f2;"><i class="fab fa-facebook-f"></i><span class="social_brand">Partagez</span></a>
		</div>
		<p>
			Les thèmes suivants contiennent des articles en lien avec celui-ci, allez faire un tour :<br><br>
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
			?>
			<?php
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
		</p>
	</div><!-- .text -->

	<div class="sidebar"><?php dynamic_sidebar( 'sidebar_post' ); ?></div><!-- .sidebar -->

</div><!-- .content -->

<?php endwhile; else : ?>

<div class="content single">

	<div class="text">
		<p>Aucun contenu n'a été trouvé</p>
	</div><!-- .text -->

</div><!-- .content -->

<?php endif; ?>