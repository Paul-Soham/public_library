<?php
/*
Template Name: Spaces & Rooms
*/
get_header(); ?>
<div class="container-fluid inner-banner-blog" style="background: url(<?php echo wp_kses_post( get_field('banner_image') ); ?>); background-size: cover; background-repeat: no-repeat;">
	<h4 class="inner-banner-heading"><?php echo wp_title('');?></h4>
	<?php get_breadcrumb(); ?>
</div>
<div class="container-fluid my-5 reserve-form">
	<div class="container">
		<h3 class="heading-text mb-4"><?php echo wp_kses_post( get_field('form_heading') ); ?></h3>
		<p class="mb-4"><?php echo wp_kses_post( get_field('form_description') ); ?></p>
		<?php echo do_shortcode( '[contact-form-7 id="8f9329a" title="Booking Form"]' ); ?>
	</div>
</div>
<?php get_footer(); ?>