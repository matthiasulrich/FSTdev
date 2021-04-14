<?php 
/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'testimonial-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'testimonial';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text = get_field('test') ?: 'Your testimonial here...';





?>
<div><?php echo $test; ?></div>
<?php

if( have_rows('repertoire-liste') ):

    while( have_rows('repertoire-liste') ) : 
        the_row();
        //$sub_value = get_sub_field('sub_field');
$werktitel = get_sub_field('werk_titel');
echo $werktitel;
    endwhile;


endif;
?>
<div class="programmpunkt_container">
    <div class="programmpunkt"><?php echo $attributes['migrane-rahmen']; ?></div>
</div>

