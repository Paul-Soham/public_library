<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Shantell+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

		<!--     
<link rel="stylesheet" href="< ?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="< ?php echo get_template_directory_uri(); ?>/css/main.css"> 
-->

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">

		<title><?php echo wp_title('');?></title>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<nav class="navbar navbar-expand-lg navbar-light bg-light align-item-center">

			<a class="navbar-brand" href="<?php echo home_url(); ?>">
				<img src="<?php the_field('header_logo', 'option'); ?>">
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav ml-auto header-menu">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'main_menu',
						'container' => false, 
						'items_wrap' => '%3$s',
						'depth' => 1,
						'fallback_cb' => false,
						'menu_item_class' => 'nav-item',
						'menu_item_link_class' => 'nav-link',
					));
					?>
				</ul>
			</div>

			<div class="social-icons">
				<ul class="list-unstyled d-flex mb-0">
					<?php 
						if( have_rows('social_icons', 'option') ):
						while ( have_rows('social_icons', 'option') ) : the_row(); 
					?>
					<li>
						<a class="social-icons-link" href="<?php the_sub_field('social_link'); ?>">
							<img src="<?php the_sub_field('social_images'); ?>">
						</a>
					</li>
					<?php 
						endwhile; 
						endif;
					?>
				</ul>
			</div>
		</nav>