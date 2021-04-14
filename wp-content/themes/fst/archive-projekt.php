<?php get_header(); ?>
<section id="content" role="main">
<header class="header">
<h1 class="entry-title">Vergangene Projekte</h1>
</header>
<?php 

include get_template_directory() . '/template_parts/datum_sortier_maschine.php';
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
