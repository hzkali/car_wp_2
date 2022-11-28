<?php $options = get_option(CARSHIRE_NAME.'_theme_options');?>
	<?php if(carshire_set($options, 'show_apt')):?>
	<!--Contact Options-->
		<section class="contact-options">
			<div class="clearfix">
				<ul class="info-box clearfix wow bounceInRight">
					<?php if(carshire_set($options, 'apt_link')):?><li><a href="<?php echo esc_url(carshire_set($options, 'apt_link'));?>"><span class="fa fa-calendar"></span> <?php esc_html_e('Make an appointment', 'carshire');?></a></li><?php endif;?>
					<?php if(carshire_set($options, 'contact_link')):?><li><a href="<?php echo esc_url(carshire_set($options, 'contact_link'));?>"><span class="fa fa-phone"></span> <?php esc_html_e('Contact Us', 'carshire');?></a> </li><?php endif;?>
				</ul>
			</div>
		</section>
	<?php endif;?>

	<?php if(carshire_set($options, 'show_whole_footer')):?>
		<!--Main Footer-->
		<footer class="main-footer">
			<?php if(carshire_set($options, 'show_upper_footer')):?>
				<!--Footer Upper-->
				<div class="footer-upper">
				
					<?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>
						<div class="auto-container">
							<div class="row clearfix">
								<?php dynamic_sidebar( 'footer-sidebar' ); ?>
							</div>
						</div>
					<?php } ?>
				
				</div>
			
			<?php endif;?>
			
			<?php if(carshire_set($options, 'show_bottom_footer')):?>
				<!--Footer Bottom-->
				<div class="footer-bottom">
					<div class="auto-container">
						<div class="row clearfix">
							<div class="col-md-6 col-sm-12 col-xs-12"><div class="copyright"><?php echo wp_kses_post(carshire_set($options, 'copy_right'));?></div></div>
							<?php if($socials = carshire_set(carshire_set($options, 'social_media'), 'social_media')): //carshire_printr($socials);?>
							<div class="col-md-6 col-sm-12 col-xs-12">	
								<div class="social-links">
									<?php foreach($socials as $key => $value):
										if(carshire_set($value, 'tocopy')) continue;
									?>
										
										<a href="<?php echo esc_url(carshire_set($value, 'social_link'));?>" class="fa <?php echo esc_attr(carshire_set($value, 'social_icon'));?>"></a>
									
									<?php endforeach;?>
								</div>
							</div>
							<?php endif;?>
						</div>
					</div>
				</div>
			<?php endif;?>
		</footer>
	<?php endif;?>
	</div>
	<!--End pagewrapper-->
	<!--Scroll to top-->
	<div class="scroll-to-top"></div>
<?php if(carshire_set($options, 'switcher')):?>
<div class="switcher">
        <i class="fa fa-cog"></i>
        <strong><?php esc_html_e('Layout', 'carshire');?></strong>
        <div class=""><a href="#" id="full"><?php esc_html_e('Full', 'carshire');?></a></div>
        <div class=""><a href="#" id="boxed"><?php esc_html_e('Box', 'carshire');?></a></div>
        <strong><?php esc_html_e('Colors', 'carshire');?></strong>
        <i class="clearfix"></i>        
        <div class="box" title="default" id="default">default</div>
        <div class="box" title="Green" id="green">green</div>
        <div class="box" title="Orange" id="orange">orange</div>
		<div class="box" title="purple" id="purple">default</div>
        <div class="box" title="yellow" id="yellow">green</div>
        <div class="box" title="teal" id="teal">orange</div>
    </div>
<?php endif;?>	
<?php wp_footer(); ?>
</body>
</html>