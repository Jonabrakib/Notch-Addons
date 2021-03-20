<?php
namespace Elementor;
class Notch_Timeline extends Widget_Base {

    public function get_name() {
        return  'notch-timeline-id';
    }

    public function get_title() {
        return esc_html__( 'Notch Timeline', 'notch-addons' );
    }


    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_categories() {
        return [ 'notch-category' ];
    }
    protected function _register_controls() {
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'notch-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'widget_title',
			[
				'label' => __( 'Title', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'notch-addons' ),
				'placeholder' => __( 'Type your title here', 'notch-addons' ),
			]
		);

		$this->end_controls_section();
    }

	protected function render() {
        require NOTCH_ADDONS_PATH . 'templates/notch-timeline.php';
    }

	protected function _content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new Notch_Timeline() );