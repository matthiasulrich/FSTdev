<?php get_header(); ?>


<?php 
/* =============================================================== *\ 
 	 Posts werden nach Aufführungsdaten gefiltert
	 - zeigt alle Projekte an, welche mindestens ein Aufführungsdatum in der Zukunft haben (das Datum des heutigen Tages wird auch dazugezählt)
	 - vergangene Aufführungsdaten kann man evtl. gestalterisch auszeichnen, sind aber sichtbar. 
\* =============================================================== */ 
  

// Heutiges Datum bestimmen
//date_default_timezone_set('Europe/Zurich'); 
$today = date('Ymd', strtotime("now")); 

// Posts auslesen
$upcoming_args = array(
	'post_type' => 'agenda',
	'posts_per_page' => -1,
	'meta_key' => 'datum_repeater',
	//'meta_compare' => 'between',
	//'meta_type' => 'numeric',
	//'meta_value' => array($date_1, $date_2),
	//'orderby' => 'meta_value_num',
	'order' => 'ASC'
); 
$upcoming_query = new WP_Query( $upcoming_args ); 

// Array mit Aufführungsdaten erstellen
if ( $upcoming_query->have_posts() ) : 
	
	/* =============================================================== *\ 
		Zwei Arrays erstellen (das erste kann eigentlich gelöscht werden)
		
		// Ein Array-Item per Post
			// post_id
			// aufführungs_daten
				// xxxx
				// xxxx
				
		// Ein Array-Item per Aufführungsdatum
			// post_id (kommt dann mehrfach vor)
			// aufführungs_datum
	\* =============================================================== */ 

	$my_post_array = array();
	$my_auffuehrungs_datum_array = array();

	while ( $upcoming_query->have_posts() ) : 
		$upcoming_query->the_post(); 
		$my_post_ID = get_the_ID();
		$newdata =  array (
		  'my_post_ID' => get_the_ID(),
		);
		
		//Beide Arrays mit Aufführungsdaten befüllen
		if( have_rows('datum_repeater') ):
			while ( have_rows('datum_repeater') ) : 
				the_row();
				
				$sub_value = get_sub_field('datum', false, false);
				$newdata['auffuehrungs_daten'][] = $sub_value;

				$my_ID = get_the_ID();
				
				$my_subarray = array(
					"my_id" => $my_ID,
					"my_auffuehrung" => $sub_value
				);
				
				$my_auffuehrungs_datum_array[] = $my_subarray;		
								
			endwhile;
		endif;
		
		$my_post_array[] = $newdata; ?>
		
	<?php endwhile; ?>
<?php endif; // Beide Arrays sind nun befüllt


/* =============================================================== *\ 
	 Array modulieren
	 my_auffuehrungs_datum_array 
\* =============================================================== */ 

// nach Auffuehrungs-Datum aufsteigend sortieren 
$my_auffuehrung  = array_column($my_auffuehrungs_datum_array, 'my_auffuehrung');
array_multisort($my_auffuehrung, SORT_ASC, $my_auffuehrungs_datum_array);

//vergangene Einträge aus array löschen
function my_removeElementWithValue($array, $key){
	global $today;
	$gestern = $today - 1;
	foreach($array as $subKey => $subArray){
		if($subArray[$key] <= $gestern){
			unset($array[$subKey]);
		}
	}
	return $array;
}
$my_auffuehrungs_datum_array = my_removeElementWithValue($my_auffuehrungs_datum_array, "my_auffuehrung");

//doppelte Einträge löschen
function super_unique($array,$key){
	$temp_array = [];
	foreach ($array as &$v) {
		if (!isset($temp_array[$v[$key]])){
			$temp_array[$v[$key]] =& $v;
		}
	}
	$array = array_values($temp_array);
	return $array;
}
$my_auffuehrungs_datum_array = super_unique($my_auffuehrungs_datum_array,'my_id');

/* =============================================================== *\ 
 	 Develop-Control 
\* =============================================================== */ 
/*
echo "my_auffuehrungs_datum_array: <br />";	
print_r($my_auffuehrungs_datum_array);
echo "<br />";
echo "my_post_array: <br />";
print_r($my_post_array);
*/
?>



