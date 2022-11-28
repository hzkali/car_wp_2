<?php /* Template Name: VC Page */

	get_header() ;

	$meta = _WSH()->get_meta('_bunch_header_settings');

	$bg = carshire_set($meta, 'header_img');

	$title = carshire_set($meta, 'header_title');

?>

<?php if(carshire_set($meta, 'breadcrumb')):?>

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

<?php endif;?>

<?php while( have_posts() ): the_post(); ?>

    <?php the_content(); ?>

<?php endwhile;  ?>


<?php get_footer() ; ?>