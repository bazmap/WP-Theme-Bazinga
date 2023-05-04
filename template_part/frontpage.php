<div class="content page frontpage">
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

<div class="content frontpage midtitle">
	Les derniers articles
</div><!-- .content -->


<!-- Les 3 derniers posts -->
<?php 
	$class_sup = 'frontpage';
	$query_post = new WP_Query( array( 'posts_per_page' => 3 ) );		
	require_once('archive.php');
?>


<div class="content frontpage last">
	<!-- Voir les derniers articles -->
	<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" target="_self" class="button">Venez découvrir tous les autres articles</a>
</div><!-- .content -->
