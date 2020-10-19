<?php

namespace Elementor;

class Widget_Tag_Buttons extends Widget_Base {

    public function get_name() {
        return 'tag-buttons';
    }

    public function get_title() {
        return 'Tag buttons';
    }

    public function get_icon() {
        return 'fa fa-tag';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Content', 'elementor' ),
            ]
        );

//        $this->add_control(
//            'title',
//            [
//                'label' => __( 'Title', 'elementor' ),
//                'label_block' => true,
//                'type' => Controls_Manager::TEXT,
//                'placeholder' => __( 'Enter your title', 'elementor' ),
//            ]
//        );
        $this->add_control(
            'show_post_count',
            [
                'label' => __( 'Show post count?', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'elementor' ),
                'label_off' => __( 'Hide', 'elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $show_post_count = false;
        $settings = $this->get_settings_for_display();
        if ( 'yes' === $settings['show_post_count'] ) {
            $show_post_count = true;
        } ?>
        <ul class="widget-tag-buttons"><?php
            $i = 0;
            add_action( 'loop_start', 'list_tags_with_count' );
            $tags = get_tags( array( 'orderby' => 'count', 'order' => 'DESC' ) );
            foreach ( (array)$tags as $tag ) {
                if ($i++ > 19) break;
                echo '<li><a href="' . get_tag_link( $tag->term_id ) . '" rel="tag">' . $tag->name . ($show_post_count ? ' ('.$tag->count.')' : '' ) . '</a></li>';

            }
            ?></ul>
        <?php
    }

    protected function _content_template() {

    }


}