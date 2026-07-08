<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// widgets/pricing-box-widget.php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

class Itzone360_Pricing_Box_Widget extends Widget_Base {

    public function get_name()  { return 'itzone360_pricing_box'; }
    public function get_title() { return 'ITzone360 Pricing Box'; }
    public function get_icon()  { return 'eicon-price-table'; }
    public function get_categories() { return [ 'general' ]; }
    public function get_keywords() { return [ 'pricing', 'price', 'plan', 'package', 'table' ]; }

    protected function register_controls() {

        // ── CONTENT TAB: PLAN ──────────────────────────
        $this->start_controls_section( 'plan_section', [
            'label' => 'Plan',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'plan_name', [
            'label'   => 'Plan Name',
            'type'    => Controls_Manager::TEXT,
            'default' => 'Basic',
        ]);

        $this->add_control( 'featured', [
            'label'        => 'Highlight as Featured',
            'type'         => Controls_Manager::SWITCHER,
            'default'      => '',
            'prefix_class' => 'cew-pricing-box-featured-',
        ]);

        $this->add_control( 'featured_label', [
            'label'     => 'Featured Badge Text',
            'type'      => Controls_Manager::TEXT,
            'default'   => 'Most Popular',
            'condition' => [ 'featured' => 'yes' ],
        ]);

        $this->add_control( 'currency', [
            'label'   => 'Currency Symbol',
            'type'    => Controls_Manager::TEXT,
            'default' => '$',
        ]);

        $this->add_control( 'price', [
            'label'   => 'Price',
            'type'    => Controls_Manager::TEXT,
            'default' => '29',
        ]);

        $this->add_control( 'period', [
            'label'   => 'Period',
            'type'    => Controls_Manager::TEXT,
            'default' => '/month',
        ]);

        $this->end_controls_section();

        // ── CONTENT TAB: FEATURES (REPEATER) ────────────
        $this->start_controls_section( 'features_section', [
            'label' => 'Features',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $repeater = new Repeater();

        $repeater->add_control( 'feature_text', [
            'label'       => 'Feature',
            'type'        => Controls_Manager::TEXT,
            'default'     => 'Feature item',
            'label_block' => true,
        ]);

        $repeater->add_control( 'included', [
            'label'        => 'Included',
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => 'Yes',
            'label_off'    => 'No',
            'default'      => 'yes',
        ]);

        $this->add_control( 'features', [
            'label'       => 'Feature List',
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [
                [ 'feature_text' => 'Feature One',   'included' => 'yes' ],
                [ 'feature_text' => 'Feature Two',   'included' => 'yes' ],
                [ 'feature_text' => 'Feature Three', 'included' => 'no' ],
            ],
            'title_field' => '{{{ feature_text }}}',
        ]);

        $this->end_controls_section();

        // ── CONTENT TAB: BUTTON ──────────────────────────
        $this->start_controls_section( 'button_section', [
            'label' => 'Button',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'button_text', [
            'label'   => 'Button Text',
            'type'    => Controls_Manager::TEXT,
            'default' => 'Choose Plan',
        ]);

        $this->add_control( 'button_url', [
            'label'       => 'Button URL',
            'type'        => Controls_Manager::URL,
            'placeholder' => 'https://example.com',
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: CARD ────────────────────────────
        $this->start_controls_section( 'style_card_section', [
            'label' => 'Card',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'card_bg', [
            'label'     => 'Background Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [ '{{WRAPPER}} .cew-pricing-box' => 'background-color: {{VALUE}}' ],
        ]);

        $this->add_control( 'card_padding', [
            'label'      => 'Padding',
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'default'    => [ 'top' => 40, 'right' => 32, 'bottom' => 40, 'left' => 32, 'unit' => 'px' ],
            'selectors'  => [
                '{{WRAPPER}} .cew-pricing-box' =>
                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'card_border_radius', [
            'label'      => 'Border Radius',
            'type'       => Controls_Manager::SLIDER,
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
            'default'    => [ 'size' => 12 ],
            'selectors'  => [
                '{{WRAPPER}} .cew-pricing-box' => 'border-radius: {{SIZE}}px;',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'card_border',
            'selector' => '{{WRAPPER}} .cew-pricing-box',
        ]);

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'card_shadow',
            'selector' => '{{WRAPPER}} .cew-pricing-box',
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: FEATURED BADGE ────────────────────
        $this->start_controls_section( 'style_featured_section', [
            'label'     => 'Featured Style',
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'featured' => 'yes' ],
        ]);

        $this->add_control( 'featured_border_color', [
            'label'     => 'Featured Border Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1a56db',
            'selectors' => [ '{{WRAPPER}}.cew-pricing-box-featured-yes .cew-pricing-box' => 'border: 2px solid {{VALUE}};' ],
        ]);

        $this->add_control( 'badge_bg', [
            'label'     => 'Badge Background',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1a56db',
            'selectors' => [ '{{WRAPPER}} .cew-pricing-box__badge' => 'background-color: {{VALUE}}' ],
        ]);

        $this->add_control( 'badge_color', [
            'label'     => 'Badge Text Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [ '{{WRAPPER}} .cew-pricing-box__badge' => 'color: {{VALUE}}' ],
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: PRICE ──────────────────────────────
        $this->start_controls_section( 'style_price_section', [
            'label' => 'Price',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'plan_name_color', [
            'label'     => 'Plan Name Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#555555',
            'selectors' => [ '{{WRAPPER}} .cew-pricing-box__plan-name' => 'color: {{VALUE}}' ],
        ]);

        $this->add_control( 'price_color', [
            'label'     => 'Price Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#111111',
            'selectors' => [ '{{WRAPPER}} .cew-pricing-box__price' => 'color: {{VALUE}}' ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'price_typography',
            'selector' => '{{WRAPPER}} .cew-pricing-box__price',
            'fields_options' => [
                'font_size'   => [ 'default' => [ 'unit' => 'px', 'size' => 44 ] ],
                'font_weight' => [ 'default' => '700' ],
            ],
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: FEATURE LIST ────────────────────────
        $this->start_controls_section( 'style_features_section', [
            'label' => 'Feature List',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'feature_text_color', [
            'label'     => 'Text Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#333333',
            'selectors' => [ '{{WRAPPER}} .cew-pricing-box__feature' => 'color: {{VALUE}}' ],
        ]);

        $this->add_control( 'feature_included_color', [
            'label'     => 'Included Icon Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#2e9e5b',
            'selectors' => [ '{{WRAPPER}} .cew-pricing-box__feature-icon--yes' => 'color: {{VALUE}}' ],
        ]);

        $this->add_control( 'feature_excluded_color', [
            'label'     => 'Excluded Icon Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#c0c0c0',
            'selectors' => [ '{{WRAPPER}} .cew-pricing-box__feature-icon--no' => 'color: {{VALUE}}' ],
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: BUTTON ────────────────────────────
        $this->start_controls_section( 'style_button_section', [
            'label' => 'Button',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'btn_bg', [
            'label'     => 'Button Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1a56db',
            'selectors' => [ '{{WRAPPER}} .cew-pricing-box__btn' => 'background-color: {{VALUE}}' ],
        ]);

        $this->add_control( 'btn_text_color', [
            'label'     => 'Button Text Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [ '{{WRAPPER}} .cew-pricing-box__btn' => 'color: {{VALUE}}' ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $s      = $this->get_settings_for_display();
        $url    = ! empty( $s['button_url']['url'] ) ? $s['button_url']['url'] : '#';
        $target = ! empty( $s['button_url']['is_external'] ) ? '_blank' : '_self';
        ?>
        <div class="cew-pricing-box">
            <?php if ( 'yes' === $s['featured'] && ! empty( $s['featured_label'] ) ) : ?>
                <div class="cew-pricing-box__badge">
                    <?php echo esc_html( $s['featured_label'] ); ?>
                </div>
            <?php endif; ?>

            <div class="cew-pricing-box__plan-name">
                <?php echo esc_html( $s['plan_name'] ); ?>
            </div>

            <div class="cew-pricing-box__price">
                <span class="cew-pricing-box__currency"><?php echo esc_html( $s['currency'] ); ?></span><?php echo esc_html( $s['price'] ); ?><span class="cew-pricing-box__period"><?php echo esc_html( $s['period'] ); ?></span>
            </div>

            <?php if ( ! empty( $s['features'] ) ) : ?>
                <ul class="cew-pricing-box__features">
                    <?php foreach ( $s['features'] as $item ) : ?>
                        <?php $included = 'yes' === $item['included']; ?>
                        <li class="cew-pricing-box__feature">
                            <span class="cew-pricing-box__feature-icon <?php echo $included ? 'cew-pricing-box__feature-icon--yes' : 'cew-pricing-box__feature-icon--no'; ?>" aria-hidden="true">
                                <?php echo $included ? '&#10003;' : '&#10005;'; ?>
                            </span>
                            <span><?php echo esc_html( $item['feature_text'] ); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if ( ! empty( $s['button_text'] ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>"
                   target="<?php echo esc_attr( $target ); ?>"
                   class="cew-pricing-box__btn">
                    <?php echo esc_html( $s['button_text'] ); ?>
                </a>
            <?php endif; ?>
        </div>
        <?php
    }
}
