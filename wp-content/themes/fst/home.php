<?php get_header(); ?>

<?php
$args = array('post_type' => array( 'agenda' ),);	
$query = new WP_Query( $args );
$query0 = new WP_Query( $args );
$bildvorhanden = false;
$link_setzen = false;
$size = 'startseite'; // (thumbnail, medium, large, full or custom size)
?>

<!--<main id="content">-->
<section id="content">

<div class="startseite_bild_container">	
<?php if ( $query0->have_posts() ) : ?>
	
		<?php
		while ( ($query0->have_posts() )) :
			
			$query0->the_post();
			$image = get_field('teaser-bild');

			/* 
			Teaserbild anzeigen, wenn:
			- eines vorhanden ist
			- Button "auf Startseite anzeigen" auf ja gestellt ist
			
			Link setzen, wenn:
			- Button "Unterseite anzeigen" auf ja gestellt ist
			
			Ansonsten das Bild aus den Optionen nehemen
			*/
			
			if( (($image)&&(get_field("teaserbild_auf_startseite")==true) )) {
				if (get_field("unterseite_anzeigen")==true){
					$link_setzen = true;				
				}
				break;
			} else {
				$image = get_field('home_img','option');
			}
			?>

		<?php endwhile; ?>
		
		<?php if($link_setzen == true) : ?>
		
			<a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $image, $size, "", ["id" => "startseite_bild"] );?></a>
		
		<?php else: ?>
		
			<?php echo wp_get_attachment_image( $image, $size, "", ["id" => "startseite_bild"] ); ?>

		<?php endif; ?>

<?php else: ?>
	<!--<div>Kein Beitrag vorhanden</div>-->
		<?php if(get_field("home_img", "option")){
			$image = get_field("home_img", "option");
			
			echo wp_get_attachment_image($image, $size, "", ["id" => "startseite_bild"]);
		}?>
<?php endif; ?>

</div>
	
	
	
	
<?php if ( $query->have_posts() ) : ?>
	<div class="auftritt_container">
		
		<?php while ( $query->have_posts() ) : ?>
			<?php $query->the_post(); ?>
			
				<div class="auftritt">
			
					<?php if (get_field("konzert_titel")) : ?>
						
						<?php if (get_field("unterseite_anzeigen")) : ?>
							<h2 class="konzert_titel"><a class="colored_link" href="<?php the_permalink();?>"><?php the_field("konzert_titel"); ?></a></h2>
						<?php else: ?>
							<h2 class="konzert_titel"><?php the_field("konzert_titel"); ?></h2>
						<?php endif; ?>
										
					<?php endif; ?>


					<div><span class="datum"><?php the_field('datum'); ?></span><?php if(get_field("zeit")) { ?><span class="zeit"> <span class='bull'> &bull;</span> <?php the_field("zeit"); ?> Uhr</span> <?php } ?></div>
					<!--&curren;-->
					<?php 
					$location_link = get_field('adresse_oder_webseite');
					?>

					<?php
					/* =============================================================== *\
						Ort verlinken 
						-> Auf Webseite, Google Maps, kein Link
					\* =============================================================== */ 
					?>
					<div class="lokalitaet_und_ort">
					
						<?php
						// Webseite
						if($location_link == "webseite") : ?>
							<a class="colored_link" href="<?php the_field("location_website"); ?>" target="_blank"><span class="location_town"><?php the_field('location_name'); ?></span></a>
						<?php 
						// Google Directories
						elseif($location_link == "googlemaps") : ?>
							<?php 
							$google_map_field = get_field("location_address");
							$map_link = 'https://www.google.com/maps/dir//' . urlencode( str_replace( '% ', ' ' , $google_map_field ) ); 
							?>
							<a class="colored_link" href="<?php echo $map_link; ?>" target="_blank"><span class="location_town"><?php the_field('location_name'); ?></span></a>
						<?php	
						// Kein Link setzen
						 else : ?>
							<span class="location_town"><?php the_field('location_name'); ?></span>
	 					<?php endif; ?>
						
						<?php 
						/* =============================================================== *\ 
	 	 					Ort 	
						\* =============================================================== */ 
						?>
						
						<?php if(get_field("ort")) : ?>
							<?php echo "<span class='bull'>&bull; </span>"; ?><span class="ort"><?php the_field('ort'); ?></span>
						<?php endif; ?>

					</div>
					
					
					<?php 
					/* =============================================================== *\ 
 	 					Auf Unterseite (Single) verlinken 
					\* =============================================================== */ 
					 ?>
					 
					 <?php 
					 if (get_field("unterseite_anzeigen")) : ?>
					 <div style="display:none" class="unterseiten_link"><a class="colored_link" href="<?php the_permalink(); ?>">more <i class="fas fa-angle-right"></i><i class="fas fa-angle-right"></i><i class="fas fa-angle-right"></i></a></div>
				 	<?php endif; ?>

				</div>
			<?php endwhile; ?>
		</div>
		
	<?php endif; ?>

	<?php wp_reset_postdata(); ?>
</section>
	<?php //get_sidebar(); ?>
	<?php get_footer(); ?>





