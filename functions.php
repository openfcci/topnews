<?php

/////////////////////////////////////
// Theme Setup
/////////////////////////////////////

if ( ! function_exists( 'mvp_setup' ) ) {
function mvp_setup(){
	load_theme_textdomain('mvp-text', get_template_directory() . '/languages');
	load_theme_textdomain('theia-post-slider', get_template_directory() . '/languages');
	load_theme_textdomain('framework_localize', get_template_directory() . '/languages');

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
}
}
add_action('after_setup_theme', 'mvp_setup');

/////////////////////////////////////
// Enqueue Javascript/CSS Files
/////////////////////////////////////

if ( ! function_exists( 'enqueue_iecss' ) ) {
function enqueue_iecss() {
    // Register stylesheet
    wp_register_style( 'iecss', get_template_directory_uri() . '/css/iecss.css' );
    // Apply IE conditionals
    $GLOBALS['wp_styles']->add_data( 'iecss', 'conditional', 'lt IE 9' );
    // Enqueue stylesheet
    wp_enqueue_style( 'iecss' );
} }
add_action( 'wp_enqueue_scripts', 'enqueue_iecss' );

if ( ! function_exists( 'mvp_scripts_method' ) ) {
function mvp_scripts_method() {
	wp_enqueue_style( 'mvp-style', get_stylesheet_uri() );
	wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.css' );
	wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

	$mvp_respond = get_option('mvp_respond'); if ($mvp_respond == "true") { if (isset($mvp_respond)) {
	wp_enqueue_style( 'media-queries', get_template_directory_uri() . '/css/media-queries.css' );
	} }

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if (is_plugin_active('menufication/menufication.php')) {
	wp_enqueue_style( 'menufication', get_template_directory_uri() . '/css/menufication.css' );
	}

	wp_enqueue_style( 'googlefonts', '//fonts.googleapis.com/css?family=Open+Sans:700,800', array(), null, 'screen' );

	wp_register_script('topnews', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '', true);
	wp_register_script('infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'), '', true);
	wp_register_script('retina', get_template_directory_uri() . '/js/retina.js', array('jquery'), '', true);
	wp_register_script('nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array('jquery'), '', true);

	wp_enqueue_script('jquery');
	wp_enqueue_script('topnews');
	wp_enqueue_script('nicescroll');
	wp_enqueue_script('infinitescroll');
	wp_enqueue_script('retina');

}
}
add_action('wp_enqueue_scripts', 'mvp_scripts_method');

/////////////////////////////////////
// Theme Options
/////////////////////////////////////

require_once(TEMPLATEPATH . '/admin/admin-functions.php');
require_once(TEMPLATEPATH . '/admin/admin-interface.php');
require_once(TEMPLATEPATH . '/admin/theme-settings.php');

if ( ! function_exists( 'my_wp_head' ) ) {
function my_wp_head() {
	$wallad = get_option('mvp_wall_ad');
	$primarytheme = get_option('mvp_primary_theme');
	$secondarytheme = get_option('mvp_secondary_theme');
	$mainmenu = get_option('mvp_menu_color');
	$mainmenuhover = get_option('mvp_menu_hover_color');
	$menutext = get_option('mvp_menu_text');
	$menutexthover = get_option('mvp_menu_hover_text');
	$link = get_option('mvp_link_color');
	$linkhover = get_option('mvp_link_hover');
	$headline_font = get_option('mvp_headline_font');
	$menu_font = get_option('mvp_menu_font');
	$content_font = get_option('mvp_content_font');
	$google_headlines = preg_replace("/ /","+",$headline_font);
	$google_menu = preg_replace("/ /","+",$menu_font);
	$google_content = preg_replace("/ /","+",$content_font);
	echo "
<style type='text/css'>

@import url(http://fonts.googleapis.com/css?family=$google_headlines:100,200,300,400,500,600,700,800,900|$google_menu:100,200,300,400,500,600,700,800,900|$google_content:100,200,300,400,500,600,700,800,900&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese);

#wallpaper {
	background: url($wallad) no-repeat 50% 0;
	}

a, a:visited,
.woocommerce ul.products li.product .price,
.woocommerce-page ul.products li.product .price,
p.comment-tab-text a,
p.comment-tab-text a:visited {
	color: $link;
	}

ul.social-drop-list,
#mobile-menu-wrap:hover,
#mobile-nav .menu {
	background: $link;
	}

.main-nav .menu li .mega-dropdown,
.main-nav .menu li ul.sub-menu,
#search-bar,
#search-button:hover,
#social-nav:hover {
	background: $mainmenuhover;
	}

.main-nav .menu li:hover ul.sub-menu,
.main-nav .menu li:hover ul.sub-menu li a {
	color: $menutexthover;
	}

.main-nav .menu li:hover ul.sub-menu li a,
.main-nav .menu li:hover ul.mega-list li a,
#search-button:hover,
#social-nav:hover span,
#searchform input,
#mobile-menu-wrap:hover {
	color: $menutexthover;
	}

.main-nav .menu li:hover ul.sub-menu li.menu-item-has-children:hover a:after,
.main-nav .menu li:hover ul.sub-menu li.menu-item-has-children a:after {
	border-color: transparent transparent transparent $menutexthover;
	}

a:hover,
h2 a:hover,
.sidebar-list-text a:hover,
span.author-name a:hover,
.widget-split-right a:hover,
.widget-full-list-text a:hover {
	color: $linkhover;
	}

.read-more-fb a:hover,
.read-more-twit a:hover,
.read-more-comment a:hover,
.post-tags a:hover,
.tag-cloud a:hover {
	background: $linkhover;
	}

