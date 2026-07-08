# Custom Elementor Widgets

Production-ready custom Elementor widgets — built with PHP and the WordPress Plugin API.

Lightweight, dependency-light (no jQuery in custom JS), and built to pass WordPress.org Plugin Check on Plugin Repo, Security, General, Performance, and Accessibility categories.



---

## Widgets

| Widget | Description |
|---|---|
| **Info Card** | Icon, title, description, CTA button — full style controls (color, typography, shadow) |
| **CTA Button** | Advanced call-to-action with gradient background and hover animation |
| **Feature Box** | Icon/Image toggle, title, description, background (color or gradient), hover-lift shadow, optional button |
| **Counter** | Animated count-up number with prefix/suffix, thousands separator, and scroll-triggered vanilla JS animation (no jQuery) |
| **Team Member** | Photo, name, position, description, and individual Facebook / LinkedIn / X / Instagram links |
| **Testimonial** | Client photo, name, company, 1–5 star rating, and review text |
| **Pricing Box** | Plan name, price, "Featured" highlight badge, repeater-driven feature list (included/excluded), CTA button |

All widgets share a consistent `cew-` CSS namespace and are registered through a single extension-friendly bootstrap (`itzone360_widgets/register_pro_widgets` action hook reserved for a future Pro add-on).

---

## Tech Stack

- **PHP** — Elementor Widget API (`Widget_Base`, `Controls_Manager`, `Repeater`, `Group_Control_*`)
- **WordPress Plugin API** — hooks, `wp_register_script` / `wp_enqueue_style`
- **Vanilla JavaScript** — `IntersectionObserver` + `requestAnimationFrame` for the Counter widget's scroll-triggered animation, no external libraries
- **CSS3** — flexbox layouts, custom properties via Elementor's `selectors` API

---

## Installation

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate **ITzone360 Widgets** from the WordPress Plugins screen
3. Make sure **Elementor** (free or Pro) is installed and activated
4. Edit any page with Elementor → search the widget panel for **"ITzone360"** or the widget name (e.g. "Feature Box")
5. Drag the widget onto the page and configure it from the Content/Style tabs

---

## Development Notes

- Each widget lives in its own file under `widgets/`, registered in `itzone360-widgets.php`
- Shared frontend styles live in `assets/css/widgets.css`
- Widget-specific JS (currently only the Counter's animation) is registered per-widget via `get_script_depends()`, so it's only loaded on pages that actually use that widget
- Class names follow the `Itzone360_{Widget_Name}_Widget` convention

## Roadmap

- [ ] Testimonial Carousel / Slider (Pro)
- [ ] Advanced Pricing Box animations (Pro)
- [ ] License-key gated Pro widget pack

## License

GPLv2 or later — see [license.txt](license.txt)
