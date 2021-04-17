<?php get_header(); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php //get_template_part( 'entry' ); ?>



<div class="datum_ort_container">
	
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
</div>
	
	
	
	
	

<h1><?php the_field("konzert_titel"); ?></h1>
<h2><?php the_field("konzert_untertitel"); ?></h2>
		
	<?php 
	/* =============================================================== *\ 

 	 Teaserbild 

\* =============================================================== */ 
  
$image = get_field('teaser-bild');
$size = 'startseite'; // (thumbnail, medium, large, full or custom size)
echo wp_get_attachment_image( $image, $size, "", ["class" => "teaser_bild"] ); 
	?>
	
	<?php 
	/* ================================================== *\ 

	 	 Mitwirkende

	\* ================================================== */ 
	?>


		<div class="mitwirkende_container scroll_fade_einhei">
		 <?php if( have_rows('mitwirkende') ): ?>
		 	<?php while( have_rows('mitwirkende') ): the_row(); ?>
		        
				<?php if( have_rows('solisten_container') ): ?>
				   <?php while( have_rows('solisten_container') ): the_row(); ?>	
				<div class="mitwirkende">
					<?php 
					if(get_sub_field('link')) : ?>
						<a class="colored_link" href="<?php the_sub_field('link'); ?>" target="_blank"><?php the_sub_field('solist'); ?></a>
					<?php else : ?>
						<?php the_sub_field('solist'); ?>
					<?php endif; ?>
				 	<span> – <?php the_sub_field('instrument'); ?></span>
				</div>
				
		    <?php endwhile; ?>
		<?php endif; ?>

		<?php if( have_rows('chor_container') ): ?>
		   <?php while( have_rows('chor_container') ): the_row(); ?>
			   
			   <div class="mitwirkende">
				   <?php 
				   if(get_sub_field('link')) : ?>
					   <a class="colored_link" href="<?php the_sub_field('link'); ?>" target="_blank"><?php the_sub_field('chor'); ?></a>
				   <?php else : ?>
					   <?php the_sub_field('chor'); ?>
				   <?php endif; ?>
			   </div>
			   
			   
		   <?php endwhile; ?>
		<?php endif; ?>

		<?php if( have_rows('orchester_container') ): ?>
		   <?php while( have_rows('orchester_container') ): the_row(); ?>
			   
			   <div class="mitwirkende">
				   <?php 
				   if(get_sub_field('link')) : ?>
					   <a class="colored_link" href="<?php the_sub_field('link'); ?>" target="_blank"><?php the_sub_field('orchester'); ?></a>
				   <?php else : ?>
					   <?php the_sub_field('orchester'); ?>
				   <?php endif; ?>
			   </div>
		   <?php endwhile; ?>
		<?php endif; ?>			   
		   <?php endwhile; ?>
		<?php endif; ?>
	</div>
	
	
	
	
	
	

		<?php 
		/* =============================================================== *\ 

		 	 Programm 

		\* =============================================================== */ 
		?>

		<?php
		/*
		if (have_rows('programmpunkt-container')): ?>
			<div class="programmpunkt_container">
				<?php
				while(have_rows('programmpunkt-container')) :
					the_row(); ?>
					
					<div class="programmpunkt">

						<?php if (get_sub_field('komponist')) : ?>
							<div class="komponist"><?php the_sub_field("komponist"); ?>
								<?php if (get_sub_field('jahrzahlen')) : ?>
									<span class="jahrzahlen"><?php the_sub_field("jahrzahlen"); ?></span>
								<?php endif; ?>
							</div>
						<?php endif; ?>



						<?php if (get_sub_field('werk_titel')) : ?>
							<h3 class="werktitel"><?php the_sub_field("werk_titel"); ?></h3>
						<?php endif; ?>


						<?php if (have_rows('satze_container')): ?>
							<div class="satze_container">
								<?php
								while(have_rows('satze_container')) :
									the_row(); ?>
					
									<?php if (get_sub_field('satze')) : ?>
										<div class="satze"><?php the_sub_field("satze"); ?></div>
									<?php endif; ?>
					
								<?php endwhile; ?>
							</div>
						<?php endif; ?>

					</div>
				<?php endwhile; ?>



			</div>

				
		<?php endif; */?>

		
		<?php 
		if (get_field("konzertprogramm")):
		?>
		<div class="programmpunkt_container">
			<div class="programmpunkt">
			<?php
			the_field("konzertprogramm");
			?>
		</div>
	</div>
			<?php
		endif;
 		?>


		<?php 
		/* =============================================================== *\ 

			 Programm / Plakat / Flyer Download 

		\* =============================================================== */ 
		?>

		<?php if(get_field('programm-download')) : ?>
			<?php 
			$field = get_field_object('angezeigter_name');
			$value = $field['value'];
			$link = get_field('programm-download');
			?>

			<div class="programm_download"><a class="colored_link" href="<?php echo $link['url']; ?>" target="_blank"><?php echo $value; ?> download</a></div>
		<?php endif; ?>

























	<?php
	/* ================================================== *\ 

	 	 Beschreibung und Zitate 

	\* ================================================== */ 
	?>

	<?php 
	if (have_rows('bechreibung_und_zitate')):
		?>
		<div class="beschreibung_und_zitate">
			<?php
			while(have_rows('bechreibung_und_zitate')) :
				the_row();
				
				
				/* =============================================================== *\ 
					Beschreibung 
				\* =============================================================== */ 
				if( get_row_layout() == 'beschreibung' ): ?>
					<div class="beschreibung scroll_fade_einheit">
						
						<?php if(get_sub_field('beschreibungs_titel')) :  ?>
								<h4 class="beschreibungstitel"><?php the_sub_field('beschreibungs_titel'); ?></h4> 
						<?php endif; ?>

						<?php if(get_sub_field('beschreibung')) : ?>
							<div class="beschreibungstext"><?php the_sub_field('beschreibung'); ?></div> 
						<?php endif; ?>
					</div>





				
				<?php 
				/* =============================================================== *\ 
					Zitat
				\* =============================================================== */ 
				elseif( get_row_layout() == 'zitat_container' ): ?>
				<div class="zitat_container">
					<div class="zitat"><?php the_sub_field('zitat'); ?></div>
					<?php 
					if(get_sub_field('zitat_autor')):?>
						<div class="zitat_autor"><?php the_sub_field('zitat_autor'); ?></div>
					<?php endif; ?>
				</div>
				
				
				
				
				<?php 
				/* ================================================== *\ 
	 				Bild
				\* ================================================== */ 
				
				elseif( get_row_layout() == 'bild' ): ?>
				
					<?php 
					$image = get_sub_field('bild');
					$size = '3000_breit'; // (thumbnail, medium, large, full or custom size)

					if( $image ) : ?>
						<div class="bild_container scroll_fade_einheit">
							<div class="bild"><?php echo wp_get_attachment_image( $image, $size ); ?>
								<?php
								if( get_sub_field('bildlegende') ) : ?>
									<div class="bildlegende"><?php the_sub_field('bildlegende') ?></div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
					
				<?php 
				/* ================================================== *\ 
					Galerie
				\* ================================================== */ 	
				elseif( get_row_layout() == 'galerie' ): ?>

					<?php
					$images = get_sub_field('galerie');
					$size = 'medium'; // (thumbnail, medium, large, full or custom size)

					if( $images ): ?>
					<div class="gallery_container">

					   <ul class="gallery scroll_fade_einheit">
						   <?php foreach( $images as $image ): ?>
							   <li>
								   <?php echo wp_get_attachment_image( $image['ID'], $size ); ?>
							   </li>
						   <?php endforeach; ?>
					   </ul>
					   <?php
					   if( get_sub_field('bildlegende') ) : ?>
						   <div class="bildlegende"><?php the_sub_field('bildlegende') ?></div>
					   <?php endif; ?>
				   </div>
					<?php endif; ?> 
				
			<?php endif; ?>
		
			<?php endwhile; ?>
		</div>
		
	<?php endif; ?>






	<?php
	/* ================================================== *\ 

	 	 Solistenportrait 

	\* ================================================== */ 
	 ?>
	 
	 <?php if( have_rows('mitwirkende') ): ?>
		<?php while( have_rows('mitwirkende') ): the_row(); ?>
	
			 <?php if( have_rows('solisten_container') ): ?>
				 <div class="solisten_portrait_container">
				 
				 	<?php while( have_rows('solisten_container') ): the_row(); ?>
						
						<?php if(get_sub_field('solisten_portrait')==1) : ?>
							<div class="solisten_portrait scroll_fade_einheit">
								
								<h3 class="name">	
									<?php 
									if(get_sub_field('link')) : ?>
										<a class="underline" href="<?php the_sub_field('link'); ?>" target="_blank"><?php the_sub_field('solist'); ?></a>
									<?php else : ?>
										<?php the_sub_field('solist'); ?>
									<? endif; ?>
								</h3>
								
								<div class="instrument"><?php the_sub_field('instrument'); ?></div>
								
								<?php 
								$image = get_sub_field('portrait-bild');
								$size = 'konzert_bild'; // (thumbnail, medium, large, full or custom size)
								if( $image ) : ?>
									<div class="bild_container">
										<div class="bild"><?php echo wp_get_attachment_image( $image, $size ); ?></div>
									</div>
								<?php endif; ?>
				
								<div class="beschreibung"><?php the_sub_field('solisten-portrait-text'); ?></div>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php endif; //Solistenkontainer ?>
		<?php endwhile; ?>
	<?php endif; //mitwirkende ?>
	
	
	
	
	
	
	


<?php endwhile; endif; //post_loop ?>





	<?php
	/* =============================================================== *\ 

	 	 Weitere Konzerte 

	\* =============================================================== */ 
	  
	$args_weitere = array(
		'post_type' => array( 'agenda' ),
		);
	$query_weitere = new WP_Query( $args_weitere );
	?>

	<?php
	if ( $query_weitere->have_posts() ) : while ( have_posts() ) : the_post() 
	?>

	<?php 
	$count_posts = wp_count_posts('agenda'); 
	$published_posts = $count_posts->publish;

	if ($published_posts>1) : ?>
	<div class="mehr"><a class="button_box colored_link" href="<?php echo get_post_type_archive_link( "agenda" ); ?>"><?php the_field("link_text_previous_events","option"); ?></a></div>
	<?php endif; ?>

	<?php endwhile; ?>
	<?php endif; ?>

	<?php wp_reset_postdata(); ?>


</section>

































	<?php //get_sidebar(); ?>
	<?php get_footer(); ?>