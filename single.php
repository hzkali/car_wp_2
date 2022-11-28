<?php $options = _WSH()->option();

	get_header(); 

	$settings  = carshire_set(carshire_set(get_post_meta(get_the_ID(), 'bunch_page_meta', true) , 'bunch_page_options') , 0);

	$meta = _WSH()->get_meta('_bunch_layout_settings');

	$meta1 = _WSH()->get_meta('_bunch_header_settings');

	$meta2 = _WSH()->get_meta();

	_WSH()->page_settings = $meta;

	if(carshire_set($_GET, 'layout_style')) $layout = carshire_set($_GET, 'layout_style'); else

	$layout = carshire_set( $meta, 'layout', 'full' );

	if( !$layout || $layout == 'full' || carshire_set($_GET, 'layout_style')=='full' ) $sidebar = ''; else

	$sidebar = carshire_set( $meta, 'sidebar', 'blog-sidebar' );

	$classes = ( !$layout || $layout == 'full' || carshire_set($_GET, 'layout_style')=='full' ) ? ' col-lg-12 col-md-12 col-sm-12 col-xs-12' : ' col-lg-9 col-md-8 col-sm-12 col-xs-12';

	if($layout == 'both') $classes = ' col-lg-6 col-md-6 col-sm-6 col-xs-12 ';  

	/** Update the post views counter */

	_WSH()->post_views( true );


	$bg = carshire_set($meta1, 'header_img');

	$title = carshire_set($meta1, 'header_title');

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

			<!-- Left Content -->

			<section class="left-content <?php echo esc_attr($classes);?>">
				<div class="thm-unit-test">
				<?php while( have_posts() ): the_post(); 

					$post_meta = _WSH()->get_meta();

				?>

					<!-- Post -->

					<article class="post post-detail">

						<div class="post-image wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">

							<?php the_post_thumbnail('carshire8', array('class' => 'img-responsive'));?>

							<div class="caption">

								<div class="date"><span class="day"><?php echo get_the_date('d');?></span><span class="month"><?php echo get_the_date('M');?></span></div>

								<div class="comments"><span class="fa fa-comments"></span> &ensp; <?php comments_number( '0', '1', '%' ); ?></div>

							</div>

						</div>

						<div class="content-box">

							<div class="post-info"><?php esc_html_e('Posted on ', 'carshire'); echo get_the_date('F d, Y')?>  / <?php esc_html_e('by', 'carshire');?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author();?></a> / <a href="<?php echo esc_url(get_permalink(get_the_id()).'#comments');?>"><?php comments_number( '0 comment', '1 comment', '% comments' ); ?></a></div>

							<div class="post-data">
								<div class="text">
								<?php the_content();?>
                                </div>
								<div class="clearfix"></div>
								<span class="tags"><?php the_tags();?></span>	
                                <?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'carshire'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>	

							</div>

							<div class="share-post wow fadeInRight" data-wow-delay="200ms" data-wow-duration="1500ms">

								<div class="social-links">

									<div class="share-box">

		                                  <ul class="psocial shares clearfix">

		                                      <li class="share_title"><?php esc_html_e('Share This Post:', 'carshire');?></li>

		                                      <li class="facebook"><span class='st_facebook_large hovicon effect-1 sub-a'></span></li>

		                                      <li class="twitter"><span class="st_twitter_large hovicon effect-1 sub-a"></span></li>

		                                      <li class="google"><span class="st_googleplus_large hovicon effect-1 sub-a"></span></li>

		                                      <li class="pinterest"><span class='st_pinterest_large hovicon effect-1 sub-a'></span></li>

		                                  </ul>

		                                  <script type="text/javascript">var switchTo5x=true;</script>

		                                  <script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>

		                                  <script type="text/javascript">stLight.options({publisher: "e5f231e9-4404-49b7-bc55-0e8351a047cc", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

		                                  <br/>

		                            </div>	

								</div>

							</div>

						</div>

					</article>

					<!--About Author-->
					<?php if(get_the_author_meta('description')){ ?>
					<div class="about-author wow fadeIn" data-wow-delay="0ms" data-wow-duration="1500ms">

						<h3 class="skew-lines"><?php esc_html_e('ABOUT THE AUTHOR', 'carshire');?></h3>

						<div class="author-info"><strong><?php the_author(); ?></strong></div>

						<div class="author-desc">

							<div class="author-thumb"><?php echo get_avatar(get_the_author_meta( 'ID' ), 84 ); ?></div>

							<div class="text"><?php echo '“ ';the_author_meta( 'description', get_the_author_meta('ID') ); echo '”';?></div>

						</div>

					</div>
					<?php } ?>
					<!-- comment area -->

		            <?php comments_template(); ?><!-- end comments -->

				<?php endwhile;?>
				</div>
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