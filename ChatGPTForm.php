<?php
/**
 * Plugin Name: ChatGPT
 * Description: ChatGPT Form Shortcode [chatgpt_form]
 * Requires at least: 6.1
 * Requires PHP: 7.0
 * Version: 0.1.0
 * Author: ai dev 
 * Author URI: ai dev 
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: todo
 *
 * @package chatgpt
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function enqueue_chatgpt_form_script() {
    // Enqueue the JavaScript file
    wp_enqueue_script(
        'chatgpt-form-script',
        plugins_url('build/chatgpt-form.js', __FILE__),
        array('jquery'),
        '1.0.0',
        true
    );

    // Pass any localized data to the script if needed
    wp_localize_script('chatgpt-form-script', 'chatgpt_form_data', array(
        'api_url' => 'https://api.openai.com/v1/chat/completions',
        'api_key' => 'YOUR_API_KEY', // Replace with your actual API key
        'model' => 'gpt-3.5-turbo',
    ));

    // Enqueue the CSS styles from the build folder
    wp_enqueue_style(
        'chatgpt-form-styles',
        plugins_url('css/chatgpt-form-styles.css', __FILE__),
        array(),
        '1.0.0'
    );

    // Enqueue your custom CSS file
    wp_enqueue_style(
        'custom-styles',
        plugins_url('css/custom-styles.css', __FILE__),
        array('chatgpt-form-styles'), // Include dependencies if needed
        '1.0.0'
    );
}


// Use wp_enqueue_scripts hook for front-end script and style loading
add_action('wp_enqueue_scripts', 'enqueue_chatgpt_form_script');

// Shortcode function for [chatgpt_form]
function chatgpt_form_shortcode() {
    ob_start(); // Start output buffering
    ?>
    <div id="chatgpt-form-container">
        <label for="user_question">Haz tu pregunta:</label>
        <input type="text" id="user_question" name="user_question">
        <button id="submit_question">Enviar</button>
    </div>

    <div id="chatgpt_response_container" class="mt-3">
        <strong>Respuesta de ChatGPT:</strong>
        <div id="chatgpt_response"></div>
    </div>
    <?php
    return ob_get_clean(); // Return buffered content
}

// Register the shortcode [chatgpt_form]
add_shortcode('chatgpt_form', 'chatgpt_form_shortcode');
?>

