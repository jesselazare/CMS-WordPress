<?php
/**
 * Header personnalisé pour le thème enfant Teluro Child
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header id="site-header" class="site-header">
        <div class="header-container">
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="https://i.pinimg.com/originals/61/6f/6d/616f6dbf806826dff146a3d15eda8585.jpg" alt="Jessé Lazare Portfolio" style="height: 120px;">
                </a>
            </div>


            <nav class="main-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary', 'menu_class'     => 'nav-menu','container'      => false,
                ) );
                ?>
            </nav>

            <div class="header-right">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" class="search-field" placeholder="Rechercher..." value="<?php echo get_search_query(); ?>" name="s" />
                </form>
            </div>
        </div>
    </header>
