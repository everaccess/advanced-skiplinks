<?php
/*
 * Plugin Name:  EverAccess Skip-Links
 * Plugin URI:   https://developer.wordpress.org/plugins/everaccess-skiplinks/
 * Description:  Adds Accessibility Skip-Links functionality to your WordPress site.
 * Version:      0.0.1
 * Author:       Amit Moreno
 * Author URI:   https://www.amitmoreno.com/
 * License:      GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  everaccess
 * Domain Path:  /languages
*/

// Define plugin directory
define( 'EA_SKIPLINKS_DIR', plugin_dir_path( __FILE__ ) );

// Define plugin ID
define( 'EA_SKIPLINKS_ID', 'ea_skiplinks' );

// Define plugin name
define( 'EA_SKIPLINKS_NAME', __('EverAccess Skiplinks', 'everaccess') );

// Require core functions
require_once( EA_SKIPLINKS_DIR . 'lib/core-functions.php');

// Require panel class
require_once( EA_SKIPLINKS_DIR . 'lib/panel.php' );

// Require meta class
require_once( EA_SKIPLINKS_DIR . 'lib/meta.php' );

// Activate Panel & Meta Classes
if( class_exists('EverAccess_SkiplinksPanel') )
    new EverAccess_SkiplinksPanel();
if( class_exists('EverAccess_SkiplinksMeta') )
    new EverAccess_SkiplinksMeta();

// Load Assets
function everaccess_skiplinks_assets( $hook ) {
    if($hook == 'accessibility_page_submenu-page' || $hook == 'post.php' || $hook == 'post-new.php' ) {
        wp_enqueue_style( 'ea-skiplinks-admin-css', plugins_url('assets/css/admin.css', __FILE__) );
        wp_enqueue_script('ea-skiplinks-admin-js',  plugins_url('assets/js/everaccess-skiplinks-admin.js', __FILE__), array('jquery', 'jquery-ui-sortable') );
    }
}
add_action( 'admin_enqueue_scripts', 'everaccess_skiplinks_assets' );
