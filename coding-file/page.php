<?php get_header(); ?>
<div class="container-fluid inner-banner-blog mb-5" style="background: url(<?php echo wp_kses_post( get_field('banner_image')); ?>); background-size: cover; background-repeat: no-repeat;">
	<h4 class="inner-banner-heading"><?php echo wp_title('');?></h4>
	<?php get_breadcrumb(); ?>
</div>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="<?php the_title();?> mt-5 mb-5">
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