<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.1.6
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$meta = _WSH()->get_meta('_bunch_layout_settings');
$meta1 = _WSH()->get_meta('_bunch_header_settings');
$layout = carshire_set( $meta, 'layout', 'right' );
$sidebar = carshire_set( $meta, 'sidebar', 'blog-sidebar' );
$classes = ( !$layout || $layout == 'full' || carshire_set($_GET, 'layout_style')=='full' ) ? ' col-lg-12 col-md-12 col-sm-12 col-xs-12 ' : ' col-lg-9 col-md-9 col-sm-12 col-xs-12 ' ;
$bg = carshire_set($meta1, 'header_img');
$title = carshire_set($meta1, 'header_title');

get_header( 'shop' ); ?>

<!--Page Title-->
<section class="page-banner" <?php if($bg):?>style="background-image:url('<?php echo esc_attr($bg)?>');"<?php endif;?>>

	 <div class="auto-container">

		<div class="page-title"><h1><?php if($title) echo wp_kses_post($title); else wp_title('');?></h1></div>

		<div class="bread-crumb text-right">

			<span class="initial-text"><?php esc_html_e('you are here: ', 'carshire');?></span>

			<?php echo wp_kses_post(carshire_get_the_breadcrumb()); ?>

		</div>

	</div>

</section>
<!--End Page Title-->

<!--Shop Single Section-->
<section class="shop-single-section">
    <div class="auto-container">
    	<div class="row clearfix">
			
            <!-- sidebar area -->
			<?php if( $layout == 'left' ): ?>
				<?php if ( is_active_sidebar( $sidebar ) ) { ?>
					<div class="sidebar-side col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <aside class="sidebar">
							<?php dynamic_sidebar( $sidebar ); ?>
                            <?php
								/**
								 * woocommerce_sidebar hook
								 *
								 * @hooked woocommerce_get_sidebar - 10
								 */
								do_action( 'woocommerce_sidebar' );
							?>
                        </aside>
                    </div>
				<?php } ?>
			<?php endif; ?>
			
            <div class="<?php echo esc_attr($classes);?>">
            	
                <div class="shop-single">
                	<div class="product-details">

						<?php
                            /**
                             * woocommerce_before_main_content hook
                             *
                             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                             * @hooked woocommerce_breadcrumb - 20
                             */
                            do_action( 'woocommerce_before_main_content' );
                        ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php wc_get_template_part( 'content', 'single-product' ); ?>
                            <?php endwhile; // end of the loop. ?>
                        <?php
                            /**
                             * woocommerce_after_main_content hook
                             *
                             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                             */
                            do_action( 'woocommerce_after_main_content' );
                        ?>
            		
                    </div>
                </div>
                
            </div>
		
        	<!-- sidebar area -->
			<?php if( $layout == 'right' ): ?>
				<?php if ( is_active_sidebar( $sidebar ) ) { ?>
					<div class="sidebar-side col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <aside class="sidebar">
							<?php dynamic_sidebar( $sidebar ); ?>
                            <?php
                                /**
                                 * woocommerce_sidebar hook
                                 *
                                 * @hooked woocommerce_get_sidebar - 10
                                 */
                                do_action( 'woocommerce_sidebar' );
                            ?>
                        </aside>
                    </div>
				<?php } ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php get_footer( 'shop' ); ?>
