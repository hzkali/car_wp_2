<?php
$options = _WSH()->option();
    get_header(); 
?>

<!-- Page Banner -->
<section class="page-banner">
	
    <div class="auto-container">
		<div class="page-title"><h1><?php esc_html_e('404', 'carshire');?></h1></div>
		<div class="bread-crumb text-right">
			<span class="initial-text"><?php esc_html_e('you are here: ', 'carshire');?></span>
		
			<?php echo wp_kses_post(carshire_get_the_breadcrumb()); ?>
			
		</div>
	</div>

</section>

<!--  Your page Content End Here -->
<!--  Your Blog Content Start From Here -->
<section id="blog_area" class="blog_area not_found">
    <!-- container -->
    <div class="container">
        
        <div class="row">
            <!-- blog post area -->
            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_post_area">
            	<div class="message-welcome text-center">
                    <h1><?php esc_html_e('Not Found ', 'carshire');?></h1>
                    <p class="lead"><?php esc_html_e('Look like something went wrong! The page you were looking for is not here. ', 'carshire');?></p>
                    <a href="<?php echo esc_url(home_url('/'));?>" class="btn btn-primary btn-lg"><?php esc_html_e('BACK TOP HOME', 'carshire');?></a>
                </div><!-- end message -->
			</div>
            <!-- blog post area -->
		
        </div>
    </div>
    <!-- container -->
</section>
<!--  Your Blog Content End Here -->  		
<?php get_footer(); ?>