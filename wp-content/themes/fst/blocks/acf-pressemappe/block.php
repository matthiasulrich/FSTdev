<?php 
/**
 * Presse-Mappe Block Template.
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
$id = 'pressemappe-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'pressemappe';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

/* =============================================================== *\ 
     ACF-Felder auslesen
\* =============================================================== */ 
if (get_field('button_beschriftung')){
    $button_beschriftung = get_field('button_beschriftung');
}

//$sprach_kuerzel = pll_current_language('slug');
$filename = site_url() . "/downloads/fathom_string_trio.zip";
?>


<div class="pressematerial">	
	<div class="download_pressematerial_container">
		<div class="material_liste"><?php //if (get_field("hinweis")){the_field("hinweis");} ?></div>
		<div class="download_pressematerial"><a class="red_link colored_link" href="<?php echo $filename; ?>" target="_blank"><?php echo $button_beschriftung; ?></a></div>
	</div>
</div>
