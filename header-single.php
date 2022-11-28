<?php $options = _WSH()->option();

    Global $wp_query;

    $icon_href = (carshire_set( $options, 'site_favicon' )) ? carshire_set( $options, 'site_favicon' ) : get_template_directory_uri().'/images/favicon.png';

     ?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->

    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->

    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->

    <!--[if gt IE 8]><!--> <!--<![endif]-->

    <head>

    	 <!-- Basic -->

        <meta charset="<?php bloginfo( 'charset' ); ?>">

        <!-- Mobile Metas -->

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Favcon -->

    	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ):?>

    		<link rel="shortcut icon" type="image/png" href="<?php echo esc_url($icon_href);?>">

    	<?php endif;?>

        <link rel="icon" href="<?php echo esc_url(get_template_directory_uri().'/images/favicon.ico'); ?>" type="image/x-icon"/>

    	<link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri().'/images/favicon.ico'); ?>" type="image/x-icon"/>

    	<?php wp_head(); ?>

    </head>

    <?php $protocol = is_ssl() ? 'https://' : 'http://';?>

    <body data-spy="scroll" data-target="#main_menu2" itemscope itemtype="<?php echo esc_attr($protocol);?>schema.org/WebPage" <?php body_class(); ?>>

        <!-- Your Body Content Start From Here -->

        <div class="body_innerwrap">

            <!--  Your Header Content Start From Here -->

                <header id="header" class="header">

                    <!-- container -->

                    <div class="container">

                        <!-- row -->

                        <div class="row">

                            <!-- column -->

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        						<div class="logo">

        							<!-- logo -->

        							<?php echo carshir_wp_get_site_logo(); ?>

        						</div>

                                <!-- menu -->

        						<nav class="navbar navbar-default" role="navigation">

        							<!-- Brand and toggle get grouped for better mobile display -->

        							<div class="navbar-header">

        							  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main_menu">

        								<span class="sr-only"><?php esc_html_e('Toggle navigation', 'carshire');?></span>

        								<span class="icon-bar"></span>

        								<span class="icon-bar"></span>

        								<span class="icon-bar"></span>

        							  </button>

        							</div>

                                    <!-- Collect the nav links, forms, and other content for toggling -->

        							<div class="collapse navbar-collapse" id="main_menu">

        							  <?php do_action( 'carshire_bunch_header_menus' ); ?>

                                    </div><!-- /.navbar-collapse -->

        						</nav>

                            </div>

                            <!-- /column -->

                        </div>

                        <!-- /row -->

                    </div>

                    <!-- /container -->

                </header>

                <!--  Your Header Content End Here -->