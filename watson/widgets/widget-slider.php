<?php

namespace Elementor;

class Widget_Slider extends Widget_Base {

    public function get_name() {
        return 'slider';
    }

    public function get_title() {
        return 'Slider';
    }

    public function get_icon() {
        return 'fa fa-list-alt';
    }

    public function get_categories() {
        return ['basic'];
    }

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_script('slick-slider', get_stylesheet_directory_uri() . '/assets/app/dist/slick.min.js', ['elementor-frontend'], '1.0.0', true);
    }

    public function get_script_depends() {
        return ['slick-slider'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Content', 'elementor'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'elementor'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Enter your title', 'elementor'),
            ]
        );


        $this->add_control(
            'gallery',
            [
                'label' => __('Add Images', 'elementor'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label' => __('Navigation arrows?', 'elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label' => __('Navigation dots?', 'elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => __('Infinite slides?', 'elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'background_size',
            [
                'label' => __('Background size', 'elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'cover' => __('Cover', 'elementor'),
                    'contain' => __('Contain', 'elementor'),
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay slider?', 'elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay speed', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['ms'],
                'range' => [
                    'ms' => [
                        'min' => 100,
                        'max' => 5000,
                        'step' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'ms',
                    'size' => 2000,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $background_size = 'background-size: ' . $settings['background_size'] . ';';
        if ($settings['title']) { ?>
            <h3><?= $settings['title']; ?></h3>
        <?php } ?>


        <div class="slider">
            <?php
            //            debug($settings);
            $images = $settings['gallery'];
            shuffle($images);
            foreach ($images as $image) { ?>
                <div class="slider-img-wrapper">
                    <div class="slider-img" style="background-image: url(<?= $image['url']; ?>);<?= $background_size; ?>">
                        <img src="<?= $image['url']; ?>">
                    </div>
                </div>
                <?php
            }
            ?>
        </div>


        <?php
        $arrows = ($settings['arrows'] == 'yes') ? 'true' : 'false';
        $dots = ($settings['dots'] == 'yes') ? 'true' : 'false';
        $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';

        $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
        $autoplay_speed = $settings['autoplay_speed']['size'];
        ?>

        <script>
					jQuery(function ($) {
						$('.slider').slick({
							arrows: <?=$arrows;?>,
							dots: <?=$dots;?>,

							infinite: <?=$infinite;?>,
							autoplay: <?=$autoplay;?>,
							autoplaySpeed: <?=$autoplay_speed;?>,
							slidesToShow: 1,
						});
					});
        </script>
        <?php
    }

    protected function _content_template() {
    }
}