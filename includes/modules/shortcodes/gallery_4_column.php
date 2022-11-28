<?php 

bunch_global_variable();

$paged = get_query_var('paged');

$args = array('post_type' => 'bunch_gallery', 'showposts'=>$num, 'orderby'=>$sort, 'order'=>$order, 'paged'=>$paged);

if($exclude_cats) $args['tax_query'] = array(array('taxonomy' => 'gallery_category','field' => 'id','terms' => array($exclude_cats),'operator' => 'NOT IN',));

$query = new WP_Query($args);

//query_posts($args);



$t = $GLOBALS['_bunch_base'];

$paged = get_query_var('paged');



$data_filtration = '';

$data_posts = '';

?>





<?php if( $query->have_posts() ):

	

ob_start();?>



	<?php $count = 0; 

	$fliteration = array();?>

	<?php while( $query->have_posts() ): $query->the_post();

		global  $post;

		//$meta = get_post_meta( get_the_id(), '_bunch_gallery_meta', true );//carshire_printr($meta);

		$meta = _WSH()->get_meta();

		$post_terms = get_the_terms( get_the_id(), 'gallery_category');// carshire_printr($post_terms); exit();

		foreach( (array)$post_terms as $pos_term ) $fliteration[$pos_term->term_id] = $pos_term;

		$temp_category = get_the_term_list(get_the_id(), 'gallery_category', '', ', ');

	?>

		<?php $post_terms = wp_get_post_terms( get_the_id(), 'gallery_category'); 

		$term_slug = '';

		if( $post_terms ) foreach( $post_terms as $p_term ) $term_slug .= $p_term->slug.' ';?>		

           

		   <?php 

			$post_thumbnail_id = get_post_thumbnail_id($post->ID);

			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

		   ?>     

		   

		   <article class="col-md-3 col-sm-6 col-xs-12 column-box mix mix_all <?php echo esc_attr($term_slug); ?>">

				<div class="inner-box hvr-float-shadow">

					<figure class="image">

						<a href="<?php echo esc_url(carshire_set($meta, 'ext_url'));?>">

							<?php the_post_thumbnail('carshire2', array('class' => 'img-responsive'));?>

						</a>

						<figcaption class="price"><sup><?php echo wp_kses_post(carshire_set($meta, 'gallery_currency'));?></sup><?php echo wp_kses_post(carshire_set($meta, 'price'));?></figcaption>

					</figure>

					<div class="post-content clearfix">

						<h3 class="skew-lines"><?php the_title();?></h3>

						<div class="text-center"><a href="<?php echo esc_url(carshire_set($meta, 'ext_url'));?>" class="theme-btn btn-style-one"><span class="fa fa-angle-right"></span><?php esc_html_e('GET A QUOTE', 'carshire');?> </a></div>

					</div>

				</div>

		   </article>

		   

<?php endwhile;?>

  

<?php wp_reset_postdata();

$data_posts = ob_get_contents();

ob_end_clean();



endif; 



ob_start();?>	 



<?php $terms = get_terms(array('gallery_category')); ?>

<!--Filter Section-->

<section class="filter-section">

<div class="auto-container1">

	<?php if( $terms ): ?>

	<div class="row clearfix">

		<div class="col-md-3 col-sm-12 col-xs-12">

			<div class="sec-title"><h3><?php echo wp_kses_post($title);?></h3></div>

		</div>

		<div class="col-md-9 col-sm-12 col-xs-12 filter-box">

			<ul class="filter-tabs clearfix">

				<li class="filter" data-role="button" data-filter="all"><?php esc_html_e('all', 'carshire');?></li>

				<?php foreach( $fliteration as $t ): ?>

				<li class="filter" data-role="button" data-filter="<?php echo esc_attr(carshire_set( $t, 'slug' )); ?>"><?php echo wp_kses_post(carshire_set( $t, 'name')); ?></li>

				<?php endforeach;?>

			</ul>

		</div>

	</div>

	<?php endif;?>

	<div class="row filter-list column-view clearfix">

		<?php echo wp_kses_post($data_posts); ?>

	</div>

	

	<div class="gallery_pagi">

		

		<?php  if($show_pagination) carshire_the_pagination(array('total'=>$query->max_num_pages, 'next_text' => '<i class="fa fa-angle-double-right"></i>', 'prev_text' => '<i class="fa fa-angle-double-left"></i>')); ?>

	

	</div>



</div>

</section>



<?php $output = ob_get_contents();

ob_end_clean(); 

return $output;?>