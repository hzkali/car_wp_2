<?php  

   $count = 1;

   $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

   

   if( $cat ) $query_args['services_category'] = $cat;

   $query = new WP_Query($query_args) ; 

   

   ob_start() ;?>

   

<?php if($query->have_posts()):  ?>   

<!--Vertical Gallery-->

<section class="vertical-gallery">

<div class="auto-container">

	<div class="ms-vertical-template  ms-tabs-vertical-template">

		<div class="master-slider vertical-gallery" id="vertical-gallery">

			 <?php while($query->have_posts()): $query->the_post();

                        global $post ; 

                        $services_meta = _WSH()->get_meta();

             ?>

			 

			 <div class="ms-slide">

				<?php the_post_thumbnail('carshire7', array('class' => 'img-responsive'));?>

				<?php the_post_thumbnail('carshire9', array('class' => 'ms-thumb img-responsive'));?>

				<div class="ms-layer slide-desc">

					<div class="icon"><span class="<?php echo str_replace("icon ", "", carshire_set($services_meta, 'fontawesome'));?>"></span></div>

					<h4><?php the_title();?></h4>

					<p><?php echo wp_kses_post(carshire_set($services_meta, 'subtitle'));?></p>

				</div>

			 </div>

			 

			 <?php endwhile;?>

			

		</div>

	</div>

</div>

</section>



<?php endif; ?>



<?php 

	wp_reset_postdata();

   $output = ob_get_contents(); 

   ob_end_clean(); 

   return $output ; ?>