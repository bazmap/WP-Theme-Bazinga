<div class="content page">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div id="<?php the_ID(); ?>" class="text">
			<?php the_content(); ?>
		</div><!-- .text -->

	<?php endwhile; else : ?>

		<div class="text">
			<p>Aucun contenu n'a été trouvé</p>
		</div><!-- .text -->

	<?php endif; ?>
</div><!-- .content -->