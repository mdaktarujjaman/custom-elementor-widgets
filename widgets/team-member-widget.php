<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// widgets/team-member-widget.php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

class Itzone360_Team_Member_Widget extends Widget_Base {

    public function get_name()  { return 'itzone360_team_member'; }
    public function get_title() { return 'Team Member'; }
    public function get_icon()  { return 'eicon-person'; }
    public function get_categories() { return [ 'general' ]; }
    public function get_keywords() { return [ 'team', 'member', 'staff', 'person', 'author' ]; }

    protected function register_controls() {

        // ── CONTENT TAB: PHOTO & BIO ──────────────────
        $this->start_controls_section( 'content_section', [
            'label' => 'Content',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'photo', [
            'label'   => 'Photo',
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ]);

        $this->add_control( 'name', [
            'label'   => 'Name',
            'type'    => Controls_Manager::TEXT,
            'default' => 'John Doe',
        ]);

        $this->add_control( 'position', [
            'label'   => 'Position',
            'type'    => Controls_Manager::TEXT,
            'default' => 'CEO & Founder',
        ]);

        $this->add_control( 'description', [
            'label'   => 'Description',
            'type'    => Controls_Manager::TEXTAREA,
            'default' => '',
            'placeholder' => 'Optional short bio.',
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
            'selectors_dictionary' => [
                'left'   => 'flex-start',
                'center' => 'center',
                'right'  => 'flex-end',
            ],
            'selectors' => [
                '{{WRAPPER}} .cew-team-member' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
            ],
        ]);

        $this->end_controls_section();

        // ── CONTENT TAB: SOCIAL LINKS ─────────────────
        $this->start_controls_section( 'social_section', [
            'label' => 'Social Links',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'facebook_url', [
            'label'       => 'Facebook URL',
            'type'        => Controls_Manager::URL,
            'placeholder' => 'https://facebook.com/username',
            'default'     => [ 'url' => '' ],
        ]);

        $this->add_control( 'linkedin_url', [
            'label'       => 'LinkedIn URL',
            'type'        => Controls_Manager::URL,
            'placeholder' => 'https://linkedin.com/in/username',
            'default'     => [ 'url' => '' ],
        ]);

        $this->add_control( 'x_url', [
            'label'       => 'X (Twitter) URL',
            'type'        => Controls_Manager::URL,
            'placeholder' => 'https://x.com/username',
            'default'     => [ 'url' => '' ],
        ]);

        $this->add_control( 'instagram_url', [
            'label'       => 'Instagram URL',
            'type'        => Controls_Manager::URL,
            'placeholder' => 'https://instagram.com/username',
            'default'     => [ 'url' => '' ],
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
            'selectors' => [ '{{WRAPPER}} .cew-team-member' => 'background-color: {{VALUE}}' ],
        ]);

        $this->add_control( 'card_padding', [
            'label'      => 'Padding',
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'default'    => [ 'top' => 32, 'right' => 24, 'bottom' => 32, 'left' => 24, 'unit' => 'px' ],
            'selectors'  => [
                '{{WRAPPER}} .cew-team-member' =>
                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'card_border_radius', [
            'label'      => 'Border Radius',
            'type'       => Controls_Manager::SLIDER,
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
            'default'    => [ 'size' => 8 ],
            'selectors'  => [
                '{{WRAPPER}} .cew-team-member' => 'border-radius: {{SIZE}}px;',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'card_border',
            'selector' => '{{WRAPPER}} .cew-team-member',
        ]);

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'card_shadow',
            'selector' => '{{WRAPPER}} .cew-team-member',
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: PHOTO ───────────────────────────
        $this->start_controls_section( 'style_photo_section', [
            'label' => 'Photo',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'photo_shape', [
            'label'   => 'Shape',
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'circle'  => [ 'title' => 'Circle',  'icon' => 'eicon-circle' ],
                'rounded' => [ 'title' => 'Rounded', 'icon' => 'eicon-image-bold' ],
                'square'  => [ 'title' => 'Square',  'icon' => 'eicon-square' ],
            ],
            'default'   => 'circle',
            'selectors_dictionary' => [
                'circle'  => '50%',
                'rounded' => '12px',
                'square'  => '0',
            ],
            'selectors' => [
                '{{WRAPPER}} .cew-team-member__photo img' => 'border-radius: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'photo_size', [
            'label'     => 'Size',
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 60, 'max' => 300 ] ],
            'default'   => [ 'size' => 120 ],
            'selectors' => [
                '{{WRAPPER}} .cew-team-member__photo img' => 'width: {{SIZE}}px; height: {{SIZE}}px; object-fit: cover;',
            ],
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: TYPOGRAPHY ──────────────────────
        $this->start_controls_section( 'style_text_section', [
            'label' => 'Typography',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'name_color', [
            'label'     => 'Name Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#111111',
            'selectors' => [ '{{WRAPPER}} .cew-team-member__name' => 'color: {{VALUE}}' ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'name_typography',
            'selector' => '{{WRAPPER}} .cew-team-member__name',
        ]);

        $this->add_control( 'position_color', [
            'label'     => 'Position Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1a56db',
            'selectors' => [ '{{WRAPPER}} .cew-team-member__position' => 'color: {{VALUE}}' ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'position_typography',
            'selector' => '{{WRAPPER}} .cew-team-member__position',
        ]);

        $this->add_control( 'desc_color', [
            'label'     => 'Description Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#555555',
            'selectors' => [ '{{WRAPPER}} .cew-team-member__desc' => 'color: {{VALUE}}' ],
        ]);

        $this->end_controls_section();

        // ── STYLE TAB: SOCIAL ICONS ─────────────────────
        $this->start_controls_section( 'style_social_section', [
            'label' => 'Social Icons',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'social_icon_size', [
            'label'     => 'Icon Size',
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 12, 'max' => 40 ] ],
            'default'   => [ 'size' => 16 ],
            'selectors' => [ '{{WRAPPER}} .cew-team-member__social a' => 'font-size: {{SIZE}}px;' ],
        ]);

        $this->add_control( 'social_icon_color', [
            'label'     => 'Icon Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#555555',
            'selectors' => [ '{{WRAPPER}} .cew-team-member__social a' => 'color: {{VALUE}};' ],
        ]);

        $this->add_control( 'social_icon_hover_color', [
            'label'     => 'Icon Hover Color',
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1a56db',
            'selectors' => [ '{{WRAPPER}} .cew-team-member__social a:hover' => 'color: {{VALUE}};' ],
        ]);

        $this->end_controls_section();
    }

    /**
     * Render a single social link if its URL is set.
     *
     * @param string $url     The URL array from an Elementor URL control.
     * @param string $label   Accessible label for screen readers.
     * @param string $svg     Inline SVG markup for the icon.
     */
    private function render_social_link( $url_control, $label, $svg ) {
        if ( empty( $url_control['url'] ) ) {
            return;
        }
        $target = ! empty( $url_control['is_external'] ) ? '_blank' : '_self';
        $rel    = ! empty( $url_control['nofollow'] ) ? 'nofollow' : '';
        ?>
        <a href="<?php echo esc_url( $url_control['url'] ); ?>"
           target="<?php echo esc_attr( $target ); ?>"
           rel="<?php echo esc_attr( $rel ); ?>"
           aria-label="<?php echo esc_attr( $label ); ?>">
            <?php echo $svg; // phpcs:ignore -- static trusted SVG markup, no user input. ?>
        </a>
        <?php
    }

    protected function render() {
        $s = $this->get_settings_for_display();

        $socials = [
            [ $s['facebook_url'],  'Facebook',  '<svg width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5 3.66 9.15 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.51 1.49-3.9 3.77-3.9 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87h2.78l-.44 2.91h-2.34V22c4.78-.79 8.44-4.94 8.44-9.94Z"/></svg>' ],
            [ $s['linkedin_url'],  'LinkedIn',  '<svg width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.86 0-2.14 1.45-2.14 2.94v5.67H9.34V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.38-1.85 3.61 0 4.28 2.38 4.28 5.47ZM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12ZM7.12 20.45H3.56V9h3.56Z"/></svg>' ],
            [ $s['x_url'],         'X (Twitter)', '<svg width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.9 2H22l-7.6 8.7L23.3 22H16.9l-5-6.5-5.7 6.5H2.9l8.1-9.3L2 2h6.6l4.5 6 5.8-6Zm-1.1 18.1h1.7L7.3 3.8H5.5l12.3 16.3Z"/></svg>' ],
            [ $s['instagram_url'], 'Instagram', '<svg width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2c2.72 0 3.06.01 4.12.06 1.06.05 1.79.22 2.43.47.66.26 1.22.6 1.77 1.16.51.5.9 1.1 1.16 1.77.25.64.42 1.37.47 2.43.05 1.06.06 1.4.06 4.11 0 2.72-.01 3.06-.06 4.12-.05 1.06-.22 1.79-.47 2.43a4.9 4.9 0 0 1-1.16 1.77 4.9 4.9 0 0 1-1.77 1.16c-.64.25-1.37.42-2.43.47-1.06.05-1.4.06-4.12.06-2.71 0-3.05-.01-4.11-.06-1.06-.05-1.79-.22-2.43-.47a4.9 4.9 0 0 1-1.77-1.16 4.9 4.9 0 0 1-1.16-1.77c-.25-.64-.42-1.37-.47-2.43C2.01 15.06 2 14.72 2 12c0-2.71.01-3.05.06-4.11.05-1.06.22-1.79.47-2.43.26-.67.6-1.27 1.16-1.77.5-.56 1.1-.9 1.77-1.16.64-.25 1.37-.42 2.43-.47C8.94 2.01 9.28 2 12 2Zm0 1.8c-2.67 0-2.99.01-4.04.06-.87.04-1.34.18-1.66.3-.4.16-.7.35-1 .65-.3.3-.5.6-.66 1-.12.32-.26.79-.3 1.66C4.29 8.51 4.28 8.83 4.28 12s.01 3.49.06 4.54c.04.87.18 1.34.3 1.66.16.4.36.7.66 1 .3.3.6.5 1 .66.32.12.79.26 1.66.3 1.05.05 1.37.06 4.04.06s2.99-.01 4.04-.06c.87-.04 1.34-.18 1.66-.3.4-.16.7-.36 1-.66.3-.3.5-.6.66-1 .12-.32.26-.79.3-1.66.05-1.05.06-1.37.06-4.54s-.01-3.49-.06-4.54c-.04-.87-.18-1.34-.3-1.66a2.7 2.7 0 0 0-.66-1 2.7 2.7 0 0 0-1-.66c-.32-.12-.79-.26-1.66-.3-1.05-.05-1.37-.06-4.04-.06Zm0 3.65a4.55 4.55 0 1 1 0 9.1 4.55 4.55 0 0 1 0-9.1Zm0 1.8a2.75 2.75 0 1 0 0 5.5 2.75 2.75 0 0 0 0-5.5Zm5.8-1.99a1.06 1.06 0 1 1-2.12 0 1.06 1.06 0 0 1 2.12 0Z"/></svg>' ],
        ];
        ?>
        <div class="cew-team-member">
            <div class="cew-team-member__photo">
                <img src="<?php echo esc_url( $s['photo']['url'] ); ?>" alt="<?php echo esc_attr( $s['name'] ); ?>">
            </div>
            <h3 class="cew-team-member__name">
                <?php echo esc_html( $s['name'] ); ?>
            </h3>
            <?php if ( ! empty( $s['position'] ) ) : ?>
                <div class="cew-team-member__position">
                    <?php echo esc_html( $s['position'] ); ?>
                </div>
            <?php endif; ?>
            <?php if ( ! empty( $s['description'] ) ) : ?>
                <p class="cew-team-member__desc">
                    <?php echo esc_html( $s['description'] ); ?>
                </p>
            <?php endif; ?>
            <div class="cew-team-member__social">
                <?php foreach ( $socials as $item ) : ?>
                    <?php $this->render_social_link( $item[0], $item[1], $item[2] ); ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}
