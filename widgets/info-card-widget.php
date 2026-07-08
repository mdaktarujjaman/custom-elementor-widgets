<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// widgets/info-card-widget.php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

class Itzone360_Info_Card_Widget extends Widget_Base {

    public function get_name()  { return 'info_card'; }
    public function get_title() { return 'Info Card'; }
    public function get_icon()  { return 'eicon-info-box'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {

        // ── CONTENT TAB ──────────────────────────────
        $this->start_controls_section( 'content_section', [
            'label' => 'Content',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'icon', [
            'label'   => 'Icon',
            'type'    => Controls_Manager::ICONS,
            'default' => [ 'value' => 'fas fa-star', 'library' => 'fa-solid' ],
        ]);

        $this->add_control( 'title', [
            'label'   => 'Title',
            'type'    => Controls_Manager::TEXT,
            'default' => 'Card Title',
        ]);

        $this->add_control( 'description', [
            'label'   => 'Description',
            'type'    => Controls_Manager::TEXTAREA,
            'default' => 'Add your description here.',
        ]);

        $this->add_control( 'button_text', [
            'label'   => 'Button Text',
            'type'    => Controls_Manager::TEXT,
            'default' => 'Learn More',
        ]);

        $this->add_control( 'button_url', [
            'label'       => 'Button URL',
            'type'        => Controls_Manager::URL,
            'placeholder' => 'https://example.com',
        ]);

        $this->end_controls_section();

        // ── STYLE TAB ────────────────────────────────
        $this->start_controls_section( 'style_section', [
            'label' => 'Card Style',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'card_bg', [
            'label'     => 'Background Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [ '{{WRAPPER}} .cew-info-card' => 'background-color: {{VALUE}}' ],
        ]);

        $this->add_control( 'card_padding', [
            'label'      => 'Padding',
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .cew-info-card' =>
                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ],
        ]);

        $this->add_control( 'border_radius', [
            'label'      => 'Border Radius',
            'type'       => Controls_Manager::SLIDER,
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
            'default'    => [ 'size' => 8 ],
            'selectors'  => [
                '{{WRAPPER}} .cew-info-card' => 'border-radius: {{SIZE}}px;'
            ],
        ]);

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'card_shadow',
            'selector' => '{{WRAPPER}} .cew-info-card',
        ]);

        $this->add_control( 'icon_color', [
            'label'     => 'Icon Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1a56db',
            'selectors' => [ '{{WRAPPER}} .cew-info-card__icon i' => 'color: {{VALUE}}' ],
        ]);

        $this->add_control( 'title_color', [
            'label'     => 'Title Color',
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .cew-info-card__title' => 'color: {{VALUE}}' ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'title_typography',
            'selector' => '{{WRAPPER}} .cew-info-card__title',
        ]);

        $this->add_control( 'btn_bg', [
            'label'     => 'Button Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1a56db',
            'selectors' => [ '{{WRAPPER}} .cew-info-card__btn' => 'background-color: {{VALUE}}' ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $s   = $this->get_settings_for_display();
        $url = ! empty( $s['button_url']['url'] ) ? $s['button_url']['url'] : '#';
        $target = $s['button_url']['is_external'] ? '_blank' : '_self';
        ?>
        <div class="cew-info-card">
            <div class="cew-info-card__icon">
                <?php \Elementor\Icons_Manager::render_icon( $s['icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </div>
            <h3 class="cew-info-card__title">
                <?php echo esc_html( $s['title'] ); ?>
            </h3>
            <p class="cew-info-card__desc">
                <?php echo esc_html( $s['description'] ); ?>
            </p>
            <?php if ( ! empty( $s['button_text'] ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>"
                   target="<?php echo esc_attr( $target ); ?>"
                   class="cew-info-card__btn">
                    <?php echo esc_html( $s['button_text'] ); ?>
                </a>
            <?php endif; ?>
        </div>
        <?php
    }
}