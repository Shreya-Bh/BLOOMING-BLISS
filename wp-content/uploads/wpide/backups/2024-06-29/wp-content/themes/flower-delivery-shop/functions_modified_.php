<?php
/**
 * Flower Delivery Shop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Flower Delivery Shop
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Flower_Delivery_Shop_Loader.php' );

$Flower_Delivery_Shop_Loader = new \WPTRT\Autoload\Flower_Delivery_Shop_Loader();

$Flower_Delivery_Shop_Loader->flower_delivery_shop_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$Flower_Delivery_Shop_Loader->flower_delivery_shop_register();

if ( ! function_exists( 'flower_delivery_shop_setup' ) ) :

	function flower_delivery_shop_setup() {

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		load_theme_textdomain( 'flower-delivery-shop', get_template_directory() . '/languages' );
		add_theme_support( 'woocommerce' );
		add_theme_support( "responsive-embeds" );
		add_theme_support( "align-wide" );
		add_theme_support( "wp-block-styles" );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
        add_image_size('flower-delivery-shop-featured-header-image', 2000, 660, true);

        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','flower-delivery-shop' ),
        ) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'flower_delivery_shop_custom_background_args', array(
			'default-color' => 'f7ebe5',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 100,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
		add_action('wp_ajax_flower_delivery_shop_dismissable_notice', 'flower_delivery_shop_dismissable_notice');
	}
endif;
add_action( 'after_setup_theme', 'flower_delivery_shop_setup' );


function flower_delivery_shop_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'flower_delivery_shop_content_width', 1170 );
}
add_action( 'after_setup_theme', 'flower_delivery_shop_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flower_delivery_shop_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'flower-delivery-shop' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'flower-delivery-shop' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'flower-delivery-shop' ),
		'id'            => 'flower-delivery-shop-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'flower-delivery-shop' ),
		'id'            => 'flower-delivery-shop-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'flower-delivery-shop' ),
		'id'            => 'flower-delivery-shop-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'flower_delivery_shop_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function flower_delivery_shop_scripts() {

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'mea-culpa',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Mea+Culpa&display=swap" rel="stylesheet"' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'jost',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"' ),
		array(),
		'1.0'
	);

	wp_enqueue_style( 'flower-delivery-shop-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css');

    wp_enqueue_style( 'owl.carousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.css');

	wp_enqueue_style( 'flower-delivery-shop-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom-option.php' );
	wp_add_inline_style( 'flower-delivery-shop-style',$flower_delivery_shop_theme_css );

	// fontawesome
	wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() .'/assets/css/fontawesome/css/all.css' );

    wp_enqueue_script('flower-delivery-shop-theme-js', get_template_directory_uri() . '/assets/js/theme-script.js', array('jquery'), '', true );

    wp_enqueue_script('owl.carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true );

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'flower_delivery_shop_scripts' );

/**
 * Enqueue Preloader.
 */
function flower_delivery_shop_preloader() {

  $flower_delivery_shop_theme_color_css = '';
  $flower_delivery_shop_preloader_bg_color = get_theme_mod('flower_delivery_shop_preloader_bg_color');
  $flower_delivery_shop_preloader_dot_1_color = get_theme_mod('flower_delivery_shop_preloader_dot_1_color');
  $flower_delivery_shop_preloader_dot_2_color = get_theme_mod('flower_delivery_shop_preloader_dot_2_color');
  $flower_delivery_shop_logo_max_height = get_theme_mod('flower_delivery_shop_logo_max_height');

  	if(get_theme_mod('flower_delivery_shop_logo_max_height') == '') {
		$flower_delivery_shop_logo_max_height = '100';
	}

	if(get_theme_mod('flower_delivery_shop_preloader_bg_color') == '') {
		$flower_delivery_shop_preloader_bg_color = '#E2809F';
	}
	if(get_theme_mod('flower_delivery_shop_preloader_dot_1_color') == '') {
		$flower_delivery_shop_preloader_dot_1_color = '#ffffff';
	}
	if(get_theme_mod('flower_delivery_shop_preloader_dot_2_color') == '') {
		$flower_delivery_shop_preloader_dot_2_color = '#463436';
	}
	$flower_delivery_shop_theme_color_css = '
		.custom-logo-link img{
			max-height: '.esc_attr($flower_delivery_shop_logo_max_height).'px;
	 	}
		.loading{
			background-color: '.esc_attr($flower_delivery_shop_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($flower_delivery_shop_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($flower_delivery_shop_preloader_dot_2_color).';
		  }
		}
	';
    wp_add_inline_style( 'flower-delivery-shop-style',$flower_delivery_shop_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'flower_delivery_shop_preloader' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


function flower_delivery_shop_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/*dropdown page sanitization*/
function flower_delivery_shop_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function flower_delivery_shop_sanitize_checkbox( $input ) {
  // Boolean check
  return ( ( isset( $input ) && true == $input ) ? true : false );
}

/*radio button sanitization*/
function flower_delivery_shop_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function flower_delivery_shop_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'flower_delivery_shop_loop_columns');
if (!function_exists('flower_delivery_shop_loop_columns')) {
	function flower_delivery_shop_loop_columns() {
		$columns = get_theme_mod( 'flower_delivery_shop_products_per_row', 3 );
		return $columns; // 3 products per row
	}
}

