<?php  

   global $post ;

   $count = 0;

   $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

   if( $cat ) $query_args['category_name'] = $cat;

   $query = new WP_Query($query_args) ; 

   

   ob_start() ;?>

   

<?php if($query->have_posts()):  ?>   



<!--Blog Section-->

<section class="blog-section column-view">

    <div class="auto-container">

        <div class="sec-title">

            <h3><?php echo wp_kses_post($title);?></h3>

        </div>

        

        <!--Column Carousel-->

        <div class="column-carousel two-column clearfix">

            

            <?php while($query->have_posts()): $query->the_post();

                global $post ; 

                $post_meta = _WSH()->get_meta();

            ?>

            <?php 

				$post_thumbnail_id = get_post_thumbnail_id($post->ID);

				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

			?>

            <article class="column-box blog-box">

                <div class="inner-box">

                    <figure class="image" style="background:url('<?php echo esc_url($post_thumbnail_url);?>')">

                        <a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_post_thumbnail('carshire5');?></a>

                    </figure>

                    <div class="post-content clearfix">

                        <h3 class="post-title"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title();?></a></h3>

                        <h5 class="date"><?php echo esc_html_e('posted on', 'carshire');?> <?php echo get_the_date('F j, Y');?></h5>

                        <div class="text"><?php echo wp_kses_post(carshire_bunch_trim(get_the_excerpt(), $text_limit));?></div>

                        <div class="text-right link"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>" class="theme-btn dark-btn"><?php esc_html_e('Read More', 'carshire');?></a></div>

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