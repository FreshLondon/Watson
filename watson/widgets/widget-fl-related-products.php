<?php

namespace Elementor;

class FL_Related_Products extends Widget_Base {

	public function get_name() {
		return 'fl-related-products';
	}

	public function get_title() {
		return __( 'FL Related Products', 'watson' );
	}

	public function get_icon() {
		return 'fa fa-cart';
	}

	public function get_categories() {
		return [ 'basic' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'watson' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'exclude_cats',
			[
				'label'       => __( 'Exclude categories by ID:', 'watson' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Category IDs for e.g: 17,23,152', 'watson' ),
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		global $product;

		if ( ! is_a( $product, 'WC_Product' ) ) {
			$product = wc_get_product( get_the_id() );
		}

		woocommerce_related_products( array(
			'posts_per_page' => 4,
			'columns'        => 4,
			'orderby'        => 'rand',
//			'category__not_in' => array( $settings[ 'exclude_cats' ] ),
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_cat',
					'terms'    => array( $settings[ 'exclude_cats' ] ),
					'operator' => 'NOT IN',
				)
			)
		) );
	}
}