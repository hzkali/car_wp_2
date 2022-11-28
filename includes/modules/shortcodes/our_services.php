<?php  
   $count = 1;
   $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['services_category'] = $cat;
   $query = new WP_Query($query_args) ; 
   
   ob_start() ;?>
   
<?php if($query->have_posts()):  ?>   
<!--Featured Services-->
    <section class="featured-services column-view">
		<div class="auto-container">
            
            <div class="sec-title">
                <h3><?php echo wp_kses_post($title);?></h3>
            </div>
                        
        	<div class="row clearfix">
            	
                <?php while($query->have_posts()): $query->the_post();
						global $post ; 
						$services_meta = _WSH()->get_meta();
				?>
                
                <article class="col-md-4 col-sm-6 col-xs-12 column-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1000ms">
                	<div class="inner-box">
                    	<figure class="image">
                        	<a href="<?php echo esc_url(carshire_set($services_meta, 'ext_url'));?>"><?php the_post_thumbnail('carshire1');?></a>
                            <figcaption class="price"><sup><?php echo wp_kses_post(carshire_set($services_meta, 'service_currency'));?></sup><?php echo wp_kses_post(carshire_set($services_meta, 'price'));?></figcaption>
                        </figure>
                        <div class="post-content clearfix">
                        	<h3 class="skew-lines"><?php the_title();?></h3>
                            <div class="text-center"><a href="<?php echo esc_url(carshire_set($services_meta, 'ext_url'));?>" class="theme-btn btn-style-one"><span class="fa fa-angle-right"></span><?php echo esc_html_e('GET A QUOTE', 'carshire');?></a> <a href="<?php echo esc_url(carshire_set($services_meta, 'ext_url'));?>" class="theme-btn dark-btn"><?php echo esc_html_e('Read More', 'carshire');?></a></div>
                        </div>
                        
                        <div class="overlay-box">
                        	<h3 class="skew-lines"><?php echo wp_kses_post(carshire_set($services_meta, 'subtitle'));?></h3>
                            <div class="text">
                            	<p><?php echo wp_kses_post(carshire_bunch_trim(get_the_excerpt(), $text_limit));?></p>
                                <br>
                                <a href="<?php echo esc_url(carshire_set($services_meta, 'ext_url'));?>" class="theme-btn dark-btn style-two"><span class="fa fa-angle-right"></span> <?php echo esc_html_e('GET A QUOTE', 'carshire');?></a>
                            </div>
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