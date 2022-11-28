<?php $options = _WSH()->option();

	get_header();

	$settings  = carshire_set(carshire_set(get_post_meta(get_the_ID(), 'bunch_page_meta', true) , 'bunch_page_options') , 0);

	$meta = _WSH()->get_meta('_bunch_layout_settings');

	$meta1 = _WSH()->get_meta('_bunch_header_settings');

	if(carshire_set($_GET, 'layout_style')) $layout = carshire_set($_GET, 'layout_style'); else

	$layout = carshire_set( $meta, 'layout', 'full' );

	$sidebar = carshire_set( $meta, 'sidebar', 'blog-sidebar' );



	$classes = ( !$layout || $layout == 'full' ) ? ' col-lg-12 col-md-12 col-sm-12 col-xs-12' : ' col-lg-9 col-md-8 col-sm-12 col-xs-12';

	if($layout == 'both') $classes = ' col-lg-6 col-md-6 col-sm-6 col-xs-12 ';  



	$bg = carshire_set($meta, 'header_img');

	$title = carshire_set($meta, 'header_title');

?>



<!-- Page Banner -->

<section class="page-banner" <?php if($bg):?>style="background-image:url('<?php echo esc_attr($bg)?>');"<?php endif;?>>

	 <div class="auto-container">

		<div class="page-title"><h1><?php if($title) echo wp_kses_post($title); else wp_title('');?></h1></div>

		<div class="bread-crumb text-right">

			<span class="initial-text"><?php esc_html_e('you are here: ', 'carshire');?></span>

			<?php echo wp_kses_post(carshire_get_the_breadcrumb()); ?>

		</div>

	</div>

</section>

<!-- Sidebar Page -->

<div class="sidebar-page">

	<div class="auto-container">

		<div class="row clearfix">

			<!-- sidebar area -->

			<?php if( $layout == 'left' ): ?>

				<?php if ( is_active_sidebar( $sidebar ) ) { ?>

					<aside class="side-bar col-lg-3 col-md-4 col-sm-5 col-xs-12">        

						<div class="sidebar">

							<?php dynamic_sidebar( $sidebar ); ?>

						</div>

					</aside>

				<?php } ?>

			<?php endif; ?>

			<!-- sidebar area -->

			<?php if( $layout == 'both' ): ?>

				<?php if ( is_active_sidebar( $sidebar ) ) { ?>

					<aside class="side-bar col-lg-3 col-md-3 col-sm-5 col-xs-12">        

						<div class="sidebar">

							<?php dynamic_sidebar( $sidebar ); ?>

						</div>

					</aside>

				<?php } ?>

			<?php endif; ?>

			<!-- Side Bar -->

			<!-- Left Content -->

			<section class="left-content <?php echo esc_attr($classes);?>">
				<div class="thm-unit-test">
				<?php while( have_posts() ): the_post();?>

					<!-- blog post item -->

	                <?php the_content(); ?>
					<div class="clearfix"></div>
					<?php comments_template(); ?><!-- end comments -->
                    <?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'carshire'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>

				<?php endwhile;?> 
				</div>
				<!-- Pagination -->

				<?php carshire_the_pagination(); ?>
			</section>

			<!-- sidebar area -->

			<?php if( $layout == 'both' ): ?>

				<?php if ( is_active_sidebar( $sidebar ) ) { ?>

					<aside class="side-bar col-lg-3 col-md-3 col-sm-5 col-xs-12">        

						<div class="sidebar">

							<?php dynamic_sidebar( $sidebar ); ?>

						</div>

					</aside>

				<?php } ?>

			<?php endif; ?>

			<!-- sidebar area -->

			<?php if( $layout == 'right' ): ?>

				<?php if ( is_active_sidebar( $sidebar ) ) { ?>

					<aside class="side-bar col-lg-3 col-md-4 col-sm-5 col-xs-12">       

						<div class="sidebar">

							<?php dynamic_sidebar( $sidebar ); ?>

						</div>

					</aside>

				<?php }?>

			<?php endif; ?>

			<!-- sidebar area -->

		</div>

	</div>

</div>

<?php get_footer(); ?>