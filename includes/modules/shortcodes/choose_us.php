<?php  

ob_start() ;?>



<section class="why-us">

    <div class="auto-container">

        <div class="row clearfix">

        

            <!--Text Content-->

            <div class="text-content">

                <div class="title-box">

                    <h3><?php echo wp_kses_post($title);?></h3>

                    <h4 class="theme-color"><?php echo wp_kses_post($subtitle);?></h4>

                </div>

                <div class="text">

                    <p><?php echo wp_kses_post($text);?></p>

                </div>

            </div>

            

        </div>

    </div>    

</section>



<?php

	$output = ob_get_contents(); 

   ob_end_clean(); 

   return $output ; ?>

   