<?php get_header(); ?>
<div class="container-fluid">
	<div class="row">
		<?php
		// Banner Section
		$banner_image = get_field('banner_image');
		$banner_image_text = get_field('banner_image_text');
		if (!empty($banner_image) && !empty($banner_image_text)) :
		?>
		<div class="col-md-8 banner-left-img" style="background: url(<?php echo $banner_image; ?>); background-size: cover; background-repeat: no-repeat; background-position: bottom right;">
			<h2><?php echo $banner_image_text; ?></h2>
		</div>
		<?php endif; ?>

		<div class="col-md-4 banner-top-right-part">
			<?php 
			if( have_rows('banner_right_link_list') ):
			while ( have_rows('banner_right_link_list') ) : the_row(); 
			?>
			<div class="banner-right-box">
				<?php 
				// Check if heading field is not empty
				$heading = get_sub_field('heading');
				if (!empty($heading)) :
				?>
				<h3 class="heading-text"><?php echo $heading; ?></h3>
				<?php endif; ?>

				<?php 
				// Check if description field is not empty
				$description = get_sub_field('description');
				if (!empty($description)) :
				?>
				<p><?php echo $description; ?></p>
				<?php endif; ?>

				<?php 
				// Check if button link and text fields are not empty
				$button_link = get_sub_field('button_link');
				$button_text = get_sub_field('button_text');
				if (!empty($button_link) && !empty($button_text)) :
				?>
				<a href="<?php echo $button_link; ?>">Read More <img src="<?php echo get_template_directory_uri(); ?>/images/long-arrow-pointing-to-the-right.svg"></a>
				<?php endif; ?>
			</div>
			<?php 
			endwhile; 
			endif;
			?>
		</div>

		<div class="col-md-8 after-banner-search">
			<?php echo do_shortcode( '[custom_search]' ); ?>
		</div>

		<?php
		// Check if banner right library time field is not empty
		$banner_right_library_time = get_field('banner_right_library_time');
		if (!empty($banner_right_library_time)) :
		?>
		<div class="col-md-4 after-banner-right-time">
			<?php echo $banner_right_library_time; ?>
		</div>
		<?php endif; ?>
	</div>
</div>

