<?php

$display_style = ($display_style == 'grey') ? 'theme-two' : '';  

ob_start() ;?>



 <!--Intro Section-->

<section class="intro-section <?php echo esc_attr($display_style);?>">

    <div class="auto-container">

        <div class="border clearfix">

            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">

                <h3><?php echo wp_kses_post($title);?></h3>

            </div>

            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 text-right">

                <a href="<?php echo esc_url($btn_link);?>" class="theme-btn dark-btn style-two"><span class="fa fa-angle-right"></span><?php echo wp_kses_post($btn_text);?></a>

            </div>

        </div>

    </div>

</section>



<?php

	$output = ob_get_contents(); 

   ob_end_clean(); 

   return $output ; ?>

   