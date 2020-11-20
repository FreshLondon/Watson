<?php

namespace Elementor;

class Widget_Slider extends Widget_Base {

    public function get_name() {
        return 'watson-slider';
    }

    public function get_title() {
        return 'Slider';
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
            'section_content',
            [
                'label' => __('Content', 'elementor'),
            ]
        );

        $this->add_control(
            'display_title',
            [
                'label' => __('Display title?', 'elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __('Title', 'elementor'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Enter your title', 'elementor'),
                'condition' => [
                    'display_title' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'elementor'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} h3',
                'condition' => [
                    'display_title' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title color', 'elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'condition' => [
                    'display_title' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'title_alignment',
            [
                'label' => __('Title alignment', 'elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'elementor'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementor'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementor'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'condition' => [
                    'display_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
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
        $thumb_size = watson_thumb_sizes();
        $thumb_Size = $thumb_size;
        $this->add_control(
            'thumbnail_size',
            [
                'label' => __('Image source size', 'watson'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    $thumb_Size,
                ],
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'navigation_options',
            [
                'label' => __('Navigation options', 'watson'),
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
            'arrow_inside',
            [
                'label' => __('Arrows inside canvas?', 'elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'arrows' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'arrow_color',
            [
                'label' => __('Arrow Color', 'elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'condition' => [
                    'arrows' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
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
            'dots_inside',
            [
                'label' => __('Dots inside canvas?', 'elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'dots' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'dots_color',
            [
                'label' => __('Dot Color', 'elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'condition' => [
                    'dots' => 'yes'
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'sider_options',
            [
                'label' => __('Slider options', 'watson'),
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

        $this->add_responsive_control(
            'slidesToShow',
            [
                'label' => __('Slides per view (click device icon)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['slides'],
                'range' => [
                    'slides' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                    ]
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'desktop_default' => [
                    'unit' => 'slides',
                    'size' => 3,
                ],
                'tablet_default' => [
                    'unit' => 'slides',
                    'size' => 2,
                ],
                'mobile_default' => [
                    'unit' => 'slides',
                    'size' => 1,
                ],
                'default' => [
                    'unit' => 'slides',
                    'size' => 3,
                ],
            ]
        );
        $this->add_control(
            'slidesToScroll',
            [
                'label' => __('Slides to scroll', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['slides'],
                'range' => [
                    'slides' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'slides',
                    'size' => 1,
                ],
            ]
        );
        $this->add_control(
            'slide_height_note',
            [
//                'label' => __( '', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __('Slide height is a percentage of the width. 100% is a square, 75% is a 4:3 image.', 'plugin-name'),
                'content_classes' => 'watson-controls-note',
            ]
        );
        $this->add_control(
            'slide_height',
            [
                'label' => __('Slide height (%)', 'elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 200,
                'step' => 1,
                'default' => 75,
            ]
        );
        $this->add_control(
            'hr2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
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
            'hr3',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
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
                'condition' => [
                    'autoplay' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $thumb_size = watson_thumb_sizes();
        $thumb_Size = $thumb_size;
//        debug($thumb_Size);


        //slider settings:
        $settings = $this->get_settings_for_display();
        $background_size = 'background-size: ' . $settings['background_size'] . ';';
        $slide_height = 'padding-top: ' . $settings['slide_height'] . '%;';
        $display_title = ($settings['display_title'] == 'yes') ? 'true' : 'false';;
        $title_alignment = $settings['title_alignment'];
        //
        $arrows = ($settings['arrows'] == 'yes') ? 'true' : 'false';
        $arrow_color = $settings['arrow_color'];
        $arrows_inside = ($settings['arrow_inside'] == 'yes') ? 'arrows_inside' : 'arrows_outside';
        $dots = ($settings['dots'] == 'yes') ? 'true' : 'false';
        $dots_color = $settings['dots_color'];
        $dots_inside = ($settings['dots_inside'] == 'yes') ? 'dots-inside' : 'dots-outside';
        $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
        $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
        $autoplay_speed = $settings['autoplay_speed']['size'];
        $slidesToShow = $settings['slidesToShow']['size'];
        $slidesToShow_tablet = ($settings['slidesToShow_tablet']['size']) ? $settings['slidesToShow_tablet']['size'] : $slidesToShow;
        $slidesToShow_mobile = ($settings['slidesToShow_mobile']['size']) ? $settings['slidesToShow_mobile']['size'] : $slidesToShow;
        $slidesToScroll = $settings['slidesToScroll']['size'];
        // end slider settings!


        if ($display_title && $settings['title']) { ?>
            <h3 style="text-align: <?= $title_alignment; ?>"><?= $settings['title']; ?></h3>
        <?php } ?>


        <div class="watson-slider <?= $dots_inside; ?>">
            <?php
            $images = $settings['gallery'];
            shuffle($images);
            foreach ($images as $image) { ?>
                <div class="slider-img-wrapper">
                    <div class="slider-img" style="background-image: url(<?= $image['url']; ?>);<?= $background_size; ?> <?= $slide_height; ?>">
                        <img src="<?= $image['url']; ?>">
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <script>
					jQuery(function ($) {
						$('.watson-slider').slick({
							arrows: <?=$arrows;?>,
                <?php if($arrows == 'true') :?>
							prevArrow: '<button type="button" class="slick-prev <?=$arrows_inside;?>" style="color: <?=$arrow_color;?>;">Previous</button>',
							nextArrow: '<button type="button" class="slick-next <?=$arrows_inside;?>" style="color: <?=$arrow_color;?>;">Next</button>',
                <?endif;?>
							dots: <?=$dots;?>,

							infinite: <?=$infinite;?>,
							autoplay: <?=$autoplay;?>,
							autoplaySpeed: <?=$autoplay_speed;?>,
							slidesToShow: <?=$slidesToShow;?>,
							slidesToScroll: <?=$slidesToScroll;?>,


							responsive: [
								{
									breakpoint: 992,
									settings: {
										slidesToShow: <?=$slidesToShow;?>,
									}
								}, {
									breakpoint: 768,
									settings: {
										slidesToShow: <?=$slidesToShow_tablet;?>,
									}
								}, {
									breakpoint: 576,
									settings: {
										slidesToShow: <?=$slidesToShow_mobile;?>,
									}
								},

							]
						});
					});
        </script>
        <style>
            body .watson-slider ul.slick-dots li button {
                background-color: <?=$dots_color;?>;
            }

            body .watson-slider.dots-outside ul.slick-dots {
                bottom: -8px;
            }
        </style>
        <?php
    }

    protected function _content_template() {
    }
}