function flower_delivery_shop_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'pro_version_footer' );
    $wp_customize->remove_control( 'pro_version_footer' );

}
add_action( 'customize_register', 'flower_delivery_shop_remove_customize_register', 11 );

/**
 * Get CSS
 */

function flower_delivery_shop_getpage_css($hook) {
	wp_register_script( 'admin-notice-script', get_template_directory_uri() . '/inc/admin/js/admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script('admin-notice-script','flower_delivery_shop',
		array('admin_ajax'	=>	admin_url('admin-ajax.php'),'wpnonce'  =>	wp_create_nonce('flower_delivery_shop_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('admin-notice-script');

    wp_localize_script( 'admin-notice-script', 'flower_delivery_shop_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
	if ( 'appearance_page_flower-delivery-shop-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'flower-delivery-shop-demo-style', get_template_directory_uri() . '/assets/css/demo.css' );
}
add_action( 'admin_enqueue_scripts', 'flower_delivery_shop_getpage_css' );

if ( ! defined( 'FLOWER_DELIVERY_SHOP_CONTACT_SUPPORT' ) ) {
define('FLOWER_DELIVERY_SHOP_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/flower-delivery-shop/','flower-delivery-shop'));
}
if ( ! defined( 'FLOWER_DELIVERY_SHOP_REVIEW' ) ) {
define('FLOWER_DELIVERY_SHOP_REVIEW',__('https://wordpress.org/support/theme/flower-delivery-shop/reviews/','flower-delivery-shop'));
}
if ( ! defined( 'FLOWER_DELIVERY_SHOP_LIVE_DEMO' ) ) {
define('FLOWER_DELIVERY_SHOP_LIVE_DEMO',__('https://demo.themagnifico.net/flower-delivery-shop/','flower-delivery-shop'));
}
if ( ! defined( 'FLOWER_DELIVERY_SHOP_GET_PREMIUM_PRO' ) ) {
define('FLOWER_DELIVERY_SHOP_GET_PREMIUM_PRO',__('https://www.themagnifico.net/products/flower-shop-wordpress-theme/','flower-delivery-shop'));
}
if ( ! defined( 'FLOWER_DELIVERY_SHOP_PRO_DOC' ) ) {
define('FLOWER_DELIVERY_SHOP_PRO_DOC',__('https://demo.themagnifico.net/eard/wathiqa/flower-delivery-shop-pro-doc/','flower-delivery-shop'));
}
if ( ! defined( 'FLOWER_DELIVERY_SHOP_FREE_DOC' ) ) {
define('FLOWER_DELIVERY_SHOP_FREE_DOC',__('https://demo.themagnifico.net/eard/wathiqa/flower-delivery-shop-free-doc/','flower-delivery-shop'));
}

add_action('admin_menu', 'flower_delivery_shop_themepage');
function flower_delivery_shop_themepage(){

	$flower_delivery_shop_theme_test = wp_get_theme();

	$flower_delivery_shop_theme_info = add_theme_page( __('Theme Options','flower-delivery-shop'), __(' Theme Options','flower-delivery-shop'), 'manage_options', 'flower-delivery-shop-info.php', 'flower_delivery_shop_info_page' );
}

function flower_delivery_shop_info_page() {
	$flower_delivery_shop_theme_user = wp_get_current_user();
	$flower_delivery_shop_theme = wp_get_theme();
	?>
	<div class="wrap about-wrap flower-delivery-shop-add-css">
		<div>
			<h1>
				<?php esc_html_e('Welcome To ','flower-delivery-shop'); ?><?php echo esc_html( $flower_delivery_shop_theme ); ?>
			</h1>
			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Contact Support", "flower-delivery-shop"); ?></h3>
						<p><?php esc_html_e("Thank you for trying Flower Delivery Shop , feel free to contact us for any support regarding our theme.", "flower-delivery-shop"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( FLOWER_DELIVERY_SHOP_CONTACT_SUPPORT ); ?>" class="button button-primary get">
							<?php esc_html_e("Contact Support", "flower-delivery-shop"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Checkout Premium", "flower-delivery-shop"); ?></h3>
						<p><?php esc_html_e("Our premium theme comes with extended features like demo content import , responsive layouts etc.", "flower-delivery-shop"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( FLOWER_DELIVERY_SHOP_GET_PREMIUM_PRO ); ?>" class="button button-primary get prem">
							<?php esc_html_e("Get Premium", "flower-delivery-shop"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Review", "flower-delivery-shop"); ?></h3>
						<p><?php esc_html_e("If You love Flower Delivery Shop theme then we would appreciate your review about our theme.", "flower-delivery-shop"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( FLOWER_DELIVERY_SHOP_REVIEW ); ?>" class="button button-primary get">
							<?php esc_html_e("Review", "flower-delivery-shop"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Free Documentation", "flower-delivery-shop"); ?></h3>
						<p><?php esc_html_e("Our guide is available if you require any help configuring and setting up the theme. Easy and quick way to setup the theme.", "flower-delivery-shop"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( FLOWER_DELIVERY_SHOP_FREE_DOC ); ?>" class="button button-primary get">
							<?php esc_html_e("FREE DOCUMENTATION", "flower-delivery-shop"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<h2><?php esc_html_e("Free Vs Premium","flower-delivery-shop"); ?></h2>
		<div class="flower-delivery-shop-button-container">
			<a target="_blank" href="<?php echo esc_url( FLOWER_DELIVERY_SHOP_PRO_DOC ); ?>" class="button button-primary get">
				<?php esc_html_e("Checkout Documentation", "flower-delivery-shop"); ?>
			</a>
			<a target="_blank" href="<?php echo esc_url( FLOWER_DELIVERY_SHOP_LIVE_DEMO ); ?>" class="button button-primary get">
				<?php esc_html_e("View Theme Demo", "flower-delivery-shop"); ?>
			</a>
		</div>


		<table class="wp-list-table widefat">
			<thead class="table-book">
				<tr>
					<th><strong><?php esc_html_e("Theme Feature", "flower-delivery-shop"); ?></strong></th>
					<th><strong><?php esc_html_e("Basic Version", "flower-delivery-shop"); ?></strong></th>
					<th><strong><?php esc_html_e("Premium Version", "flower-delivery-shop"); ?></strong></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php esc_html_e("Header Background Color", "flower-delivery-shop"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Navigation Logo Or Text", "flower-delivery-shop"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Hide Logo Text", "flower-delivery-shop"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Premium Support", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Fully SEO Optimized", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Recent Posts Widget", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Easy Google Fonts", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Pagespeed Plugin", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Header Image On Front Page", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Show Header Everywhere", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Text On Header Image", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Full Width (Hide Sidebar)", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Upper Widgets On Front Page", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Replace Copyright Text", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Upper Widgets Colors", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Navigation Color", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Post/Page Color", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Blog Feed Color", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Footer Color", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Sidebar Color", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Background Color", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Importable Demo Content	", "flower-delivery-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
			</tbody>
		</table>
		<div class="flower-delivery-shop-button-container">
			<a target="_blank" href="<?php echo esc_url( FLOWER_DELIVERY_SHOP_GET_PREMIUM_PRO ); ?>" class="button button-primary get prem">
				<?php esc_html_e("Go Premium", "flower-delivery-shop"); ?>
			</a>
		</div>
	</div>
	<?php
}

//Admin Notice For Getstart
function flower_delivery_shop_ajax_notice_handler() {
	if (!wp_verify_nonce($_POST['wpnonce'], 'flower_delivery_shop_dismissed_notice_nonce')) {
		exit;
	}
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}
add_action( 'wp_ajax_flower_delivery_shop_dismissed_notice_handler', 'flower_delivery_shop_ajax_notice_handler' );

function flower_delivery_shop_deprecated_hook_admin_notice() {

    $flower_delivery_shop_dismissed = get_user_meta(get_current_user_id(), 'flower_delivery_shop_dismissable_notice', true);
    if ( !$flower_delivery_shop_dismissed) { ?>
        <div class="updated notice notice-success is-dismissible notice-get-started-class" data-notice="get_started" style="background: #f7f9f9; padding: 20px 10px; display: flex;">
	    	<div class="tm-admin-image">
	    		<img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
	    	</div>
	    	<div class="tm-admin-content" style="padding-left: 30px; align-self: center">
	    		<h2 style="font-weight: 600;line-height: 1.3; margin: 0px;"><?php esc_html_e('Thank You For Choosing ', 'flower-delivery-shop'); ?><?php echo wp_get_theme(); ?><h2>
	    		<p style="color: #3c434a; font-weight: 400; margin-bottom: 30px;"><?php _e('Get Started With Theme By Clicking On Getting Started.', 'flower-delivery-shop'); ?><p>
	        	<a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=flower-delivery-shop-info.php' )); ?>"><?php esc_html_e( 'Get started', 'flower-delivery-shop' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( FLOWER_DELIVERY_SHOP_FREE_DOC ); ?>"><?php esc_html_e( 'Documentation', 'flower-delivery-shop' ) ?></a>
	        	<span style="padding-top: 15px; display: inline-block; padding-left: 8px;">
	        	<span class="dashicons dashicons-admin-links"></span>
	        	<a class="admin-notice-btn"	 target="_blank" href="<?php echo esc_url( FLOWER_DELIVERY_SHOP_LIVE_DEMO ); ?>"><?php esc_html_e( 'View Demo', 'flower-delivery-shop' ) ?></a>
	        	</span>
	    	</div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'flower_delivery_shop_deprecated_hook_admin_notice' );

function flower_delivery_shop_switch_theme() {
    delete_user_meta(get_current_user_id(), 'flower_delivery_shop_dismissable_notice');
}
add_action('after_switch_theme', 'flower_delivery_shop_switch_theme');
function flower_delivery_shop_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'flower_delivery_shop_dismissable_notice', true);
    die();
}

// Add the following code to your theme's functions.php file

// Hook into Contact Form 7's mail sent action
// Ensure this code runs only in a WordPress context
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include Flower Delivery Shop Loader
if (function_exists('get_theme_file_path')) {
    include get_theme_file_path('vendor/wptrt/autoload/src/Flower_Delivery_Shop_Loader.php');
} else {
    error_log('Function get_theme_file_path() is not available.');
}

// Hook into Contact Form 7's before send mail action
add_action('wpcf7_before_send_mail', 'save_testimonial_to_db');

function save_testimonial_to_db($cf7) {
    if ($cf7->id() == '0918007') {
        error_log('Form ID matched');
        $submission = WPCF7_Submission::get_instance();

        if ($submission) {
            $data = $submission->get_posted_data();

            $name = sanitize_text_field($data['your-name']);
            $email = sanitize_email($data['your-email']);
            $phone = isset($data['your-phone']) ? sanitize_text_field($data['your-phone']) : '';
            $comment = sanitize_textarea_field($data['your-comment']);

            // Database credentials
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "wordpress";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                error_log("Connection failed: " . $conn->connect_error);
                return;
            } else {
                error_log('Database connected successfully');
            }

            // Prepare and bind SQL statement
            $stmt = $conn->prepare("INSERT INTO testimonials (name, email, phone, comment, approve) VALUES (?, ?, ?, ?, ?)");
            if ($stmt === false) {
                error_log("Prepare failed: " . $conn->error);
                return;
            }

            $approve = 0; // Default to not approved
            $stmt->bind_param("ssssi", $name, $email, $phone, $comment, $approve);

            // Execute statement
            if (!$stmt->execute()) {
                error_log("Execute failed: " . $stmt->error);
            } else {
                error_log("Data inserted successfully into testimonials table.");
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        } else {
            error_log('No submission instance found.');
        }
    } else {
        error_log('Form ID does not match.');
    }
}
