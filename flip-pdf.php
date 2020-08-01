<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              Tuan Ha
 * @since             1.0.0
 * @package           Flip_Pdf
 *
 * @wordpress-plugin
 * Plugin Name:       Flip PDF
 * Plugin URI:        flip-pdf
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Tuan Ha
 * Author URI:        Tuan Ha
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       flip-pdf
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('FLIP_PDF_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-flip-pdf-activator.php
 */
function activate_flip_pdf()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-flip-pdf-activator.php';
    Flip_Pdf_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-flip-pdf-deactivator.php
 */
function deactivate_flip_pdf()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-flip-pdf-deactivator.php';
    Flip_Pdf_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_flip_pdf');
register_deactivation_hook(__FILE__, 'deactivate_flip_pdf');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-flip-pdf.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_flip_pdf()
{

    $plugin = new Flip_Pdf();
    $plugin->run();
}

//Create meta box
function meta_box()
{
    add_meta_box('get-pdf', 'Upload File PDF', 'html_get_pdf', 'post');
}

function html_get_pdf($post)
{
    $url_pdf = get_post_meta($post->ID, '_url_pdf', true);
    if (!empty($url_pdf)) {
        echo('<div>
            <label for="url-pdf">Đường dẫn file PDF</label>
            <input type="text" value="' . $url_pdf . '" class="regular-text process_custom_images"  name="url_pdf" id="url-pdf" >
            <button class="set_custom_images button">Upload</button>
        </div>');
    } else {
        echo('<div>
            <label for="url-pdf">Đường dẫn file PDF</label>
            <input type="text" value="" class="regular-text process_custom_images"  name="url_pdf" id="url-pdf" >
            <button class="set_custom_images button">Upload</button>
        </div>');
    }
}

add_action('admin_enqueue_scripts', function () {
    if (is_admin())
        wp_enqueue_media();
});

function pdf_save($post_id)
{
    $url_pdf = sanitize_text_field($_POST['url_pdf']);
    update_post_meta($post_id, '_url_pdf', $url_pdf);
}

function pdf_flip_footer()
{
    if (is_single()) {
        $post_id = get_the_ID();
        $urlpdf = get_post_meta($post_id, '_url_pdf', true);
        echo "
            <script>
                var urlPdf = '';                
            </script>
        ";
        if (!empty($urlpdf)){
            echo "
            <script>
                urlPdf = '" . $urlpdf . "';                
            </script>
            <style>
                body{
                  overflow: hidden;
                }          
                @media only screen and (max-width: 500px) {
                    #fb3d-ctx .view .fnav span.icon{
                        font-size: 30pt !important;
                    }
                    .view .fnav a{
                    font-size: 30pt !important;
                    }
                }          
            </style>
            <div class='pdf-container'>               
            </div>
        ";
        }
    } else {

    }
}
add_action('save_post', 'pdf_save');
add_action('add_meta_boxes', 'meta_box');
add_action('wp_footer', 'pdf_flip_footer');
//add_action('wp_head','pdf_flip_header');
run_flip_pdf();
