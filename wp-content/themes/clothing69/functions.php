<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

if (!defined("CLOTHING69_THEME_DIR")) define("CLOTHING69_THEME_DIR", trailingslashit( get_template_directory() ));
if (!defined("CLOTHING69_CHILD_DIR")) define("CLOTHING69_CHILD_DIR", trailingslashit( get_stylesheet_directory() ));

// Theme storage
$CLOTHING69_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array(

		// Required plugins
		// DON'T COMMENT OR REMOVE NEXT LINES!
		'trx_addons',

		// Recommended (supported) plugins
		// If plugin not need - comment (or remove) it
		'elegro-payment',
		'essential-grid',
		'instagram-feed',
		'js_composer',
		'mailchimp-for-wp',
		'contact-form-7',
		'revslider',
		'trx_updater',
		'trx_socials',
		'woocommerce',
        'yith-woocommerce-compare',
        'yith-woocommerce-wishlist',
		'wp-gdpr-compliance'
		)
);


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('clothing69_theme_setup1') ) {
	add_action( 'after_setup_theme', 'clothing69_theme_setup1', 1 );
	function clothing69_theme_setup1() {
		// Make theme available for translation
		// Translations can be filed in the /languages directory
		// Attention! Translations must be loaded before first call any translation functions!
		load_theme_textdomain( 'clothing69', get_template_directory() . '/languages' );

		// Set theme content width
		$GLOBALS['content_width'] = apply_filters( 'clothing69_filter_content_width', 1170 );
	}
}

if ( !function_exists('clothing69_theme_setup') ) {
	add_action( 'after_setup_theme', 'clothing69_theme_setup' );
	function clothing69_theme_setup() {

		// Add default posts and comments RSS feed links to head 
		add_theme_support( 'automatic-feed-links' );
		
		// Custom header setup
		add_theme_support( 'custom-header', array(
			'header-text'=>false,
			'video' => true
			)
		);

		// Custom backgrounds setup
		add_theme_support( 'custom-background', array()	);
		
		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') ); 
 
 		// Autogenerate title tag
		add_theme_support('title-tag');
 		
		// Add theme menus
		add_theme_support('nav-menus');
		
		// Switch default markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
		
		// Editor custom stylesheet - for user
		add_editor_style( array_merge(
			array(
				'css/editor-style.css',
				clothing69_get_file_url('css/fontello/css/fontello-embedded.css')
			),
			clothing69_theme_fonts_for_editor()
			)
		);	
	
		// Register navigation menu
		register_nav_menus(array(
			'menu_main' => esc_html__('Main Menu', 'clothing69'),
			'menu_mobile' => esc_html__('Mobile Menu', 'clothing69'),
			'menu_footer' => esc_html__('Footer Menu', 'clothing69')
			)
		);

		// Excerpt filters
		add_filter( 'excerpt_length',						'clothing69_excerpt_length' );
		add_filter( 'excerpt_more',							'clothing69_excerpt_more' );
		
		// Add required meta tags in the head
		add_action('wp_head',		 						'clothing69_wp_head', 0);
		
		// Load current page/post customization (if present)
		add_action('wp_footer',		 						'clothing69_wp_footer');
		add_action('admin_footer',	 						'clothing69_wp_footer');

		// Enqueue scripts and styles for frontend
		add_action('wp_enqueue_scripts', 					'clothing69_wp_scripts', 1000);			// priority 1000 - load styles
																									// before the plugin's support custom styles
																									// (with priority 1100)
		add_action('wp_footer',		 						'clothing69_localize_scripts');
		add_action('wp_enqueue_scripts', 					'clothing69_wp_scripts_responsive', 2000);	// priority 2000 - load responsive
																									// after all other styles
		
		// Add body classes
		add_filter( 'body_class',							'clothing69_add_body_classes' );

		// Register sidebars
		add_action('widgets_init',							'clothing69_register_sidebars');

		// Set options for importer (before other plugins)
		add_filter( 'trx_addons_filter_importer_options',	'clothing69_importer_set_options', 9 );
	}

}


//-------------------------------------------------------
//-- Theme scripts and styles
//-------------------------------------------------------

