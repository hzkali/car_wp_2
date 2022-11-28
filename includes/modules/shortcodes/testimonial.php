<?php  

   $count = 1;

   $query_args = array('post_type' => 'bunch_testimonials' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

   

   if( $cat ) $query_args['testimonials_category'] = $cat;

   $query = new WP_Query($query_args) ; 

   $display_style = ($display_style == 'red')? 'theme-two' : '';

   ob_start() ;?>

   

<?php if($query->have_posts()):  ?>   



<!--Testimonials-->

    <section class="testimonials-section <?php echo esc_attr($display_style);?>" style="background-image: url('<?php echo wp_get_attachment_url( $image, 'full' ); ?>');">

		<div class="auto-container">

            

            <div class="sec-title text-center">

                <h3><?php echo wp_kses_post($title);?></h3>

            </div>

                        

        	<div class="testimonials-slider column-carousel three-column">

            	

                <?php while($query->have_posts()): $query->the_post();

					global $post ; 

					$client_meta = _WSH()->get_meta();

				?>

                

                <article class="slide-item">

                	<figure class="image-box"><?php the_post_thumbnail('carshire3');?></figure>

                    <div class="slide-text">

                        <p><?php echo wp_kses_post(carshire_bunch_trim(get_the_excerpt(), $text_limit));?></p>

                    </div>

                    

                    <div class="info-box clearfix">

                    	<h3>

							<?php the_title();?>  &ensp; 

							<strong class="rating">

								<?php

					

									$ratting = carshire_set($client_meta, 'testimonial_rating');

									

									for ($x = 1; $x <= 5; $x++) {

										if($x <= $ratting) echo '<span class="star"></span>'; else echo '<span class="star empty-star-class"></span>'; 

									}

								?>

							</strong>

						</h3>

                    </div>

                    

                </article>

                

                <?php endwhile; ?>

                

            </div>

            

        </div>    

    </section>

    

<?php endif; ?>



<?php 

	wp_reset_postdata();

   $output = ob_get_contents(); 

   ob_end_clean(); 

   return $output ; ?>