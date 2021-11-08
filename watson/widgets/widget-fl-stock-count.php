<?php

namespace Elementor;

class FL_Stock_Count extends Widget_Base {

	public function get_name() {
		return 'fl-stock-count';
	}

	public function get_title() {
		return __( 'FL Stock Count', 'watson' );
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
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'stock-limit',
			[
				'label' => __( 'Show when under __ items in stock:', 'watson' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 3,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$stock_limit = $settings[ 'stock-limit' ];
		global $product;
		if ( $product ) {
			$stock_quantity = $product->get_stock_quantity() ?? null;
//		debug( $stock_quantity );
			if ( $stock_quantity and $stock_quantity < $stock_limit ) { ?>
				<div class="fl-stock-count">
					Få på lager
				</div>
				<?php
			}
		}
	}
}