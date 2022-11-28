<?php ob_start(); ?>



<!--Price Plans-->

<section class="price-plans no-padd-top1">

    <div class="auto-container">

        

        <div class="sec-title">

            <h3><?php echo wp_kses_post($title);?></h3>

        </div>

        

        <div class="row clearfix">

            <?php echo do_shortcode( $contents );?>

        </div>

        

    </div>

</section>



<?php return ob_get_clean(); ?>