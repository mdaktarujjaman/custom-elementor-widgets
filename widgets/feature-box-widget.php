<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// widgets/feature-box-widget.php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

class Itzone360_Feature_Box_Widget extends Widget_Base {

    public function get_name()  { return 'feature_box'; }
    public function get_title() { return 'Feature Box'; }
    public function get_icon()  { return 'eicon-featured-image'; }
    public function get_categories() { return [ 'general' ]; }
    public function get_keywords() { return [ 'feature', 'box', 'icon', 'card' ]; }

    protected function register_controls() {

        // ── CONTENT TAB ──────────────────────────────
        $this->start_controls_section( 'content_section', [
            'label' => 'Content',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'media_type', [
            'label'   => 'Media Type',
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'icon'  => [ 'title' => 'Icon',  'icon' => 'eicon-star' ],
                'image' => [ 'title' => 'Image', 'icon' => 'eicon-image' ],
            ],
            'default' => 'icon',
            'toggle'  => false,
        ]);

        $this->add_control( 'icon', [
            'label'     => 'Icon',
            'type'      => Controls_Manager::ICONS,
            'default'   => [ 'value' => 'fas fa-check-circle', 'library' => 'fa-solid' ],
            'condition' => [ 'media_type' => 'icon' ],
        ]);

        $this->add_control( 'image', [
            'label'     => 'Image',
            'type'      => Controls_Manager::MEDIA,
            'default'   => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            'condition' => [ 'media_type' => 'image' ],
        ]);

        $this->add_control( 'title', [
            'label'   => 'Title',
            'type'    => Controls_Manager::TEXT,
            'default' => 'Fast Delivery',
        ]);

        $this->add_control( 'description', [
            'label'   => 'Description',
            'type'    => Controls_Manager::TEXTAREA,
            'default' => 'Add your feature description here.',
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

        $this->add_control( 'alignment', [
            'label'   => 'Alignment',
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left'   => [ 'title' => 'Left',   'icon' => 'eicon-text-align-left' ],
                'center' => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => 'Right',  'icon' => 'eicon-text-align-right' ],
            ],
            'default'   => 'left',
            'selectors_dictionary' => [
                'left'   => 'flex-start',
                'center' => 'center',
                'right'  => 'flex-end',
            ],
            'selectors' => [
                '{{WRAPPER}} .cew-feature-box' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
            ],
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: BOX ───────────────────────────
        $this->start_controls_section( 'style_box_section', [
            'label' => 'Box',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'box_bg',
            'types'    => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .cew-feature-box',
        ]);

        $this->add_control( 'box_padding', [
            'label'      => 'Padding',
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'default'    => [ 'top' => 32, 'right' => 32, 'bottom' => 32, 'left' => 32, 'unit' => 'px' ],
            'selectors'  => [
                '{{WRAPPER}} .cew-feature-box' =>
                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'border_radius', [
            'label'      => 'Border Radius',
            'type'       => Controls_Manager::SLIDER,
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 60 ] ],
            'default'    => [ 'size' => 8 ],
            'selectors'  => [
                '{{WRAPPER}} .cew-feature-box' => 'border-radius: {{SIZE}}px;',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'box_border',
            'selector' => '{{WRAPPER}} .cew-feature-box',
        ]);

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'box_shadow',
            'selector' => '{{WRAPPER}} .cew-feature-box',
        ]);

        $this->add_control( 'hover_shadow_heading', [
            'label'     => 'Hover Shadow',
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'box_hover_shadow',
            'selector' => '{{WRAPPER}} .cew-feature-box:hover',
        ]);

        $this->add_control( 'hover_lift', [
            'label'        => 'Lift on Hover',
            'type'         => Controls_Manager::SWITCHER,
            'default'      => 'yes',
            'prefix_class' => 'cew-feature-box-lift-',
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: ICON / IMAGE ──────────────────
        $this->start_controls_section( 'style_icon_section', [
            'label' => 'Icon / Image',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'icon_color', [
            'label'     => 'Icon Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1a56db',
            'condition' => [ 'media_type' => 'icon' ],
            'selectors' => [ '{{WRAPPER}} .cew-feature-box__icon i' => 'color: {{VALUE}}' ],
        ]);

        $this->add_control( 'icon_size', [
            'label'     => 'Icon Size',
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 16, 'max' => 100 ] ],
            'default'   => [ 'size' => 40 ],
            'condition' => [ 'media_type' => 'icon' ],
            'selectors' => [ '{{WRAPPER}} .cew-feature-box__icon i' => 'font-size: {{SIZE}}px' ],
        ]);

        $this->add_control( 'image_width', [
            'label'     => 'Image Width',
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 30, 'max' => 300 ] ],
            'default'   => [ 'size' => 64 ],
            'condition' => [ 'media_type' => 'image' ],
            'selectors' => [ '{{WRAPPER}} .cew-feature-box__icon img' => 'width: {{SIZE}}px' ],
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: TYPOGRAPHY ─────────────────────
        $this->start_controls_section( 'style_text_section', [
            'label' => 'Typography',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'title_color', [
            'label'     => 'Title Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#111111',
            'selectors' => [ '{{WRAPPER}} .cew-feature-box__title' => 'color: {{VALUE}}' ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'title_typography',
            'selector' => '{{WRAPPER}} .cew-feature-box__title',
        ]);

        $this->add_control( 'desc_color', [
            'label'     => 'Description Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#555555',
            'selectors' => [ '{{WRAPPER}} .cew-feature-box__desc' => 'color: {{VALUE}}' ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'desc_typography',
            'selector' => '{{WRAPPER}} .cew-feature-box__desc',
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: BUTTON ─────────────────────────
        $this->start_controls_section( 'style_button_section', [
            'label'     => 'Button',
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'button_text!' => '' ],
        ]);

        $this->add_control( 'btn_bg', [
            'label'     => 'Button Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1a56db',
            'selectors' => [ '{{WRAPPER}} .cew-feature-box__btn' => 'background-color: {{VALUE}}' ],
        ]);

        $this->add_control( 'btn_text_color', [
            'label'     => 'Button Text Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [ '{{WRAPPER}} .cew-feature-box__btn' => 'color: {{VALUE}}' ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $s      = $this->get_settings_for_display();
        $url    = ! empty( $s['button_url']['url'] ) ? $s['button_url']['url'] : '#';
        $target = ! empty( $s['button_url']['is_external'] ) ? '_blank' : '_self';
        ?>
        <div class="cew-feature-box">
            <div class="cew-feature-box__icon">
                <?php if ( 'image' === $s['media_type'] && ! empty( $s['image']['url'] ) ) : ?>
                    <img src="<?php echo esc_url( $s['image']['url'] ); ?>" alt="<?php echo esc_attr( $s['title'] ); ?>">
                <?php else : ?>
                    <?php \Elementor\Icons_Manager::render_icon( $s['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php endif; ?>
            </div>
            <h3 class="cew-feature-box__title">
                <?php echo esc_html( $s['title'] ); ?>
            </h3>
            <p class="cew-feature-box__desc">
                <?php echo esc_html( $s['description'] ); ?>
            </p>
            <?php if ( ! empty( $s['button_text'] ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>"
                   target="<?php echo esc_attr( $target ); ?>"
                   class="cew-feature-box__btn">
                    <?php echo esc_html( $s['button_text'] ); ?>
                </a>
            <?php endif; ?>
        </div>
        <?php
    }
}
