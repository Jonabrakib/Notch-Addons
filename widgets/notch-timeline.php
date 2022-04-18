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
		// Content Section
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

		// Style Section
		//Line
		$this->start_controls_section(
			'timeline_line_style',
			[
				'label' => __( 'Line', 'notch-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bar_background',
				'label' => esc_html__( 'Line Background', 'notch-addons' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .notch-timeline:before',
			]
		);
		$this->add_control(
			'timeline_line_width',
			[
				'label' => esc_html__( 'Width', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors' => [
					'{{WRAPPER}} .notch-timeline:before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		//Title
		$this->start_controls_section(
			'timeline_title_style',
			[
				'label' => __( 'Title', 'notch-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'timeline_title_typography',
				'selector' => '{{WRAPPER}} .notch-timeline-flag',
			]
		);
		$this->add_control(
			'timeline_title_color',
			[
				'label' => esc_html__( 'Title Color', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-flag' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'timeline_title_background',
				'label' => esc_html__( 'Background', 'notch-addons' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .notch-timeline-flag',
			]
		);
		$this->add_control(
			'timeline_title_padding',
			[
				'label' => esc_html__( 'Padding', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-flag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'timeline_title_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-flag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//Date
		$this->start_controls_section(
			'timeline_date_style',
			[
				'label' => __( 'Date', 'notch-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'timeline_date_typography',
				'selector' => '{{WRAPPER}} .notch-timeline-time',
			]
		);
		$this->add_control(
			'timeline_date_color',
			[
				'label' => esc_html__( 'Date Color', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-time' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'timeline_date_background',
				'label' => esc_html__( 'Background', 'notch-addons' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .notch-timeline-time',
			]
		);
		$this->add_control(
			'timeline_date_padding',
			[
				'label' => esc_html__( 'Padding', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'timeline_date_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-time' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Content
		$this->start_controls_section(
			'timeline_content_style',
			[
				'label' => __( 'Content', 'notch-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'timeline_content_typography',
				'selector' => '{{WRAPPER}} .notch-timeline-desc',
			]
		);
		$this->add_control(
			'timeline_content_color',
			[
				'label' => esc_html__( 'Content Color', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-desc' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'timeline_content_margin',
			[
				'label' => esc_html__( 'Margin Top', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-desc' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		//Dots
		$this->start_controls_section(
			'timeline_dots_style',
			[
				'label' => __( 'Dots', 'notch-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'timeline_dots_border_color',
			[
				'label' => esc_html__( 'Border Color', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-flag:before' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'timeline_dots_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-flag:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'timeline_dots_border-radius',
			[
				'label' => esc_html__( 'Border Radius', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-flag:before' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'timeline_dots_h',
			[
				'label' => esc_html__( 'Height', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-flag:before' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'timeline_dots_w',
			[
				'label' => esc_html__( 'Width', 'notch-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .notch-timeline-flag:before' => 'width: {{SIZE}}{{UNIT}};',
				],
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