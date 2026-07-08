<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// widgets/testimonial-widget.php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

class Itzone360_Testimonial_Widget extends Widget_Base {

    public function get_name()  { return 'itzone360_testimonial'; }
    public function get_title() { return 'ITzone360 Testimonial'; }
    public function get_icon()  { return 'eicon-testimonial'; }
    public function get_categories() { return [ 'general' ]; }
    public function get_keywords() { return [ 'testimonial', 'review', 'rating', 'client', 'feedback' ]; }

    protected function register_controls() {

        // ── CONTENT TAB ──────────────────────────────
        $this->start_controls_section( 'content_section', [
            'label' => 'Content',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'rating', [
            'label'   => 'Rating',
            'type'    => Controls_Manager::SELECT,
            'default' => '5',
            'options' => [
                '1' => '★☆☆☆☆ (1)',
                '2' => '★★☆☆☆ (2)',
                '3' => '★★★☆☆ (3)',
                '4' => '★★★★☆ (4)',
                '5' => '★★★★★ (5)',
            ],
        ]);

        $this->add_control( 'review', [
            'label'   => 'Review',
            'type'    => Controls_Manager::TEXTAREA,
            'rows'    => 4,
            'default' => 'Excellent service. Highly recommended for anyone looking for quality and reliability.',
        ]);

        $this->add_control( 'client_image', [
            'label'   => 'Client Image',
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ]);

        $this->add_control( 'client_name', [
            'label'   => 'Name',
            'type'    => Controls_Manager::TEXT,
            'default' => 'John Doe',
        ]);

        $this->add_control( 'company', [
            'label'   => 'Company',
            'type'    => Controls_Manager::TEXT,
            'default' => 'Google',
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
                '{{WRAPPER}} .cew-testimonial' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
            ],
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
            'selectors' => [ '{{WRAPPER}} .cew-testimonial' => 'background-color: {{VALUE}}' ],
        ]);

        $this->add_control( 'card_padding', [
            'label'      => 'Padding',
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'default'    => [ 'top' => 32, 'right' => 32, 'bottom' => 32, 'left' => 32, 'unit' => 'px' ],
            'selectors'  => [
                '{{WRAPPER}} .cew-testimonial' =>
                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'card_border_radius', [
            'label'      => 'Border Radius',
            'type'       => Controls_Manager::SLIDER,
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
            'default'    => [ 'size' => 8 ],
            'selectors'  => [
                '{{WRAPPER}} .cew-testimonial' => 'border-radius: {{SIZE}}px;',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'card_border',
            'selector' => '{{WRAPPER}} .cew-testimonial',
        ]);

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'card_shadow',
            'selector' => '{{WRAPPER}} .cew-testimonial',
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: RATING ──────────────────────────
        $this->start_controls_section( 'style_rating_section', [
            'label' => 'Rating',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'star_color', [
            'label'     => 'Filled Star Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#f5a623',
            'selectors' => [ '{{WRAPPER}} .cew-testimonial__star--filled' => 'color: {{VALUE}}' ],
        ]);

        $this->add_control( 'star_empty_color', [
            'label'     => 'Empty Star Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#e0e0e0',
            'selectors' => [ '{{WRAPPER}} .cew-testimonial__star--empty' => 'color: {{VALUE}}' ],
        ]);

        $this->add_control( 'star_size', [
            'label'     => 'Star Size',
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 10, 'max' => 32 ] ],
            'default'   => [ 'size' => 16 ],
            'selectors' => [ '{{WRAPPER}} .cew-testimonial__rating' => 'font-size: {{SIZE}}px;' ],
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: REVIEW TEXT ──────────────────────
        $this->start_controls_section( 'style_review_section', [
            'label' => 'Review Text',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'review_color', [
            'label'     => 'Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#333333',
            'selectors' => [ '{{WRAPPER}} .cew-testimonial__review' => 'color: {{VALUE}}' ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'review_typography',
            'selector' => '{{WRAPPER}} .cew-testimonial__review',
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: CLIENT INFO ───────────────────────
        $this->start_controls_section( 'style_client_section', [
            'label' => 'Client Info',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'photo_size', [
            'label'     => 'Photo Size',
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 30, 'max' => 120 ] ],
            'default'   => [ 'size' => 48 ],
            'selectors' => [
                '{{WRAPPER}} .cew-testimonial__photo img' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
            ],
        ]);

        $this->add_control( 'name_color', [
            'label'     => 'Name Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#111111',
            'selectors' => [ '{{WRAPPER}} .cew-testimonial__name' => 'color: {{VALUE}}' ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'name_typography',
            'selector' => '{{WRAPPER}} .cew-testimonial__name',
        ]);

        $this->add_control( 'company_color', [
            'label'     => 'Company Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#777777',
            'selectors' => [ '{{WRAPPER}} .cew-testimonial__company' => 'color: {{VALUE}}' ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $s      = $this->get_settings_for_display();
        $rating = max( 1, min( 5, (int) $s['rating'] ) );
        ?>
        <div class="cew-testimonial">
            <div class="cew-testimonial__rating" aria-label="<?php echo esc_attr( $rating . ' out of 5 stars' ); ?>">
                <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                    <span class="cew-testimonial__star <?php echo $i <= $rating ? 'cew-testimonial__star--filled' : 'cew-testimonial__star--empty'; ?>" aria-hidden="true">★</span>
                <?php endfor; ?>
            </div>

            <?php if ( ! empty( $s['review'] ) ) : ?>
                <p class="cew-testimonial__review">
                    <?php echo esc_html( $s['review'] ); ?>
                </p>
            <?php endif; ?>

            <div class="cew-testimonial__client">
                <div class="cew-testimonial__photo">
                    <img src="<?php echo esc_url( $s['client_image']['url'] ); ?>" alt="<?php echo esc_attr( $s['client_name'] ); ?>">
                </div>
                <div class="cew-testimonial__client-info">
                    <div class="cew-testimonial__name">
                        <?php echo esc_html( $s['client_name'] ); ?>
                    </div>
                    <?php if ( ! empty( $s['company'] ) ) : ?>
                        <div class="cew-testimonial__company">
                            <?php echo esc_html( $s['company'] ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}
