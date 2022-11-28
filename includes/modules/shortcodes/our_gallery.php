<?php  

   $count = 1;

   $query_args = array('post_type' => 'bunch_gallery' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

   

   if( $cat ) $query_args['gallery_category'] = $cat;

   $query = new WP_Query($query_args) ; 

   

   ob_start() ;?>

   

<?php if($query->have_posts()):  ?>   



<!--Our Gallery-->

    <section class="gallery-section">

		<div class="auto-container">

            

            <div class="sec-title">

                <h3><?php echo wp_kses_post($title);?></h3>

            </div>

            

            <!--Carousel-->

        	<div class="gallery-slider column-carousel four-column">

            	

                <?php while($query->have_posts()): $query->the_post();

					global $post ; 

					$gallery_meta = _WSH()->get_meta();

				?>

                <?php 

					$post_thumbnail_id = get_post_thumbnail_id($post->ID);

					$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

				?>

                <article class="slide-item">

                	<figure class="image-box"><a href="<?php esc_url($post_thumbnail_url);?>" class="lightbox-image" title="<?php the_title_attribute();?>"><?php the_post_thumbnail('carshire2');?></a></figure>

                    <a href="<?php echo esc_url($post_thumbnail_url);?>" class="overlay lightbox-image" title="<?php the_title_attribute();?>"></a>

                    <div class="item-caption">

                    	<h4><strong><?php the_title();?></strong></h4>

                        <p><?php echo wp_kses_post(carshire_bunch_trim(get_the_content(), $text_limit));?></p>

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