#nav-wrap,
.more-nav-contain,
.main-nav-contain,
#nav-right,
.nav-spacer,
#menufication-top,
#menufication-non-css3-top {
	background: $mainmenu;
	}

.more-nav-contain:before {
	background: -moz-linear-gradient(to left, $mainmenu, rgba(255,255,255,0));
	background: -ms-linear-gradient(to left, $mainmenu, rgba(255,255,255,0));
	background: -o-linear-gradient(to left, $mainmenu, rgba(255,255,255,0));
	background: -webkit-linear-gradient(to left, $mainmenu, rgba(255,255,255,0));
	background: linear-gradient(to left, $mainmenu, rgba(255,255,255,0));
	}

.main-nav .menu li a,
#social-nav span,
#mobile-menu-wrap,
ul.ubermenu-nav li a,
#search-button {
	color: $menutext;
	}

.main-nav .menu li.menu-item-has-children a:after {
	border-color: $menutext transparent transparent transparent;
	}

.prev-next-text a,
.prev-next-text a:visited,
.prev-next-text a:hover,
ul.post-social-list li.post-social-comm a,
#sidebar-mobi-tab,
span.mobi-tab-but,
ul.tabber-header li.active,
h3.sidebar-header,
#sidebar-scroll-wrap,
ul.tabber-header li:hover,
span.post-tags-header {
	background: $primarytheme;
	}

.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content {
	background-color: $primarytheme;
	}

span.social-count-num {
	color: $primarytheme;
	}

span.img-cat,
.read-more-comment a,
#infscr-loading,
span.comment-but-text,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce #respond input#submit,
.woocommerce #content input.button,
.woocommerce-page a.button,
.woocommerce-page button.button,
.woocommerce-page input.button,
.woocommerce-page #respond input#submit,
.woocommerce-page #content input.button,
.woocommerce div.product form.cart .button,
.woocommerce #content div.product form.cart .button,
.woocommerce-page div.product form.cart .button,
.woocommerce-page #content div.product form.cart .button,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce #respond input#submit.alt,
.woocommerce #content input.button.alt,
.woocommerce-page a.button.alt,
.woocommerce-page button.button.alt,
.woocommerce-page input.button.alt,
.woocommerce-page #respond input#submit.alt,
.woocommerce-page #content input.button.alt,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.woocommerce #respond input#submit:hover,
.woocommerce #content input.button:hover,
.woocommerce-page a.button:hover,
.woocommerce-page button.button:hover,
.woocommerce-page input.button:hover,
.woocommerce-page #respond input#submit:hover,
.woocommerce-page #content input.button:hover,
.woocommerce div.product form.cart .button:hover,
.woocommerce #content div.product form.cart .button:hover,
.woocommerce-page div.product form.cart .button:hover,
.woocommerce-page #content div.product form.cart .button:hover,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce #respond input#submit.alt,
.woocommerce #content input.button.alt,
.woocommerce-page a.button.alt,
.woocommerce-page button.button.alt,
.woocommerce-page input.button.alt,
.woocommerce-page #respond input#submit.alt,
.woocommerce-page #content input.button.alt,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce #respond input#submit.alt:hover,
.woocommerce #content input.button.alt:hover,
.woocommerce-page a.button.alt:hover,
.woocommerce-page button.button.alt:hover,
.woocommerce-page input.button.alt:hover,
.woocommerce-page #respond input#submit.alt:hover,
.woocommerce-page #content input.button.alt:hover,
.woocommerce span.onsale,
.woocommerce-page span.onsale,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
	background: $secondarytheme;
	}

.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
	background-color: $secondarytheme;
	}

#category-header-wrap h1,
ul.trending-list li.trending-head,
.woocommerce .woocommerce-product-rating .star-rating,
.woocommerce-page .woocommerce-product-rating .star-rating,
.woocommerce .products .star-rating,
.woocommerce-page .products .star-rating {
	color: $secondarytheme;
	}

.main-nav .menu li a:hover,
.main-nav .menu li:hover a {
	border-bottom: 5px solid $secondarytheme;
	}

.main-nav .menu li a,
ul.ubermenu-nav li a {
	font-family: '$menu_font', sans-serif;
	}

#featured-multi-main-text h2,
.featured-multi-sub-text h2,
.widget-full-list-text a,
.widget-split-right a,
.home-widget-large-text a,
.home-widget-list-text a,
.widget-list-small-text a,
.story-contain-text h2,
h1.story-title,
.full-wide-text a,
.main-nav .menu li:hover ul.mega-list li a,
ul.trending-list li.trending-head,
.grid-main-text h2,
.grid-sub-text h2,
#content-area blockquote p,
#woo-content h1,
#woo-content h2,
#woo-content h3,
#woo-content h4,
#woo-content h5,
#woo-content h6,
#content-area h1,
#content-area h2,
#content-area h3,
#content-area h4,
#content-area h5,
#content-area h6,
ul.trending-list li a,
.sidebar-list-text a,
.sidebar-list-text a:visited {
	font-family: '$headline_font', sans-serif;
	}

body,
#searchform input,
.add_to_cart_button,
.woocommerce .woocommerce-result-count,
.woocommerce-page .woocommerce-result-count {
	font-family: $content_font, sans-serif;
	}

#menufication-outer-wrap.light #menufication-top #menufication-btn:before,
#menufication-outer-wrap.light #menufication-non-css3-top #menufication-non-css3-btn:before,
#menufication-non-css3-outer-wrap.light #menufication-top #menufication-btn:before,
#menufication-non-css3-outer-wrap.light #menufication-non-css3-top #menufication-non-css3-btn:before {
	border-color: $menutext !important;
	}

