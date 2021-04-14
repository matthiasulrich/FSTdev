<?php 
/* =============================================================== *\ 
	Prev- und Next-Link ausgeben
\* =============================================================== */ 

$current_post_ID = get_the_ID();
include get_template_directory() . '/template_parts/datum_sortier_maschine.php';


/* =============================================================== *\ 
 	 Weiche:
	 Aktuell angezeigter Post ist ein Current-Project 
	 oder Archive-Project
\* =============================================================== */ 
/*
// ist Current-Project
if(in_array ( $current_post_ID, $posts_to_show_array)==true):
	//echo "current: " . $current_post_ID . "</br>";
	$index = array_search($current_post_ID, $posts_to_show_array);
	if($index !== false && $index > 0 ): // next Link
		$prev = $posts_to_show_array[$index-1]; ?>
		<i class="fas fa-caret-right"></i> <a href="<?php echo get_permalink($prev); ?>"><?php echo get_the_title($prev);?></a>
	<?php endif; ?>
	
	<?php
	if($index !== false && $index < count($posts_to_show_array)-1): // Prev Link
		$next = $posts_to_show_array[$index+1]; ?>
		<i class="fas fa-caret-right"></i> <a href="<?php echo get_permalink($next); ?>"><?php echo get_the_title($next);?></a> 
		
	<?php endif; ?>
<?php
// ist Archive-Project
else:
	echo "archive";
endif;

*/
?>
<?php
/* =============================================================== *\ 

 	 Variante 
	 > alle Projekte ausgeben, ausser das aktuelle,
	 > vollständig vergangene Projekte ausgegraut
\* =============================================================== */ 
//Current-Posts

$my_future_array = array();
$my_past_array = array();
$prev_next_title = "";
if(is_home()==true):
	$my_past_array = $expired_posts_array;
	$prev_next_title = "Vergangene Projekte";
elseif(is_archive()==true): 
	$my_future_array = $all_project_IDs;
	$prev_next_title = "achrive true";
else: 	
	$my_future_array = $posts_to_show_array;
	$my_past_array = $expired_posts_array;
	$prev_next_title = "Weitere Projekte";
endif; ?>

<ul class="other_projects">
<h3><?php echo $prev_next_title; ?></h3>
<?php 
foreach($my_future_array as $menu_item): 
	if($menu_item != $current_post_ID): ?>
		<li><i class="fas fa-caret-right"></i> <a class="" href="<?php echo get_permalink($menu_item); ?>"><?php echo get_the_title($menu_item);?></a></li>
	<?php endif; ?>
<?php endforeach; ?>

<?php
foreach($my_past_array as $menu_item): 
	if((is_home()==true) || ($menu_item != $current_post_ID)): ?>
		<li><i class="fas fa-caret-right is_over"></i> <a class="is_over" href="<?php echo get_permalink($menu_item); ?>"><?php echo get_the_title($menu_item);?></a></li>
	<?php endif; ?>
<?php endforeach; 
?>
</ul>

