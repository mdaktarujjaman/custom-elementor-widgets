<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class ITzone360_CTA_Button_Widget extends Widget_Base {

    public function get_name()        { return 'cta_button'; }
    public function get_title()       { return 'CTA Button'; }
    public function get_icon()        { return 'eicon-button'; }
    public function get_categories()  { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section( 'content', [
            'label' => 'Button',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'text', [
            'label'   => 'Button Text',
            'type'    => Controls_Manager::TEXT,
            'default' => 'Click Here',
        ]);

        $this->add_control( 'url', [
            'label' => 'URL',
            'type'  => Controls_Manager::URL,
            'default' => [ 'url' => '#' ],
        ]);

        $this->add_control( 'bg_color', [
            'label'     => 'Background',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1a56db',
            'selectors' => [ '{{WRAPPER}} .cew-cta-btn' => 'background-color: {{VALUE}}' ],
        ]);

        $this->add_control( 'text_color', [
            'label'     => 'Text Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [ '{{WRAPPER}} .cew-cta-btn' => 'color: {{VALUE}}' ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $s      = $this->get_settings_for_display();
        $url    = ! empty( $s['url']['url'] ) ? $s['url']['url'] : '#';
        $target = ! empty( $s['url']['is_external'] ) ? '_blank' : '_self';
        ?>
        <div class="cew-cta-wrap">
            <a href="<?php echo esc_url( $url ); ?>"
               target="<?php echo esc_attr( $target ); ?>"
               class="cew-cta-btn">
                <?php echo esc_html( $s['text'] ); ?>
            </a>
        </div>
        <?php
    }
}