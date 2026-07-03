<?php
/**
 * Portada del sitio Two Buck Trucks.
 *
 * @package tbt-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$lang = tbt_current_lang();

get_header();
?>

<main>

    <!-- ================================================
         HERO
    ================================================ -->
    <section class="hero-home">
        <div class="hero-home-media" style="background-image:url('<?php echo esc_url( content_url( 'uploads/2026/06/TBT_Top_Image.png' ) ); ?>');">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1 class="hero-title">
                    <?php if ( 'es' === $lang ) : ?>
                        ESTACIONAMIENTO<br>
                        <em>SEGURO PARA</em><br>
                        TU CAMINO
                    <?php else : ?>
                        SECURE<br>
                        <em>PARKING FOR</em><br>
                        YOUR TRUCK
                    <?php endif; ?>
                </h1>
                <p class="hero-sub"><?php echo esc_html( tbt_text( 'home_intro' ) ); ?></p>
                <div class="hero-buttons">
                    <a class="btn-hero-outline btn-hero-solid" href="<?php echo esc_url( tbt_page_url( '/services' ) ); ?>">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <?php echo esc_html( 'es' === $lang ? 'Nuestros Servicios' : 'Our Services' ); ?>
                    </a>
                    <a class="btn-hero-outline" href="<?php echo esc_url( tbt_page_url( '/location' ) ); ?>">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <?php echo esc_html( 'es' === $lang ? 'Ver Ubicación' : 'View Location' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================================================
         BARRA DE FEATURES
    ================================================ -->
    <section class="features-bar">
        <div class="features-bar-inner">

            <div class="feature-item">
                <span class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                </span>
                <div class="feature-text">
                    <strong><?php echo esc_html( 'es' === $lang ? 'Seguridad 24/7' : 'Security 24/7' ); ?></strong>
                    <span><?php echo esc_html( 'es' === $lang ? 'Vigilancia y monitoreo las 24 horas del día.' : 'Surveillance and monitoring 24 hours a day.' ); ?></span>
                </div>
            </div>

            <div class="feature-item">
                <span class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
                </span>
                <div class="feature-text">
                    <strong><?php echo esc_html( 'es' === $lang ? 'Espacios Amplios' : 'Wide Spaces' ); ?></strong>
                    <span><?php echo esc_html( 'es' === $lang ? 'Espacios diseñados para trailers de 18 ruedas.' : 'Spaces designed for 18-wheel trailers.' ); ?></span>
                </div>
            </div>

            <div class="feature-item">
                <span class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </span>
                <div class="feature-text">
                    <strong><?php echo esc_html( 'es' === $lang ? 'Ubicación Estratégica' : 'Strategic Location' ); ?></strong>
                    <span><?php echo esc_html( 'es' === $lang ? 'Fácil acceso a las principales rutas de transporte.' : 'Easy access to major transport routes.' ); ?></span>
                </div>
            </div>

            <div class="feature-item">
                <span class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
                <div class="feature-text">
                    <strong><?php echo esc_html( 'es' === $lang ? 'Servicio Confiable' : 'Reliable Service' ); ?></strong>
                    <span><?php echo esc_html( 'es' === $lang ? 'Comprometidos con la seguridad y satisfacción de nuestros clientes.' : 'Committed to safety and customer satisfaction.' ); ?></span>
                </div>
            </div>

        </div>
    </section>

    <!-- ================================================
         SOBRE NOSOTROS
    ================================================ -->
    <section class="about-section" style="background-image:url('<?php echo esc_url( content_url( 'uploads/2026/06/TBT_bottom_image.png' ) ); ?>');"  >
        <div class="about-inner">

            <div class="about-text">
                <h2 class="about-title">
                    <?php echo esc_html( 'es' === $lang ? 'Sobre' : 'About' ); ?>
                    <em><?php echo esc_html( 'es' === $lang ? 'Nosotros' : 'Us' ); ?></em>
                </h2>
                <p><?php echo esc_html( tbt_text( 'home_services_copy' ) ); ?></p>
                <a class="btn-about" href="<?php echo esc_url( tbt_page_url( '/location' ) ); ?>">
                    <?php echo esc_html( 'es' === $lang ? 'Conoce Más' : 'Learn More' ); ?>
                    <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>

            <div class="about-media">
                <img
                    src="<?php echo esc_url( content_url( 'uploads/2026/05/Main-entrance.png' ) ); ?>"
                    alt="<?php echo esc_attr( 'es' === $lang ? 'Entrada principal Two Buck Trucks' : 'Two Buck Trucks main entrance' ); ?>"
                    class="about-img"
                    loading="lazy"
                >
                <div class="about-logo-badge">
                    <img src="<?php echo esc_url( content_url( 'uploads/2026/05/logo1.png' ) ); ?>" alt="Two Buck Trucks">
                </div>
            </div>

        </div>
    </section>

    <!-- ================================================
         BANNER CTA AMARILLO
    ================================================ -->
    <section class="cta-banner">
        <div class="cta-banner-inner">
            <img
                src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo1.png' ); ?>"
                alt=""
                class="cta-banner-truck"
                aria-hidden="true"
            >
            <div class="cta-banner-text">
                <strong><?php echo esc_html( 'es' === $lang ? '¿Necesitas un espacio?' : 'Need a parking space?' ); ?></strong>
                <span><?php echo esc_html( 'es' === $lang ? 'Reserva tu lugar de forma rápida y segura.' : 'Reserve your spot quickly and securely.' ); ?></span>
            </div>
            <a class="btn-cta-banner" href="<?php echo esc_url( tbt_page_url( '/services' ) ); ?>">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <?php echo esc_html( 'es' === $lang ? 'Reservar Ahora' : 'Reserve Now' ); ?>
            </a>
        </div>
    </section>

</main>

<?php
get_footer();
