<?php
/*
Template Name: Blog
*/
get_header(); ?>
<div class="container-fluid inner-banner-blog" style="background: url(<?php the_field('banner_image'); ?>); background-size: cover; background-repeat: no-repeat;">
	<h4 class="inner-banner-heading"><?php echo wp_title('');?></h4>
	<?php get_breadcrumb(); ?>
</div>
<div class="container-fluid blog-listing-section">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 pr-3 pr-md-5">
				<?php echo do_shortcode( '[blog_listing_ajax_pagination]' ); ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		var page = 1;
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		jQuery('body').on('click', '.LoadMore', function() {
			var data = {
				'action': 'load_more_posts',
				'page': page,
			};
			jQuery.post(ajaxurl, data, function(response) {
				jQuery('.blog-listing-part').append(response);
				page++;
			});
		});
	});
</script>
<?php get_footer(); ?>