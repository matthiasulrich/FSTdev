<?php 
//https://www.tring-web-design.co.uk/2017/04/acf-gallery-automated-zip-file-download/
?>

<?php get_header(); ?>

<section id="content">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	

<?php 
/* =============================================================== *\ 
	Pressematerial
\* =============================================================== */ 
?>

<div class="pressematerial">	
	<h1 class="entry-title titel_links"><?php the_title(); ?></h1>

	<?php 
	if (get_field('button_beschriftung')){
		$button_beschriftung = get_field('button_beschriftung');
	}

	//$sprach_kuerzel = pll_current_language('slug');
	$filename = site_url() . "/downloads/fathom_string_trio.zip";
	?>

	<div class="download_pressematerial_container">
		<div class="material_liste"><?php if (get_field("hinweis")){the_field("hinweis");} ?></div>
		<div class="download_pressematerial"><a class="red_link colored_link" href="<?php echo $filename; ?>" target="_blank"><?php echo $button_beschriftung; ?></a></div>
	</div>

</div>

<?php 
/* =============================================================== *\ 
	Presse-Clippings
\* =============================================================== */ 
?>

<div class="presseclippings">
	<?php 
	if( have_rows('presse_clippings') ):
		while ( have_rows('presse_clippings') ) : 
			the_row(); ?>
			
			<?php		
			$image = get_sub_field('teaser_bild');
			$size = 'medium'; // (thumbnail, medium, large, full or custom size)

			if( $image ) : ?>
				<a href="<?php echo get_sub_field('original_scan')?>" target='_blank'>
					<?php echo wp_get_attachment_image( $image, $size,  "", array( "class" => "pressebild" ) );  ?>
				</a>
			<?php endif;?>
			
			<?php if(get_sub_field('teaser_satz')): ?>
				<a href="<?php echo get_sub_field('original_scan')?>" target='_blank'>				
					<p class="teaser_satz"><?php the_sub_field('teaser_satz'); ?></p>
				</a>
				
			 <?php endif;?>			

			<?php if(get_sub_field('quellenangabe')):  ?>
				<a href="<?php echo get_sub_field('original_scan')?>" target='_blank'>				
					<p class="quellenangabe"><?php the_sub_field('quellenangabe'); ?></p>
			 	</a>
			 <?php endif;?>

	
			
		
			<!--original_scan-->

		<?php endwhile; ?>

	<?php endif; ?>
 
</div>



<?php endwhile; ?>
<?php endif; //end Loop ?>

<?php wp_reset_postdata(); ?>


</section>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>