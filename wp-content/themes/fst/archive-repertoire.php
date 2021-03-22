<?php get_header(); ?>
<section id="content" role="main">
<header class="header">
<h1 class="entry-title">Repertoire</h1>
</header>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part( 'entry', 'content' ); ?>
	<?php
	if (have_rows("repertoire-liste")): ?> 
	
		<div id="rep_filter_sort">Filter</div>
		<div id="filter_sort_buttons" style="display:none">
			<div id="filters" class="button_group_filtern">  
				<button class="button" data-filter=".trio">Trio</button>
				<button class="button" data-filter=".duo">Duo</button>
				<button class="button" data-filter=".solo">Solo</button>
				<button class="button" data-filter=".erweiterte_besetzung">Erweiterte Besetzung</button>
				<button class="button" data-filter=".fuer_fst_komponiert">Für Fathom String Trio komponiert</button>
			</div>

			<div id="sorts" class="button_group_sortieren">  
				<!--<button class="button is-checked" data-sort-by="original-order">original order</button>-->
				<button class="button" data-sort-value="nachname">Name</button>
				<button class="button" data-sort-value="werktitel">Werktitel</button>
				<button class="button" data-sort-value="entstehungsjahr">Jahr</button>
			</div>
		</div>
		<ul class="repertoire_grid">
			<?php
			while (have_rows("repertoire-liste")):
				the_row(); ?>

				<?php 
				//klasssen aus Checkboxen herauslesen und in ein Array packen
				// Array in einen String umwandeln - mit Leerzeichen zwischen den einzelnen Items
				$class_arr = get_sub_field('eigenschaften');
				$css_klassen = implode(" ", $class_arr);
				?>
				
				<?php
				if (get_sub_field('komponist')):
					$komponist = get_sub_field('komponist');
					$vorname = $komponist['komponist-vorname'];
					$nachname = $komponist['komponist-nachname'];
					?>
				<?php endif; ?>

				<?php 
				if(get_sub_field('werk_titel')):
					$werktitel = get_sub_field('werk_titel'); 
				?>
				<?php endif; ?>

				<li class="repertoire_eintrag <?php echo $css_klassen; ?>">
					<span class="vorname"><?php echo $vorname; ?></span><span> </span>
					<span class="nachname"><?php echo $nachname; ?></span><span>, </span> 
					<span class="werktitel"><?php echo $werktitel; ?></span></li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
</article>


<?php endwhile; endif; ?>
</section>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
