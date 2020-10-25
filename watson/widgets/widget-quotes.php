<?php

namespace Elementor;

class Widget_Quotes extends Widget_Base {

    public function get_name() {
        return 'quotes';
    }

    public function get_title() {
        return 'Quotes';
    }

    public function get_icon() {
        return 'fa fa-quote-left';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'watson'),
            ]
        );
        $this->add_control(
            'display_title',
            [
                'label' => __('Display title?', 'watson'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'watson'),
                'label_off' => __('No', 'watson'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __('Title', 'watson'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Enter your title', 'watson'),
                'condition' => [
                    'display_title' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'watson'),
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
                'label' => __('Title color', 'watson'),
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
                'label' => __('Title alignment', 'watson'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'watson'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'watson'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'watson'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'condition' => [
                    'display_title' => 'yes'
                ],
            ]
        );

        $quotes = new \Elementor\Repeater();

        $quotes->add_control(
            'quote_content', [
                'label' => __('Content', 'watson'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('List Content', 'watson'),
                'show_label' => false,
            ]
        );
        $quotes->add_control(
            'quote_author', [
                'label' => __('Author', 'watson'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('List Title', 'watson'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'quotes',
            [
                'label' => __('Quotes', 'watson'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $quotes->get_controls(),
                'default' => [
                    [
                        'quote_author' => __('Nelson Mandela', 'watson'),
                        'quote_content' => __('The greatest glory in living lies not in never falling, but in rising every time we fall.', 'watson'),
                    ],
                    [
                        'quote_author' => __('Walt Disney', 'watson'),
                        'quote_content' => __('The way to get started is to quit talking and begin doing.', 'watson'),
                    ], [
                        'quote_author' => __('John Lennon', 'watson'),
                        'quote_content' => __('Life is what happens when you&#146;re busy making other plans.', 'watson'),
                    ],
                ],
                'title_field' => '{{{ quote_author }}}',
            ]
        );
        $this->add_control(
            'shuffle',
            [
                'label' => __('Shuffle quotes?', 'watson'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'watson'),
                'label_off' => __('No', 'watson'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'watson'),
            ]
        );
        $this->add_control(
            'quote_spacing',
            [
                'label' => __('Spacing between quotes', 'plugin-domain'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                        'step' => 1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .watson-quote' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'advanced_styling',
            [
                'label' => __('Toggle advanced styling?', 'watson'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'watson'),
                'label_off' => __('No', 'watson'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'color_scheme',
            [
                'label' => __('General color scheme', 'watson'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'condition' => [
                    'advanced_styling' => ''
                ],
            ]
        );
        $this->add_control(
            'hr1',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'advanced_styling' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Content: typography', 'watson'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .watson-quote-author',
                'condition' => [
                    'advanced_styling' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __('Content: text color', 'watson'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'condition' => [
                    'advanced_styling' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'content_alignment',
            [
                'label' => __('Content: alignment', 'watson'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'watson'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'watson'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'watson'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'condition' => [
                    'advanced_styling' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'hr2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'advanced_styling' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'label' => __('Author: typography', 'watson'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .watson-quote-author',
                'condition' => [
                    'advanced_styling' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'author_color',
            [
                'label' => __('Author: text color', 'watson'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'condition' => [
                    'advanced_styling' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'author_alignment',
            [
                'label' => __('Author: alignment', 'watson'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'watson'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'watson'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'watson'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'condition' => [
                    'advanced_styling' => 'yes'
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $display_title = ($settings['display_title'] == 'yes') ? 'true' : 'false';;
        $title_alignment = $settings['title_alignment'];
        $color_scheme = $settings['color_scheme'];

        if ($display_title && $settings['title']) { ?>
            <h3 style="text-align: <?= $title_alignment; ?>;"><?= $settings['title']; ?></h3>
        <?php } ?>
        <style>
            :root {
                --col-quotes: <?=$color_scheme;?>;
            }
        </style>
        <div class="watson-quotes">
            <?php
            $quotes = $settings['quotes'];
            $shuffle = $settings['shuffle'];
            if ($shuffle == 'yes') :
                shuffle($quotes);
            endif;

            $content_alignment = $settings['content_alignment'];
            $author_alignment = $settings['author_alignment'];


            foreach ($quotes as $quote) {
                $quote_author = $quote['quote_author'];
                $quote_content = $quote['quote_content'];
                ?>

                <div class="watson-quote">
                    <div class="watson-quote-content" style="text-align: <?= $content_alignment; ?>;"><?= $quote_content; ?></div>
                    <div class="watson-quote-author" style="text-align: <?= $author_alignment; ?>;"><?= $quote_author; ?></div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    protected function _content_template() {

    }


}