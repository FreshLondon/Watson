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
function watson_scripts() {
    wp_enqueue_style('watson-front', plugin_dir_url(__FILE__) . 'assets/compiled/watson-front.css', array(), time(), true);
//    wp_enqueue_script( 'script-name', plugin_dir_url( __FILE__ ). '/js/example.js', array(), '1.0.0', true );
}

add_action('wp_enqueue_scripts', 'watson_scripts');

class My_Elementor_Widgets {

    protected static $instance = null;

    public static function get_instance() {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    protected function __construct() {
        require_once('widgets/widget-slider.php');
        require_once('widgets/widget-masonry.php');
//        require_once('widgets/widget-tag-buttons.php');
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
    }

    public function register_widgets() {
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Widget_Slider());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Widget_Masonry());
//        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Widget_Tags());
        //		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Widget_Category_Buttons() );


    }

}

add_action('init', 'my_elementor_init');
function my_elementor_init() {
    My_Elementor_Widgets::get_instance();
}