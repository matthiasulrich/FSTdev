<div class="clear"></div>
</div>



<footer id="footer" role="contentinfo">

	<!--
	<div class="footer_menu_1"><?php wp_nav_menu(array( 'theme_location' => 'footer_menu_1' )); ?></div>
	<div class="footer_menu_2"><?php wp_nav_menu(array( 'theme_location' => 'footer_menu_2' )); ?></div>
	-->
	
	<div class="footer_content">
		<div class="adress"><?php the_field("adresse", "option")?></div>
		<div class="phone"><?php the_field("telefonnummer", "option")?></div>
		<div class="email"><a href="mailto:<?php the_field("e-mail","option")?>"><?php the_field("e-mail","option")?></a></div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>

<div id="linie_unten" class="linie"></div>

</body>
</html>