#menufication-top #menufication-btn:before,
#menufication-non-css3-top #menufication-non-css3-btn:before {
	border-bottom: 11px double $menutext;
	border-top: 4px solid $menutext;
	}

</style>
	";
}
}
add_action( 'wp_head', 'my_wp_head' );

/////////////////////////////////////
// Register Widgets
/////////////////////////////////////

if ( !function_exists( 'mvp_sidebars_init' ) ) {
	function mvp_sidebars_init() {
		register_sidebar(array(
			'id' => 'homepage-widget',
			'name' => 'Homepage Widget Area',
			'before_widget' => '<div id="%1$s" class="home-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-header-wrap left relative"><span>',
			'after_title' => '</span></h3>',
		));

		register_sidebar(array(
			'id' => 'sidebar-home-widget',
			'name' => 'Homepage Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h3 class="sidebar-header left relative"><span>',
			'after_title' => '</span></h3><div class="sidebar-widget-content left relative">',
		));

		register_sidebar(array(
			'id' => 'sidebar-widget',
			'name' => 'Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h3 class="sidebar-header left relative"><span>',
			'after_title' => '</span></h3><div class="sidebar-widget-content left relative">',
		));

		register_sidebar(array(
			'id' => 'footer-widget',
			'name' => 'Footer Widget Area',
			'before_widget' => '<div id="%1$s" class="foot-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="foot-head">',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'id' => 'cat-body-widget',
			'name' => 'Category Body Widget Area',
			'before_widget' => '<div id="%1$s" class="home-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-header-wrap left relative"><span>',
			'after_title' => '</span></h3>',
		));

		register_sidebar(array(
			'id' => 'cat-sidebar-widget',
			'name' => 'Category Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h3 class="sidebar-header left relative"><span>',
			'after_title' => '</span></h3><div class="sidebar-widget-content left relative">',
		));

		register_sidebar(array(
			'id' => 'sidebar-woo-widget',
			'name' => 'WooCommerce Sidebar Widget Area',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h3 class="sidebar-header left relative"><span>',
			'after_title' => '</span></h3><div class="sidebar-widget-content left relative">',
		));

	}
}
add_action( 'widgets_init', 'mvp_sidebars_init' );

include("widgets/widget-ad.php");
include("widgets/widget-catfeat.php");
include("widgets/widget-catposts.php");
include("widgets/widget-facebook.php");
include("widgets/widget-grid.php");
include("widgets/widget-sidecat.php");
include("widgets/widget-tabs.php");
include("widgets/widget-tagfeat.php");
include("widgets/widget-tagposts.php");
include("widgets/widget-tags.php");
include("widgets/widget-trending.php");

/////////////////////////////////////
// Register Custom Menus
/////////////////////////////////////

if ( !function_exists( 'register_menus' ) ) {
function register_menus() {
	register_nav_menus(
		array(
			'main-menu' => __( 'Main Menu', 'mvp-text' ),
			'more-menu' => __( 'More Menu', 'mvp-text' ),
			'mobile-menu' => __( 'Mobile Menu', 'mvp-text' ),)
	  	);
	  }
}
add_action( 'init', 'register_menus' );


class select_menu_walker extends Walker_Nav_Menu{

	 function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}


	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}

	 function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		$classes[] = 'menu-item-' . $object->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $object->ID, $object, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
		$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
		$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
		$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

		$sel_val =  ' value="'   . esc_attr( $object->url        ) .'"';

		//check if the menu is a submenu
		switch ($depth){
		  case 0:
			   $dp = "";
			   break;
		  case 1:
			   $dp = "-";
			   break;
		  case 2:
			   $dp = "--";
			   break;
		  case 3:
			   $dp = "---";
			   break;
		  case 4:
			   $dp = "----";
			   break;
		  default:
			   $dp = "";
		}

		$output .= $indent . '<option'. $sel_val . $id . $value . '>'.$dp;

		$item_output = $args->before;
		//$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;
		//$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
	}

	function end_el( &$output, $object, $depth = 0, $args = array() ) {
		$output .= "</option>\n";
	}

}

/////////////////////////////////////
// Register Mega Menu
/////////////////////////////////////

add_filter( 'walker_nav_menu_start_el', 'wpse63345_walker_nav_menu_start_el', 10, 4 );

function wpse63345_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {
	global $wp_query;
    // The mega dropdown only applies to the main navigation.
    // Your theme location name may be different, "main" is just something I tend to use.
    if ( 'main-menu' !== $args->theme_location )
        return $item_output;

    // The mega dropdown needs to be added to one specific menu item.
    // I like to add a custom CSS class for that menu via the admin area.
    // You could also do an item ID check.
    if ( in_array( 'mega-dropdown', $item->classes ) ) {
        global $wp_query;
        global $post;
        $thePostID = $post->ID;
	$thumbnail = '';
 	if( has_post_thumbnail( $post->ID ) ) {
   		$thumbnail = get_the_post_thumbnail( $post->ID );
  	}

        $subposts = get_posts( 'numberposts=5&cat=' . $item->object_id );

	$item_output .= '<div class="mega-dropdown"><div class="mega-dropdown-out"><div class="mega-dropdown-in"><ul class="mega-list">';
            foreach( $subposts as $post ) :
                setup_postdata( $post );
                $item_output .= '<li><div class="mega-img"><a href="'. get_permalink( $post->ID ) .'">';
		$item_output .= get_the_post_thumbnail( $post->ID, 'medium-thumb', array( 'class' => 'unlazy') );
		$item_output .= '</a></div><a href="'. get_permalink( $post->ID ) .'">';
		$item_output .= get_the_title( $post->ID );
                $item_output .= '</a></li>';
            endforeach;
	$item_output .= '</ul></div></div></div>';

    }

    return $item_output;
}

