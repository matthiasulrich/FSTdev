<?php get_header(); ?>
<section id="content" role="main">
<header class="header">
<h1 class="entry-title"><?php
if ( is_day() ) { printf( __( 'Daily Archives: %s', 'betschart-gh' ), get_the_time( get_option( 'date_format' ) ) ); }
elseif ( is_month() ) { printf( __( 'Monthly Archives: %s', 'betschart-gh' ), get_the_time( 'F Y' ) ); }
elseif ( is_year() ) { printf( __( 'Yearly Archives: %s', 'betschart-gh' ), get_the_time( 'Y' ) ); }
else { the_field("site_titel_previous_events","option");}
?></h1>
</header>




<div class="agenda_container">	

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
	<?php echo "archive-konozert-archiv"; ?>
	
	
	
	<div class="auftritt">

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
		if (get_field("konzert_titel")) : ?>
			
			
			<?php 					 
			if (get_field("unterseite_anzeigen")) : ?>
				<a class="colored_link" href="<?php the_permalink();?>"><div class="konzert_titel"><?php the_field("konzert_titel"); ?></div></a>
			<?php else: ?>
				<div class="konzert_titel"><?php the_field("konzert_titel"); ?></div>
			<?php endif; ?>
		
		
		<?php endif; ?>


		<?php 
		/* =============================================================== *\ 

	 	 Teaserbild 

		 \* =============================================================== */ 
	  
		$image = get_field('teaser-bild');
		$size = 'medium'; // (thumbnail, medium, large, full or custom size)
		echo wp_get_attachment_image( $image, $size, "", ["class" => "teaser_bild"] ); 
		?>
	</div>
	
	
	
	

<?php endwhile; endif; ?>
</div>
<?php //get_template_part( 'nav', 'below' ); ?>
</section>


<div class="mehr"><a class="colored_link" href="<?php echo get_post_type_archive_link( "agenda" );  ?>"><?php the_field("link_text_upcoming_events","option"); ?></a></div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
