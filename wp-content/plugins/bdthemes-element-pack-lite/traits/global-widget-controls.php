<?php
	namespace ElementPack\Traits;
	
	use Elementor\Controls_Manager;
	use Elementor\Group_Control_Background;
	use Elementor\Group_Control_Border;
	use Elementor\Group_Control_Typography;
	
	
	defined( 'ABSPATH' ) || die();
	
	trait Global_Widget_Controls {
		
		protected function register_pagination_controls() {

			$this->start_controls_tabs( 'tabs_pagination_style' );

			$this->start_controls_tab(
				'tab_pagination_normal',
				[
					'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
				]
			);

			$this->add_control(
				'pagination_color',
				[
					'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} ul.bdt-pagination li a, {{WRAPPER}} ul.bdt-pagination li span' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'      => 'pagination_background',
					'types'     => [ 'classic', 'gradient' ],
					'selector'  => '{{WRAPPER}} ul.bdt-pagination li a',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'pagination_border',
					'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
					'selector'    => '{{WRAPPER}} ul.bdt-pagination li a',
				]
			);

			$this->add_responsive_control(
				'pagination_offset',
				[
					'label'     => esc_html__( 'Offset', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::SLIDER,
					'selectors' => [
						'{{WRAPPER}} .bdt-pagination' => 'margin-top: {{SIZE}}px;',
					],
				]
			);

			$this->add_responsive_control(
				'pagination_space',
				[
					'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::SLIDER,
					'selectors' => [
						'{{WRAPPER}} .bdt-pagination' => 'margin-left: {{SIZE}}px;',
						'{{WRAPPER}} .bdt-pagination > *' => 'padding-left: {{SIZE}}px;',
					],
				]
			);

			$this->add_responsive_control(
				'pagination_padding',
				[
					'label'     => esc_html__( 'Padding', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::DIMENSIONS,
					'selectors' => [
						'{{WRAPPER}} ul.bdt-pagination li a' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					],
				]
			);

			$this->add_responsive_control(
				'pagination_radius',
				[
					'label'     => esc_html__( 'Radius', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::DIMENSIONS,
					'selectors' => [
						'{{WRAPPER}} ul.bdt-pagination li a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					],
				]
			);

			$this->add_responsive_control(
				'pagination_arrow_size',
				[
					'label'     => esc_html__( 'Arrow Size', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::SLIDER,
					'selectors' => [
						'{{WRAPPER}} ul.bdt-pagination li a svg' => 'height: {{SIZE}}px; width: auto;',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'pagination_typography',
					'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
					'selector' => '{{WRAPPER}} ul.bdt-pagination li a, {{WRAPPER}} ul.bdt-pagination li span',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_pagination_hover',
				[
					'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
				]
			);

			$this->add_control(
				'pagination_hover_color',
				[
					'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} ul.bdt-pagination li a:hover, {{WRAPPER}} ul.bdt-pagination li a:hover span' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'pagination_hover_border_color',
				[
					'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} ul.bdt-pagination li a:hover' => 'border-color: {{VALUE}};',
					],
					'condition' => [
						'pagination_border_border!' => ''
					]
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'      => 'pagination_hover_background',
					'types'     => [ 'classic', 'gradient' ],
					'selector'  => '{{WRAPPER}} ul.bdt-pagination li a:hover',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_pagination_active',
				[
					'label' => esc_html__( 'Active', 'bdthemes-element-pack' ),
				]
			);

			$this->add_control(
				'pagination_active_color',
				[
					'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} ul.bdt-pagination li.bdt-active a, {{WRAPPER}} ul.bdt-pagination li.bdt-active span' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'pagination_active_border_color',
				[
					'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} ul.bdt-pagination li.bdt-active a' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'pagination_active_background',
					'selector' => '{{WRAPPER}} ul.bdt-pagination li.bdt-active a',
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();	

		}
	}