// Load frontend scripts
if ( !function_exists( 'clothing69_wp_scripts' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'clothing69_wp_scripts', 1000);
	function clothing69_wp_scripts() {
		
		// Enqueue styles
		//------------------------
		
		// Links to selected fonts
		$links = clothing69_theme_fonts_links();
		if (count($links) > 0) {
			foreach ($links as $slug => $link) {
				wp_enqueue_style( sprintf('clothing69-font-%s', $slug), $link );
			}
		}
		
		// Fontello styles must be loaded before main stylesheet
		// This style NEED the theme prefix, because style 'fontello' in some plugin contain different set of characters
		// and can't be used instead this style!
		wp_enqueue_style( 'fontello-style',  clothing69_get_file_url('css/fontello/css/fontello-embedded.css') );

		// Load main stylesheet
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		wp_enqueue_style( 'clothing69-main', $main_stylesheet, array(), null );

		// Load child stylesheet (if different) after the main stylesheet and fontello icons (important!)
		$child_stylesheet = get_stylesheet_directory_uri() . '/style.css';
		if ($child_stylesheet != $main_stylesheet) {
			wp_enqueue_style( 'clothing69-child', $child_stylesheet, array('clothing69-main'), null );
		}

		// Add custom bg image for the body_style == 'boxed'
		if ( clothing69_get_theme_option('body_style') == 'boxed' && ($bg_image = clothing69_get_theme_option('boxed_bg_image')) != '' )
			wp_add_inline_style( 'clothing69-main', '.body_style_boxed { background-image:url('.esc_url($bg_image).') }' );

		// Merged styles
		if ( clothing69_is_off(clothing69_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'clothing69-styles', clothing69_get_file_url('css/__styles.css') );

		// Custom colors
		if ( !is_customize_preview() && !isset($_GET['color_scheme']) && clothing69_is_off(clothing69_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'clothing69-colors', clothing69_get_file_url('css/__colors.css') );
		else
			wp_add_inline_style( 'clothing69-main', clothing69_customizer_get_css() );

		// Add post nav background
		clothing69_add_bg_in_post_nav();

		// Disable loading JQuery UI CSS
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//------------------------
		
		// Modernizr will load in head before other scripts and styles
		if ( in_array(substr(clothing69_get_theme_option('blog_style'), 0, 7), array('gallery', 'portfol', 'masonry')) )
			wp_enqueue_script( 'modernizr', clothing69_get_file_url('js/theme.gallery/modernizr.min.js'), array(), null, false );

		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', clothing69_get_file_url('js/superfish.js'), array('jquery'), null, true );
		
		// Merged scripts
		if ( clothing69_is_off(clothing69_get_theme_option('debug_mode')) )
			wp_enqueue_script( 'clothing69-init', clothing69_get_file_url('js/__scripts.js'), array('jquery'), null, true );
		else {
			// Skip link focus
			wp_enqueue_script( 'skip-link-focus-fix', clothing69_get_file_url('js/skip-link-focus-fix.js'), null, true );
			// Background video
			$header_video = clothing69_get_header_video();
			if (!empty($header_video) && !clothing69_is_inherit($header_video)) {
				if (clothing69_is_youtube_url($header_video))
					wp_enqueue_script( 'tubular', clothing69_get_file_url('js/jquery.tubular.js'), array('jquery'), null, true );
				else
					wp_enqueue_script( 'bideo', clothing69_get_file_url('js/bideo.js'), array(), null, true );
			}
			// Theme scripts
			wp_enqueue_script( 'clothing69-utils', clothing69_get_file_url('js/_utils.js'), array('jquery'), null, true );
			wp_enqueue_script( 'clothing69-init', clothing69_get_file_url('js/_init.js'), array('jquery'), null, true );	
		}
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Media elements library	
		if (clothing69_get_theme_setting('use_mediaelements')) {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}
	}
}

// Add variables to the scripts in the frontend
if ( !function_exists( 'clothing69_localize_scripts' ) ) {
	//Handler of the add_action('wp_footer', 'clothing69_localize_scripts');
	function clothing69_localize_scripts() {

		$video = clothing69_get_header_video();

		wp_localize_script( 'clothing69-init', 'CLOTHING69_STORAGE', apply_filters( 'clothing69_filter_localize_script', array(
			// AJAX parameters
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			
			// Site base url
			'site_url' => get_site_url(),
						
			// Site color scheme
			'site_scheme' => sprintf('scheme_%s', clothing69_get_theme_option('color_scheme')),
			
			// User logged in
			'user_logged_in' => is_user_logged_in() ? true : false,
			
			// Window width to switch the site header to the mobile layout
			'mobile_layout_width' => 767,
			'mobile_device' => wp_is_mobile(),
						
			// Sidemenu options
			'menu_side_stretch' => clothing69_get_theme_option('menu_side_stretch') > 0 ? true : false,
			'menu_side_icons' => clothing69_get_theme_option('menu_side_icons') > 0 ? true : false,

			// Video background
			'background_video' => clothing69_is_from_uploads($video) ? $video : '',

			// Video and Audio tag wrapper
			'use_mediaelements' => clothing69_get_theme_setting('use_mediaelements') ? true : false,

			// Messages max length
			'comment_maxlength'	=> intval(clothing69_get_theme_setting('comment_maxlength')),

			
			// Internal vars - do not change it!
			
			// Flag for review mechanism
			'admin_mode' => false,

			// E-mail mask
			'email_mask' => '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$',
			
			// Strings for translation
			'strings' => array(
					'ajax_error'		=> esc_html__('Invalid server answer!', 'clothing69'),
					'error_global'		=> esc_html__('Error data validation!', 'clothing69'),
					'name_empty' 		=> esc_html__("The name can't be empty", 'clothing69'),
					'name_long'			=> esc_html__('Too long name', 'clothing69'),
					'email_empty'		=> esc_html__('Too short (or empty) email address', 'clothing69'),
					'email_long'		=> esc_html__('Too long email address', 'clothing69'),
					'email_not_valid'	=> esc_html__('Invalid email address', 'clothing69'),
					'text_empty'		=> esc_html__("The message text can't be empty", 'clothing69'),
					'text_long'			=> esc_html__('Too long message text', 'clothing69')
					)
			))
		);
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( !function_exists( 'clothing69_wp_scripts_responsive' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'clothing69_wp_scripts_responsive', 2000);
	function clothing69_wp_scripts_responsive() {
		wp_enqueue_style( 'clothing69-responsive', clothing69_get_file_url('css/responsive.css') );
		wp_enqueue_style( 'clothing69-add', clothing69_get_file_url('css/add.css') );
	}
}

//  Add meta tags and inline scripts in the header for frontend
if (!function_exists('clothing69_wp_head')) {
	//Handler of the add_action('wp_head',	'clothing69_wp_head', 1);
	function clothing69_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="profile" href="//gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
}

// Add theme specified classes to the body
if ( !function_exists('clothing69_add_body_classes') ) {
	//Handler of the add_filter( 'body_class', 'clothing69_add_body_classes' );
	function clothing69_add_body_classes( $classes ) {
		$classes[] = 'body_tag';	// Need for the .scheme_self
		$classes[] = 'scheme_' . esc_attr(clothing69_get_theme_option('color_scheme'));

		$blog_mode = clothing69_storage_get('blog_mode');
		$classes[] = 'blog_mode_' . esc_attr($blog_mode);
		$classes[] = 'body_style_' . esc_attr(clothing69_get_theme_option('body_style'));

		if (in_array($blog_mode, array('post', 'page'))) {
			$classes[] = 'is_single';
		} else {
			$classes[] = ' is_stream';
			$classes[] = 'blog_style_'.esc_attr(clothing69_get_theme_option('blog_style'));
			if (clothing69_storage_get('blog_template') > 0)
				$classes[] = 'blog_template';
		}
		
		if (clothing69_sidebar_present()) {
			$classes[] = 'sidebar_show sidebar_' . esc_attr(clothing69_get_theme_option('sidebar_position')) ;
		} else {
			$classes[] = 'sidebar_hide';
			if (clothing69_is_on(clothing69_get_theme_option('expand_content')))
				 $classes[] = 'expand_content';
		}
		
		if (clothing69_is_on(clothing69_get_theme_option('remove_margins')))
			 $classes[] = 'remove_margins';

		$classes[] = 'header_style_' . esc_attr(clothing69_get_theme_option("header_style"));
		$classes[] = 'header_position_' . esc_attr(clothing69_get_theme_option("header_position"));

		$menu_style= clothing69_get_theme_option("menu_style");
		$classes[] = 'menu_style_' . esc_attr($menu_style) . (in_array($menu_style, array('left', 'right'))	? ' menu_style_side' : '');
		$classes[] = 'no_layout';
		
		return $classes;
	}
}
	
// Load current page/post customization (if present)
if ( !function_exists( 'clothing69_wp_footer' ) ) {
	//Handler of the add_action('wp_footer', 'clothing69_wp_footer');
	function clothing69_wp_footer() {
		if (($css = clothing69_get_inline_css()) != '') {
			wp_enqueue_style(  'clothing69-inline-styles',  clothing69_get_file_url('css/__inline.css') );
			wp_add_inline_style( 'clothing69-inline-styles', $css );
		}
	}
}

/**
 * Fire the wp_body_open action.
 *
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 */
		do_action('wp_body_open');
	}
}

//-------------------------------------------------------
//-- Sidebars and widgets
//-------------------------------------------------------

// Register widgetized areas
if ( !function_exists('clothing69_register_sidebars') ) {
	// Handler of the add_action('widgets_init', 'clothing69_register_sidebars');
	function clothing69_register_sidebars() {
		$sidebars = clothing69_get_sidebars();
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$sb) {
				register_sidebar( array(
										'name'          => $sb['name'],
										'description'   => $sb['description'],
										'id'            => $id,
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget'  => '</aside>',
										'before_title'  => '<h5 class="widget_title">',
										'after_title'   => '</h5>'
										)
								);
			}
		}
	}
}

