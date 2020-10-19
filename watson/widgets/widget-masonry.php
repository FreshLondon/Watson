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
		return 'fa fa-list-alt';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		wp_register_script( 'fancybox-js', get_stylesheet_directory_uri() . '/assets/app/dist/jquery.fancybox.min.js', [ 'elementor-frontend' ], '3.5.7', true );
		wp_register_style( 'fancybox-css', get_stylesheet_directory_uri() . '/assets/app/dist/jquery.fancybox.min.css', [ 'elementor-frontend' ], '3.5.7', 'screen' );
	}

	public function get_script_depends() {
		return [ 'fancybox-js' ];
	}

	public function get_style_depends() {
		return [ 'fancybox-css' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'elementor' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'elementor' ),
			]
		);


		$this->add_control(
			'gallery',
			[
				'label'   => __( 'Add Images', 'plugin-domain' ),
				'type'    => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
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

		if ( $settings['title'] ) { ?>
            <h3><?= $settings['title']; ?></h3>
		<?php } ?>


        <div class="masonry">
			<?php
			$images = $settings['gallery'];
			shuffle( $images );
			foreach ( $images as $image ) {
				$image_small = wp_get_attachment_image_src( $image['id'], 'medium_large' );
//				debug($image_small);
			    ?>

                <img class="masonry-item" src="<?= $image_small[0]; ?>" data-fancybox="gallery" data-src="<?= $image['url']; ?>">
				<?php
			}
			?>
        </div>
		<?php
	}

	protected function _content_template() {

	}


}