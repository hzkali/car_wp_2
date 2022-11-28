<?php  

   $count = 1;

   $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

   

   if( $cat ) $query_args['services_category'] = $cat;

   $query = new WP_Query($query_args) ; 

   $display_style = ($display_style == 'grey') ? 'theme-two' : '';

   ob_start() ;?>

   

<?php if($query->have_posts()):  ?>   



<!--Services Section-->

<section class="services-section <?php echo esc_attr($display_style);?>">

    <div class="auto-container">

    

        <div class="sec-title wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1000ms">

            <h3><?php echo wp_kses_post($title);?></h3>

        </div>

        

        <div class="row clearfix">

        

            <?php while($query->have_posts()): $query->the_post();

					global $post ; 

					$services_meta = _WSH()->get_meta();

			?>

            

            <article class="col-md-4 col-sm-12 col-xs-12 post wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1000ms">

                <div class="inner">

                    <div class="icon"><span class="<?php echo str_replace("icon ", "",carshire_set($services_meta, 'fontawesome'));?>"></span></div>

                    <h3 class="post-title"><?php the_title();?></h3>

                    <div class="text"><?php echo wp_kses_post(carshire_bunch_trim(get_the_content(), $text_limit));?></div>

                </div>

            </article>

            

            <?php endwhile;?>

            

        </div>

    </div>

</section><strong></strong>



<?php endif; ?>



<?php 

	wp_reset_postdata();

   $output = ob_get_contents(); 

   ob_end_clean(); 

   return $output ; ?>