<div class="container-fluid Trending-section">
	<div class="container">
		<div class="row">
			<div class="col-md-9 about-left p-0 pr-5">
				<h3 class="heading-text mb-5"><?php echo get_field('trending_heading'); ?></h3>

				<div class="d-flex flex-wrap">
					<div class="col-md-4 special-collections-listing">
						<ul class="list-unstyled mb-0">
							<?php 
							if( have_rows('special_collections_list') ):
							while ( have_rows('special_collections_list') ) : the_row(); 
							$link = get_sub_field('menu_list');
							?>
							<li><a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['title']); ?></a></li>
							<?php 
							endwhile; 
							else:
							endif;
							?>
						</ul>
					</div>
					<div class="col-md-4 special-collections-single-img" style="background: url(<?php echo get_field('special_collections_image'); ?>); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
					<div class="col-md-4 special-collections-single-content">
						<h3 class="mb-4"><?php echo get_field('special_collections_heading'); ?></h3>
						<?php $service = get_field('special_collections_text');?>
						<a class="mb-4" href="<?php echo $service['url'] ?>"><?php echo $service['title'] ?></a>
						<p><?php echo get_field('special_collections_description'); ?></p>
					</div>
				</div>

				<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 2
				);
				$query = new WP_Query($args);
				$count = 0;
				if ($query->have_posts()) :
				while ($query->have_posts()) : $query->the_post();
				$count++;
				$flex_wrap_class = $count % 2 === 0 ? 'flex-wrap-reverse' : 'flex-wrap';
				$box_order_class = $count % 2 === 0 ? 'order-md-1' : 'order-md-2';
				?>
				<div class="d-flex <?php echo $flex_wrap_class; ?> blog-section mt-5">
					<div class="col-md-6 <?php echo $box_order_class; ?> blog-section-box-content">
						<div class="blog-section-box-heading mb-4">
							<span><?php the_category(', '); ?></span>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>
						<p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
					</div>
					<div class="col-md-6 <?php echo $box_order_class; ?> blog-section-box-img" style="background: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
				</div>

				<?php
				endwhile;
				wp_reset_postdata();
				else :
				echo 'No posts found';
				endif;
				?>
				<div class="load-more-btn text-center mt-4">
					<a class="btn btn-custom" href="<?php echo wp_kses_post( get_field('post_read_more'));?>" role="button">Read More</a>
				</div>
			</div>

			<div class="col-md-3 about-right">
				<h3 class="heading-text mb-5">Library News</h3>
				<?php
				$args = array(
					'post_type'      => 'post',
					'posts_per_page' => 4,
					'orderby'        => 'date',
					'order'          => 'DESC',
				);
				$query = new WP_Query($args);
				if ($query->have_posts()) :
				while ($query->have_posts()) : $query->the_post();
				?>
				<div class="library-news-right-box">
					<h5 class="mb-3"><?php the_title(); ?></h5>
					<p class="mb-2"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
					<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/long-arrow-pointing-to-the-right.svg"> Posted on <?php echo get_the_date('m.d.Y'); ?></a>
				</div>
				<?php
				endwhile;
				wp_reset_postdata();
				else :
				echo 'No posts found';
				endif;
				?>

				<div class="library-hours-right-box">
					<img class="bookmark-icon" src="<?php echo get_template_directory_uri(); ?>/images/bookmark-icon.png">
					<h2><?php echo wp_kses_post( get_field('library_hours_heading'));?></h2>
					<ul class="list-unstyled mb-0">
						<?php 
						if( have_rows('library_hours_timming') ):
						while ( have_rows('library_hours_timming') ) : the_row(); 
						?>
						<li>
							<span><?php the_sub_field('time_heading'); ?></span>
							<h3><?php the_sub_field('timing'); ?></h3>
						</li>
						<?php 
						endwhile; 
						endif;
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid digital-resources py-5">
	<div class="container">
		<h3 class="heading-text middle-align mb-5"><?php echo wp_kses_post( get_field('digital_resource_heading')); ?></h3>
		<div class="row text-align-center align-item-center justify-content-around mt-5">
			<?php 
			if( have_rows('digital_resource_content') ):
			while ( have_rows('digital_resource_content') ) : the_row(); 
			?>
			<div class="digital-resources-box">
				<img src="<?php the_sub_field('content_image'); ?>">
				<h5><?php the_sub_field('content_text'); ?></h5>
			</div>
			<?php 
			endwhile; 
			endif;
			?>
		</div>
	</div>
</div>

<div class="container-fluid news-events py-5">
	<div class="container">
		<h3 class="heading-text mb-5">News and Events</h3>
		<div class="owl-slider">
			<div id="carousel" class="owl-carousel">
				<?php
				$args = array(
					'post_type' => 'post'
				);
				$query = new WP_Query($args);
				if ($query->have_posts()) :
				while ($query->have_posts()) : $query->the_post();
				?>

				<div class="item">
					<div class="blog-box bg-img-1 px-0" <?php if ( has_post_thumbnail() ) : ?> style="background: url(<?php the_post_thumbnail_url( 'large' ); ?>);" <?php endif; ?>>
						<div class="blog-box-content">
							<div class="for-sideline">
								<p><?php the_category(', '); ?></p>
								<a href="<?php the_permalink();?>">
									<h3><?php the_title(); ?></h3>
								</a>
							</div>
						</div>
					</div>
				</div>

				<?php
				endwhile;
				wp_reset_postdata();
				else :
				echo 'No posts found';
				endif;
				?>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid place-to-study " style="background: url(<?php echo wp_kses_post( get_field('study_place_image')); ?>);">
	<div class="container text-center">
		<h2><?php echo wp_kses_post( get_field('study_place_heading')); ?></h2>
		<p><?php echo wp_kses_post( get_field('study_place_text')); ?></p>
		<a class="btn btn-cta-1" href="<?php echo wp_kses_post( get_field('study_place_button_link')); ?>" role="button"><?php echo wp_kses_post( get_field('study_place_button_text')); ?></a>
	</div>
</div>

<div class="container-fluid donation ">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-md-6 donation-text">
				<p><?php echo wp_kses_post( get_field('donation_heading')); ?></p>
				<h4><?php echo wp_kses_post( get_field('donation_text')); ?></h4>
			</div>
			<div class="col-12 col-md-6 donation-button text-right">
				<a class="btn btn-cta-2" href="<?php echo wp_kses_post( get_field('donation_button_link')); ?>" role="button"><?php echo wp_kses_post( get_field('donation_button_text')); ?></a>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>   