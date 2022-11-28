<?php $options = _WSH()->option();

	Global $wp_query;

	$icon_href = (carshire_set( $options, 'site_favicon' )) ? carshire_set( $options, 'site_favicon' ) : get_template_directory_uri().'/images/favicon.png';

 ?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>

		 <!-- Basic -->

	    <meta charset="<?php bloginfo( 'charset' ); ?>">

	    <meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

		<!-- Favcon -->

		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ):?>

			<link rel="shortcut icon" type="image/png" href="<?php echo esc_url($icon_href);?>">

		<?php endif;?>
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

	<div class="page-wrapper">


	<?php if(carshire_set($options, 'preloader')):?> 	

		<!-- Preloader -->

		<div class="preloader"></div>

	<?php endif;?>

	<!-- Main Header -->

	<header class="main-header">

		<div class="header-top">

			<div class="auto-container">

				<div class="row clearfix">

					<!--Logo-->

					<div class="col-md-3 col-sm-3 col-xs-12 logo">

						<?php if(carshire_set($options, 'logo_image')):?>

	                    	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="img-responsive" src="<?php echo esc_url(carshire_set($options, 'logo_image'));?>" alt="<?php esc_html_e('image', 'carshire');?>"></a>

						<?php else:?>

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="img-responsive" src="<?php echo esc_url(get_template_directory_uri().'/images/logo.png');?>" alt="<?php esc_html_e('image', 'carshire');?>"></a>

						<?php endif;?>

					</div>

					<div class="col-lg-5 col-md-6 col-sm-10 header-top-infos pull-right">

						<ul class="clearfix">

							<?php if(carshire_set($options, 'phone')):?>

							<li>

								<div class="clearfix ">

									<img src="<?php echo esc_url(get_template_directory_uri().'/images/icons/header-phone.png');?>" alt="<?php esc_html_e('image', 'carshire');?>">

									<p><b><?php esc_html_e('Call Us Now', 'carshire');?></b> <br><?php echo wp_kses_post(carshire_set($options, 'phone'));?></p>

								</div>

							</li>

							<?php endif;?>

							<?php if(carshire_set($options, 'opening_hours')):?>

							<li>

								<div class="clearfix ">

									<img src="<?php echo esc_url(get_template_directory_uri().'/images/icons/header-timer.png');?>" alt="<?php esc_html_e('image', 'carshire');?>">

									<p><b><?php esc_html_e('Opening Hours', 'carshire');?></b> <br><?php echo wp_kses_post(carshire_set($options, 'opening_hours'));?></p>

								</div>

							</li>

							<?php endif;?>

						</ul>

					</div>

				</div>

			</div>

		</div>

		<!--Header Lower-->

		<div class="header-lower">

			<div class="auto-container">

				<div class="row clearfix">

					<!--Main Menu-->

					<nav class="col-md-9 col-sm-12 col-xs-12 main-menu">

						<div class="navbar-header">

							<!-- Toggle Button -->      

							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

								<span class="icon-bar"></span>

								<span class="icon-bar"></span>

								<span class="icon-bar"></span>

							</button>

						</div>

						<div class="navbar-collapse collapse clearfix">                                                                                              

							<ul class="navigation">

								<?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'container_id' => 'navbar-collapse-1',

											'container_class'=>'navbar-collapse collapse navbar-right',

											'menu_class'=>'nav navbar-nav',

											'fallback_cb'=>false, 

											'items_wrap' => '%3$s', 

											'container'=>false,

											'walker'=> new Bunch_Bootstrap_walker()  

								) ); ?>

							</ul>

						</div>

					</nav>

					<!--Main Menu End-->

					<?php if(carshire_set($options, 'show_shocial_icons')):?>

						<!--Social Links-->

						<?php if($socials = carshire_set(carshire_set($options, 'social_media'), 'social_media')): //carshire_printr($socials);?>

							<div class="col-md-3 col-sm-12 col-xs-12 social-outer">

								<div class="social-links text-right">

									<?php foreach($socials as $key => $value):

										if(carshire_set($value, 'tocopy')) continue;

										?>

										<a href="<?php echo esc_url(carshire_set($value, 'social_link'));?>" class="fa <?php echo esc_attr(carshire_set($value, 'social_icon'));?>"></a>

									<?php endforeach;?>

								</div>

							</div>

						<?php endif;?>

					<?php endif;?>

				</div>

			</div>

		</div>

	</header>

<!--End Main Header -->