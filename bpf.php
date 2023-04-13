<?php
                

/**
* Plugin Name: Block Post Formats
* Plugin URI: https://courtneyr.dev/block-post-format
* Description: Block Post Format Description
* Version: 0.0.1
* Requires at least: 6.0
* Requires PHP:      8.0
* Author:            Courtney Robertson
* Author URI:        https://courtneyr.dev
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:       bpf
* Domain Path:       /languages
*/

/**
* Include the autoloader
*/
add_action( 'plugins_loaded', function () {
    if ( file_exists(__DIR__ . '/vendor/autoload.php' ) ) {
        include __DIR__ . '/vendor/autoload.php';
    }
}, 1 );

include_once dirname( __FILE__ ). '/inc/functions.php';
include_once dirname( __FILE__ ). '/inc/hooks.php';
/**
* Setup plugin updater
*/
add_action( 'plugins_loaded', function(){
    new \BlockPostFormat\Updater( '0.0.1', plugin_basename( __DIR__ ), plugin_basename( __FILE__ ) );
});
