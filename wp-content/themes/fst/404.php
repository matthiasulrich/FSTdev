<?php get_header(); ?>
<section id="content" role="main">
<article id="post-0" class="post not-found">
<header class="header">
<h1 class="entry-title">Hoppla!</h1>
</header>
<section class="entry-content">
	<?php 

	$image = get_field('gif','option');
	$size = 'full'; // (thumbnail, medium, large, full or custom size)
	
	if( $image ) {
		echo wp_get_attachment_image( $image, $size, "", ["class" => "image_404"] ); 
	}
	?>
	<p>Hier stimmt etwas nicht - die gesuchte Seite gibt es nicht.</p>
	<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Hier</a> gehts zur Startseite.</p>
<?php //get_search_form(); ?>
</section>
</article>
</section>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
