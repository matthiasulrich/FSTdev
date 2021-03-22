<?php get_header(); ?>

<section id="content">
	
<?php
$args = array('post_type' => 'portrait');
$query = new WP_Query( $args );

if ( $query->have_posts() ) :
	while ( $query->have_posts() ) :
			$query->the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<div class="lauftext einfuhrungstext"><?php the_field("einfuhrungstext"); ?></div>
			<div class="band_member_container">
			
			<?php 
			/* =============================================================== *\ 
				Einzelne Bandmitglieder ausgeben
			\* =============================================================== */ 
  
			if (have_rows('band-mitglieder')):
				  while(have_rows('band-mitglieder')) :
					  the_row(); ?>
					 
					 <?php 
					  /*
					  name
					  foto
					  instrument
					  kurzbio
					  */
					  ?>
					<div class="band_member">
						<?php 
						$image = get_sub_field('foto');
						$size = 'startseite'; // (thumbnail, medium, large, full or custom size)
						if( $image ) { echo wp_get_attachment_image( $image, $size, "", ["id" => "band_member_bild"] ); }
						?>
						<div class="text_container">
							<h2><?php the_sub_field("name"); ?></h2><br />
							<div class="instrument"><?php the_sub_field("instrument"); ?></div>
							<div class="kurzbio"><?php the_sub_field("kurzbio"); ?></div>
				  		</div>
			  		</div>
					  
				  <?php endwhile; ?> 

			  <?php endif; ?> 
		  </div>
			
	<?php endwhile; ?>
<?php endif; ?>


<?php wp_reset_postdata(); ?>


</section>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>