<footer class="container-fluid ftr">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-3 logo-address">
				<img src="<?php the_field('header_logo', 'option'); ?>" class="img-fluid mb-4">
				<p><?php the_field('footer_address', 'option'); ?></p>
			</div>

			<div class="col-12 col-md-3 footer-link-col">
				<h5 class="mb-3"><?php echo esc_html( wp_get_nav_menu_name( 'footer_menu_one' ) ); ?></h5>
				<ul class="list-unstyled mb-0">
					<?php
					// Output the menu items
					wp_nav_menu( array(
						'theme_location' => 'footer_menu_one',
						'container' => '',
						'items_wrap' => '%3$s', // Output only the list items
					) );
					?>
				</ul>
			</div>


			<div class="col-12 col-md-3 footer-link-col">
				<h5 class="mb-3"><?php echo esc_html( wp_get_nav_menu_name( 'footer_menu_two' ) ); ?></h5>
				<ul class="list-unstyled mb-0">
					<?php
					// Output the menu items
					wp_nav_menu( array(
						'theme_location' => 'footer_menu_two',
						'container' => '',
						'items_wrap' => '%3$s', // Output only the list items
					) );
					?>
				</ul>
			</div>

			<div class="col-12 col-md-3 footer-link-col">
				<h5 class="mb-3"><?php echo esc_html( wp_get_nav_menu_name( 'footer_menu_three' ) ); ?></h5>
				<ul class="list-unstyled mb-0">
					<?php
					// Output the menu items
					wp_nav_menu( array(
						'theme_location' => 'footer_menu_three',
						'container' => '',
						'items_wrap' => '%3$s', // Output only the list items
					) );
					?>
				</ul>
			</div>
		</div>
	</div>
</footer>

<div class="container-fluid after-ftr-copyright text-center">
	<div class="container" style="display: flex; justify-content: center;">
		<p>Copyright © <?php echo date('Y'); ?>, <?php the_field('footer_bottom_copyright_text', 'option'); ?></p>
	</div>
</div>

<!-- Optional JavaScript -->

  
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/popper.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

<script>
	jQuery("#carousel").owlCarousel({
		autoplay: true,
		loop: true,
		margin: 20,
		responsiveClass: true,
		autoHeight: true,
		autoplayTimeout: 7000,
		smartSpeed: 800,
		nav: true,
		responsive: {
			0: {
				items: 1
			},

			600: {
				items: 2
			},

			1024: {
				items: 3
			},

			1366: {
				items: 3
			}
		}
	});
</script>

<script>
        $(document).ready(function(){
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            $('#timepicker').timepicker({
                minuteStep: 1,
                showSeconds: false,
                showMeridian: false
            });
        });
    </script>

<?php wp_footer(); ?>
</body>
</html>