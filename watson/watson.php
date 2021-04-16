<?php
/*
    Plugin Name: Watson
    Plugin URI: https://freshlondon.biz/
    description: A custom bundle of additional widgets for Elementor
    Version: 0.1
    Author: FreshLondon
    Author URI: https://freshlondon.biz/
    License: GPL3
*/


/**
 * Enqueue scripts and styles
 */
add_action('wp_enqueue_scripts', 'watson_scripts');
function watson_scripts() {
    wp_enqueue_style('watson-front', esc_url(plugins_url('assets/compiled/watson.css', __FILE__)), array(), time(), 'all');
//    wp_enqueue_script( 'script-name', WATSON_DIR( __FILE__ ). '/js/example.js', array(), '1.0.0', true );
}


/**
 * Enqueue admin scripts and styles
 */
//add_action('admin_enqueue_scripts', 'watson_admin_head');
//
//function watson_admin_head() {
//    wp_enqueue_style('watson-admin', esc_url(plugins_url('assets/compiled/watson-admin.css', __FILE__)), array(), time(), 'all');
//}
//

/**
 * Ready up Elementor stuffs
 */
class My_Elementor_Widgets {

    protected static $instance = null;

    public static function get_instance() {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    protected function __construct() {
//        require_once('widgets/widget-slider.php');
        require_once('widgets/widget-slider-gif.php');
//        require_once('widgets/widget-masonry.php');
//        require_once('widgets/widget-quotes.php');
//        require_once('widgets/widget-woocommerce-add-to-cart.php');
//        require_once('widgets/widget-tag-buttons.php');
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
    }

    public function register_widgets() {
//        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Widget_Slider());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Widget_Slider_gif());
//        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Widget_Masonry());
//        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Widget_Quotes());
//        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Widget_WooAddToCart());
    }
}

add_action('init', 'my_elementor_init');
function my_elementor_init() {
    My_Elementor_Widgets::get_instance();
}

add_action('elementor/editor/before_enqueue_scripts', function () {
    wp_enqueue_style('watson-front', esc_url(plugins_url('assets/compiled/watson-admin.css', __FILE__)), array(), time(), 'all');
//    wp_enqueue_script( ... );
});

/**
 * DEBUGGING
 */
if (!function_exists('debug')) {
    function debug($data) {
        print('<pre>');
        print_r($data);
        print('</pre>');
    }
}

/**
 * GENERATE A RTANDOM STRING
 */
if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
/**
 * Get thumbnail sizes
 */
function watson_thumb_sizes() {
    global $_wp_additional_image_sizes;
    $sizes = array();
    $tSizes = array();
    foreach (get_intermediate_image_sizes() as $s) {
        $sizes[$s] = array(0, 0);
        if (in_array($s, array('thumbnail', 'medium', 'medium_large', 'large'))) {
            $sizes[$s][0] = get_option($s . '_size_w');
            $sizes[$s][1] = get_option($s . '_size_h');
        } else {
            if (isset($_wp_additional_image_sizes) && isset($_wp_additional_image_sizes[$s]))
                $sizes[$s] = array($_wp_additional_image_sizes[$s]['width'], $_wp_additional_image_sizes[$s]['height'],);
        }
    }
    foreach ($sizes as $size => $atts) {
        $tSizes[$size] = $size . ': ' . implode(' x ', $atts);
    }
    return $tSizes;
}