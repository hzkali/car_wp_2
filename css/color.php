<?php


/** Set ABSPATH for execution */
define( 'WPINC', 'wp-includes' );


/**
 * @ignore
 */
function add_filter() {}

/**
 * @ignore
 */
function esc_attr($str) {return $str;}

/**
 * @ignore
 */
function apply_filters() {}

/**
 * @ignore
 */
function get_option() {}

/**
 * @ignore
 */
function is_lighttpd_before_150() {}

/**
 * @ignore
 */
function add_action() {}

/**
 * @ignore
 */
function did_action() {}

/**
 * @ignore
 */
function do_action_ref_array() {}

/**
 * @ignore
 */
function get_bloginfo() {}

/**
 * @ignore
 */
function is_admin() {return true;}

/**
 * @ignore
 */
function site_url() {}

/**
 * @ignore
 */
function admin_url() {}

/**
 * @ignore
 */
function home_url() {}

/**
 * @ignore
 */
function includes_url() {}

/**
 * @ignore
 */
function wp_guess_url() {}

if ( ! function_exists( 'json_encode' ) ) :
/**
 * @ignore
 */
function json_encode() {}
endif;



/* Convert hexdec color string to rgb(a) string */
 
function hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
          return $default; 
 
	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}
//$blue = $_GET['b'];
//$black = $_GET['bl'];
$red = $_GET['main_color'];

ob_start(); ?>

.light-btn:hover,.dark-btn:hover,
.btn-style-one:hover,
.skew-lines:after,
.main-header .header-top .form button:hover,
.main-menu .navbar-collapse > ul > li:hover > a,.main-menu .navbar-collapse > ul > li.current > a,.main-menu .navbar-collapse > ul > li.current-menu-item > a,
.main-menu .navbar-collapse > ul > li > ul,
.main-menu .navbar-collapse > ul > li > ul > li > ul,
.main-menu .navbar-collapse > ul > li > ul > li > ul > li > ul,
.main-menu .navbar-collapse > ul > li > ul > li > ul > li > ul > li > ul,
.header-lower .social-links a:hover,
.why-us .box .tab-link .arrow,
.main-slider:before,.page-banner:before,
.column-view .column-box .image .price,
.column-view .column-box .overlay-box,
.testimonials-section.theme-two,
.testimonials-section .column-carousel.three-column .owl-dot span:hover,.testimonials-section .column-carousel.three-column .owl-dot.active span,
.contact-options .info-box,
.team-box .social-links .plus-btn,
.team-box .social-links li a,
.main-footer .footer-upper .newsletter-widget button,
.main-footer .social-links a:hover,
.scroll-to-top:hover,
.gallery-tabs .tabs-two .slide-item .lightbox-image,
.price-plans .table-column .table-header,
.price-plans .read-more,
.vertical-gallery .slide-desc,
.filter-section .pagination li:hover a,.filter-section .pagination li.current a,
.sidebar-page .post .overlay .icon,
.sidebar-page .post .caption .date,
.sidebar-page .social-links a:hover,
.sidebar-page .comment-form button:before,
.sidebar-page .pagination a:hover,.sidebar-page .pagination a.active,
.side-bar .search-form button:hover,
.side-bar .tags a:hover,
.contact-form button:before,
#appointment-content button[type="submit"]:before,
#appointment-content .thm-spinner .ui-widget-header,
#appointment-content .thm-spinner.ui-slider .ui-slider-handle,
#appointment-content ul.special-checkbox li.active,
.pagination > li > a, .pagination > li > span,
.pagination > li > a, .pagination > li > span:hover,
.comment-reply-link:hover,
.side-bar .tagcloud a:hover,
.paginate-links > span,
.paginate-links > span:hover,.paginate-links a:hover,.paginate-links > span,
.main-menu .navbar-collapse > ul > li.current-menu-parent > a,
.intro-section,
.intro-section .border,
.scroll-to-top,
.ms-tabs-vertical-template
{

	background-color: #<?php echo esc_attr($red); ?>;
}

.main-header .header-top .user-links a:hover,.main-header .header-top .user-links a.active,
.why-us .box .tab-link .icon,
.main-slider .white-title,
.column-view .column-box .post-content h3 a:hover,
.gallery-section .item-caption,
.tabs-box .tab-buttons .tab-btn .icon,
.tabs-box .tab-title h3,
.tabs-box .tab .list ul li:before,
.team-box .occupation,
.blog-section .column-box .date,
.main-footer .footer-upper a,
.main-footer .footer-upper .links li a:hover,
.main-footer .footer-upper .links li a i,
.main-footer .footer-upper .newsletter-widget button:hover,
.default-content h3,
.gallery-tabs .tabs-two .tab-buttons .tab-btn .icon,
.services-section .post .icon,
.price-plans .list li:before,
.page-banner .page-title h1,
.page-banner .bread-crumb a:hover,
.sidebar-page .post .post-title a:hover,
.sidebar-page .post .post-info a,
.sidebar-page .blog-detail a,.sidebar-page blockquote a,
.side-bar .latest-comments .comment-info a,
.side-bar .latest-comments .comment .comm-box p a:hover,
.side-bar .latest-posts .post a,
.side-bar .cont-info .cont-box .info li a,
.side-bar .widget_bunch_latest_comments .comment-info a,
.side-bar .widget_bunch_latest_comments .comment .comm-box p a:hover,
.theme-color,
.main-footer .footer-upper .links li a:hover
{
	color: #<?php echo esc_attr($red); ?>;
}

.light-btn:hover,.dark-btn:hover,
.btn-style-one:hover,
.why-us .title-box,
.column-view .column-box .inner-box:hover,
.gallery-section .slide-item,
.gallery-section .item-caption,
.testimonials-section .sec-title h3,
.testimonials-section .testimonials-slider .slide-item,
.contact-options,
.column-carousel .owl-controls .owl-next:hover,.column-carousel .owl-controls .owl-prev:hover,
.main-footer .footer-upper .newsletter-widget input:focus,.main-footer .footer-upper .newsletter-widget textarea:focus,
.main-footer .footer-upper .newsletter-widget button,
.gallery-tabs .tabs-two .bx-controls .bx-next:hover,.gallery-tabs .tabs-two .bx-controls .bx-prev:hover,
.ms-tabs-vertical-template .ms-nav-next:hover,.ms-tabs-vertical-template .ms-nav-prev:hover,
.sidebar-page blockquote,
.side-bar .search-form input[type="search"]:focus,.side-bar .search-form input[type="text"]:focus,
#appointment-content .title-box,
#appointment-content button[type="submit"]:hover,
#appointment-content ul.special-checkbox li.active,
.comment-reply-link:hover,
.scroll-to-top
{
	border-color: #<?php echo esc_attr($red); ?>;
}

<?php 

$out = ob_get_clean();
$expires_offset = 31536000; // 1 year
header('Content-Type: text/css; charset=UTF-8');
header('Expires: ' . gmdate( "D, d M Y H:i:s", time() + $expires_offset ) . ' GMT');
header("Cache-Control: public, max-age=$expires_offset");
header('Vary: Accept-Encoding'); // Handle proxies
header('Content-Encoding: gzip');

echo gzencode($out);
exit;