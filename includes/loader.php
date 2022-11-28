<?php



if( !class_exists( 'Bunch_Base' ) ) include_once trailingslashit(get_template_directory()) . '/includes/base.php';

add_action( 'init', 'carshire_bunch_theme_init');





if( !function_exists( 'carshire_set' ) ) {

	function carshire_set( $var, $key, $def = '' )

	{

		if( !$var ) return false;

	

		if( is_object( $var ) && isset( $var->$key ) ) return $var->$key;

		elseif( is_array( $var ) && isset( $var[$key] ) ) return $var[$key];

		elseif( $def ) return $def;

		else return false;

	}

}





if( !function_exists('carshire_printr' ) ) {

	function carshire_printr($data)

	{

		echo '<pre>'; print_r($data);exit;

	}

}



if( !function_exists('carshire__font_awesome' ) ) {

	function carshire_font_awesome( $index )

	{

		$array = array_values($GLOBALS['_font_awesome']);

		if( $font = carshire_set($array, $index )) return $font;

		else return false;

	}

}



if( !function_exists('carshire_load_class' ) ) {

	function carshire_load_class($class, $directory = 'libraries', $global = true, $prefix = 'Bunch_')

	{

		$obj = &$GLOBALS['_bunch_base'];

		$obj = is_object( $obj ) ? $obj : new stdClass;

	

		$name = FALSE;

	

		// Is the request a class extension?  If so we load it too

		$path = trailingslashit(get_template_directory()).'/includes/'.$directory.'/'.$class.'.php';

		if( file_exists($path) )

		{

			$name = $prefix.ucwords( $class );

	

			if (class_exists($name) === FALSE)	require_once($path);

		}

	

		// Did we find the class?

		if ($name === FALSE) exit('Unable to locate the specified class in theme: '.$class.'.php');

	

		if( $global ) $GLOBALS['_bunch_base']->$class = new $name();

		else new $name();

	}

}





include_once trailingslashit(get_template_directory()) . '/includes/library/form_helper.php';

include_once trailingslashit(get_template_directory()) . '/includes/library/functions.php';

include_once trailingslashit(get_template_directory()) . '/includes/library/widgets.php';




carshire_load_class( 'enqueue', 'helpers', false );


carshire_load_class( 'bootstrap_walker', 'helpers', false );





if( carshire_set( $_GET, 'bunch_shortcode_editor_action' ) ) {

	include_once trailingslashit(get_template_directory()) . '/ resource/shortcode_output.php';exit;

}



/**

 * Include Vafpress Framework

 */

	



if( is_admin() )

/** Plugin Activation */

get_template_part( 'includes/thirdparty/tgm-plugin-activation/plugins' );



function carshire_bunch_theme_init()

{

	

	global $pagenow;

	$bunch_exlude_hooks = include_once( 'resource/remove_action.php' );
	foreach( $bunch_exlude_hooks as $k => $v )
	{
		foreach( $v as $value )
		remove_action( $k, $value[0], $value[1] );
	}

	return;

	

	/**

	 * Include Custom Data Sources

	 */

	//require_once 'vafpress/admin/data_sources.php';

	

	/**

	 * Load options, metaboxes, and shortcode generator array templates.

	 */

	// metaboxes

	$tmpl_mb1  = include CARSHIRE_ROOT.'includes/vafpress/admin/metabox/meta_boxes.php';

	// * Create instances of Metaboxes

	foreach( $tmpl_mb1 as $tmb )  new VP_Metabox($tmb);

	

	$tmpl_mb1  = include CARSHIRE_ROOT.'includes/vafpress/admin/taxonomy/taxonomy.php';

	include_once trailingslashit(get_template_directory()) .  '/vp_new/taxonomy.php' ;

	foreach( $tmpl_mb1 as $tmb )  new Bunch_Metabox($tmb);

	

	

	// shortocode generators

	$tmpl_sg1  = CARSHIRE_ROOT.'includes/vafpress/admin/shortcode_generator/shortcodes1.php';

	$tmpl_sg2  = CARSHIRE_ROOT.'includes/vafpress/admin/shortcode_generator/shortcodes2.php';



	if( is_admin() ) {

		

		include_once trailingslashit(get_template_directory()) . '/helpers/backup_class.php';

		$backup = new Bunch_Backup_class;

		

		if( carshire_set( $_GET, 'page' ) == 'carshire'.'_option' ) 

		{

			if( carshire_set( $_GET, 'bunch_dummydata_export' ) ){

				

				$backup->export();

			}

			

			/*if( carshire_set( $_GET, 'bunch_dummydata_import' ) ){ 

				include_once trailingslashit(get_template_directory()) . '/helpers/backup_class.php';

				$backup = new Bunch_Backup_class;

				$backup->import();

			}*/

			

		}

	}	

	

	if( function_exists( 'carshire_vc_map' )) 

	include_once trailingslashit(get_template_directory()) .  '/vc_map.php' ;

	

	// options

	$tmpl_opt  = CARSHIRE_ROOT.'includes/vafpress/admin/option/option.php';

	

	

	/**

	 * Create instance of Options

	 */

	$theme_options = new VP_Option(array(

		'is_dev_mode'           => false,                                  // dev mode, default to false

		'option_key'            => 'carshire'.'_theme_options',                      // options key in db, required

		'page_slug'             => 'carshire'.'_option',                      // options page slug, required

		'template'              => $tmpl_opt,                              // template file path or array, required

		'menu_page'             => 'themes.php',                           // parent menu slug or supply `array` (can contains 'icon_url' & 'position') for top level menu

		'use_auto_group_naming' => true,                                   // default to true

		'use_util_menu'         => true,                                   // default to true, shows utility menu

		'minimum_role'          => 'edit_theme_options',                   // default to 'edit_theme_options'

		'layout'                => 'fluid',                                // fluid or fixed, default to fixed

		'page_title'            => esc_html__( 'Theme Options', 'carshire' ), // page title

		'menu_label'            => esc_html__( 'Theme Options', 'carshire' ), // menu label

	));

	

		_WSH()->user_extra( array('facebook'=>esc_html__('Facebook', 'carshire'), 'twitter'=>esc_html__('Twitter', 'carshire'), 'dribbble'=>esc_html__('Dribble', 'carshire'), 'github'=>esc_html__('Github', 'carshire'),

	'flickr'=>esc_html__('Flickr', 'carshire'), 'google-plus'=>esc_html__('Google+', 'carshire'), 'youtube'=>esc_html__('Youtube', 'carshire')) );

	

	$bunch_exlude_hooks = include_once trailingslashit(get_template_directory()) . '/resource/remove_action.php';



	foreach( $bunch_exlude_hooks as $k => $v )

	{

		foreach( $v as $value )

		remove_action( $k, $value[0], $value[1] );

	}



}