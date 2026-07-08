<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// widgets/counter-widget.php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Itzone360_Counter_Widget extends Widget_Base {

    public function get_name()  { return 'itzone360_counter'; }
    public function get_title() { return 'ITzone360 Counter'; }
    public function get_icon()  { return 'eicon-counter'; }
    public function get_categories() { return [ 'general' ]; }
    public function get_keywords() { return [ 'counter', 'number', 'stats', 'animation' ]; }

    public function get_script_depends() {
        return [ 'itzone360-counter' ];
    }

    protected function register_controls() {

        // ── CONTENT TAB ──────────────────────────────
        $this->start_controls_section( 'content_section', [
            'label' => 'Counter',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'starting_number', [
            'label'   => 'Starting Number',
            'type'    => Controls_Manager::NUMBER,
            'default' => 0,
        ]);

        $this->add_control( 'ending_number', [
            'label'   => 'Ending Number',
            'type'    => Controls_Manager::NUMBER,
            'default' => 500,
        ]);

        $this->add_control( 'prefix', [
            'label'   => 'Prefix',
            'type'    => Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => '$',
        ]);

        $this->add_control( 'suffix', [
            'label'   => 'Suffix',
            'type'    => Controls_Manager::TEXT,
            'default' => '+',
            'placeholder' => '+',
        ]);

        $this->add_control( 'title', [
            'label'   => 'Label',
            'type'    => Controls_Manager::TEXT,
            'default' => 'Projects Completed',
        ]);

        $this->add_control( 'duration', [
            'label'   => 'Animation Duration (ms)',
            'type'    => Controls_Manager::NUMBER,
            'default' => 2000,
            'min'     => 200,
            'max'     => 10000,
            'step'    => 100,
        ]);

        $this->add_control( 'thousand_separator', [
            'label'        => 'Thousands Separator',
            'type'         => Controls_Manager::SWITCHER,
            'default'      => 'yes',
        ]);

        $this->add_control( 'alignment', [
            'label'   => 'Alignment',
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left'   => [ 'title' => 'Left',   'icon' => 'eicon-text-align-left' ],
                'center' => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => 'Right',  'icon' => 'eicon-text-align-right' ],
            ],
            'default'   => 'center',
            'selectors' => [
                '{{WRAPPER}} .cew-counter' => 'text-align: {{VALUE}};',
            ],
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: NUMBER ─────────────────────────
        $this->start_controls_section( 'style_number_section', [
            'label' => 'Number',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'number_color', [
            'label'     => 'Number Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1a56db',
            'selectors' => [ '{{WRAPPER}} .cew-counter__number' => 'color: {{VALUE}}' ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'number_typography',
            'selector' => '{{WRAPPER}} .cew-counter__number',
            'fields_options' => [
                'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 48 ] ],
                'font_weight' => [ 'default' => '700' ],
            ],
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: LABEL ──────────────────────────
        $this->start_controls_section( 'style_label_section', [
            'label' => 'Label',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'label_color', [
            'label'     => 'Label Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#555555',
            'selectors' => [ '{{WRAPPER}} .cew-counter__label' => 'color: {{VALUE}}' ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'label_typography',
            'selector' => '{{WRAPPER}} .cew-counter__label',
            'fields_options' => [
                'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 16 ] ],
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();

        $this->add_render_attribute( 'number', [
            'class' => 'cew-counter__number',
            'data-start'     => (int) $s['starting_number'],
            'data-end'       => (int) $s['ending_number'],
            'data-duration'  => (int) $s['duration'],
            'data-separator' => $s['thousand_separator'] === 'yes' ? '1' : '0',
            'data-prefix'    => esc_attr( $s['prefix'] ),
            'data-suffix'    => esc_attr( $s['suffix'] ),
        ]);
        ?>
        <div class="cew-counter">
            <div <?php echo $this->get_render_attribute_string( 'number' ); ?>>
                <?php echo esc_html( $s['prefix'] . $s['starting_number'] . $s['suffix'] ); ?>
            </div>
            <?php if ( ! empty( $s['title'] ) ) : ?>
                <div class="cew-counter__label">
                    <?php echo esc_html( $s['title'] ); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
}