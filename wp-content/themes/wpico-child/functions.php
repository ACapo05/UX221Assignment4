<?php
/**
 * Brew Better Child Theme — functions.php
 * Parent: wpico (PicoCSS)
 */

/* -------------------------------------------------------------------
 * 1. Enqueue parent + child styles
 * ------------------------------------------------------------------ */
add_action( 'wp_enqueue_scripts', 'brew_better_enqueue_styles' );
function brew_better_enqueue_styles() {
    // Parent theme stylesheet (already handled by wpico's own enqueue,
    // but we also load the PicoCSS CDN to be safe)
    wp_enqueue_style(
        'pico',
        'https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.sand.min.css',
        array(),
        '2.0'
    );

    // Child theme stylesheet
    wp_enqueue_style(
        'brew-better-child',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'pico' ),
        wp_get_theme()->get( 'Version' )
    );

    // Google Fonts: Merriweather for body, Poppins for headings
    wp_enqueue_style(
        'brew-fonts',
        'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400&family=Poppins:wght@600;700&display=swap',
        array(),
        null
    );
}

/* -------------------------------------------------------------------
 * 2. Favicon
 * ------------------------------------------------------------------ */
add_action( 'wp_head', 'brew_better_favicon' );
function brew_better_favicon() {
    $favicon_url = get_stylesheet_directory_uri() . '/favicon.svg';
    echo '<link rel="icon" type="image/svg+xml" href="' . esc_url( $favicon_url ) . '">' . "\n";
    echo '<link rel="shortcut icon" href="' . esc_url( $favicon_url ) . '">' . "\n";
}

/* -------------------------------------------------------------------
 * 3. Google Analytics (GA4)
 *    Measurement ID: G-BREWBETTER1  ← replace with real ID in production
 * ------------------------------------------------------------------ */
add_action( 'wp_head', 'brew_better_google_analytics' );
function brew_better_google_analytics() {
    if ( is_admin() ) return;
    ?>
<!-- Google tag (gtag.js) — Brew Better Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-BREWBETTER1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-BREWBETTER1');
</script>
    <?php
}

/* -------------------------------------------------------------------
 * 4. Skip-to-content link for accessibility
 * ------------------------------------------------------------------ */
add_action( 'wp_body_open', 'brew_better_skip_link' );
function brew_better_skip_link() {
    echo '<a class="skip-link" href="#main-content">Skip to main content</a>';
}

/* -------------------------------------------------------------------
 * 5. Theme supports
 * ------------------------------------------------------------------ */
add_action( 'after_setup_theme', 'brew_better_setup' );
function brew_better_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) );

    // Register primary navigation menu
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'brew-better' ),
    ) );
}

/* -------------------------------------------------------------------
 * 6. Custom excerpt length
 * ------------------------------------------------------------------ */
add_filter( 'excerpt_length', function() { return 30; }, 999 );
add_filter( 'excerpt_more', function() {
    return '&hellip; <a href="' . get_permalink() . '" aria-label="Read more about ' . get_the_title() . '">Read more</a>';
} );
