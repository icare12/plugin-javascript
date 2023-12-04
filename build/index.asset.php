function enqueue_your_script() {
    wp_enqueue_script(
        'your-script-handle',
        plugin_dir_url(__FILE__) . 'path/to/your/script.js',
        array('wp-element', 'wp-components', 'wp-api-fetch'),
        '1.0.0',
        true
    );
}

add_action('wp_enqueue_scripts', 'enqueue_your_script');


