<?php  

ob_start() ;

$options = _WSH()->option();

?>



<!--Sponsors-->

<section class="sponsors">

    <div class="auto-container">

        <ul class="slider">

            

            <?php if($clients = carshire_set(carshire_set($options, 'clients'), 'clients')):?>

			<?php foreach($clients as $key => $value):?>

			<?php if(carshire_set($value, 'tocopy')) continue;?>

            <li><a href="<?php echo esc_url(carshire_set($value, 'client_link'));?>"><img src="<?php echo esc_url(carshire_set($value, 'client_img'));?>" alt="<?php esc_html_e('image', 'carshire');?>" title="<?php echo esc_attr(carshire_set($value, 'title'));?>"></a></li>

        	<?php endforeach;?>

        	<?php endif;?>

        </ul>

    </div>

</section>



<?php

	$output = ob_get_contents(); 

   ob_end_clean(); 

   return $output ; ?>

   