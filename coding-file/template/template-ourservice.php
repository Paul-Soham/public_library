<?php
/*
Template Name: Our Service
*/
get_header(); ?>
<div class="container-fluid inner-banner-blog" style="background: url(<?php echo get_field('banner_image'); ?>); background-size: cover; background-repeat: no-repeat;">
	<h4 class="inner-banner-heading"><?php echo wp_title('');?></h4>
	<?php get_breadcrumb(); ?>
</div>
<div class="container-fluid staff-section">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-7 pt-4">
				<?php $staff_section_heading = get_field('staff_section_heading');
				if (!empty($staff_section_heading)) : ?>
				<h3 class="heading-text mb-5"><?php echo esc_html($staff_section_heading); ?></h3>
				<?php endif; ?>

				<?php $staff_section_description = get_field('staff_section_description');
				if (!empty($staff_section_description)) {
					echo wp_kses_post($staff_section_description);
				} ?>

				<?php $staff_section_button_link = get_field('staff_section_button_link');
				$staff_section_button_text = get_field('staff_section_button_text');
				if (!empty($staff_section_button_link) && !empty($staff_section_button_text)) : ?>
				<a class="btn btn-grey" href="<?php echo esc_url($staff_section_button_link); ?>" role="button"><?php echo esc_html($staff_section_button_text); ?></a>
				<?php endif; ?>
			</div>

			<div class="col-12 col-md-5 text-right mt-5 mt-md-0">
				<?php $staff_section_image = get_field('staff_section_image');
				if (!empty($staff_section_image)) : ?>
				<img src="<?php echo esc_url($staff_section_image); ?>" class="img-fluid">
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid our-service-section">
	<div class="container">
		<h3 class="heading-text mb-5 text-center"><?php echo get_field('our_services_heading'); ?></h3>
		<div class="row">
			<?php 
			if( have_rows('serviceses') ):
			while ( have_rows('serviceses') ) : the_row(); 
			?>

			<div class="col-12 col-md-4 services-box">
				<div class="services-box-img">
					<img src="<?php echo get_sub_field('service_image'); ?>" class="img-fluid">
				</div>
				<a href="<?php echo get_sub_field('service_link'); ?>">
					<h4><?php echo get_sub_field('service_heading'); ?></h4>
				</a>
				<p><?php echo get_sub_field('service_description'); ?></p>
			</div>
			<?php 
			endwhile; 
			endif;
			?>

		</div>
	</div>
</div>

<div class="container-fluid app-section pt-5">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-5 app-img text-center">
				<?php $app_section_image = get_field('app_section_image');
				if (!empty($app_section_image)) : ?>
				<img src="<?php echo esc_url($app_section_image); ?>">
				<?php endif; ?>
			</div>

			<div class="col-12 col-md-7 app-content">
				<?php $app_section_heading = get_field('app_section_heading');
				if (!empty($app_section_heading)) : ?>
				<h3 class="heading-text mb-5"><?php echo esc_html($app_section_heading); ?></h3>
				<?php endif; ?>

				<?php $app_section_description = get_field('app_section_description');
				if (!empty($app_section_description)) : ?>
				<p><?php echo esc_html($app_section_description); ?></p>
				<?php endif; ?>

				<div class="d-flex flex-wrap app-download-btn">
					<?php $app_section_ios_image = get_field('app_section_ios_image');
					if (!empty($app_section_ios_image)) : ?>
					<a href="<?php the_field('app_store_link'); ?>" target="_blank">
						<img src="<?php echo esc_url($app_section_ios_image); ?>" class="mr-3">
					</a>
					<?php endif; ?>

					<?php $app_section_android_image = get_field('app_section_android_image');
					if (!empty($app_section_android_image)) : ?>
					<a href="<?php the_field('play_store_link'); ?>" target="_blank">
						<img src="<?php echo esc_url($app_section_android_image); ?>">
					</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>