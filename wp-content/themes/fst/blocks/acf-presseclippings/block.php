<?php 
/**
 * Presse-Clippings Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
/* =============================================================== *\ 
    https://www.tring-web-design.co.uk/2017/04/acf-gallery-automated-zip-file-download/ 
 	 ZIP > functions.php 
\* =============================================================== */ 
  

// Create id attribute allowing for custom "anchor" value.
$id = 'presseclip-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'presseclip';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

/* =============================================================== *\ 
     ACF-Felder auslesen
\* =============================================================== */ 
$size = 'medium'; // (thumbnail, medium, large, full or custom size)
$image = get_field('teaser_bild');
$teaser_satz = get_field('teaser_satz');
$zeitungstitel = get_field('zeitungstitel');
$erscheinungsdatum = get_field('erscheinungsdatum');

// Zeitungstitel und Erscheinungsdatum zusammensetzen
$quellenangabe = $zeitungstitel;
if($erscheinungsdatum){
    $quellenangabe = $quellenangabe . ", " . $erscheinungsdatum;
}

//PDF Link setzen, wenn PDF vorhanden
$pdf_link = get_field('original_scan');
$link_open_markup = "";
$link_close_markup = "";
if($pdf_link){
    $link_url = $pdf_link;
    $link_open_markup = '<a href="' . $pdf_link . '" target="_blank">';
    $link_close_markup = '</a>';
}


/* =============================================================== *\ 
	Presse-Clippings
\* =============================================================== */ 
?>

<div class="presseclippings">
	<?php		
	if( $image ) :
        echo $link_open_markup;
		echo wp_get_attachment_image( $image, $size,  "", array( "class" => "pressebild" ) );
        echo $link_close_markup;
	endif;
    
    if($teaser_satz):
        echo $link_open_markup;
        echo '<p class="teaser_satz">' . $teaser_satz . '</p>';
        echo $link_close_markup;
    endif;		

    if($quellenangabe!=""):
        echo $link_open_markup;
        echo '<p class="quellenangabe">' . $quellenangabe . '</p>';
        echo $link_close_markup;
    endif;    
    ?>
</div>