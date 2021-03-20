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
    protected function _register_controls() {}

	protected function render() {}

	protected function _content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new Notch_Timeline() );