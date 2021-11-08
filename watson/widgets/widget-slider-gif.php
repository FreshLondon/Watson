<?php

namespace Elementor;

class Widget_Slider_gif extends Widget_Base {

    public function get_name() {
        return 'watson-slider-gif';
    }

    public function get_title() {
        return 'Watson GIF Slider';
    }

    public function get_icon() {
        return 'fa fa-images';
    }

    public function get_categories() {
        return ['basic'];
    }

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_script('slick-slider', esc_url(plugins_url('../assets/compiled/slick.min.js', __FILE__)), ['elementor-frontend'], '1.0.0', true);
//        wp_register_style('slider', esc_url(plugins_url('../assets/compiled/slider.min.css', __FILE__)), ['elementor-frontend'], '1.0.0', 'all');
    }

    public function get_script_depends() {
        return ['slick-slider'];
    }

//    public function get_style_depends() {
//        return ['fa-icons'];
//    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'watson'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Choose Image', 'watson'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'slide_title', [
                'label' => __('Title', 'watson'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('slide Title', 'watson'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_content', [
                'label' => __('Content', 'watson'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('slide Content', 'watson'),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'slide',
            [
                'label' => __('Repeater slide', 'watson'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_title' => __('Title #1', 'watson'),
                        'slide_content' => __('Item content. Click the edit button to change this text.', 'watson'),
                    ],
                    [
                        'slide_title' => __('Title #2', 'watson'),
                        'slide_content' => __('Item content. Click the edit button to change this text.', 'watson'),
                    ],
                ],
                'title_field' => '{{{ slide_title }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        //slider settings:
        $settings = $this->get_settings_for_display();
//        debug($settings['slide']);
        ?>

        <div class="watson-slider-gif">

            <? foreach ($settings['slide'] as $slide) : ?>
                <div class="watson-slider-gif-slide">
                    <img class="watson-slider-gif-slide-img" src="<?= $slide['image']['url']; ?>"/>
                    <div class="watson-slider-gif-slide-title">
                        <?= $slide['slide_title']; ?>
                    </div>
                    <div class="watson-slider-gif-slide-content">
                        <?= $slide['slide_content']; ?>
                    </div>
                </div>
            <? endforeach; ?>

        </div>




        <script>
					jQuery(function ($) {
						$('.watson-slider-gif').slick({
							//
							arrows: false,
							autoplay: true,
							autoplaySpeed: 3000,
							dots: true,
							pauseOnFocus: false,
							pauseOnHover: false,

						});
					});
        </script>
        <?php
    }

    protected function _content_template() {
    }
}