/////////////////////////////////////
// Register Custom Background
/////////////////////////////////////

$custombg = array(
	'default-color' => 'eee',
);
add_theme_support( 'custom-background', $custombg );

/////////////////////////////////////
// Register Thumbnails
/////////////////////////////////////

if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
$mvp_max_img = get_option('mvp_max_img'); if ($mvp_max_img == "1000 x 600") { if (isset($mvp_max_img)) {
set_post_thumbnail_size( 1000, 600, true );
add_image_size( 'post-thumb', 1000, 600, true );
}
set_post_thumbnail_size( 1000, 600, true );
add_image_size( 'post-thumb', 1000, 600, true );
} else {
set_post_thumbnail_size( 660, 400, true );
add_image_size( 'post-thumb', 660, 400, true );
}
add_image_size( 'medium-thumb', 400, 240, true );
add_image_size( 'small-thumb', 95, 60, true );
}

/////////////////////////////////////
// Title Meta Data
/////////////////////////////////////

if ( !function_exists( 'rw_title' ) ) {
function rw_title( $title, $sep, $seplocation )
{
    global $page, $paged;
    // Don't affect in feeds.
    if ( is_feed() )
        return $title;
    // Add the blog name
    if ( 'right' == $seplocation )
        $title .= get_bloginfo( 'name' );
    else
        $title = get_bloginfo( 'name' ) . $title;
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title .= " {$sep} {$site_description}";
    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
    return $title;
}
}
add_filter( 'wp_title', 'rw_title', 10, 3 );

/////////////////////////////////////
// Add Custom Meta Box
/////////////////////////////////////

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'mvp_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'mvp_post_meta_boxes_setup' );

/* Meta box setup function. */
if ( !function_exists( 'mvp_post_meta_boxes_setup' ) ) {
function mvp_post_meta_boxes_setup() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'mvp_add_post_meta_boxes' );

	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'mvp_save_video_embed_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_featured_headline_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_photo_credit_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_post_template_meta', 10, 2 );
	add_action( 'save_post', 'mvp_save_featured_image_meta', 10, 2 );
}
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
if ( !function_exists( 'mvp_add_post_meta_boxes' ) ) {
function mvp_add_post_meta_boxes() {

	add_meta_box(
		'mvp-video-embed',			// Unique ID
		esc_html__( 'Video/Audio Embed', 'mvp-text' ),		// Title
		'mvp_video_embed_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',				// Context
		'high'					// Priority
	);

	add_meta_box(
		'mvp-featured-headline',			// Unique ID
		esc_html__( 'Featured Headline', 'mvp-text' ),		// Title
		'mvp_featured_headline_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',				// Context
		'high'					// Priority
	);

	add_meta_box(
		'mvp-photo-credit',			// Unique ID
		esc_html__( 'Featured Image Caption', 'mvp-text' ),		// Title
		'mvp_photo_credit_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',				// Context
		'high'					// Priority
	);

	add_meta_box(
		'mvp-post-template',			// Unique ID
		esc_html__( 'Post Template', 'mvp-text' ),		// Title
		'mvp_post_template_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'side',					// Context
		'core'					// Priority
	);

	add_meta_box(
		'mvp-featured-image',			// Unique ID
		esc_html__( 'Featured Image Show/Hide', 'mvp-text' ),		// Title
		'mvp_featured_image_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'side',					// Context
		'core'					// Priority
	);
}
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_featured_headline_meta_box' ) ) {
function mvp_featured_headline_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'mvp_featured_headline_nonce' ); ?>

	<p>
		<label for="mvp-featured-headline"><?php _e( "Add a custom featured headline that will be displayed in the featured slider.", 'example' ); ?></label>
		<br />
		<input class="widefat" type="text" name="mvp-featured-headline" id="mvp-featured-headline" value="<?php echo esc_html__( get_post_meta( $object->ID, 'mvp_featured_headline', true ) ); ?>" size="30" />
	</p>

<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_video_embed_meta_box' ) ) {
function mvp_video_embed_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'mvp_video_embed_nonce' ); ?>

	<p>
		<label for="mvp-video-embed"><?php _e( "Enter your video or audio embed code.", 'mvp-text' ); ?></label>
		<br />
		<input class="widefat" type="text" name="mvp-video-embed" id="mvp-video-embed" value="<?php echo esc_html__( get_post_meta( $object->ID, 'mvp_video_embed', true ) ); ?>" />
	</p>

<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_photo_credit_meta_box' ) ) {
function mvp_photo_credit_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'mvp_photo_credit_nonce' ); ?>

	<p>
		<label for="mvp-photo-credit"><?php _e( "Add a caption and/or photo credit information for the featured image.", 'mvp-text' ); ?></label>
		<br />
		<input class="widefat" type="text" name="mvp-photo-credit" id="mvp-photo-credit" value="<?php echo esc_html__( get_post_meta( $object->ID, 'mvp_photo_credit', true ) ); ?>" size="30" />
	</p>

<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_post_template_meta_box' ) ) {
function mvp_post_template_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'mvp_post_template_nonce' ); $selected = esc_html__( get_post_meta( $object->ID, 'mvp_post_template', true ) ); ?>

	<p>
		<label for="mvp-post-template"><?php _e( "Select a template for your post.", 'mvp-text' ); ?></label>
		<br /><br />
		<select class="widefat" name="mvp-post-template" id="mvp-post-template">
            		<option value="def" <?php selected( $selected, 'def' ); ?>>Default</option>
            		<option value="def-wide" <?php selected( $selected, 'def-wide' ); ?>>Default Wide</option>
			<option value="full-def" <?php selected( $selected, 'full-def' ); ?>>Full-Width Default</option>
			<option value="full-wide" <?php selected( $selected, 'full-wide' ); ?>>Full-Width Wide</option>
        	</select>
	</p>
