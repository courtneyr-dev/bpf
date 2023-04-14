<?php

/** Functions **/
// add all post format support
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

add_filter('the_title', 'add_post_format_emoji', 10, 2);

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
    