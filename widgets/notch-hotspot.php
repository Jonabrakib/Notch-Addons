<?php
namespace Elementor;
class Notch_Hotspot extends Widget_Base {

    public function get_name() {
        return  'notch-hotspot-id';
    }

    public function get_title() {
        return esc_html__( 'Notch Hotspot', 'notch-addons' );
    }


    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'notch-category' ];
    }
    protected function _register_controls() {}

	protected function render() {}

	protected function _content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new Notch_Hotspot() );