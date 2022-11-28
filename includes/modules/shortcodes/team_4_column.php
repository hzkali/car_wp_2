<?php 

bunch_global_variable();

$paged = get_query_var('paged');

$args = array('post_type' => 'bunch_team', 'showposts'=>$num, 'orderby'=>$sort, 'order'=>$order, 'paged'=>$paged);

if($exclude_cats) $args['tax_query'] = array(array('taxonomy' => 'team_category','field' => 'id','terms' => array($exclude_cats),'operator' => 'NOT IN',));

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

		$teams_meta = _WSH()->get_meta();

		$post_terms = get_the_terms( get_the_id(), 'team_category');// carshire_printr($post_terms); exit();

		foreach( (array)$post_terms as $pos_term ) $fliteration[$pos_term->term_id] = $pos_term;

		$temp_category = get_the_term_list(get_the_id(), 'team_category', '', ', ');

	?>

		<?php $post_terms = wp_get_post_terms( get_the_id(), 'team_category'); 

		$term_slug = '';

		if( $post_terms ) foreach( $post_terms as $p_term ) $term_slug .= $p_term->slug.' ';?>		

           

		   <?php 

			$post_thumbnail_id = get_post_thumbnail_id($post->ID);

			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

		   ?>     

		   

		   <article class="col-md-3 col-sm-6 col-xs-12 column-box team-box mix mix_all <?php echo esc_attr($term_slug); ?>">

			<div class="inner-box hvr-float-shadow">

				<figure class="image">

					<a href="<?php echo esc_url(carshire_set($teams_meta, 'team_link'));?>">

						<?php the_post_thumbnail('carshire4', array('class' => 'img-responsive'));?>

					</a>

					<div class="social-links">

						<div class="plus-btn"></div>

						<?php if($socials = carshire_set($teams_meta, 'bunch_team_social')):?>

							<ul class="links">

								<?php foreach($socials as $key => $value):?>

									

									<li><a href="<?php echo esc_url(carshire_set($value, 'social_link'));?>" class="fa <?php echo esc_attr(carshire_set($value, 'social_icon'));?>"></a></li>

								

								<?php endforeach;?>

							</ul>

						<?php endif;?>

					</div>

				</figure>

				<div class="post-content text-center clearfix">

					<h3><?php the_title();?></h3>

					<h5 class="occupation"><?php echo wp_kses_post(carshire_set($teams_meta, 'designation'));?></h5>

				</div>

			</div>

		   </article>

		   

		   

<?php endwhile;?>

  

<?php wp_reset_postdata();

$data_posts = ob_get_contents();

ob_end_clean();



endif; 



ob_start();?>	 



<?php $terms = get_terms(array('team_category')); ?>



<!--Filter Section-->

<section class="filter-section no-padd-bottom">

<div class="auto-container">

	

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

	

	<div class="filter-list column-view row clearfix">

		

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