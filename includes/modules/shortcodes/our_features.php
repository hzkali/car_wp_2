<?php  

   $count = 1;

   $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

   

   if( $cat ) $query_args['services_category'] = $cat;

   $query = new WP_Query($query_args) ; 

   

   ob_start() ;?>

   

<?php if($query->have_posts()):  ?>   



<!--Our Features Section-->

<section class="features-section column-view">

    <div class="auto-container">

        <div class="sec-title">

            <h3><?php echo wp_kses_post($title);?></h3>

        </div>

        

        <!--Column Carousel-->

        <div class="column-carousel four-column clearfix">

            

            <?php while($query->have_posts()): $query->the_post();

					global $post ; 

					$services_meta = _WSH()->get_meta();

			?>

            

            <article class="column-box">

                <div class="inner-box hvr-float-shadow">

                    <figure class="image">

                        <a href="<?php echo esc_url(carshire_set($services_meta, 'ext_url'));?>"><?php the_post_thumbnail('carshire4');?></a>

                        <figcaption class="price"><sup><?php echo wp_kses_post(carshire_set($services_meta, 'service_currency'));?></sup><?php echo wp_kses_post(carshire_set($services_meta, 'price'));?></figcaption>

                    </figure>

                    <div class="post-content clearfix">

                        <h3 class="skew-lines"><?php the_title();?></h3>

                        <div class="text-center"><a href="<?php echo esc_url(carshire_set($services_meta, 'ext_url'));?>" class="theme-btn btn-style-one"><span class="fa fa-angle-right"></span> <?php echo esc_html_e('GET A QUOTE', 'carshire');?></a></div>

                    </div>

                </div>

            </article>

            

            <?php endwhile;?>

            

        </div>

    </div>    

</section>



<?php endif; ?>



<?php 

	wp_reset_postdata();

   $output = ob_get_contents(); 

   ob_end_clean(); 

   return $output ; ?>