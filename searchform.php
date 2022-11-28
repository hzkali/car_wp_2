<form action="<?php echo home_url('/'); ?>" method="get" class="search-form">
	<div class="form-group">
		<input type="search" name="s" value="" placeholder="<?php esc_html_e('search for something', 'carshire');?>">
		 <button type="submit" name="submit"><span class="fa fa-search"></span></button>
	</div>
</form>
