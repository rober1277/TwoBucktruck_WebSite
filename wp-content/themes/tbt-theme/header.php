<?php
/**
 * Plantilla de cabecera para el tema Two Buck Trucks
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <div class="site-branding">
        <a href="<?php echo esc_url( tbt_page_url( '/' ) ); ?>">
            <img src="<?php echo esc_url( content_url( 'uploads/2026/06/TBT_Logo_Drk.png' ) ); ?>" alt="Two Buck Trucks logo" class="site-logo">
        </a>
    </div>
    <nav class="primary-nav">
        <ul>
            <li><a href="<?php echo esc_url( tbt_page_url( '/' ) ); ?>"><?php echo esc_html( tbt_text( 'nav_home' ) ); ?></a></li>
            <li><a href="<?php echo esc_url( tbt_page_url( '/services' ) ); ?>"><?php echo esc_html( tbt_text( 'nav_services' ) ); ?></a></li>
            <li><a href="<?php echo esc_url( tbt_page_url( '/location' ) ); ?>"><?php echo esc_html( tbt_text( 'nav_location' ) ); ?></a></li>
            <li><a href="<?php echo esc_url( tbt_page_url( '/contact' ) ); ?>"><?php echo esc_html( tbt_text( 'nav_contact' ) ); ?></a></li>
        </ul>
    </nav>
    <a class="language-toggle" href="<?php echo esc_url( tbt_language_switch_url() ); ?>" aria-label="<?php echo esc_attr( tbt_text( 'language_label' ) ); ?>">
        <?php echo esc_html( tbt_text( 'language_label' ) ); ?>
    </a>
    <a class="btn-header-cta" href="<?php echo esc_url( tbt_page_url( '/services' ) ); ?>">
        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <?php echo esc_html( 'es' === tbt_current_lang() ? 'Reservar Ahora' : 'Reserve Now' ); ?>
    </a>
</header>
