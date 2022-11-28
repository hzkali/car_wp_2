<?php ob_start(); ?>



<!--Table Column-->

<article class="col-md-3 col-sm-6 col-xs-12 table-column wow fadeIn" data-wow-delay="0ms" data-wow-duration="1000ms">

    <div class="table-inner">

        <div class="table-header">

            <h3><?php echo wp_kses_post($title);?></h3>

        </div>

        <div class="price-column price">

            <h4 class="amount"><?php echo wp_kses_post($price);?><sup><?php echo wp_kses_post($currency);?></sup></h4>

            <p><?php echo wp_kses_post($text);?></p>

        </div>

        <div class="list">

            <ul>

            	<?php $fearures = explode("\n",$feature_str);?>

                	<?php foreach($fearures as $feature):?>

                	<li><?php echo wp_kses_post($feature);?></li>

                    <?php endforeach;?>

            </ul>

        </div>

        

        <a href="<?php echo esc_url($btn_link);?>" class="read-more hvr-bounce-to-right"><span class="fa fa-angle-right"></span><?php echo wp_kses_post($btn_text);?></a>

    </div>

</article>



<?php return ob_get_clean(); 