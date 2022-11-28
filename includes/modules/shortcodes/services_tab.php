<?php  

   $count = 1;

   $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

   

   if( $cat ) $query_args['services_category'] = $cat;

   $query = new WP_Query($query_args) ; 

   

   $data_filtration = array();

   $data_content = array();

   ?>

   

<?php if($query->have_posts()):  ?>

<?php while($query->have_posts()): $query->the_post();

	  global $post ; 

	  $services_meta = _WSH()->get_meta();

	  $active_filter = ($count == 1) ? 'active-btn' : '';

	  $active_tab = ($count == 1) ? 'active-tab' : '';

	  $data = get_the_content();

	 

	  $data_filtration[get_the_id()] = '<li class="wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1000ms"><a href="#service'.get_the_id().'" class="tab-btn clearfix '.$active_filter.'"><div class="icon"><span class="'.str_replace("icon ", "", carshire_set($services_meta, 'fontawesome')).'"></span></div><h4>'.get_the_title($post->ID).'</h4><p>'.carshire_set($services_meta, 'subtitle').'</p></a></li>';

	  

	  $data_content[get_the_id()] = '<div class="tab '.$active_tab.'" id="service'.get_the_id().'">

										<div class="tab-title">

											<h2>'.get_the_title($post->ID).'</h2>

											<h3>'.carshire_set($services_meta, 'subtitle').'</h3>

										</div>

										'.get_the_content($post->ID).'

									</div>';

?>

<?php $count++; endwhile; endif;

wp_reset_postdata();

ob_start() ;

?>   

<!--Tabs Section-->

<section class="tabs-section">

<div class="auto-container">

	<div class="row">

		

		<div class="tabs-box clearfix">

			

			<!--Buttons Side-->

			<div class="col-md-4 col-sm-6 col-xs-12 buttons-side">

				

				<div class="sec-title">

					<h3><?php echo wp_kses_post($title);?></h3>

				</div>

				<!--Tab Buttons-->

				<ul class="tab-buttons">

					<?php foreach($data_filtration as $key => $value):?>

						<?php echo wp_kses_post($value);?>

					<?php endforeach;?>

				</ul>

			</div>

			

			<!--Content Side-->

			<div class="col-md-8 col-sm-6 col-xs-12 tabs-content clearfix">

				

				<?php foreach($data_content as $key => $content):?>

					<?php echo wp_kses_post($content);?>

				<?php endforeach;?>

				

			</div>

			

		</div>

		

	</div>

</div>

</section>



<?php 

	wp_reset_postdata();

   $output = ob_get_contents(); 

   ob_end_clean(); 

   return $output ; ?>