<?php }
}

/* Display the post meta box. */
if ( !function_exists( 'mvp_featured_image_meta_box' ) ) {
function mvp_featured_image_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'mvp_featured_image_nonce' ); $selected = esc_html__( get_post_meta( $object->ID, 'mvp_featured_image', true ) ); ?>

	<p>
		<label for="mvp-featured-image"><?php _e( "Select to show or hide the featured image from automatically displaying in this post.", 'mvp-text' ); ?></label>
		<br /><br />
		<select class="widefat" name="mvp-featured-image" id="mvp-featured-image">
            		<option value="show" <?php selected( $selected, 'show' ); ?>>Show</option>
            		<option value="hide" <?php selected( $selected, 'hide' ); ?>>Hide</option>
        	</select>
	</p>
<?php }
}

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_video_embed_meta' ) ) {
function mvp_save_video_embed_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_video_embed_nonce'] ) || !wp_verify_nonce( $_POST['mvp_video_embed_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-video-embed'] ) ? balanceTags( $_POST['mvp-video-embed'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_video_embed';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_featured_headline_meta' ) ) {
function mvp_save_featured_headline_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_featured_headline_nonce'] ) || !wp_verify_nonce( $_POST['mvp_featured_headline_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-featured-headline'] ) ? balanceTags( $_POST['mvp-featured-headline'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_featured_headline';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_photo_credit_meta' ) ) {
function mvp_save_photo_credit_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_photo_credit_nonce'] ) || !wp_verify_nonce( $_POST['mvp_photo_credit_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-photo-credit'] ) ? balanceTags( $_POST['mvp-photo-credit'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_photo_credit';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_post_template_meta' ) ) {
function mvp_save_post_template_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_post_template_nonce'] ) || !wp_verify_nonce( $_POST['mvp_post_template_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-post-template'] ) ? balanceTags( $_POST['mvp-post-template'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_post_template';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/* Save the meta box's post metadata. */
if ( !function_exists( 'mvp_save_featured_image_meta' ) ) {
function mvp_save_featured_image_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['mvp_featured_image_nonce'] ) || !wp_verify_nonce( $_POST['mvp_featured_image_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['mvp-featured-image'] ) ? balanceTags( $_POST['mvp-featured-image'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'mvp_featured_image';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} }

/////////////////////////////////////
// Add Content Limit
/////////////////////////////////////

if ( !function_exists( 'excerpt' ) ) {
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
}

if ( !function_exists( 'content' ) ) {
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}
}

/////////////////////////////////////
// Social Shares
/////////////////////////////////////

if (!function_exists('get_tweets')) {
function get_tweets( $post_id ) {

	if ( ! ( $count = get_transient( 'get_tweets' . $post_id ) ) ) {

    // Do API call
    $response = wp_remote_retrieve_body( wp_remote_get( 'https://cdn.api.twitter.com/1/urls/count.json?url=' . urlencode( get_permalink( $post_id ) ), array(

		'sslverify' => false,
		'compress' => true,
		'timeout' => 1

	) ) );

    // If error in API call, stop and don't store transient
    if ( is_wp_error( $response ) )
      return 'error';

    // Decode JSON
    $json = json_decode( $response, true );

    // Set total count
    $count = absint( $json['count'] );

	// Set transient to expire every 30 minutes
	set_transient( 'get_tweets' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );

	}
 	return absint( $count );
} }

if (!function_exists('get_fb')) {
function get_fb( $post_id ) {

	// Check for transient
	if ( ! ( $count = get_transient( 'get_fb' . $post_id ) ) ) {

    // Do API call
    $response = wp_remote_retrieve_body( wp_remote_get( 'http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls=' . urlencode( get_permalink( $post_id ) ), array(

		'sslverify' => false,
		'compress' => true,
		'timeout' => 5

	) ) );

    // If error in API call, stop and don't store transient
    if ( is_wp_error( $response ) )
      return 'error';

    // Decode JSON
    $json = json_decode( $response, true );

    // Set total count
    $count = absint( $json[0]['total_count'] );

	// Set transient to expire every 30 minutes
	set_transient( 'get_fb' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );
 
	}

 return absint( $count );
} }

if (!function_exists('get_plusones')) {
function get_plusones( $post_id )  {

	// Check for transient
	if ( ! ( $count = get_transient( 'get_plusones' . $post_id ) ) ) {

   $args = array(
            'method' => 'POST',
            'headers' => array(
                // setup content type to JSON
                'Content-Type' => 'application/json'
            ),
            // setup POST options to Google API
            'body' => json_encode(array(
                'method' => 'pos.plusones.get',
                'id' => 'p',
                'method' => 'pos.plusones.get',
                'jsonrpc' => '2.0',
                'key' => 'p',
                'apiVersion' => 'v1',
                'params' => array(
                    'nolog'=>true,
                    'id'=> get_permalink( $post_id ),
                    'source'=>'widget',
                    'userId'=>'@viewer',
                    'groupId'=>'@self'
                )
             )),
             // disable checking SSL certificates
		'compress' => true,
            	'sslverify'=> false,
		'timeout' => 5
        );

    // retrieves JSON with HTTP POST method for current URL
    $json_string = wp_remote_post("https://clients6.google.com/rpc", $args);

    if (is_wp_error($json_string)){
        // return zero if response is error
        return "0";
    } else {
        $json = json_decode($json_string['body'], true);
        // return count of Google +1 for requsted URL
        $count = intval( $json['result']['metadata']['globalCounts']['count'] );
    }

	// Set transient to expire every 30 minutes
	set_transient( 'get_plusones' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );
 
	}

 return absint( $count );
} }

if (!function_exists('get_pinterest')) {
function get_pinterest( $post_id ) {

	// Check for transient
	if ( ! ( $count = get_transient( 'get_pinterest' . $post_id ) ) ) {

    // Do API call
    $response = wp_remote_retrieve_body( wp_remote_get( 'http://api.pinterest.com/v1/urls/count.json?url=' . urlencode( get_permalink( $post_id ) ), array(

		'sslverify' => false,
		'compress' => true,
		'timeout' => 5

	) ) );

    // If error in API call, stop and don't store transient
    if ( is_wp_error( $response ) )
      return 'error';
	$json_string = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $response);
    // Decode JSON
    $json = json_decode( $json_string );

    // Set total count
    $count = absint( $json->count );

	// Set transient to expire every 30 minutes
	set_transient( 'get_pinterest' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );
 
	}

 return absint( $count );
} }

