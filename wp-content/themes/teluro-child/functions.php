<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enqueue parent + child styles
 */
function teluro_child_enqueue_assets() {
    // Parent style
    wp_enqueue_style(
        'teluro-parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme( get_template() )->get('Version')
    );

    // Child style
    wp_enqueue_style(
        'teluro-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('teluro-parent-style'),
        filemtime( get_stylesheet_directory() . '/style.css' )
    );
}
add_action( 'wp_enqueue_scripts', 'teluro_child_enqueue_assets' );

/**
 * Register Footer Widgets
 */
function teluro_child_footer_widgets() {
    register_sidebar( array(
        'name'          => __( 'Footer Zone 1', 'teluro-child' ),
        'id'            => 'teluro-footer-1',
        'description'   => __( 'Widgets du footer colonne 1', 'teluro-child' ),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
        'name'          => __( 'Footer Zone 2', 'teluro-child' ),
        'id'            => 'teluro-footer-2',
        'description'   => __( 'Widgets du footer colonne 3', 'teluro-child' ),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'teluro_child_footer_widgets' );

/**
 * Register Footer Menu
 */
function teluro_child_register_menus() {
    register_nav_menus( array(
        'footer-menu' => __( 'Menu Footer', 'teluro-child' )
    ) );
}
add_action( 'init', 'teluro_child_register_menus' );

/**
 * Customizer Settings
 */
function teluro_child_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'teluro_child_footer', array(
        'title'    => __( 'Footer Options', 'teluro-child' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'teluro_child_footer_text', array(
        'default'           => 'Tous droits réservés.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'teluro_child_footer_text', array(
        'label'    => __( 'Texte copyright', 'teluro-child' ),
        'section'  => 'teluro_child_footer',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'teluro_child_customize_register' );

/**
 * Footer Output via Hooks
 */
function teluro_child_footer_output() {
    ?>
    <footer id="footer" class="site-footer">
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h3><?php _e('À propos', 'teluro-child'); ?></h3>
                        <?php if ( is_active_sidebar( 'teluro-footer-1' ) ) : ?>
                            <?php dynamic_sidebar( 'teluro-footer-1' ); ?>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-md-4">
                        <h3><?php _e('Liens rapides', 'teluro-child'); ?></h3>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer-menu',
                            'menu_class'     => 'footer-menu',
                            'container'      => false,
                        ) );
                        ?>
                    </div>
                    <div class="col-md-4">
                        <h3><?php _e('Contact', 'teluro-child'); ?></h3>
                        <footer>
                            <p>© 2025 Jessé Lazare — Tous droits réservés.</p>
                            <p>Développé avec ❤️ sous WordPress. Contact : <a href="lazaretsobgny@gmail.com">Portfolio@gmail.fr</a></p>
                        </footer>
                        <?php if ( is_active_sidebar( 'teluro-footer-2' ) ) : ?>
                            <?php dynamic_sidebar( 'teluro-footer-2' ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php
}

// Attach footer to appropriate hooks
if ( class_exists( '\ColibriWP\Theme\Core\Hooks' ) ) {
    \ColibriWP\Theme\Core\Hooks::prefixed_add_action( 'footer', 'teluro_child_footer_output', 10 );
} else {
    add_action( 'wp_footer', 'teluro_child_footer_output', 20 );
}