<?php  

   $count = 1;

   $query_args = array('post_type' => 'bunch_team' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

   if( $cat ) $query_args['team_category'] = $cat;

   $query = new WP_Query($query_args) ; 

   

   ob_start() ;?>

   

<?php if($query->have_posts()):  ?>



 <!--Our Team Section-->

    <section class="team-section column-view">

		<div class="auto-container">

        	<div class="sec-title">

            	<h3><?php echo wp_kses_post($title);?></h3>

            </div>

            

            <!--Column Carousel-->

        	<div class="column-carousel four-column clearfix">

            

            	<?php while($query->have_posts()): $query->the_post();

					global $post ; 

					$teams_meta = _WSH()->get_meta();

				?>

                

                <article class="column-box team-box">

                	<div class="inner-box hvr-float-shadow">

                    	<figure class="image">

                        	<a href="<?php echo esc_url(carshire_set($teams_meta, 'team_link'));?>"><?php the_post_thumbnail('carshire4');?></a>

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

                

            </div>

        </div>    

    </section>

 

<?php endif; ?>



<?php 

	wp_reset_postdata();

   $output = ob_get_contents(); 

   ob_end_clean(); 

   return $output ; ?>