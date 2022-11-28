<?php  
   $count = 1;
   $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['services_category'] = $cat;
   $query = new WP_Query($query_args) ; 
   
   ob_start() ;?>
   
<?php if($query->have_posts()):  ?>   
<!-- Services -->
<section class="why-us">
    <div class="row clearfix">
    
        <!--Tabs Side-->
        <div class="col-xs-12">
            <div class="row clearfix">
                
                <?php while($query->have_posts()): $query->the_post();
                        global $post ; 
                        $services_meta = _WSH()->get_meta();
						//carshire_printr($services_meta); exit("sdsds");
                ?> 
                
                <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInUp box" data-wow-delay="0ms" data-wow-duration="1000ms">
					<a href="<?php echo esc_url(carshire_set($services_meta, 'ext_url'));?>" class="tab-link">
						<div class="icon"><span class="<?php echo str_replace("icon ", "", carshire_set($services_meta, 'fontawesome'));?>"></span></div>
						<h4><?php the_title();?></h4>
						<p><?php echo wp_kses_post(carshire_set($services_meta, 'subtitle'));?></p><span class="arrow fa fa-angle-right"></span>
					</a>
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