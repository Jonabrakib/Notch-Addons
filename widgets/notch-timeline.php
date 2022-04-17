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
    protected function register_controls() {
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Timeline Content', 'notch-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'timeline_title', [
				'label' => esc_html__( 'Title', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'timeline_date', [
				'label' => esc_html__( 'Date', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'timeline_content', [
				'label' => esc_html__( 'Content', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);

		$this->add_control(
			'timeline',
			[
				'label' => esc_html__( 'Timeline List', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'timeline_title' => esc_html__( 'Freelancer', 'notch-addons' ),
						'timeline_date' => esc_html__( '2013 - present', 'notch-addons' ),
						'timeline_content' => esc_html__( 'My current employment. Way better than the position before!', 'notch-addons' ),
					],
					[
						'timeline_title' => esc_html__( 'Apple Inc.', 'notch-addons' ),
						'timeline_date' => esc_html__( '2011 - 2013', 'notch-addons' ),
						'timeline_content' => esc_html__( "My first employer. All the stuff I've learned and projects I've been working on.", 'notch-addons' ),
					],
					[
						'timeline_title' => esc_html__( 'Harvard University', 'notch-addons' ),
						'timeline_date' => esc_html__( '2008 - 2011', 'notch-addons' ),
						'timeline_content' => esc_html__( 'A notch-timeline-description of all the lectures and courses I have taken and my final degree?', 'notch-addons' ),
					],
				],
				'title_field' => '{{{ timeline_title }}}',
			]
		);


		$this->end_controls_section();
    }

	protected function render() {
		$settings = $this->get_settings_for_display();
		$timeline = $settings['timeline'];
		$count=1;
		$alter_class='';
		?>
		<ul class="notch-timeline">
		<?php
		foreach ( $timeline as $item ) {
			if($count % 2 == 0){
				$alter_class = 'l';
			}else{
				$alter_class = 'r';
			}
        	require NOTCH_ADDONS_PATH . 'templates/notch-timeline.php';
			$count++;
		}
		?>
		</ul>
		<?php
    }

	protected function content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new Notch_Timeline() );