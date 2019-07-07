<?php
/**
 * pandublog functions and definitions
 *
 * @package pandublog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$pandublog_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
	'/class-tgm-plugin-activation.php',
);

foreach ( $pandublog_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}









# plugin yang harus di install
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
	$plugins = array(

		array(
			'name'        => 'Social Sharing Buttons – Social Pug',
			'slug'        => 'social-pug',
			'is_callable' => 'social-pug',
		),

	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);
	tgmpa( $plugins, $config );
}

// custom function

function add_copyright_text() {
if (is_single()) { ?>
	<script type='text/javascript'>
	function addLink() {
		if (
			window.getSelection().containsNode(
			document.getElementsByClassName('entry-content')[0], true)) {
				var body_element = document.getElementsByTagName('body')[0];
				var selection;
				selection = window.getSelection();
				var oldselection = selection
				var pagelink = "<br /><br /> Source Article : <?php the_title(); ?> <a href='"+document.location.href+"'>"+document.location.href+"</a><br/>"; 
				var copy_text = selection + pagelink;
				var new_div = document.createElement('div');
				new_div.style.left='-99999px';
				new_div.style.position='absolute';
				body_element.appendChild(new_div );
				new_div.innerHTML = copy_text ;
				selection.selectAllChildren(new_div );
				window.setTimeout(function() {
				body_element.removeChild(new_div );
			},0);
		}
	}
	document.oncopy = addLink;
	</script>
<?php
}
}
add_action( 'wp_head', 'add_copyright_text');

