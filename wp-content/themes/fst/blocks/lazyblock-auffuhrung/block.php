
<?php if(is_archive()==true){
    //echo "Archiv";
}
?>
<div>
    <?php echo date_i18n( 'F j, Y', strtotime( $attributes['date-time-picker'] ) ); ?>
</div>