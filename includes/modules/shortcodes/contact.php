<?php 
ob_start();
?>
<!-- Contact Form -->
<div class="contact-form">
		
	<div class="sec-title"><h3 class="skew-lines"><?php echo wp_kses_post($title);?></h3></div>
	<div class="msg-text"><?php echo wp_kses_post($text);?></div>
	<!--Contact Form-->
	
    <?php echo do_shortcode(bunch_base_decode($contact_form));?>
		
</div>
<?php return ob_get_clean();?>		