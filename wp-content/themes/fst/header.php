<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="Beschreibung hier">

<!-- Global site tag (gtag.js) - Google Analytics -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-78418230-17"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-78418230-17');
</script>
-->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/favicon-16x16.png">
<link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/safari-pinned-tab.svg" color="#000000">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
	
<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
<div id="linie_oben" class="linie"></div>

	<div id="page_wrapper" class="hfeed">
		<header id="header">
			<div id="branding">
				<div id="site-title">
					<?php if (is_home()==true){ ?>
						<h1>
					<?php } else{ ?>
						<div>
					<?php } ?>
					<a href="<?php echo home_url(); ?>"><img id="fathom_string_trio_logo" src="<?php echo get_stylesheet_directory_uri();?>/images/fathom_string_trio_logo-05.svg" alt="Fathom String Trio Logo" /></a>			
					<?php if (is_home()==true){ ?>
						</h1>
					<?php } else { ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<nav id="menu">
				<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
				<?php wp_nav_menu( array( 'theme_location' => 'main_menu_2' ) ); ?>
			</nav>
			<div id="hamburger_container"><div class="hamburger"> <span class="line"></span> <span class="line"></span> <span class="line"></span></div></div>	
		</header>
		

		<div id="content_container">