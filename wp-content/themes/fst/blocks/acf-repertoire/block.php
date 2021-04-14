<?php 
/**
 * repertoire Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'repertoire-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'repertoire';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

/* =============================================================== *\ 
     ACF-Felder auslesen
\* =============================================================== */ 
//ACF-Checkbox 
$werk_eigenschaften_classes = "";
$werk_eigenschaften = get_field('eigenschaften');
if( $werk_eigenschaften ): 
    foreach($werk_eigenschaften as $eigenschaft):
        $werk_eigenschaften_classes .= $eigenschaft . " ";
    endforeach;
endif; 

//ACF-Soundcloud
$soundcloud_url = "";
$soundcloud = get_field('soundcloud');
if($soundcloud):
    $soundcloud_url = $soundcloud;
endif;

//ACF-Rest
$acf_fields_array = array(
    'komponist-vorname',
    'komponist-nachname',
    'werk_titel',
    'entstehungs-jahr',
    'dauer',
    );
    
    
    
/* =============================================================== *\ 
 	 Content_Markup 
\* =============================================================== */ 

$content_markup = "";
foreach($acf_fields_array as $acf_field){    
    if(get_field($acf_field)){
        $$acf_field = get_field($acf_field);
        $content_markup .= "<span class=\"" . $acf_field . "\">" . $$acf_field . ", </span>";
    }else{
        $$acf_field = "";
    }
}
//letztes Komma weg
$content_markup = substr_replace($content_markup = rtrim($content_markup, ' ,'), '', strrpos($content_markup, ','), 1); 


/* =============================================================== *\ 
 	 Soundcloud 
\* =============================================================== */ 
if($soundcloud_url!=""):
    $fullstring = $soundcloud_url;    
    
    //grabbing the track number
    if(function_exists('get_track_number')==false){
        function get_track_number($string, $start, $end){
            $string = ' ' . $string;
            $ini = strpos($string, $start);
            if ($ini == 0) return '';
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;
            return substr($string, $ini, $len);
        }
    }
    $track_nr = get_track_number($fullstring, 'tracks/', '&color');
    
    //grabbing url
    if(function_exists('get_soundcloud_url')==false){
        function get_soundcloud_url($string, $start, $end){
            $string = ' ' . $string;
            $ini = strpos($string, $start);
            if ($ini == 0) return '';
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;
            return substr($string, $ini, $len);
        }
    }
    $soundcloud_link = get_soundcloud_url($fullstring, 'href="', '" title');
    $soundcloud_link;

    $content_markup .= '<span class="audio_buttons"><i style="font-size:15px" class="audio_button fas fa-play play" id="'; 
    $content_markup .= $id;
    $content_markup .='_play">&nbsp;</i><i style="font-size: 15px" class="audio_button fas fa-pause pause disabled" id="' . $id . '_pause"></i></span> <a href="' . $soundcloud_link .'" target="_blank"><i class="fab fa-soundcloud"></i></a>';

    //dummy iframesoundcloud_url vorbereiten
    $content_markup .= '<iframe style="visibility:hidden;margin-top:-100px" id="' . $id . '" width="100" height="100" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/';
    $content_markup .= $track_nr;
    $content_markup .= '&auto_play=false&hide_related=false&show_comments=false&show_user=false&show_reposts=false&show_teaser=false"></iframe>';

endif; ?>



<li class="repertoire_eintrag <?php echo $werk_eigenschaften_classes; ?>"><?php echo $content_markup; ?></li>
<?php if($soundcloud_url!=""): ?>
<script>
jQuery(document).ready(function ($) {
        $("#<?php echo $id; ?>_play").click(function() {
            SC.Widget("<?php echo $id; ?>").play();
        });

        $("#<?php echo $id; ?>_pause").click(function() {
            SC.Widget("<?php echo $id; ?>").pause();
        });        
  
});//ready beenden

</script>
<?php endif; ?>