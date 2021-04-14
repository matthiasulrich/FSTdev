<?php 
/*
* Template Name: Test Projekte
*/
?>
<?php get_header(); ?>
<section id="content" role="main">
<header class="header"></header>

<?php 
/* =============================================================== *\ 
 	 Sortier-Maschine anwerfen 
\* =============================================================== */ 
include get_template_directory() . '/template_parts/datum_sortier_maschine.php';
?>

<?php 
/* =============================================================== *\ 
 	 Startseite-Bild 
	 Wird ausgegeben, wenn über die Projekt-Übersicht kein Bild ausgegeben wird.
\* =============================================================== */ 
$bild_bei_projekt_vorhanden = false;
foreach($posts_to_show_array as $my_post):	
	$blocks = parse_blocks( get_the_content( null, false, $my_post ) );
	foreach ($blocks as $block) {
		if(($block["blockName"]=="core/image")&&(isset($block['attrs']['visibleOnArchive']))):
 			$bild_bei_projekt_vorhanden = true;		
		endif;
	}
endforeach;

if($bild_bei_projekt_vorhanden==false){
	$size = 'startseite'; // (thumbnail, medium, large, full or custom size)
	if(get_field("home-img", "option")){
		$image = get_field("home-img", "option");		
		echo wp_get_attachment_image($image, $size, "", ["id" => "startseite_bild"]);
	}
}
?>

<?php 
/* =============================================================== *\ 
 	 Ausgabe 
\* =============================================================== */ 
include get_template_directory() . '/template_parts/projekt_ausgabe.php';
?>
<?php 
/* =============================================================== *\ 
 	Prev- und Next ausgeben
\* =============================================================== */ 
include get_template_directory() . '/template_parts/prev_next_link.php';
?>

<?php get_footer(); ?>

