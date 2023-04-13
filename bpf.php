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
add_action('plugins_loaded', function () {
    $autoloader = __DIR__ . '/vendor/autoload.php';
    if (file_exists($autoloader)) {
        include $autoloader;
    }
}, 1);

include_once dirname(__FILE__) . '/inc/functions.php';
include_once dirname(__FILE__) . '/inc/hooks.php';
/**
 * Setup plugin updater
 */
add_action('plugins_loaded', function () {
    new \BlockPostFormat\Updater('0.0.1', plugin_basename(__DIR__), plugin_basename(__FILE__));
});

// Add all post formats to the post type    
function bpf_theme_setup()
{
    add_theme_support('post-formats', array(
        'aside',   // title-less blurb
        'gallery', // gallery of images
        'link',    // quick link to other site
        'image',   // an image
        'quote',   // a quick quote
        'status',  // a Facebook-like status update
        'video',   // video
        'audio',   // audio
    ), 'bpf');
}
add_action('after_setup_theme', 'bpf_theme_setup');

// Post formats templates
while (have_posts()) {
    the_post();
    $post_format = get_post_format() ?: 'standard';
    get_template_part('content', $post_format);
}
