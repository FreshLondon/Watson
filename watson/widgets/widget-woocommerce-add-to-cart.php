<?php

namespace Elementor;

class Widget_WooAddToCart extends Widget_Base {

    public function get_name() {
        return 'woocommerce_add_to_cart';
    }

    public function get_title() {
        return 'WooCommerce add to cart';
    }

    public function get_icon() {
        return 'fa fa-shopping-cart';
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
            'text',
            [
                'label' => __('Button text', 'watson'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Add to cart', 'watson'),
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => __('Text color', 'watson'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selector' => '{{WRAPPER}} .watson-watc-button',
            ]
        );
        $this->add_control(
            'text_color_hover',
            [
                'label' => __('Text color: hover', 'watson'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selector' => '{{WRAPPER}} .watson-watc-button:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __('Button text typography', 'watson'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .watson-watc-button',
            ]
        );


//        $this->end_controls_section();
//        $this->start_controls_section(
//            'section_style',
//            [
//                'label' => __('Style', 'watson'),
//            ]
//        );


        $this->add_control(
            'button_color',
            [
                'label' => __('Button color', 'watson'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffc700',
                'selector' => '{{WRAPPER}} .watson-watc-button',
            ]
        );
        $this->add_control(
            'button_color_hover',
            [
                'label' => __('Button color: hover', 'watson'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selector' => '{{WRAPPER}} .watson-watc-button:hover',
            ]
        );

        $this->add_control(
            'width',
            [
                'label' => __('Width', 'watson'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 350,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .watson-watc-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'productID',
            [
                'label' => __('WooCommerce product ID', 'watson'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('1234', 'watson'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $randomString = generateRandomString();
        $randomStringID = '#' . $randomString;
        $settings = $this->get_settings_for_display();

        $watc = $settings;
        $productID = $watc['productID'];
        ?>
        <div id="<?= $randomString; ?>" class="watson-woocommerce_add_to_cart watc">
            <style>
                .watc .watson-watc-button {
                    text-align: center;
                    border-radius: 0;
                    width: 100%;
                    text-transform: uppercase;
                    font-weight: bold;
                    margin: 0 auto;
                    display: block;
                    -webkit-box-sizing: border-box;
                    box-sizing: border-box;
                    font-size: 1.3em;
                    padding: .8em 2.8em;
                    border: 1px solid rgba(0,0,0,0.45);
                    border-width: 1px 2px 3px;
                    -webkit-box-shadow: inset 0px 0px 8px 2px rgba(0,0,0,0.15);
                    box-shadow: inset 0px 0px 8px 2px rgba(0,0,0,0.15);
                    background-color: <?= $watc['button_color']; ?>;
                    color: <?= $watc['text_color']; ?>;
                }

                .watc .watson-watc-button:hover {
                    background-color: <?= $watc['button_color_hover']; ?>;
                    color: <?= $watc['text_color_hover']; ?>;
                }
            </style>

            <form class="cart" action="" method="post" enctype="multipart/form-data">
                <div class="quantity" style="display:none;">
                    <input type="number" id="quantity_5fb79ecf0df7c" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric">
                </div>
                <button type="submit" name="add-to-cart" value="<?= $productID; ?>" class="single_add_to_cart_button button alt watson-watc-button">
                    <?= $watc['text']; ?>
                </button>
            </form>
        </div>


        <div style="display: none;"><? debug($settings); ?></div>
        <?php
    }

    protected function _content_template() {

    }


}