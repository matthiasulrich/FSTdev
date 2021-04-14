
<?php if(is_archive()==true){
    //echo "Archiv";
}
/*
Vergangenen Daten die Klasse .is_over hinzufügen*/
$my_offset =  get_option('gmt_offset'); //Zeitzone aus Wordpress-Eintstellungen auslesen
$my_time = time() + ($my_offset * 60 * 60); //in Stunden umrechnen

$today = date("YmdHi", $my_time ); // Zeitangabe mit Offset
$block_date = date_i18n( 'YmdHi', strtotime( $attributes['date-time-picker'] ) );
//date_i18n( string $format, int|bool $timestamp_with_offset = false, bool $gmt = false )

if($today>$block_date): 
    $my_block_class = "datum_ort_container is_over";
else:
        $my_block_class = "datum_ort_container ";
endif; 

//Block ausgeben
?>
<div class="<?php echo $my_block_class; ?>">
    <span><?php echo date_i18n( 'j. F Y • H:i', strtotime( $attributes['date-time-picker'] ) ); ?> Uhr</span>
    
    <?php 
    //Ort 
    if($attributes['ort']!=""): ?>
        <span class="bull"> •</span> <span><?php echo $attributes['ort']; ?></span>
    <?php endif; ?>
    
    <?php 
    //Link
    if(($attributes['link']!="")&&($attributes['link-text']!="")): ?>
        <span class="bull"> •</span> <a href="<?php echo $attributes['link']; ?>" target="_blank"><?php echo $attributes['link-text']; ?></a>
    <?php elseif(($attributes['link']!="")&&($attributes['link-text']=="")): ?>
        <span class="bull"> •</span> <a href="<?php echo $attributes['link']; ?>" target="_blank"><?php echo $attributes['link']; ?></a>
    <?php endif; ?>
    
    <?php 
    //Link
    if($attributes['alert-text']!=""): ?>
        <span class="bull"> •</span> <span class="alert-text"><?php echo $attributes['alert-text']; ?></span>
    <?php endif; ?>
</div>        