// Return theme specific widgetized areas
if ( !function_exists('clothing69_get_sidebars') ) {
	function clothing69_get_sidebars() {
		$list = apply_filters('clothing69_filter_list_sidebars', array(
			'sidebar_widgets'		=> array(
											'name' => esc_html__('Sidebar Widgets', 'clothing69'),
											'description' => esc_html__('Widgets to be shown on the main sidebar', 'clothing69')
											),
			'header_widgets'		=> array(
											'name' => esc_html__('Header Widgets', 'clothing69'),
											'description' => esc_html__('Widgets to be shown at the top of the page (in the page header area)', 'clothing69')
											),
			'above_page_widgets'	=> array(
											'name' => esc_html__('Above Page Widgets', 'clothing69'),
											'description' => esc_html__('Widgets to be shown below the header, but above the content and sidebar', 'clothing69')
											),
			'above_content_widgets' => array(
											'name' => esc_html__('Above Content Widgets', 'clothing69'),
											'description' => esc_html__('Widgets to be shown above the content, near the sidebar', 'clothing69')
											),
			'below_content_widgets' => array(
											'name' => esc_html__('Below Content Widgets', 'clothing69'),
											'description' => esc_html__('Widgets to be shown below the content, near the sidebar', 'clothing69')
											),
			'below_page_widgets' 	=> array(
											'name' => esc_html__('Below Page Widgets', 'clothing69'),
											'description' => esc_html__('Widgets to be shown below the content and sidebar, but above the footer', 'clothing69')
											),
			'footer_widgets'		=> array(
											'name' => esc_html__('Footer Widgets', 'clothing69'),
											'description' => esc_html__('Widgets to be shown at the bottom of the page (in the page footer area)', 'clothing69')
											)
			)
		);
		return $list;
	}
}


