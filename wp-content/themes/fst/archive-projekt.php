<?php get_header(); ?>
<section id="content" role="main">
<header class="header">
<h1 class="entry-title">Repertoire</h1>
</header>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part( 'entry', 'content' ); ?>
</article>
<?php endwhile; ?>
<?php endif; ?>
</section>
<?php get_footer(); ?>