if (!function_exists('mvp_share_count')) {
function mvp_share_count() {

	$post_id = get_the_ID(); ?>

						<?php $soc_tot = get_tweets( $post_id ) + get_plusones( $post_id ) + get_fb( $post_id ) + get_pinterest( $post_id ); if($soc_tot==0) { ?>
						<?php } elseif($soc_tot==1) { ?>
							<li class="post-social-count">
								<span class="social-count-num"><?php echo esc_html( $soc_tot ); ?></span>
								<span class="social-count-text"><?php _e( 'Share', 'mvp-text' ); ?></span>
							</li>
						<?php } else { ?>
							<li class="post-social-count">
								<span class="social-count-num"><?php echo esc_html( $soc_tot ); ?></span>
								<span class="social-count-text"><?php _e( 'Shares', 'mvp-text' ); ?></span>
							</li>
						<?php } ?>

<?php } }


/////////////////////////////////////
// Comments
/////////////////////////////////////

if ( !function_exists( 'mvp_comment' ) ) {
function mvp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">


		<div class="comment-wrapper" id="comment-<?php comment_ID(); ?>">
			<div class="comment-inner">

				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 46 ); ?>
				</div>

				<div class="commentmeta">
					<p class="comment-meta-1">
						<?php printf( __( '%s ', 'mvp-text'), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</p>
					<p class="comment-meta-2">
						<?php echo get_comment_date(); ?> <?php _e( 'at', 'mvp-text'); ?> <?php echo get_comment_time(); ?>
						<?php edit_comment_link( __( 'Edit', 'mvp-text'), '(' , ')'); ?>
					</p>

				</div>

				<div class="text">

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="waiting_approval"><?php _e( 'Your comment is awaiting moderation.', 'mvp-text' ); ?></p>
					<?php endif; ?>

					<div class="c">
						<?php comment_text(); ?>
					</div>

				</div><!-- .text  -->
				<div class="clear"></div>
				<div class="comment-reply"><span class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span></div>
			</div><!-- comment-inner  -->
		</div><!-- comment-wrapper  -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'mvp-text' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'mvp-text' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
}

/////////////////////////////////////
// Popular Posts
/////////////////////////////////////

function getCrunchifyPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

function setCrunchifyPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/////////////////////////////////////
// Pagination
/////////////////////////////////////

if ( !function_exists( 'pagination' ) ) {
function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}
}

/////////////////////////////////////
// Add/Remove User Contact Info
/////////////////////////////////////

if ( !function_exists( 'new_contactmethods' ) ) {
function new_contactmethods( $contactmethods ) {
    $contactmethods['facebook'] = 'Facebook'; // Add Facebook
    $contactmethods['twitter'] = 'Twitter'; // Add Twitter
    $contactmethods['pinterest'] = 'Pinterest'; // Add Pinterest
    $contactmethods['googleplus'] = 'Google Plus'; // Add Google Plus
    $contactmethods['instagram'] = 'Instagram'; // Add Instagram
    $contactmethods['linkedin'] = 'LinkedIn'; // Add LinkedIn
    unset($contactmethods['yim']); // Remove YIM
    unset($contactmethods['aim']); // Remove AIM
    unset($contactmethods['jabber']); // Remove Jabber

    return $contactmethods;
}
}
add_filter('user_contactmethods','new_contactmethods',10,1);

/////////////////////////////////////
// Footer Javascript
/////////////////////////////////////

if ( !function_exists( 'mvp_wp_footer' ) ) {
function mvp_wp_footer() {

?>

<?php $mvp_infinite_scroll = get_option('mvp_infinite_scroll'); if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) { ?>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function($) {
"use strict";
$('.infinite-content').infinitescroll({
	navSelector: ".nav-links",
	nextSelector: ".nav-links a:first",
	itemSelector: ".infinite-post",
	loading: {
		msgText: "<?php _e( 'Loading more posts...', 'mvp-text' ); ?>",
		finishedMsg: "<?php _e( 'Sorry, no more posts', 'mvp-text' ); ?>"
	}
});

$(window).load(function(){
$("#sidebar-widget-in").niceScroll({cursorcolor:"#bbb",cursorwidth: 7, cursorborder: 0,zindex:999999});
$("#sidebar-widget-in").getNiceScroll().resize();
});

});
//]]>
</script>
<?php } } ?>

<?php }

}
add_action( 'wp_footer', 'mvp_wp_footer' );

/////////////////////////////////////
// Site Layout
/////////////////////////////////////

