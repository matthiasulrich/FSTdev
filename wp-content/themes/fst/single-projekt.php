<?php get_header(); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : 
	while ( have_posts() ) : 
		the_post(); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php
		$my_blockName = 'lazyblock/auffuhrung';
		$blocks = parse_blocks($post->post_content);

		/* =============================================================== *\ 
			Aufführungen im Projekt drin sortieren 
		\* =============================================================== */ 	
		array_multisort(array_map(function($element) {
			if(isset($element['attrs']['date-time-picker'])){
				return $element['attrs']['date-time-picker'];
			}
		}, $blocks), SORT_ASC, $blocks);	

		foreach ($blocks as $block) {
			if ( $my_blockName === $block['blockName'] ) {
				$content_markup = render_block( $block );
				echo $content_markup;
			}
		}
		?>
		<?php 
		/* =============================================================== *\ 

 	 Visible 

\* =============================================================== */ 
  

		$content_markup = '';
		foreach ( $blocks as $block ) {
			//print_r($block);
			if ( $my_blockName === $block['blockName'] ) {
				continue;
			} else {
				if(isset($block['attrs']['hideOnSingle']) && ($block['attrs']['hideOnSingle']==true)){
					continue;					
				}else{
					$content_markup .= render_block( $block );
				}
			}
		}

		// Remove wpautop filter so we do not get paragraphs for two line breaks in the content.
		$priority = has_filter( 'the_content', 'wpautop' );
		if ( false !== $priority ) {
			remove_filter( 'the_content', 'wpautop', $priority );
		}

		echo apply_filters( 'the_content', $content_markup );

		if ( false !== $priority ) {
			add_filter( 'the_content', 'wpautop', $priority );
		}
		
		?>
		<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
	<?php endwhile; ?>
<?php endif; ?>

<?php 
/*
$post = get_queried_object();
$postType = get_post_type_object(get_post_type($post));
if ($postType) :
	$archive_name =  esc_html($postType->labels->singular_name); ?>
	<a href="<?php echo get_post_type_archive_link('projekt'); ?>" style="border-bottom:0px;"><i class="fas fa-arrow-alt-left"></i></a><a href="<?php echo get_post_type_archive_link('projekt'); ?>"> <?php echo $archive_name; ?></a>
<?php endif;
*/
?>

</section>

<?php 
/* =============================================================== *\ 
 	Prev- und Next ausgeben
\* =============================================================== */ 
include get_template_directory() . '/template_parts/prev_next_link.php';
?>



<?php //get_sidebar(); ?>
<?php get_footer(); ?>