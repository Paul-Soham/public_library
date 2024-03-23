<?php get_header(); ?>
<div class="container-fluid inner-banner-blog" style="background: url(<?php the_field('banner_image', 19); ?>); background-size: cover; background-repeat: no-repeat;">
	<h4 class="inner-banner-heading"><?php single_tag_title(); ?></h4>
	<?php get_breadcrumb(); ?>
</div>
<div class="container-fluid blog-listing-section">
	<div class="container">
		<div class="row">
			<?php the_content(); ?>
			<div class="col-12 col-md-8 pr-3 pr-md-5">
				<?php
				if (have_posts()) :
				while (have_posts()) : the_post();
				?>
				<div class="blog-single-box">
					<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-fluid mb-4" alt="<?php the_title_attribute(); ?>">
					<h2><?php the_title(); ?></h2>
					<span><?php the_category(', '); ?></span>
					<p><?php the_excerpt(); ?></p>
					<a class="btn btn-cta-1" href="<?php the_permalink(); ?>" role="button">Read More</a>
				</div>
				<?php
				endwhile;
				// Include pagination
				// echo do_shortcode('[blog_listing_ajax_pagination]');
				else :
				// If no posts found
				echo 'No posts found.';
				endif;
				?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>