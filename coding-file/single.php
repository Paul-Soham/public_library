<?php get_header(); ?>
<div class="container-fluid inner-banner-blog" style="background: url('<?php $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'new-size'); echo $thumbnail_url[0]; ?>') no-repeat center / cover;">
	<h4 class="inner-banner-heading"><?php echo wp_title('');?></h4>
	<?php get_breadcrumb(); ?>
</div>
<div class="container-fluid blog-listing-section">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 pr-3 pr-md-5">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="container blog-inner-bg <?php the_title();?>">
					<div class="row">
						<div class="col-md-12 single-blog-section p-0">
							<?php if (get_field('single_page_image')) : ?>
							<div class="blog-inner-img mb-4" style="background: url('<?php the_field('single_page_image'); ?>') no-repeat center / cover;"></div>
							<?php endif; ?>
							<!-- <img src="< ?php the_field('single_page_image'); ?>" alt="single-img" class="mb-4"> -->
							<div class="px-5">
								<?php the_content(); ?>
								<hr>
							</div>

						</div>
					</div>
					<div class="row px-5">
						<div class="col-md-6 d-flex">
							<p>Share: <?php echo do_shortcode( '[Sassy_Social_Share]' ); ?></p>
						</div>
						<div class="col-md-6 d-flex justify-content-end">
							<p>Tags:</p>
							<?php
							$post_tags = get_the_tags();
							if ($post_tags) {
								echo '<ul class="list-unstyled d-flex tags">';
								foreach($post_tags as $tag) {
									echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
								}
								echo '</ul>';
							}
							?>
						</div>
					</div>
				</div>
				<?php endwhile; endif;?>
				<div>
					<h3 class="heading-text mb-4">Related Post</h3>
					<div class="row">
						<?php
						$related_posts = new WP_Query(
							array(
								'post_type' => 'post',
								'posts_per_page' => 2,
								'post__not_in' => array(get_the_ID()),
								'orderby' => 'rand',
							)
						);
						if ($related_posts->have_posts()) :
						while ($related_posts->have_posts()) : $related_posts->the_post();
						?>
						<div class="col-md-6">
							<div class="blog-box bg-img-1 px-0" style="background: url('<?php echo get_the_post_thumbnail_url(); ?>');">
								<div class="blog-box-content">
									<div class="for-sideline">
										<p><a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>" rel="category tag"><?php echo esc_html(get_the_category()[0]->name); ?></a></p>
										<a href="<?php the_permalink(); ?>">
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
						echo 'No related posts found.';
						endif;
						?>
					</div>
				</div>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>