<?php 
/* =============================================================== *\ 
\* =============================================================== */ 
$button_beschriftung = $attributes['button-beschriftung'];
//var_dump($attributes);
//$sprach_kuerzel = pll_current_language('slug');
$filename = site_url() . "/downloads/fathom_string_trio.zip";
?>


<div class="pressematerial">
    <span class="my_block_notification">Container-Block für Pressemappe</span>
	
	<div class="download_pressematerial_container">
		<div class="material_liste"><?php //if (get_field("hinweis")){the_field("hinweis");} ?></div>
		<div class="download_pressematerial"><a class="red_link colored_link" href="<?php echo $filename; ?>" target="_blank"><?php echo $button_beschriftung; ?></a></div>
	</div>
</div>