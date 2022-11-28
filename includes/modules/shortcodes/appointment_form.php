<?php
   ob_start();
   $mail_salt = function_exists('_bunch_generate_salt' ) ? _bunch_generate_salt( $email ) : $email;
?>
<section id="appointment-content">
<div class="auto-container">
	<div class="title-box">
		<h3><?php echo wp_kses_post($title);?></h3>
		<h4 class="theme-color"><?php echo wp_kses_post($subtitle);?></h4>                
	</div>
	<br> 
	<p><?php echo wp_kses_post($text);?></p>
	<div id="apt_message"></div>
	<form role="form" id="appointment_form" method="post" action="<?php echo admin_url( 'admin-ajax.php?action=_bunch_ajax_callback&amp;subaction=appointment_form_submit'); ?>" name="appointment_form">
	<div class="vehicle-info clearfix">
		<div class="sec-title"><h3 class="skew-lines"><?php esc_html_e('Vehicle Information', 'carshire');?></h3></div>                    
		<div class="row">
			<div class="col-md-4">
				<div class="sec-title"><h3><?php esc_html_e('Vehicle Year', 'carshire');?></h3></div>
				<div class="vehicle-year">                          
					<div class="thm-spinner" data-min-value="<?php echo esc_attr($vehicle_year_minimum_value);?>" data-max-value="<?php echo esc_attr($vehicle_year_maximum_value);?>" data-default-value="<?php echo esc_attr($vehicle_year_default_value);?>">
						<!-- loaded content via jquery ui -->
					</div>
					<input type="text" name="apt_vehicle_year" id="apt_vehicle_year" readonly class="vehicle-year">
				</div>
			</div>                   
			<div class="col-md-4">
				<div class="sec-title"><h3><?php esc_html_e('Vehicle Make', 'carshire');?></h3></div>
				<select name="apt_vehicle_make" id="apt_vehicle_make" class="select-input">
					<option value="" selected="selected"><?php esc_html_e('Choose...', 'carshire');?></option>
					<?php $makes = explode("\n",$makes_str);?>
					<?php foreach($makes as $make):?>
						<option value="<?php echo esc_attr(str_replace("<br />","",$make));?>"><?php echo wp_kses_post(str_replace("<br />","",$make));?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div class="col-md-4">
				<div class="sec-title"><h3><?php esc_html_e('Vehicle Mileage', 'carshire');?></h3></div>
				<input type="text" name="apt_vehicle_milage" id="apt_vehicle_milage" placeholder="<?php esc_html_e('Vehicle Mileage', 'carshire');?>">
			</div>
		</div>
	</div>
	<div class="vehicle-info clearfix">
		<div class="sec-title"><h3 class="skew-lines"><?php esc_html_e('Appoinment Information', 'carshire');?></h3></div>                    
		<div class="row">
			<div class="col-md-6">
				<div class="sec-title"><h3><?php esc_html_e('Appoinment Date', 'carshire');?></h3></div>
				<input type="text" name="apt_date" id="apt_date" class="date-picker" placeholder="<?php esc_html_e('MM/DD/YYYY', 'carshire');?>">
			</div>                   
			<div class="col-md-6">
				<div class="sec-title"><h3><?php esc_html_e('Appoinment Timeframe', 'carshire');?></h3></div>
				<select  name="apt_timeframe" id="apt_timeframe" class="select-input">                       
					<option value="" selected="selected"><?php esc_html_e('Choose...', 'carshire');?></option>
					<?php $time_frames = explode("\n",$time_frames_str);?>
					<?php foreach($time_frames as $time_frame):?>
						<option value="<?php echo esc_attr(str_replace("<br />","",$time_frame));?>"><?php echo wp_kses_post(str_replace("<br />","",$time_frame));?></option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
	</div>
	<div class="vehicle-info clearfix">
		<div class="sec-title"><h3 class="skew-lines"><?php esc_html_e('Select Services Need', 'carshire');?></h3></div>
		<ul class="special-checkbox">
			<?php $services_needed = explode("\n",$services_needed_str);?>
			<?php foreach($services_needed as $service):?>
				<li>
					<span class="input-checker">
						<input type="checkbox" name="apt_vehicle_services_needed" id="apt_vehicle_services_needed" value="<?php echo esc_attr(str_replace("<br />","",$service));?>">
					</span>
					<?php echo wp_kses_post(str_replace("<br />","",$service));?>
				</li>
			<?php endforeach;?>
		</ul>
	</div>
	<!--Contact Form-->
		<div class="clearfix">
			<div class="sec-title"><h3 class="skew-lines"><?php esc_html_e('Contact Details', 'carshire');?></h3></div>
			<div class="row">
				<div class="col-md-5 col-sm-12 col-xs-12">
					<div class="form-group">                            
						<input type="text" name="apt_customer_name" id="apt_customer_name" value="" placeholder="<?php esc_html_e('Enter Your Name', 'carshire');?>">
					</div>
					<div class="form-group">
						<input type="email" name="apt_customer_email" id="apt_customer_email" value="" placeholder="<?php esc_html_e('Enter Your Email Address', 'carshire');?>">
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<input type="text" name="apt_customer_subject" id="apt_customer_subject" value="" placeholder="<?php esc_html_e('Enter a Subject', 'carshire');?>">
					</div>
				</div>
				<div class="col-md-7 col-sm-12 col-xs-12">
					<div class="form-group">
						<textarea name="apt_customer_message" id="apt_customer_message" placeholder="<?php esc_html_e('Type Message Here', 'carshire');?>"></textarea>
					</div>
			</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="receiver_email" id="receiver_email" value="<?php echo esc_attr( $mail_salt ); ?>"  />
				<button type="submit" name="submit-form" class="theme-btn dark-btn hvr-bounce-to-right"><span class="fa fa-envelope"></span> <?php esc_html_e('Send Message', 'carshire');?></button>
			</div>
		</div>
	</form>
</div>
</section>    

<?php return ob_get_clean();?>		