<?php
/**
 * Plantilla de página: Contacto
 *
 * @package tbt-theme
 * Template Name: Contact
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$lang = tbt_current_lang();

get_header();
?>

<main class="contact-page"
      style="background-image:url('<?php echo esc_url( content_url( 'uploads/2026/06/TBT_bottom_image.png' ) ); ?>');">

    <div class="contact-bg-overlay" aria-hidden="true"></div>

    <div class="contact-wrap">

        <!-- Título centrado -->
        <div class="contact-heading">
            <h1 class="contact-title">
                <?php if ( 'es' === $lang ) : ?>
                    <span><?php echo esc_html( 'CONTÁCTANOS' ); ?></span>
                <?php else : ?>
                    <span><?php echo esc_html( 'CONTACT' ); ?></span> <em><?php echo esc_html( 'US' ); ?></em>
                <?php endif; ?>
            </h1>
            <p class="contact-subtitle">
                <?php echo esc_html( tbt_text( 'contact_intro' ) ); ?>
            </p>
        </div>

        <!-- Tarjeta del formulario -->
        <div class="contact-card">

            <!-- Info rápida: email + redes -->
            <div class="contact-info-row">
                <a class="contact-info-item" href="mailto:info@2bucktrucks.com">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    info@2bucktrucks.com
                </a>
                <a class="contact-info-item" href="tel:+19562074413">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.18 2 2 0 0 1 3.59 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.56a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    (956) 207 4413
                </a>
                <a class="contact-info-item" href="https://www.instagram.com/two_buck_trucks" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    @two_buck_trucks
                </a>
                <a class="contact-info-item" href="https://www.facebook.com/twobucktrucksparkinglot" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    2Buck Trucks
                </a>
            </div>

            <div class="contact-divider" aria-hidden="true"></div>

            <!-- Formulario -->
            <form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="tbt_handle_contact_request">
                <?php wp_nonce_field( 'tbt_contact_request', 'tbt_contact_nonce' ); ?>

                <div class="contact-form-row">
                    <label class="contact-label">
                        <span><?php echo esc_html( tbt_text( 'contact_name' ) ); ?></span>
                        <input type="text" name="contact_name" required placeholder="<?php echo esc_attr( 'es' === $lang ? 'Tu nombre completo' : 'Your full name' ); ?>">
                    </label>
                    <label class="contact-label">
                        <span><?php echo esc_html( tbt_text( 'contact_email' ) ); ?></span>
                        <input type="email" name="contact_email" required placeholder="<?php echo esc_attr( 'es' === $lang ? 'tu@correo.com' : 'you@email.com' ); ?>">
                    </label>
                </div>

                <label class="contact-label">
                    <span><?php echo esc_html( tbt_text( 'contact_phone' ) ); ?></span>
                    <input type="tel" name="contact_phone" placeholder="<?php echo esc_attr( 'es' === $lang ? '(000) 000-0000' : '(000) 000-0000' ); ?>">
                </label>

                <label class="contact-label">
                    <span><?php echo esc_html( tbt_text( 'contact_message' ) ); ?></span>
                    <textarea name="contact_message" rows="5" placeholder="<?php echo esc_attr( 'es' === $lang ? '¿En qué podemos ayudarte?' : 'How can we help you?' ); ?>"></textarea>
                </label>

                <button class="btn-contact-submit" type="submit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    <?php echo esc_html( tbt_text( 'request_call' ) ); ?>
                </button>

            </form>

        </div><!-- /.contact-card -->

    </div><!-- /.contact-wrap -->

    <!-- Modal de éxito — siempre presente en el DOM, visible solo con JS -->
    <div class="cs-modal" id="contactSuccessModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="csModalTitle">
        <div class="cs-modal-backdrop"></div>
        <div class="cs-modal-box">
            <div class="cs-modal-img-wrap" aria-hidden="true">
                <img src="<?php echo esc_url( content_url( 'uploads/2026/06/TBT_bottom_image.png' ) ); ?>" alt="">
                <div class="cs-modal-img-overlay"></div>
            </div>
            <div class="cs-modal-body">
                <div class="cs-modal-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <h2 class="cs-modal-title" id="csModalTitle">
                    <?php echo esc_html( 'es' === $lang ? 'Su solicitud fue enviada con éxito' : 'Your request was sent successfully' ); ?>
                </h2>
                <p class="cs-modal-sub">
                    <?php echo esc_html( 'es' === $lang
                        ? 'Nos pondremos en contacto con usted a la brevedad posible.'
                        : 'We will get back to you as soon as possible.' ); ?>
                </p>
                <button class="cs-modal-close" id="csModalClose" type="button">
                    <?php echo esc_html( 'es' === $lang ? 'Cerrar' : 'Close' ); ?>
                </button>
            </div>
        </div>
    </div>

</main>

<script>
(function () {
    var sent  = <?php echo ( isset( $_GET['contact'] ) && 'sent' === $_GET['contact'] ) ? 'true' : 'false'; ?>;
    var modal = document.getElementById('contactSuccessModal');
    var close = document.getElementById('csModalClose');

    if (sent && modal) {
        modal.setAttribute('aria-hidden', 'false');
        modal.classList.add('cs-modal--open');
        document.body.style.overflow = 'hidden';
    }

    if (close) {
        close.addEventListener('click', function () {
            modal.setAttribute('aria-hidden', 'true');
            modal.classList.remove('cs-modal--open');
            document.body.style.overflow = '';
            /* limpia el parámetro de la URL sin recargar */
            var url = new URL(window.location.href);
            url.searchParams.delete('contact');
            window.history.replaceState({}, '', url);
        });
    }

    /* clic en backdrop también cierra */
    var backdrop = modal && modal.querySelector('.cs-modal-backdrop');
    if (backdrop) {
        backdrop.addEventListener('click', function () {
            close && close.click();
        });
    }
}());
</script>

<?php get_footer(); ?>