if ( !function_exists( 'mvp_site_layout' ) ) {
function mvp_site_layout() {

?>

<style type="text/css">

<?php if(get_option('mvp_site_layout') == 'Boxed' || get_option('mvp_wall_ad')) { ?>

@media screen and (min-width: 1042px) {

#site {
	float: none;
	margin: 0 auto;
	width: 1040px;
	}

#nav-wrap {
		-ms-box-shadow: 0 7px 10px -5px rgba(0,0,0,0.3);
		-moz-box-shadow: 0 7px 10px -5px rgba(0,0,0,0.3);
		-o-box-shadow: 0 7px 10px -5px rgba(0,0,0,0.3);
		-webkit-box-shadow: 0 7px 10px -5px rgba(0,0,0,0.3);
	box-shadow: 0 7px 10px -5px rgba(0,0,0,0.3);
	clip: rect(0px,1040px,5000px,0px);
	left: auto;
	width: 1040px;
	}

.nav-spacer {
	right: 0;
	}

#search-bar {
	right: 0;
	}

.main-nav .menu li .mega-dropdown,
.main-nav .menu li.mega-dropdown ul.sub-menu {
	left: 0;
	}

.content-out,
.content-in {
	margin-left: 0;
	}

.content-out {
	right: 0;
	}

#nav-wrap .content-out {
	margin-left: 0;
	right: 0;
	}

#nav-wrap .content-in {
	margin-left: 0;
	}

.single .main-nav .menu li .mega-dropdown {
	left: 0;
	}

.single .main-nav .menu li.menu-item-has-children .mega-dropdown-out {
	margin-left: -240px;
	right: 0;
	}

.single .main-nav .menu li.menu-item-has-children .mega-dropdown-in {
	margin-left: 240px;
	}

.single .main-nav .menu li.mega-dropdown ul.sub-menu {
	left: 20px;
	}

.single #search-bar {
	right: 0;
	}

.author-info-wrap {
	display: none;
	}

#left-content-mobi {
	display: block;
	}

#home-content-out,
#home-content-in {
	margin-left: auto;
	}

#featured-multi-wrap {
	height: auto;
	}
		
#featured-multi-main {
	margin: 0;
	width: 100%;
	height: 400px;
	}
			
#featured-multi-sub-wrap {
	margin: 1px 0 0 -.099700897308%; /* 1px / 1003px */
	width: 100.099700897%; /* 1004px / 1003px */
	}
			
.featured-multi-sub {
	margin: 0 0 0 .099601593625%; /* 1px / 1004px */ 
	width: 24.9003984064%; /* 250px / 1004px */
	height: 200px;
	}

.featured-multi-sub-text {
	padding: 30px 8.13008130081% 20px; /* 20px / 246px */
	width: 83.8%; /* 206px / 246px */
	}

.featured-multi-sub-text h2 {
	font-size: .9em;
	}

.video-but-contain {
	bottom: 60%;
	font-size: 60px;
	width: 52px;
	height: 60px;
	}

.home-widget {
	padding: 20px 2.7027027027%; /* 20px / 740px */
	width: 94.5945945945%; /* 700px / 740px */
	}

ul.widget-full1 {
	margin-left: -3.21027287319%; /* 20px / 623px */
	width: 103.21027287319%; /* 643px / 623px */
	}
			
		ul.widget-full1 li {
			margin: 0 0 20px 3.11041990669%; /* 20px / 643px */
			width: 46.8895800933%; /* 301.5px / 643px */
			height: 350px;
			}
			
		.full-wide-img img {
			min-width: 600px;
			}
		
		.story-section {
			margin: 0 0 0 -.151745068285%; /* 1px / 659px */
			width: 100.151745068285%; /* 660px / 659px */
			}

		.widget-grid-wrap {
			height: auto;
			}
			
		.grid-main,
		.grid-main-img {
			width: 100%;
			height: 240px;
			}
			
		.grid-right {
			margin-left: -.164744645799%; /* 1px / 607px */
			width: 100.164744645799%; /* 608px / 607px */
			}

		.grid-sub {
			margin: 1px 0 0 .164473684211%; /* 1px / 608px */
			width: 49.8355263158%; /* 303px / 608px */
			height: 120px;
			}
			
		.grid-sub-img {
			height: 120px;
			}

.story-contain {
	margin: 0 0 1px .15151515151515%; /* 1px / 660px */
	width: 49.8484848484884%; /* 329px / 660px */
	}
			
		.story-contain-text {
			padding: 15px 6.27615062762%; /* 15px / 239px */
			width: 87.4476987448%; /* 209px / 239px */
			}
			
		.story-contain-text h2 {
			margin-bottom: 0;
			}

.content-out.post-full,
.content-in.post-full {
	margin-right: 0;
	}

.story-section {
	margin: 2px 0 0 -.352112676056%; /* 2px / 586px */
	width: 100.352112676056%; /* 588px / 586px */
	}

.story-contain-text {
	padding: 15px 6.27615062762%; /* 15px / 239px */
	width: 87.4476987448%; /* 209px / 239px */
	}

#sidebar-contain {
	margin-left: 699px;
	right: auto;
	}

.side-fixed,
.page .side-fixed, .woocommerce .side-fixed,
.single .side-fixed {
	right: auto !important;
	}

#post-content-contain #sidebar-contain {
	margin-left: 639px;
	}

#post-social-wrap,
.social-fixed {
	left: auto !important;
	}

p.author-desc,
span.author-twit,
.post-date-wrap,
#left-content {
	display: none;
	}

.post-tags-mobi {
	display: block;
	}

