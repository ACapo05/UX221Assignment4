<?php
/**
 * Brew Better — functions.php
 * Child of: Twenty Twenty-Five (FSE)
 */

/* -------------------------------------------------------------------
 * 1. Enqueue child stylesheet AFTER parent
 * ------------------------------------------------------------------ */
add_action( 'wp_enqueue_scripts', 'brew_better_enqueue_styles' );
function brew_better_enqueue_styles() {
    wp_enqueue_style(
        'brew-better',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'wp-block-library' ),
        wp_get_theme()->get( 'Version' )
    );
}

/* -------------------------------------------------------------------
 * 2. Favicon
 * ------------------------------------------------------------------ */
add_action( 'wp_head', 'brew_better_favicon', 1 );
function brew_better_favicon() {
    $url = esc_url( get_stylesheet_directory_uri() . '/favicon.svg' );
    echo '<link rel="icon" type="image/svg+xml" href="' . $url . '">' . "\n";
    echo '<link rel="shortcut icon" href="' . $url . '">' . "\n";
}

/* -------------------------------------------------------------------
 * 3. Google Analytics (GA4) — replace G-XXXXXXXXXX with your real ID
 * ------------------------------------------------------------------ */
add_action( 'wp_head', 'brew_better_analytics', 5 );
function brew_better_analytics() {
    if ( is_admin() || ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ) return;
    ?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-BREWBETTER1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-BREWBETTER1', { 'anonymize_ip': true });
</script>
    <?php
}

/* -------------------------------------------------------------------
 * 4. Accessibility: skip-to-content link
 * ------------------------------------------------------------------ */
add_action( 'wp_body_open', 'brew_better_skip_link' );
function brew_better_skip_link() {
    echo '<a class="skip-link" href="#wp--skip-link--target">' .
         esc_html__( 'Skip to main content', 'brew-better' ) .
         '</a>' . "\n";
}

/* -------------------------------------------------------------------
 * 5. Theme supports
 * ------------------------------------------------------------------ */
add_action( 'after_setup_theme', 'brew_better_setup' );
function brew_better_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'gallery', 'caption', 'style', 'script',
    ) );
}
