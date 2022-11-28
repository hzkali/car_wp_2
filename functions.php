<?php
add_action('after_setup_theme', 'carshire_bunch_theme_setup');
function carshire_bunch_theme_setup()
{
	global $wp_version;
	if(!defined('CARSHIRE_VERSION')) define('CARSHIRE_VERSION', '1.0');
	if( !defined( 'CARSHIRE_NAME' ) ) define( 'CARSHIRE_NAME', 'wp_carshire' );
	if( !defined( 'CARSHIRE_ROOT' ) ) define('CARSHIRE_ROOT', get_template_directory().'/');
	if( !defined( 'CARSHIRE_URL' ) ) define('CARSHIRE_URL', get_template_directory_uri().'/');	
	include_once get_template_directory() . '/includes/loader.php';
	
	
	load_theme_textdomain('carshire', get_template_directory() . '/languages');
	
	//ADD THUMBNAIL SUPPORT
	add_theme_support('post-thumbnails');
	add_theme_support('woocommerce');
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support('automatic-feed-links'); //Enables post and comment RSS feed links to head.
	add_theme_support('widgets'); //Add widgets and sidebar support
	add_theme_support( "title-tag" );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	/** Register wp_nav_menus */
	if(function_exists('register_nav_menu'))
	{
		register_nav_menus(
			array(
				/** Register Main Menu location header */
				'main_menu' => esc_html__('Main Menu', 'carshire'),
			)
		);
	}
	if ( ! isset( $content_width ) ) $content_width = 960;
	add_image_size( 'carshire1', 369, 230, true ); // '369x230'
	add_image_size( 'carshire2', 269, 230, true ); // '269x230'
	add_image_size( 'carshire3', 80, 80, true ); // '80x80'
	add_image_size( 'carshire4', 268, 234, true ); // '268x234'
	add_image_size( 'carshire5', 299, 260, true );  // '299x260'
	add_image_size( 'carshire6', 268, 167, true );  // '268x167'
	add_image_size( 'carshire7', 868, 529, true );  // '868x529'
	add_image_size( 'carshire8', 1170, 349, true );  // '1170x349'
 	add_image_size( 'carshire9', 300, 150, true ); // '300x150'
	
	
	
	
}

