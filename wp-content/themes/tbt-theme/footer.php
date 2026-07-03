<?php
/**
 * Plantilla de pie de página para el tema Two Buck Trucks
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<footer class="site-footer">
    <div class="footer-main">
        <div class="footer-brand">
            <img src="<?php echo esc_url( content_url( 'uploads/2026/06/TBT_Logo_Drk.png' ) ); ?>" alt="Two Buck Trucks" class="footer-logo">
        </div>

        <div class="footer-contact">
            <a class="footer-contact-item" href="tel:+19567244413">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.18 2 2 0 0 1 3.59 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.56a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 16.92z"/></svg>
                <span>(956) 207 4413</span>
            </a>
            <a class="footer-contact-item" href="mailto:info@2bucktrucks.com">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <span>info@2bucktrucks.com</span>
            </a>
            <div class="footer-contact-item">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <span>11129 FM1902, Crowley,<br>TX 76036</span>
            </div>
        </div>

        <div class="footer-social">
            <a class="footer-social-link" href="https://www.instagram.com/two_buck_trucks?igsh=MWNsNDJkNnNoNDhkMQ%3D%3D" target="_blank" rel="noopener" aria-label="Instagram">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                <span>@2bucktrucks</span>
            </a>
            <a class="footer-social-link" href="https://www.facebook.com/twobucktrucksparkinglot" target="_blank" rel="noopener" aria-label="Facebook">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                <span>2Buck Trucks</span>
            </a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Two Buck Trucks. <?php echo esc_html( tbt_text( 'footer_rights' ) ); ?></p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
