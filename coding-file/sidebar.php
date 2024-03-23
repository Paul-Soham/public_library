<div class="col-12 col-md-4 mt-5 mt-md-0">
	<div class="search-sidebar mb-5">
		<h3 class="heading-text mb-4"><?php the_field('sidebar_one_heading', 'option'); ?></h3>
		<?php echo do_shortcode( '[custom_search]' ); ?>
	</div>
	<div class="categories-sidebar mb-5">
		<h3 class="heading-text mb-4"><?php the_field('sidebar_two_heading', 'option'); ?></h3>
		<ul class="list-unstyled mb-0">
			<?php
			$categories = get_categories(array(
				'exclude' => get_cat_ID('Uncategorized') // Exclude the "Uncategorized" category
			));

			foreach ($categories as $category) {
				echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
			}
			?>
		</ul>
	</div>
	<div class="news-sidebar mb-5">
		<h3 class="heading-text mb-4"><?php the_field('sidebar_three_heading', 'option'); ?></h3>
		<?php
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => 2,
			'orderby'        => 'date',
			'order'          => 'DESC'
		);
		$query = new WP_Query($args);
		if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();
		?>
		<div class="library-news-right-box">
			<h5 class="mb-3"><?php the_title(); ?></h5>
			<p class="mb-2"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
			<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/long-arrow-pointing-to-the-right.svg"> Posted on <?php echo get_the_date('m.d.Y'); ?></a>
		</div>
		<?php
		endwhile;
		wp_reset_postdata();
		else :
		echo 'No posts found.';
		endif;
		?>
	</div>
	<div class="news-sidebar mb-5">
		<h3 class="heading-text mb-5"><?php the_field('sidebar_four_heading', 'option'); ?></h3>
		<ul class="d-flex flex-wrap list-unstyled mb-0">
			<?php
			$tags = get_tags();

			if ($tags) :
			foreach ($tags as $tag) :
			?>
			<li><a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a></li>
			<?php
			endforeach;
			else :
			echo '<li>No tags found.</li>';
			endif;
			?>
		</ul>
	</div>
</div>