function carshire_gutenberg_editor_palette_styles() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'strong yellow', 'carshire' ),
            'slug' => 'strong-yellow',
            'color' => '#f7bd00',
        ),
        array(
            'name' => esc_html__( 'strong white', 'carshire' ),
            'slug' => 'strong-white',
            'color' => '#fff',
        ),
		array(
            'name' => esc_html__( 'light black', 'carshire' ),
            'slug' => 'light-black',
            'color' => '#242424',
        ),
        array(
            'name' => esc_html__( 'very light gray', 'carshire' ),
            'slug' => 'very-light-gray',
            'color' => '#797979',
        ),
        array(
            'name' => esc_html__( 'very dark black', 'carshire' ),
            'slug' => 'very-dark-black',
            'color' => '#000000',
        ),
    ) );
	
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => esc_html__( 'Small', 'carshire' ),
			'size' => 10,
			'slug' => 'small'
		),
		array(
			'name' => esc_html__( 'Normal', 'carshire' ),
			'size' => 15,
			'slug' => 'normal'
		),
		array(
			'name' => esc_html__( 'Large', 'carshire' ),
			'size' => 24,
			'slug' => 'large'
		),
		array(
			'name' => esc_html__( 'Huge', 'carshire' ),
			'size' => 36,
			'slug' => 'huge'
		)
	) );
	
}
add_action( 'after_setup_theme', 'carshire_gutenberg_editor_palette_styles' );
function carshire_bunch_widget_init()
{
	global $wp_registered_sidebars;
	$theme_options = _WSH()->option();
	
	register_sidebar(array(
	  'name' => esc_html__( 'Default Sidebar', 'carshire' ),
	  'id' => 'default-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'carshire' ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s" class="widget sidebar_widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<div class="sec-title"><h3>',
	  'after_title' => '</h3></div>'
	));
	register_sidebar(array(
	  'name' => esc_html__( 'Footer Sidebar', 'carshire' ),
	  'id' => 'footer-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown in Footer Area.', 'carshire' ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s"  class="col-md-3 col-sm-12 col-xs-12 footer-widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h3>',
	  'after_title' => '</h3>'
	));
	
	register_sidebar(array(
	  'name' => esc_html__( 'Blog Listing', 'carshire' ),
	  'id' => 'blog-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'carshire' ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s" class="widget sidebar_widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<div class="sec-title"><h3>',
	  'after_title' => '</h3></div>'
	));
	if( !is_object( _WSH() )  )  return;
	$sidebars = carshire_set(carshire_set( $theme_options, 'dynamic_sidebar' ) , 'dynamic_sidebar' ); 
	foreach( array_filter((array)$sidebars) as $sidebar)
	{
		if(carshire_set($sidebar , 'topcopy')) continue ;
		
		$name = carshire_set( $sidebar, 'sidebar_name' );
		
		if( ! $name ) continue;
		$slug = carshire_bunch_slug( $name ) ;
		
		register_sidebar( array(
			'name' => $name,
			'id' =>  sanitize_title( $slug ),
			'before_widget' => '<div id="%1$s" class="side-bar widget sidebar_widget %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<div class="sec-title"><h3 class="skew-lines">',
			'after_title' => '</h3></div>',
		) );		
	}
	
	update_option('wp_registered_sidebars' , $wp_registered_sidebars) ;
}
add_action( 'widgets_init', 'carshire_bunch_widget_init' );
// Update items in cart via AJAX
add_filter('add_to_cart_fragments', 'carshire_bunch_woo_add_to_cart_ajax');
function carshire_bunch_woo_add_to_cart_ajax( $fragments ) {
    
	global $woocommerce;
    ob_start();
	
	get_template_part('includes/modules/wc_cart' );
	
	$fragments['li.wc-header-cart'] = ob_get_clean();
	
    return $fragments;
}
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
function carshire_bunch_animate_it( $atts, $contents = null )
{
	return get_template_part( 'includes/modules/shortcodes/animate_it' );
}
function carshire_load_head_scripts() {
	$options = _WSH()->option();
    if ( !is_admin() ) {
	$protocol = is_ssl() ? 'https://' : 'http://';
	if(carshire_set($options, 'map_api_key')){
	$map_path = '?key='.carshire_set($options, 'map_api_key');	
    wp_enqueue_script( 'map-api', ''.$protocol.'maps.google.com/maps/api/js'.$map_path, array(), false, false );
	wp_enqueue_script( 'googlemap', get_template_directory_uri().'/js/googlemaps.js', array(), false, false );
	}
	wp_enqueue_script( 'html5shiv', get_template_directory_uri().'/js/html5shiv.js', array(), false, false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'respond-min', get_template_directory_uri().'/js/respond.min.js', array(), false, false );
	wp_script_add_data( 'respond-min', 'conditional', 'lt IE 9' );
	}
}
add_action( 'wp_enqueue_scripts', 'carshire_load_head_scripts' );
//global variables
function bunch_global_variable() {
    global $wp_query;
}
/*----------------------------Enqueue scripts---------------------------------*/
function carshire_enqueue_scripts() {
	$theme_options = _WSH()->option();
	$maincolor = str_replace( '#', '' , carshire_set( $theme_options, 'main_color_scheme', 'fb4848' ) );
	//styles
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'owl-slider', get_template_directory_uri() . '/css/owl.css' );
	wp_enqueue_style( 'master-slider', get_template_directory_uri() . '/css/masterslider.css' );
	wp_enqueue_style( 'ms-vertical', get_template_directory_uri() . '/css/masterslider/ms-vertical.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/css/flaticon.css' );
	wp_enqueue_style( 'hover', get_template_directory_uri() . '/css/hover.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css' );
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css' );
	wp_enqueue_style( 'carshire-main-style', get_stylesheet_uri() );
	wp_enqueue_style( 'carshire-custom-style', get_template_directory_uri() . '/css/custom.css' );
	wp_enqueue_style( 'carshire-tut-style', get_template_directory_uri() . '/css/tut.css' );
	wp_enqueue_style( 'carshire-gutenberg-style', get_template_directory_uri() . '/css/gutenberg.css' );
	if(class_exists('woocommerce')) wp_enqueue_style( 'carshire-woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
	wp_enqueue_style( 'carshire-responsive', get_template_directory_uri() . '/css/responsive.css' );
	wp_enqueue_style( 'carshire-main-color', get_template_directory_uri() . '/css/color.php?main_color='.$maincolor );
	wp_enqueue_style( 'carshire-color-panel', get_template_directory_uri() . '/css/color-panel.css' );
	
	//scripts
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'bootstrap-ui', get_template_directory_uri().'/js/jquery-ui.min.js', array(), false, true );
	wp_enqueue_script( 'bxslider', get_template_directory_uri().'/js/bxslider.js', array(), false, true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri().'/js/owl.carousel.min.js', array(), false, true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri().'/js/jquery.fancybox.pack.js', array(), false, true );
	wp_enqueue_script( 'wow-animation', get_template_directory_uri().'/js/wow.js', array(), false, true );
	wp_enqueue_script( 'mixitup', get_template_directory_uri().'/js/jquery.mixitup.min.js', array(), false, true );
	wp_enqueue_script( 'ms-slider', get_template_directory_uri().'/js/masterslider.min.js', array(), false, true );
	wp_enqueue_script( 'carshire-main-script', get_template_directory_uri().'/js/script.js', array(), false, true );
	if(carshire_set($theme_options, 'switcher')){
		wp_enqueue_script( 'carshire-jquery-cookie', get_template_directory_uri().'/js/jquery.cookie.js', array(), false, true );
		wp_enqueue_script( 'carshire-theme-panel', get_template_directory_uri().'/js/themepanel.js', array(), false, true );
	}
	if( is_singular() ) wp_enqueue_script('comment-reply');
}
add_action( 'wp_enqueue_scripts', 'carshire_enqueue_scripts' );
/*-------------------------------------------------------------*/
function carshire_theme_slug_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $droid = _x( 'on', 'Droid font: on or off', 'carshire' );
	$montserrat = _x( 'on', 'Montserrat font: on or off', 'carshire' );
	
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'carshire' );
 
    if ( 'off' !== $droid || 'off' !== $open_sans || 'off' !== $montserrat ) {
        $font_families = array();
 
        if ( 'off' !== $droid ) {
            $font_families[] = 'Droid Sans:400,700';
        }
		
		if ( 'off' !== $montserrat ) {
            $font_families[] = 'Montserrat:400,700';
        }
		
		if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:400,400italic,600,300italic,300';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}
function carshire_theme_slug_scripts_styles() {
    wp_enqueue_style( 'carshire-theme-slug-fonts', carshire_theme_slug_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'carshire_theme_slug_scripts_styles' );
add_action( 'admin_enqueue_scripts', 'carshire_theme_slug_scripts_styles' );
/*---------------------------------------------------------------------*/
function carshire_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'carshire_add_editor_styles' );
