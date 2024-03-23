<?php
/*
Template Name: Event
*/
get_header(); ?>
<div class="container-fluid inner-banner-blog sdcsd" style="background: url(<?php the_field('banner_image', 18); ?>); background-size: cover; background-repeat: no-repeat;">
	<h4 class="inner-banner-heading"><?php echo wp_title('');?></h4>
	<?php get_breadcrumb(); ?>
</div>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<section class="<?php the_title();?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>
<?php endwhile; endif;?>
<?php get_footer(); ?>