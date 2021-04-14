<?php
/**
 * Restricted Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" and "align" values.
$classes = '';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}
if( !empty($block['align']) ) {
    $classes .= sprintf( ' align%s', $block['align'] );
}
?>
<style>
/*Block-Überschrift*/
.my_block_notification{
    display:none;
    }
.wp-admin .my_block_notification{ 
    display: block;
    padding: 5px 10px 0;
    font-weight: 500;
    }
.wp-admin .repertoire_container_block{
    background: #ececec;
    border-radius: 5px;
    border: 1px solid;
}
/*Block-Container*/
.repertoire_container_block ul.repertoire_container{
    margin:0;
    padding:0px;
    }
    
.wp-admin .repertoire_container_block ul.repertoire_container{
    padding:10px;
    }
    
/*Einzelne Blocks*/
.repertoire_container_block .block-editor-block-list__block{
    margin-top:0;
    margin-bottom: 10px;
    }

.repertoire_container_block .acf-block-component .acf-block-fields{
    background: white;
    border: 0px solid black;
    border-radius: 5px;
    padding: 7px 0;
    }
    
.repertoire_container_block .acf-fields>.acf-field{
    border:0px solid black;
    padding:5px 10px;
}
div[data-name="werk_titel"] .acf-label,
div[data-name="komponist-vorname"] .acf-label,
div[data-name="komponist-nachname"] .acf-label,
div[data-name="entstehungs-jahr"] .acf-label,
div[data-name="dauer"] .acf-label,
div[data-name="eigenschaften"] .acf-label{
    display:none;
}
div[data-name="eigenschaften"] .acf-checkbox-list{
    margin: 0;
    padding: 0;
}
</style>


<div class="repertoire_container_block <?php echo esc_attr($classes); ?>">

    <span class="my_block_notification">Container-Block für Repertoire</span>
    
    <?php if( !$is_preview ) : ?>
    <div id="filter_sort_buttons" style="">
			<div id="filters" class="button_group_filtern">  
				<button class="button" data-filter=".trio">Trio</button>
				<button class="button" data-filter=".duo">Duo</button>
				<button class="button" data-filter=".solo">Solo</button>
				<button class="button" data-filter=".erweiterte_besetzung">Erweiterte Besetzung</button>
				<button class="button" data-filter=".fuer_fst_komponiert">Für Fathom String Trio komponiert</button>
			</div>

			<div id="sorts" class="button_group_sortieren">  
				<button class="button" data-sort-value="nachname">Name</button>
				<button class="button" data-sort-value="werktitel">Werktitel</button>
				<button class="button" data-sort-value="entstehungsjahr">Jahr</button>
			</div>
		</div>
    
    <?php endif; ?>
    
    
    
    <ul class="repertoire_container">
        <?php $allowed_blocks = array( 'acf/repertoire' );
        echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" />';
        ?>
    </ul>
</div>



