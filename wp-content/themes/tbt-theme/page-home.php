<?php
/**
 * Plantilla de página: Página de Inicio
 *
 * Proporciona un diseño personalizado para la página de inicio de Two Buck Trucks.
 * Incluye una sección hero destacando el servicio y una llamada a la acción.
 *
 * @package tbt-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Template Name: Home
 */

get_header();
?>

<main>
    <section class="hero-home">
        <div class="hero-home-media">
            <video class="home-intro-video" controls preload="metadata" poster="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo1.png' ); ?>">
                <source src="<?php echo esc_url( content_url( 'uploads/2026/05/TwoBuckTrucks-Video.mp4' ) ); ?>" type="video/mp4">
                <?php echo esc_html( tbt_text( 'home_video_fallback' ) ); ?>
            </video>
        </div>
    </section>

    <section class="section intro-section">
        <p class="intro-lead"><?php echo esc_html( tbt_text( 'home_intro' ) ); ?></p>
        <p><?php echo esc_html( tbt_text( 'home_services_copy' ) ); ?></p>
        <figure class="home-site-map-figure">
            <img src="<?php echo esc_url( content_url( 'uploads/2026/05/ChatGPT-Image-May-15-2026-07_51_55-PM.png' ) ); ?>" alt="Parking lot map">
        </figure>
    </section>

    <?php tbt_render_home_maintenance_carousel(); ?>
</main>

<script>
document.querySelectorAll('[data-carousel]').forEach((carousel) => {
    const track = carousel.querySelector('[data-carousel-track]');
    const previous = carousel.querySelector('[data-carousel-prev]');
    const next = carousel.querySelector('[data-carousel-next]');
    const dotsWrap = carousel.querySelector('[data-carousel-dots]');

    if (!track || !previous || !next || !dotsWrap) {
        return;
    }

    const cards = Array.from(track.querySelectorAll('[data-carousel-card]'));
    const dots = cards.map((_, index) => {
        const dot = document.createElement('button');
        dot.className = 'carousel-dot';
        dot.type = 'button';
        dot.setAttribute('aria-label', `Go to service ${index + 1}`);
        dot.addEventListener('click', () => {
            cards[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        });
        dotsWrap.appendChild(dot);
        return dot;
    });

    const scrollByCard = (direction) => {
        const card = track.querySelector('[data-carousel-card]');
        const amount = card ? card.getBoundingClientRect().width + 20 : track.clientWidth;
        track.scrollBy({ left: amount * direction, behavior: 'smooth' });
    };

    const updateDots = () => {
        const center = track.scrollLeft + track.clientWidth / 2;
        let activeIndex = 0;
        let activeDistance = Infinity;

        cards.forEach((card, index) => {
            const cardCenter = card.offsetLeft + card.offsetWidth / 2;
            const distance = Math.abs(center - cardCenter);
            if (distance < activeDistance) {
                activeDistance = distance;
                activeIndex = index;
            }
        });

        dots.forEach((dot, index) => {
            dot.classList.toggle('is-active', index === activeIndex);
        });
    };

    previous.addEventListener('click', () => scrollByCard(-1));
    next.addEventListener('click', () => scrollByCard(1));
    track.addEventListener('scroll', updateDots, { passive: true });
    updateDots();
});
</script>

<?php
get_footer();
