<?php
/**
 * Plantilla de página: Ubicación
 *
 * @package tbt-theme
 * Template Name: Location
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$lang = tbt_current_lang();

get_header();
?>

<main class="location-page"
      style="background-image:url('<?php echo esc_url( content_url( 'uploads/2026/06/TBT_Top_Image.png' ) ); ?>');">

    <div class="loc-bg-overlay" aria-hidden="true"></div>

    <!-- ================================================
         BLOQUE 1 — TEXTO + MAPA (lado a lado)
    ================================================ -->
    <section class="loc-main">

        <!-- Columna izquierda: título, íconos, botón -->
        <div class="loc-left">

            <h1 class="loc-title">
                <?php if ( 'es' === $lang ) : ?>
                    UBICADOS<br>ESTRATÉGICAMENTE<br><em>PARA CONDUCTORES</em>
                <?php else : ?>
                    CONVENIENTLY<br>LOCATED<br><em>FOR TRUCK DRIVERS</em>
                <?php endif; ?>
            </h1>

            <p class="loc-sub">
                <?php echo esc_html( 'es' === $lang
                    ? 'Fácil acceso a las principales autopistas y servicios esenciales.'
                    : 'Easy access to major highways and essential services.' ); ?>
            </p>

            <div class="loc-icons">

                <div class="loc-icon-row">
                    <div class="loc-icon-svg" aria-hidden="true">
                        <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M30 5 55 18v22L30 55 5 40V18z" stroke="#F7E020" stroke-width="2.5" fill="none"/>
                            <rect x="18" y="20" width="24" height="18" rx="2" stroke="#F7E020" stroke-width="2" fill="none"/>
                            <line x1="30" y1="20" x2="30" y2="38" stroke="#F7E020" stroke-width="2"/>
                            <line x1="18" y1="29" x2="42" y2="29" stroke="#F7E020" stroke-width="2"/>
                        </svg>
                    </div>
                    <div class="loc-icon-text">
                        <strong><?php echo esc_html( 'es' === $lang ? 'ACCESO INTERESTATAL' : 'INTERSTATE ACCESS' ); ?></strong>
                        <span><?php echo esc_html( 'es' === $lang ? 'I-35W a 5 min via W Risinger Rd' : 'I-35W within 5 min via W Risinger Rd' ); ?></span>
                    </div>
                </div>

                <div class="loc-icon-row">
                    <div class="loc-icon-svg" aria-hidden="true">
                        <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="20" width="32" height="20" rx="2" stroke="#F7E020" stroke-width="2.5" fill="none"/>
                            <path d="M36 28h12l6 10v6H36V28z" stroke="#F7E020" stroke-width="2.5" fill="none" stroke-linejoin="round"/>
                            <circle cx="14" cy="44" r="5" stroke="#F7E020" stroke-width="2.5" fill="none"/>
                            <circle cx="46" cy="44" r="5" stroke="#F7E020" stroke-width="2.5" fill="none"/>
                        </svg>
                    </div>
                    <div class="loc-icon-text">
                        <strong><?php echo esc_html( 'es' === $lang ? 'RUTAS DE CAMIONES' : 'MAJOR TRUCK ROUTES' ); ?></strong>
                        <span><?php echo esc_html( 'es' === $lang ? 'Chisholm Trail Pkwy a menos de 1 milla' : 'Chisholm Trail Pkwy under 1 mile · Fort Worth 20 min' ); ?></span>
                    </div>
                </div>

                <div class="loc-icon-row">
                    <div class="loc-icon-svg" aria-hidden="true">
                        <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="10" y="8" width="24" height="42" rx="2" stroke="#F7E020" stroke-width="2.5" fill="none"/>
                            <rect x="16" y="14" width="12" height="10" rx="1" stroke="#F7E020" stroke-width="2" fill="none"/>
                            <path d="M34 18h6a4 4 0 0 1 4 4v16a4 4 0 0 1-4 4" stroke="#F7E020" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                            <circle cx="40" cy="42" r="4" stroke="#F7E020" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                    <div class="loc-icon-text">
                        <strong><?php echo esc_html( 'es' === $lang ? 'COMBUSTIBLE CERCANO' : 'FUEL STATIONS NEARBY' ); ?></strong>
                        <span><?php echo esc_html( 'es' === $lang ? 'Varias opciones a 5 minutos' : 'Multiple options within 5 minutes' ); ?></span>
                    </div>
                </div>

                <div class="loc-icon-row">
                    <div class="loc-icon-svg" aria-hidden="true">
                        <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="16" y1="8" x2="44" y2="52" stroke="#F7E020" stroke-width="3" stroke-linecap="round"/>
                            <line x1="44" y1="8" x2="16" y2="52" stroke="#F7E020" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="loc-icon-text">
                        <strong><?php echo esc_html( 'es' === $lang ? 'RESTAURANTES' : 'RESTAURANTS NEARBY' ); ?></strong>
                        <span><?php echo esc_html( 'es' === $lang ? 'Opciones de comida a 5 minutos' : 'Food options within 5 minutes' ); ?></span>
                    </div>
                </div>

            </div>

            <a class="btn-loc-dir"
               href="https://www.google.com/maps/dir/?api=1&destination=32.552975,-97.426093"
               target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                <?php echo esc_html( 'es' === $lang ? 'Cómo Llegar' : 'Get Directions' ); ?>
            </a>

        </div>

        <!-- Columna derecha: mapa -->
        <div class="loc-right">
            <iframe
                class="loc-map-iframe"
                src="https://www.google.com/maps?q=32.552975,-97.426093&z=14&output=embed"
                allowfullscreen=""
                loading="lazy"
                title="Two Buck Trucks"
            ></iframe>
        </div>

    </section>

    <!-- ================================================
         BLOQUE 2 — GALERÍA DE FOTOS
    ================================================ -->
    <section class="loc-gallery">
        <div class="loc-gallery-inner">

            <h2 class="loc-gallery-title">
                <?php echo esc_html( 'es' === $lang ? 'FOTOS DE NUESTRAS INSTALACIONES' : 'PHOTOS OF OUR FACILITY' ); ?>
            </h2>

            <div class="loc-gallery-grid">
                <div class="loc-gallery-item">
                    <img src="<?php echo esc_url( content_url( 'uploads/2026/05/Main-entrance.png' ) ); ?>"
                         alt="<?php echo esc_attr( 'es' === $lang ? 'Entrada principal' : 'Main entrance' ); ?>"
                         loading="lazy">
                </div>
                <div class="loc-gallery-item">
                    <img src="<?php echo esc_url( content_url( 'uploads/2026/05/FM1902-view.png' ) ); ?>"
                         alt="<?php echo esc_attr( 'es' === $lang ? 'Vista FM1902' : 'FM1902 view' ); ?>"
                         loading="lazy">
                </div>
                <div class="loc-gallery-item">
                    <img src="<?php echo esc_url( content_url( 'uploads/2026/05/Satelital-View.png' ) ); ?>"
                         alt="<?php echo esc_attr( 'es' === $lang ? 'Vista satelital' : 'Satellite view' ); ?>"
                         loading="lazy">
                </div>
                <div class="loc-gallery-item">
                    <img src="<?php echo esc_url( content_url( 'uploads/2026/06/TBT_bottom_image.png' ) ); ?>"
                         alt="<?php echo esc_attr( 'es' === $lang ? 'Instalaciones' : 'Facility' ); ?>"
                         loading="lazy">
                </div>
            </div>

        </div>
    </section>

    <div class="loc-end-bar" aria-hidden="true"></div>

</main>

<?php get_footer(); ?>