//-------------------------------------------------------
//-- Theme fonts
//-------------------------------------------------------

// Return links for all theme fonts
if ( !function_exists('clothing69_theme_fonts_links') ) {
	function clothing69_theme_fonts_links() {
		$links = array();
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Google fonts: on or off', 'clothing69' ) );
		$custom_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Custom fonts (included in the theme): on or off', 'clothing69' ) );
		
		if ( ($google_fonts_enabled || $custom_fonts_enabled) && !clothing69_storage_empty('load_fonts') ) {
			$load_fonts = clothing69_storage_get('load_fonts');
			if (count($load_fonts) > 0) {
				$google_fonts = '';
				foreach ($load_fonts as $font) {
					$slug = clothing69_get_load_fonts_slug($font['name']);
					$url  = clothing69_get_file_url( sprintf('css/font-face/%s/stylesheet.css', $slug));
					if ($url != '') {
						if ($custom_fonts_enabled) {
							$links[$slug] = $url;
						}
					} else {
						if ($google_fonts_enabled) {
							$google_fonts .= ($google_fonts ? '|' : '') 
											. str_replace(' ', '+', $font['name'])
											. ':' 
											. (empty($font['styles']) ? '400,400italic,700,700italic' : $font['styles']);
						}
					}
				}
				if ($google_fonts && $google_fonts_enabled) {
					$links['google_fonts'] = sprintf('%s://fonts.googleapis.com/css?family=%s&subset=%s', clothing69_get_protocol(), $google_fonts, clothing69_get_theme_option('load_fonts_subset'));
				}
			}
		}
		return $links;
	}
}