.single .content-out,
.single .content-in {
	margin-left: 0;
	right: 0;
	}

		h1.story-title {
			font-size: 2.4em;
			}
			
		#post-area,
		#feat-img-wide-text {
			padding: 20px 3.12989045383%; /* 20px / 639px */
			width: 93.7402190923%; /* 599px / 639px */
			}
			
		h1.story-title {
			font-size: 2em;
			margin-bottom: 20px;
			}
			
		#left-content,
		#right-content {
			margin: 0;
			width: 100%;
			}
			
		.post-cat-mob {
			display: block;
			width: 100%;
			}
			
		.post-cat-mob .img-cat {
			padding: 5px 10px;
			width: auto;
			}
			
		.author-info-wrap {
			border-bottom: none;
			margin-bottom: 15px;
			padding-bottom: 0;
			}
			
		.author-img {
			margin: 0 15px 0 0;
			width: auto;
			}
		
		.author-img img {
			width: 70px;
			height: 70px;
			}
			
		.author-info-mob-wrap {
			float: left;
			width: 70%;
			}
			
		span.author-name {
			text-align: left;
			}
		
		.post-date-mob {
			border-bottom: none;
			display: inline-block;
			margin-bottom: 0;
			padding-bottom: 0;
			width: auto;
			}
			
		span.post-date {
			float: left;
			width: 100%;
			}
			
		#feat-img-wide img,	
		#feat-img-reg img {
			margin: 0 !important;
			}
			
		span.feat-caption-wide {
			font-size: .8em;
			}
			
		span.comment-but-text {
			width: 100%;
			}

.foot-widget {
	margin: 0 0 40px 6.07902735562%; /* 40px / 658px */
	width: 40.8814589666%; /* 269px / 658px */
	}

.foot-widget:nth-child(2n+3) {
	clear: both;
	}

}

<?php } ?>

<?php $mvp_social_page = get_option('mvp_social_page'); if (is_page()) { if ($mvp_social_page == "false") { ?>

#post-social-out,
#post-social-in {
	margin-left: 0;
	}

<?php if(get_option('mvp_site_layout') == 'Boxed') { ?>

@media screen and (min-width: 1003px) {

#post-content-contain #sidebar-contain {
	margin-left: 699px;
	}

}

<?php } ?>

<?php } } else if ( is_single() ) { $mvp_social_box = get_option('mvp_social_box'); if ($mvp_social_box == "false") { ?>
#post-social-out,
#post-social-in {
	margin-left: 0;
	}

<?php if(get_option('mvp_site_layout') == 'Boxed') { ?>

@media screen and (min-width: 1003px) {

#post-content-contain #sidebar-contain {
	margin-left: 699px;
	}

}

<?php } ?>

<?php } } ?>

<?php $mvp_social_box = get_option('mvp_social_box'); if (is_single()) { if ($mvp_social_box == "true") { ?>

@media screen and (max-width: 479px) {

	.social-bottom {
		margin-bottom: 44px;
		}

	}

<?php } } ?>

<?php $mvp_social_page = get_option('mvp_social_page'); if (is_page()) { if ($mvp_social_page == "true") { ?>

@media screen and (max-width: 479px) {

	.social-bottom {
		margin-bottom: 44px;
		}

	}

<?php } } ?>

<?php if(get_option('mvp_static_sidebar')) { } else { ?>

#sidebar-widget-wrap {
	top: 0;
	}

<?php } ?>

<?php $sticky_side = get_option('mvp_sticky_sidebar'); if ($sticky_side == "true") { if (isset($sticky_side)) { } } else { if (isset($sticky_side)) { ?>

@media screen and (min-width: 1003px) {

#sidebar-contain {
	bottom: auto;
	height: 100%;
	}

#post-content-contain #sidebar-contain {
	margin-left: 699px;
	}

.side-fixed {
	position: absolute !important;
		top: 0 !important;
		bottom: auto !important;
		right: -341px !important;
	}

.single .side-fixed,
.page .side-fixed,
.woocommerce .side-fixed {
	right: -341px !important;
	}

#sidebar-scroll-wrap {
	display: none;
	}

}

<?php if(get_option('mvp_site_layout') == 'Boxed') { ?>

#content-out,
#content-in {
	margin-right: 0;
	}

<?php } else { ?>

#content-out {
	margin-right: -60px;
	}

#content-in {
	margin-right: 60px;
	}

<?php } ?>

@media screen and (max-width: 1263px) {

	#content-out,
	#content-in {
		margin-right: 0;
		}

	}

<?php } } ?>

</style>

<style type="text/css">
<?php $customcss = get_option('mvp_customcss'); if ($customcss) { echo stripslashes($customcss); } ?>
</style>

<?php }

}

add_action( 'wp_head', 'mvp_site_layout' );

/////////////////////////////////////
// Remove Pages From Search Results
/////////////////////////////////////

if ( !is_admin() ) {

function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','SearchFilter');

}

/////////////////////////////////////
// Miscellaneous
/////////////////////////////////////

// Place Wordpress Admin Bar Above Main Navigation

if ( is_user_logged_in() ) {
	if ( is_admin_bar_showing() ) {
	function mvp_admin_bar() {
		echo "
			<style type='text/css'>
			#nav-wrap {top: 32px !important;}
			</style>
		";
	}
	add_action( 'wp_head', 'mvp_admin_bar' );
	}
}

// Set Content Width
if ( ! isset( $content_width ) ) $content_width = 620;

// Add RSS links to <head> section
add_theme_support( 'automatic-feed-links' );

add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}

// Prevents double posts on second page

add_filter('redirect_canonical','pif_disable_redirect_canonical');

function pif_disable_redirect_canonical($redirect_url) {
    if (is_singular()) $redirect_url = false;
return $redirect_url;
}

/////////////////////////////////////
// WooCommerce
/////////////////////////////////////

add_theme_support( 'woocommerce' );

?>