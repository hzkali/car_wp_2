<?php
/**
 * Enqueu Class include functions which are necessary for enqueuing styles and scripts..
 *
 * @package   Enqueue-Package
 * @version   1.0
 * @link      http://themeforest.net/user/template_path
 * @author    Amir
 * @copyright Copyright (c) 2015, Amir
 * @license   GPL-2.0+
*/
class Bunch_Enqueue
{
	
	function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'bunch_enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'wp_head' ) );
		add_action( 'wp_footer', array( $this, 'wp_footer' ) );
		
		// Apply filter
		add_filter('body_class', array( $this, 'custom_body_classes') );
		
		add_action( 'carshire_bunch_body_id', array( $this, 'body_id' ) );
		
	}
	function bunch_enqueue_scripts()
	{
		global $post, $wp_query;
		$options = _WSH()->option();
		$current_theme = wp_get_theme();
		$header_style = carshire_set( $options, 'header_style' );
		
 
		$version = $current_theme->get( 'Version' );
		$maincolor = str_replace( '#', '' , carshire_set( $options, 'main_color_scheme', 'fb4848' ) );
		$dark_color = ( carshire_set( $options, 'website_theme' ) == 'dark' ) ? true : false;
		
		$dark_color = ( carshire_set( $_GET, 'color_style' ) == 'dark' ) ? true : $dark_color;
		
		if(carshire_set($options, 'color_scheme') == 'color2') : $color = 'css/color2.css'; else: $color = 'css/color1.css'; endif;	
		
		$protocol = is_ssl() ? 'https' : 'http';
		$styles = array( /*'carshire_bootstrap' => 'css/bootstrap.css',
						 'carshire_owl-slider' => 'css/owl.css',
						 'carshire_master-slider' => 'css/masterslider.css',
						 'carshire_ms-vertical' => 'css/masterslider/ms-vertical.css',
						 'carshire_fontawesom' => 'css/font-awesome.css',
						 'carshire_flaticon' => 'css/flaticon.css',
						 'carshire_hover' => 'css/hover.css',
						 'carshire_animate' => 'css/animate.css',
						 'carshire-fancybox' => 'css/jquery.fancybox.css',
						 'carshire_main-style'	=> 'style.css',
						 'carshire_responsive' => 'css/responsive.css',
						 'carshire_custom-style'	=> 'css/custom.css',
						 
						 'carshire-main-color' => 'css/color.php?main_color='.$maincolor,
						 'carshire-color-panel' => ( carshire_set($options, 'switcher') ) ? 'css/color-panel.css' : '',
						 */
						 
						);
		
		$styles = $this->custom_fonts($styles); //Load google fonts that user choose from theme options
		
							
		foreach( $styles as $name => $style )
		{
			if( !$style ) continue;
			if(strstr($style, 'http') || strstr($style, 'https') ) wp_enqueue_style( $name, $style);
			else wp_enqueue_style( $name, _WSH()->includes( $style, true ), '', $version );
		}
		
		$scripts = array( 
						  /*'carshire_bootstrap' => 'js/bootstrap.min.js',
						  'carshire_bootstrap_ui' => 'js/jquery-ui.min.js',
						  
						  'carshire_bxslider' => 'js/bxslider.js',
						  'carshire_owl-carousel' => 'js/owl.carousel.min.js',
						  'carshire-fancybox'		=> 'js/jquery.fancybox.pack.js',
						  'carshire_wow-animation'		=> 'js/wow.js',
						  'carshire-mixitup'		=> 'js/jquery.mixitup.min.js',
						  'carshire_ms-slider'		=> 'js/masterslider.min.js',
						  
						  'carshire_main_script' => 'js/script.js',
						  'carshire-jquery-cookie' => 'js/jquery.cookie.js',
						  'carshire-theme-panel' => 'js/themepanel.js',
						  */
						 );
		foreach( $scripts as $name => $js )
		{
			wp_register_script( $name, _WSH()->includes( $js, true ), '', $version, true);
		}
		//wp_enqueue_script( array('jquery', 'carshire_bootstrap_ui', 'carshire_bootstrap', 'carshire_bxslider', 'carshire_owl-carousel', 'carshire-fancybox', 'carshire_wow-animation', 'carshire-mixitup', 'carshire_ms-slider', 'carshire_main_script'));
		
		//if( is_singular() ) wp_enqueue_script('comment-reply');
		//if(carshire_set($options, 'switcher')) wp_enqueue_script(array('carshire-jquery-cookie', 'carshire-theme-panel'));
		
		/*if( is_single() ) {
			$format = get_post_format();
			if( $format == 'gallery' ) wp_enqueue_script( array( 'carshire_jquery-flexslider' ) );
			if( $format == 'video' || $format == 'audio' ) wp_enqueue_script( array( 'carshire_jquery-fitvids' ) );
		}*/
		//if( is_singular( 'bunch_projects' ) || $wp_query->is_posts_page || is_search() || is_tag() || is_category() || is_author() || is_archive() ) 
  		//wp_enqueue_script( array('carshire_jquery-flexslider', 'carshire_owl.carousel', 'carshire_jquery-fitvids') );
		//wp_enqueue_script( array('carshire_custom_script') );
		
		
	}
	
	function wp_head()
	{
		$opt = _WSH()->option();
		$boxed = carshire_set( $opt, 'boxed_layout' );
		$boxed_style = ( $boxed && carshire_set( $opt, 'bg_boxed' ) ) ? ' body { background: url('.carshire_set( $opt, 'bg_boxed').') repeat center center; }' : '';
		
		if( is_page() ) {
			$meta = _WSH()->get_meta();//carshire_printr($meta);
			$boxed = (carshire_set( $meta, 'boxed' )) ? true : $boxed;
			$boxed_style = ( $boxed && carshire_set( $meta, 'bg_boxed' ) ) ? ' body { background: url('.carshire_set( $meta, 'bg_boxed').') repeat center center; }' : '';
		}
		
		echo '<script type="text/javascript"> if( ajaxurl === undefined ) var ajaxurl = "'.admin_url('admin-ajax.php').'";</script>';?>
		<style type="text/css">
			<?php
			if( carshire_set( $opt, 'body_custom_font') )
			echo wp_kses_post(carshire_bunch_get_font_settings( array( 'body_font_size' => 'font-size', 'body_font_family' => 'font-family', 'body_font_style' => 'font-style', 'body_font_color' => 'color', 'body_line_height' => 'line-height' ), 'body, p {', '}' ));
			
			if( carshire_set( $opt, 'use_custom_font' ) ){
				echo wp_kses_post(carshire_bunch_get_font_settings( array( 'h1_font_size' => 'font-size', 'h1_font_family' => 'font-family', 'h1_font_style' => 'font-style', 'h1_font_color' => 'color', 'h1_line_height' => 'line-height' ), 'h1 {', '}' ));
				echo wp_kses_post(carshire_bunch_get_font_settings( array( 'h2_font_size' => 'font-size', 'h2_font_family' => 'font-family', 'h2_font_style' => 'font-style', 'h2_font_color' => 'color', 'h2_line_height' => 'line-height' ), 'h2 {', '}' ));
				echo wp_kses_post(carshire_bunch_get_font_settings( array( 'h3_font_size' => 'font-size', 'h3_font_family' => 'font-family', 'h3_font_style' => 'font-style', 'h3_font_color' => 'color', 'h3_line_height' => 'line-height' ), 'h3 {', '}' ));
				echo wp_kses_post(carshire_bunch_get_font_settings( array( 'h4_font_size' => 'font-size', 'h4_font_family' => 'font-family', 'h4_font_style' => 'font-style', 'h4_font_color' => 'color', 'h4_line_height' => 'line-height' ), 'h4 {', '}' ));
				echo wp_kses_post(carshire_bunch_get_font_settings( array( 'h5_font_size' => 'font-size', 'h5_font_family' => 'font-family', 'h5_font_style' => 'font-style', 'h5_font_color' => 'color', 'h5_line_height' => 'line-height' ), 'h5 {', '}' ));
				echo wp_kses_post(carshire_bunch_get_font_settings( array( 'h6_font_size' => 'font-size', 'h6_font_family' => 'font-family', 'h6_font_style' => 'font-style', 'h6_font_color' => 'color', 'h6_line_height' => 'line-height' ), 'h6 {', '}' ));
			}
			echo wp_kses_post($boxed_style);			
			echo wp_kses_post(carshire_set( $opt, 'header_css' ));
			?>
		</style>
        
        <?php if(function_exists('bunch_theme_color_scheme')) bunch_theme_color_scheme(); ?>
		
		<?php if( carshire_set( $opt, 'header_js' ) ): ?>
			<script type="text/javascript">
                <?php echo esc_js(carshire_set( $opt, 'header_js' ));?>
            </script>
        <?php endif;?>
        <?php
	}
	
	function wp_footer()
	{
		$analytics = carshire_set( _WSH()->option(), 'footer_analytics');
		
		echo wp_kses_post($analytics);
		
		$theme_options = _WSH()->option();
		
		if( carshire_set( $theme_options, 'footer_js' ) ): ?>
			<script type="text/javascript">
                <?php echo esc_js(carshire_set( $theme_options, 'footer_js' ));?>
            </script>
        <?php endif;
	}
	
	function custom_fonts( $styles )
	{
		$opt = _WSH()->option();
		$protocol = ( is_ssl() ) ? 'https' : 'http';
		$font = array();
		
		if( carshire_set( $opt, 'use_custom_font' ) ){
			
			if( $h1 = carshire_set( $opt, 'h1_font_family' ) ) $font[$h1] = urlencode( $h1 ).':400,300,600,700,800';
			if( $h2 = carshire_set( $opt, 'h2_font_family' ) ) $font[$h2] = urlencode( $h2 ).':400,300,600,700,800';
			if( $h3 = carshire_set( $opt, 'h3_font_family' ) ) $font[$h3] = urlencode( $h3 ).':400,300,600,700,800';
		}
		
		if( carshire_set( $opt, 'body_custom_font' ) ){
			if( $body = carshire_set( $opt, 'body_font_family' ) ) $font[$body] = urlencode( $body ).':400,300,600,700,800';
		}
		
		if( $font ) $styles['bunch_google_custom_font'] = $protocol.'://fonts.googleapis.com/css?family='.implode('|', $font);
		
		return $styles;
	}
	
	function custom_body_classes( $classes )
	{
		$options = _WSH()->option();
		
		$dark_color = ( carshire_set( $options, 'website_theme' ) == 'dark' ) ? true : false;
		
		$dark_color = ( carshire_set( $_GET, 'color_style' ) == 'dark' ) ? true : $dark_color;
		
		if( $dark_color ) $classes[] = 'dark-style';
	
		return $classes;
	}
	
	function body_id() 
	{
		$options = _WSH()->option();
		
		$boxed = carshire_set( $options, 'boxed_layout' );
		
		$boxed_layout = ( $boxed && !$nobg ) ? ' id="boxed" ' : ''; 
		
		echo wp_kses_post($boxed_layout);
	}
}