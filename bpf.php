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

add_filter('the_title', 'add_post_format_emoji', 10, 2);

//add emoji to post format
function add_post_format_emoji($title, $id)
{
    // Get the post format for the current post
    $post_format = get_post_format($id);

    // Add a corresponding emoji based on the post format
    switch ($post_format) {
        case 'aside':
            $emoji = '📝';
            break;
        case 'gallery':
            $emoji = '🖼️';
            break;
        case 'link':
            $emoji = '🔗';
            break;
        case 'image':
            $emoji = '📷';
            break;
        case 'quote':
            $emoji = '❤️';
            break;
        case 'status':
            $emoji = '💬';
            break;
        case 'video':
            $emoji = '📹';
            break;
        case 'audio':
            $emoji = '🎧';
            break;
        default:
            $emoji = '';
            break;
    }

    // Return the modified title
    return $emoji . ' ' . $title;
}