// Return links for WP Editor
if ( !function_exists('clothing69_theme_fonts_for_editor') ) {
	function clothing69_theme_fonts_for_editor() {
		$links = array_values(clothing69_theme_fonts_links());
		if (is_array($links) && count($links) > 0) {
			for ($i=0; $i<count($links); $i++) {
				$links[$i] = str_replace(',', '%2C', $links[$i]);
			}
		}
		return $links;
	}
}


//-------------------------------------------------------
//-- The Excerpt
//-------------------------------------------------------
if ( !function_exists('clothing69_excerpt_length') ) {
	function clothing69_excerpt_length( $length ) {
		return max(1, clothing69_get_theme_setting('max_excerpt_length'));
	}
}

if ( !function_exists('clothing69_excerpt_more') ) {
	function clothing69_excerpt_more( $more ) {
		return '&hellip;';
	}
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'clothing69_importer_set_options' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_importer_options',	'clothing69_importer_set_options', 9 );
	function clothing69_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(clothing69_get_protocol() . '://demofiles.axiomthemes.com/clothing69/');
			// Required plugins
			$options['required_plugins'] = clothing69_storage_get('required_plugins');
			// Default demo
			$options['files']['default']['title'] = esc_html__('69 Clothing Demo', 'clothing69');
			$options['files']['default']['domain_dev']  = esc_url(clothing69_get_protocol() . '://clothing69.axiomthemes.com');	// Developers domain
			$options['files']['default']['domain_demo'] = esc_url(clothing69_get_protocol() . '://clothing69.axiomthemes.com');	// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
		}
		return $options;
	}
}



//-------------------------------------------------------
//-- Include theme (or child) PHP-files
//-------------------------------------------------------

require_once CLOTHING69_THEME_DIR . 'includes/utils.php';
require_once CLOTHING69_THEME_DIR . 'includes/storage.php';
require_once CLOTHING69_THEME_DIR . 'includes/lists.php';
require_once CLOTHING69_THEME_DIR . 'includes/wp.php';

if (is_admin()) {
	require_once CLOTHING69_THEME_DIR . 'includes/tgmpa/class-tgm-plugin-activation.php';
	require_once CLOTHING69_THEME_DIR . 'includes/admin.php';
}

require_once CLOTHING69_THEME_DIR . 'theme-options/theme.customizer.php';

require_once CLOTHING69_THEME_DIR . 'theme-specific/theme.tags.php';
require_once CLOTHING69_THEME_DIR . 'theme-specific/theme.hovers/theme.hovers.php';


// Plugins support
if (is_array($CLOTHING69_STORAGE['required_plugins']) && count($CLOTHING69_STORAGE['required_plugins']) > 0) {
	foreach ($CLOTHING69_STORAGE['required_plugins'] as $plugin_slug) {
		$plugin_slug = clothing69_esc($plugin_slug);
		$plugin_path = CLOTHING69_THEME_DIR . sprintf('plugins/%s/%s.php', $plugin_slug, $plugin_slug);
		if (file_exists($plugin_path)) { require_once $plugin_path; }
	}
}
?>