<section id="content" role="main">
	<header class="header">
		<h1 class="entry-title"><?php the_field("site_titel_upcoming_events","option"); ?></h1>
	</header>
	
	<div class="agenda_container">	
		
	<?php 
	/*if ( have_posts() ) : 
		while ( have_posts() ) : 
			the_post(); 
	*/		
	foreach($my_auffuehrungs_datum_array as $my_post):
		$my_post_id = $my_post['my_id'];
		echo $my_post_id;
		?>
		
	
		<div class="auftritt post-<?php echo $my_post_id; ?>">
			<?php 
			if (get_field("konzert_titel", $my_post_id)) : ?>
				
				<?php 					 
				if (get_field("unterseite_anzeigen", $my_post_id)) : ?>
					<a class="colored_link" href="<?php the_permalink($my_post_id);?>"><div class="konzert_titel"><?php the_field("konzert_titel", $my_post_id); ?></div></a>
				<?php else: ?>
					<div class="konzert_titel"><?php the_field("konzert_titel", $my_post_id); ?></div>
				<?php endif; ?>
			<?php else: ?>
				<?php echo get_the_title($my_post_id); ?>
			<?php endif; ?>
			
			<div>
				<?php 
  				/* =============================================================== *\ 
 	 			   Datum-Repeater auslesen
                   Bestimmen, ob Veranstaltung in Vergangenheit liegt
				\* =============================================================== */ 
				if( have_rows('datum_repeater', $my_post_id) ):
					while( have_rows('datum_repeater', $my_post_id) ) : 
						the_row();
        				$datum = get_sub_field('datum'); 
						$datum_blank = get_sub_field('datum', false);
						$zeit = get_sub_field('zeit');
						if(get_sub_field('zeit')){
							$zeit = "<span class='bull'> &bull;</span> ";
							$zeit .= get_sub_field('zeit');	
							$zeit .= " Uhr";						
						}else{
							$zeit = "";
						};
                        $is_over_class = "";
                        if($datum_blank < $today){$is_over_class="is_over";}
                        ?>
                        
						<div class="datum_zeit_container <?php echo $is_over_class; ?>">
								<span class="datum" ><?php echo $datum; ?></span>
								<span class="zeit"> <?php echo $zeit; ?></span>
						</div>
    					<?php
                        
    					/* =============================================================== *\ 
    					   Indiviuelle Locations-Daten ausgeben 
    					\* =============================================================== */ 
                        $location_name = get_sub_field('location_name');
                        $location_link = get_sub_field('adresse_oder_webseite_repeater');
                        ?>
                        
                        <?php if(get_field("hat_an_unterschiedlichen_locations_stattgefunden")==true): ?>
                            <div class="lokalitaet_und_ort <?php echo $is_over_class; ?>">

                                <?php
                                // Webseite
                                if($location_link == "webseite") : ?>
                                    <a class="colored_link" href="<?php the_sub_field("location_website_repeater"); ?>" target="_blank"><span class="location_town"><?php the_sub_field('location_name'); ?></span></a>
                                <?php 
                                // Google Directories
                                elseif($location_link == "googlemaps") : ?>
                                    <?php 
                                    $google_map_field = get_sub_field("location_address_repeater");
                                    $map_link = 'https://www.google.com/maps/dir//' . urlencode( str_replace( '% ', ' ' , $google_map_field ) ); 
                                    ?>
                                    <a class="colored_link" href="<?php echo $map_link; ?>" target="_blank"><span class="location_town"><?php the_sub_field('location_name'); ?></span></a>
                                <?php	
                                // Kein Link setzen
                                 else : ?>
                                    <span class="location_town"><?php the_sub_field('location_name'); ?></span>
                                <?php endif; ?>
                                
                                <?php if(get_sub_field("ort_repeater")) : ?>
                                    <?php echo "<span class='bull'>&bull; </span>"; ?><span class="ort"><?php the_sub_field('ort_repeater'); ?></span>
                                <?php endif; ?>

                            </div>
                        <?php endif; //hat_an_unterschiedlichen_locations_stattgefunden ?>
                    <?php endwhile; //datum-repeater ?>
    			<?php endif; //datum-repeater ?>
			</div>
			<!--&curren;-->
			<?php 
			$location_link = get_field('adresse_oder_webseite');
			?>

			<?php
			/* =============================================================== *\
				Einmalige Location-Daten ausgeben
			\* =============================================================== */ 
            if(get_field("hat_an_unterschiedlichen_locations_stattgefunden")==false): ?>

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
    								
    				<?php if(get_field("ort")) : ?>
    					<?php echo "<span class='bull'>&bull; </span>"; ?><span class="ort"><?php the_field('ort'); ?></span>
    				<?php endif; ?>

    			</div>
            <?php endif; //hat_an_unterschiedlichen_locations_stattgefunden ?>
			

			<?php 
			/* =============================================================== *\ 

		 	 Teaserbild 

			 \* =============================================================== */ 
		  echo "teaserbild";
			$image = get_field('teaser-bild');
			$size = 'medium'; // (thumbnail, medium, large, full or custom size)
			echo wp_get_attachment_image( $image, $size, "", ["class" => "teaser_bild"] ); 
			?>

		</div>
		
		
		
		

	<?php 
endforeach;
	//endwhile; endif; ?>
	</div>
<?php //get_template_part( 'nav', 'below' ); ?>
</section>


<div class="mehr"><a class="colored_link" href="<?php echo get_post_type_archive_link( "konzert-archiv" ); ?>"><?php the_field("link_text_previous_events","option"); ?></a></div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
