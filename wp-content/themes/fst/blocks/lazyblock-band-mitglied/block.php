<?php 
//Block-Attributes
/*portrait
name
instrument
kurzbio*/






?>
<div class="band_member">
    <?php 
    if ( isset( $attributes['portrait']['id'] ) ) {
        echo wp_get_attachment_image( $attributes['portrait']['id'], 'startseite', false, array('class'=>'band_member_bild'));
    }
    ?>
    <div class="text_container">
		<h2><?php if(isset($attributes['name'])){
            echo $attributes['name'];
        } ?></h2><br>
        
		<div class="instrument"><?php if(isset($attributes['instrument'])){
            echo $attributes['instrument'];
        } ?></div>
        
		<div class="kurzbio"><?php if(isset($attributes['kurzbio'])){
            echo $attributes['kurzbio'];
        }; ?></div>
	</div>
</div>



