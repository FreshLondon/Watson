<?php

namespace Elementor;

class Widget_Masonry extends Widget_Base {

    public function get_name() {
        return 'masonry';
    }

    public function get_title() {
        return 'Masonry';
    }

    public function get_icon() {
        return 'fa fa-square';
    }




    public function get_categories() {
        return ['basic'];
    }




    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_script('fancybox-js', esc_url(plugins_url('../assets/compiled/jquery.fancybox.min.js', __FILE__)), ['elementor-frontend'], '3.5.7', true);
        wp_register_style('fancybox-css', esc_url(plugins_url('../assets/compiled/jquery.fancybox.min.css', __FILE__)), ['elementor-frontend'], '3.5.7', 'screen');
    }




    public function get_script_depends() {
        return ['fancybox-js'];
    }

    public function get_style_depends() {
        return ['fancybox-css'];
    }
// register controld
    protected function _register_controls() {

        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Content', 'elementor'),
            ]
        );
        $this->add_control(
            'important_note',
            [
//                'label' => __( '', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __('This masonry grid displays best within stretched, unboxed sections.', 'plugin-name'),
                'content_classes' => 'watson-controls-note',
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
            'gallery',
            [
                'label' => __('Add images', 'elementor'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $this->add_control(
            'lightbox',
            [
                'label' => __('Activate lightbox?', 'elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

//		$this->add_control(
//			'responsive',
//			[
//				'label'        => __( 'Responsive slider?', 'elementor' ),
//				'type'         => \Elementor\Controls_Manager::SWITCHER,
//				'label_on'     => __( 'Yes', 'elementor' ),
//				'label_off'    => __( 'No', 'elementor' ),
//				'return_value' => 'yes',
//				'default'      => 'yes',
//			]
//		);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $display_title = ($settings['display_title'] == 'yes') ? 'true' : 'false';;
        $title_alignment = $settings['title_alignment'];
        $lightbox = $settings['lightbox'];

        if ($display_title && $settings['title']) { ?>
            <h3 style="text-align: <?= $title_alignment; ?>"><?= $settings['title']; ?></h3>
        <?php } ?>

        <div class="watson-masonry">
            <?php
            $images = $settings['gallery'];
            shuffle($images);
            foreach ($images as $image) {
                $image_small = wp_get_attachment_image_src($image['id'], 'medium_large');
                ?>

                <img class="watson-masonry-item" src="<?= $image_small[0]; ?>"
                    <?php if ($lightbox == 'yes') : ?>
                        data-fancybox="gallery" data-src="<?= $image['url']; ?>"
                    <?php endif; ?>
                     alt="<?= $image['alt']; ?>">
                <?php
            }
            ?>
        </div>
        <?php
    }

    protected function _content_template() {

    }


}