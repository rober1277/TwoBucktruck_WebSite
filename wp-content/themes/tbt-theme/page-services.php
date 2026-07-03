<?php
/**
 * Plantilla de página: Servicios y Tarifas
 *
 * Muestra los servicios de estacionamiento ofrecidos por Two Buck Trucks
 * junto con sus tarifas. Puede editar los precios y descripciones
 * directamente desde esta plantilla o modificar la página en WordPress.
 *
 * @package tbt-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Template Name: Services
 */

get_header();

$tbt_space_statuses = tbt_monday_get_reserved_spaces();
$tbt_reserved_spaces = $tbt_space_statuses['reserved'] ?? [];
$tbt_processing_spaces = $tbt_space_statuses['processing'] ?? [];
$tbt_unavailable_spaces = array_values( array_unique( array_merge( $tbt_reserved_spaces, $tbt_processing_spaces ) ) );
$tbt_reserved_lookup = array_fill_keys( $tbt_reserved_spaces, true );
$tbt_processing_lookup = array_fill_keys( $tbt_processing_spaces, true );
$tbt_section_a_available = 56 - count( array_filter( $tbt_unavailable_spaces, static function ( $space ) {
    return 0 === strpos( $space, 'A-' );
} ) );
$tbt_section_b_available = 56 - count( array_filter( $tbt_unavailable_spaces, static function ( $space ) {
    return 0 === strpos( $space, 'B-' );
} ) );
?>

<main>
    <section class="services-page">

        <!-- ── HERO DE PLANES ── -->
        <div class="plans-hero">
            <h1 class="plans-hero-title">
                <?php if ( 'es' === tbt_current_lang() ) : ?>
                    <?php echo esc_html( tbt_text( 'services_title' ) ); ?>
                <?php else : ?>
                    <?php echo esc_html( tbt_text( 'services_title' ) ); ?>
                <?php endif; ?>
            </h1>
            <p class="plans-hero-sub"><?php echo esc_html( tbt_text( 'services_intro' ) ); ?></p>
        </div>

        <!-- ── TARJETAS DE PLANES ── -->
        <div class="plans-grid">

            <div class="plan-card-new">
                <div class="plan-card-top">
                    <span class="plan-card-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </span>
                    <h3 class="plan-card-name"><?php echo esc_html( tbt_text( 'plan_day' ) ); ?></h3>
                    <div class="plan-card-price">$15 <span>USD</span></div>
                    <p class="plan-card-desc"><?php echo esc_html( tbt_text( 'plan_day_copy' ) ); ?></p>
                </div>
                <a class="plan-card-btn" href="#site-map"><?php echo esc_html( tbt_text( 'subscribe' ) ); ?></a>
            </div>

            <div class="plan-card-new">
                <div class="plan-card-top">
                    <span class="plan-card-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </span>
                    <h3 class="plan-card-name"><?php echo esc_html( tbt_text( 'plan_week' ) ); ?></h3>
                    <div class="plan-card-price">$50 <span>USD</span></div>
                    <p class="plan-card-desc"><?php echo esc_html( tbt_text( 'plan_week_copy' ) ); ?></p>
                </div>
                <a class="plan-card-btn" href="#site-map"><?php echo esc_html( tbt_text( 'subscribe' ) ); ?></a>
            </div>

            <div class="plan-card-new">
                <div class="plan-card-top">
                    <span class="plan-card-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 10 10"/><path d="M12 6v6l4 2"/></svg>
                    </span>
                    <h3 class="plan-card-name"><?php echo esc_html( tbt_text( 'plan_month' ) ); ?></h3>
                    <div class="plan-card-price">$175 <span>USD</span></div>
                    <p class="plan-card-desc"><?php echo esc_html( tbt_text( 'plan_month_copy' ) ); ?></p>
                </div>
                <a class="plan-card-btn" href="#site-map"><?php echo esc_html( tbt_text( 'subscribe' ) ); ?></a>
            </div>

            <div class="plan-card-new plan-card-featured">
                <div class="plan-card-badge"><?php echo esc_html( 'es' === tbt_current_lang() ? 'Más Popular' : 'Most Popular' ); ?></div>
                <div class="plan-card-top">
                    <span class="plan-card-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </span>
                    <h3 class="plan-card-name"><?php echo esc_html( tbt_text( 'plan_recurring' ) ); ?></h3>
                    <div class="plan-card-price">$175 <span>USD/<?php echo esc_html( 'es' === tbt_current_lang() ? 'mes' : 'mo' ); ?></span></div>
                    <p class="plan-card-desc"><?php echo esc_html( tbt_text( 'plan_recurring_copy' ) ); ?></p>
                </div>
                <a class="plan-card-btn" href="#site-map"><?php echo esc_html( tbt_text( 'subscribe' ) ); ?></a>
            </div>

        </div>

        <!-- ══════════════════════════════════════════════════════
             MAPA INTERACTIVO — Plano Real + Panel
        ═══════════════════════════════════════════════════════ -->
        <div class="lot-map" id="site-map">

            <!-- Encabezado -->
            <div class="lot-map-header">
                <div class="lot-map-header-left">
                    <h2 class="lot-map-title"><?php echo esc_html( tbt_text( 'site_map' ) ); ?></h2>
                    <p class="lot-map-subtitle">
                        <?php
                        $tbt_total_available = max( 0, $tbt_section_a_available ) + max( 0, $tbt_section_b_available );
                        echo esc_html( 'es' === tbt_current_lang()
                            ? $tbt_total_available . ' / 112 lugares disponibles'
                            : $tbt_total_available . ' / 112 spots available'
                        );
                        ?>
                    </p>
                </div>
                <div class="lot-map-legend">
                    <span class="lot-legend-item lot-legend-free"><?php echo esc_html( 'es' === tbt_current_lang() ? 'Disponible' : 'Available' ); ?></span>
                    <span class="lot-legend-item lot-legend-selected"><?php echo esc_html( 'es' === tbt_current_lang() ? 'Seleccionado' : 'Selected' ); ?></span>
                    <span class="lot-legend-item lot-legend-reserved"><?php echo esc_html( 'es' === tbt_current_lang() ? 'Reservado' : 'Reserved' ); ?></span>
                </div>
            </div>

            <!-- Cuerpo: plano + panel -->
            <div class="lot-map-body">

                <!-- ── PLANO DEL PARQUEADERO ── -->
                <div class="lot-plan-wrap">
                    <div class="lot-plan-container">

                        <!-- Imagen base del plano real -->
                        <img
                            class="lot-plan-img"
                            src="<?php echo esc_url( content_url( 'uploads/2026/06/Reserve_Map.png' ) ); ?>"
                            alt="<?php echo esc_attr( 'es' === tbt_current_lang() ? 'Plano del parqueadero' : 'Parking lot map' ); ?>"
                            draggable="false"
                        >

                        <!-- ── ÁREA A — rectángulo verde ── -->
                        <!-- Coordenadas sobre la imagen 1672×941:
                             left≈4.7%  top≈23.7%  width≈81.5%  height≈16.3% -->
                        <div class="lot-area-zone lot-area-zone-a" data-area="A"
                             aria-label="<?php echo esc_attr( tbt_text('section_a') ); ?>">
                            <div class="lot-zone-track" data-track="A">
                                <?php for ( $i = 56; $i >= 1; $i-- ) :
                                    $space         = 'A-' . $i;
                                    $is_reserved   = isset( $tbt_reserved_lookup[ $space ] );
                                    $is_processing = isset( $tbt_processing_lookup[ $space ] );
                                    $is_unavail    = $is_reserved || $is_processing;
                                    $cls = 'lot-spot';
                                    if ( $is_reserved )   $cls .= ' is-reserved';
                                    if ( $is_processing ) $cls .= ' is-processing';
                                ?>
                                <button
                                    class="<?php echo esc_attr( $cls ); ?>"
                                    type="button"
                                    data-spot="<?php echo esc_attr( $space ); ?>"
                                    aria-pressed="false"
                                    aria-label="<?php echo esc_attr( ( $is_unavail ? tbt_text('reserved_spot') : tbt_text('available_spot') ) . ' ' . $space ); ?>"
                                    <?php if ( $is_unavail ) echo 'disabled aria-disabled="true" data-reserved="true"'; ?>
                                >
                                    <span class="lot-spot-num"><?php echo esc_html( $space ); ?></span>
                                </button>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <!-- ── ÁREA B — rectángulo azul ── -->
                        <!-- Coordenadas sobre la imagen 1672×941:
                             left≈4.7%  top≈46.0%  width≈81.5%  height≈17.8% -->
                        <div class="lot-area-zone lot-area-zone-b" data-area="B"
                             aria-label="<?php echo esc_attr( tbt_text('section_b') ); ?>">
                            <div class="lot-zone-track" data-track="B">
                                <?php for ( $i = 112; $i >= 57; $i-- ) :
                                    $space         = 'B-' . $i;
                                    $is_reserved   = isset( $tbt_reserved_lookup[ $space ] );
                                    $is_processing = isset( $tbt_processing_lookup[ $space ] );
                                    $is_unavail    = $is_reserved || $is_processing;
                                    $cls = 'lot-spot';
                                    if ( $is_reserved )   $cls .= ' is-reserved';
                                    if ( $is_processing ) $cls .= ' is-processing';
                                ?>
                                <button
                                    class="<?php echo esc_attr( $cls ); ?>"
                                    type="button"
                                    data-spot="<?php echo esc_attr( $space ); ?>"
                                    aria-pressed="false"
                                    aria-label="<?php echo esc_attr( ( $is_unavail ? tbt_text('reserved_spot') : tbt_text('available_spot') ) . ' ' . $space ); ?>"
                                    <?php if ( $is_unavail ) echo 'disabled aria-disabled="true" data-reserved="true"'; ?>
                                >
                                    <span class="lot-spot-num"><?php echo esc_html( $space ); ?></span>
                                </button>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <!-- Etiqueta sección A -->
                        <div class="lot-plan-label lot-plan-label-a">
                            <span class="lot-plan-section-badge">
                                <?php echo esc_html( tbt_text( 'section_a' ) ); ?>
                                <em><?php echo esc_html( max( 0, $tbt_section_a_available ) ); ?> <?php echo esc_html( 'es' === tbt_current_lang() ? 'disp.' : 'avail.' ); ?></em>
                            </span>
                        </div>

                        <!-- Etiqueta sección B -->
                        <div class="lot-plan-label lot-plan-label-b">
                            <span class="lot-plan-section-badge">
                                <?php echo esc_html( tbt_text( 'section_b' ) ); ?>
                                <em><?php echo esc_html( max( 0, $tbt_section_b_available ) ); ?> <?php echo esc_html( 'es' === tbt_current_lang() ? 'disp.' : 'avail.' ); ?></em>
                            </span>
                        </div>

                        <!-- Drive aisle label -->
                        <div class="lot-plan-aisle-label" aria-hidden="true">
                            <svg viewBox="0 0 24 12" fill="none"><path d="M2 6h20M16 2l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <?php echo esc_html( tbt_text( 'entrance_label' ) ); ?>
                        </div>

                    </div><!-- /.lot-plan-container -->

                    <!-- Hint -->
                    <p class="lot-plan-hint" aria-live="polite">
                        <?php echo esc_html( 'es' === tbt_current_lang()
                            ? 'Desplázate dentro de cada sección para ver todos los lugares'
                            : 'Scroll inside each section to see all spots'
                        ); ?>
                    </p>
                </div><!-- /.lot-plan-wrap -->

                <!-- ── PANEL DE RESERVA (columna derecha) ── -->
                <div class="lot-info-panel" data-info-panel>

                    <!-- Sección: spot seleccionado -->
                    <div class="lot-panel-section lot-info-focused">
                        <p class="lot-info-label"><?php echo esc_html( 'es' === tbt_current_lang() ? 'Lugar seleccionado' : 'Selected spot' ); ?></p>
                        <div class="lot-info-spot-id" data-info-spot-id>—</div>
                        <div class="lot-info-status" data-info-spot-status>
                            <span class="lot-status-dot" data-info-status-dot></span>
                            <span data-info-status-text><?php echo esc_html( 'es' === tbt_current_lang() ? 'Elige un lugar en el mapa' : 'Choose a spot on the map' ); ?></span>
                        </div>
                        <button class="lot-btn-add" type="button" data-info-add-btn hidden>
                            <?php echo esc_html( 'es' === tbt_current_lang() ? '+ Agregar a selección' : '+ Add to selection' ); ?>
                        </button>
                        <button class="lot-btn-remove" type="button" data-info-remove-btn hidden>
                            <?php echo esc_html( 'es' === tbt_current_lang() ? '✕ Quitar de selección' : '✕ Remove from selection' ); ?>
                        </button>
                    </div>

                    <div class="lot-info-divider"></div>

                    <!-- Sección: lista de seleccionados -->
                    <div class="lot-panel-section lot-info-selection">
                        <p class="lot-info-label"><?php echo esc_html( 'es' === tbt_current_lang() ? 'Mi selección' : 'My selection' ); ?></p>
                        <ul class="lot-selected-list" data-selected-list>
                            <li class="lot-selected-empty" data-selected-empty><?php echo esc_html( 'es' === tbt_current_lang() ? 'Ninguno aún' : 'None yet' ); ?></li>
                        </ul>
                        <p class="lot-selection-max"><?php echo esc_html( 'es' === tbt_current_lang() ? 'Máx. 4 lugares' : 'Max. 4 spots' ); ?></p>
                    </div>

                    <!-- Botón reservar -->
                    <div class="lot-panel-section lot-info-reserve">
                        <button class="lot-btn-reserve button-primary reserve-button" type="button" data-reserve-button>
                            <?php echo esc_html( tbt_text( 'reserve_selected' ) ); ?>
                        </button>
                    </div>

                    <!-- Panel de reserva (hidden, usado por el JS existente) -->
                    <div class="reservation-panel" data-reservation-panel style="display:none"></div>

                </div><!-- /.lot-info-panel -->

            </div><!-- /.lot-map-body -->

        </div><!-- /.lot-map -->

            <!-- Modal: reserved — mantenido para compatibilidad JS, no visible -->
            <div class="reservation-modal" data-modal="reserved" hidden aria-hidden="true">
                <p data-reserved-spaces hidden></p>
                <button type="button" data-info-button hidden></button>
            </div>

            <!-- Modal: sin selección -->
            <div class="rsv-modal" data-modal="no-selection" hidden role="dialog" aria-modal="true" aria-labelledby="no-sel-title">
                <div class="rsv-modal-backdrop" data-modal-close></div>
                <div class="rsv-modal-box rsv-modal-box--sm">
                    <button class="rsv-modal-close" type="button" data-modal-close aria-label="<?php echo esc_attr( tbt_text('close') ); ?>">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="1" y1="1" x2="13" y2="13"/><line x1="13" y1="1" x2="1" y2="13"/></svg>
                    </button>
                    <div class="rsv-modal-alert">
                        <div class="rsv-alert-icon rsv-alert-icon--warn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        </div>
                        <h3 class="rsv-alert-title" id="no-sel-title"><?php echo esc_html( tbt_text( 'no_spaces_selected' ) ); ?></h3>
                        <button class="rsv-btn rsv-btn--outline" type="button" data-modal-close><?php echo esc_html( tbt_text( 'close' ) ); ?></button>
                    </div>
                </div>
            </div>

            <!-- Modal: límite de selección — estilo cs-modal -->
            <div class="cs-modal" id="maxSelectionModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="maxSelectionModalTitle">
                <div class="cs-modal-backdrop" id="maxSelectionModalBackdrop"></div>
                <div class="cs-modal-box">
                    <div class="cs-modal-img-wrap" aria-hidden="true">
                        <img src="<?php echo esc_url( content_url( 'uploads/2026/06/TBT_bottom_image.png' ) ); ?>" alt="">
                        <div class="cs-modal-img-overlay"></div>
                    </div>
                    <div class="cs-modal-body">
                        <div class="cs-modal-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </div>
                        <h2 class="cs-modal-title" id="maxSelectionModalTitle">
                            <?php echo esc_html( 'es' === tbt_current_lang() ? 'Límite alcanzado' : 'Limit reached' ); ?>
                        </h2>
                        <p class="cs-modal-sub">
                            <?php echo esc_html( tbt_text( 'max_spaces_selected' ) ); ?>
                        </p>
                        <button class="cs-modal-close" id="maxSelectionModalClose" type="button">
                            <?php echo esc_html( tbt_text( 'close' ) ); ?>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal: formulario de reserva (pasos 1 y 2) -->
            <div class="rsv-modal" data-modal="customer-info" hidden role="dialog" aria-modal="true" aria-labelledby="customer-info-modal-title">
                <div class="rsv-modal-backdrop" data-modal-close></div>
                <div class="rsv-modal-box rsv-modal-box--form">

                    <!-- Imagen de cabecera con la forma del formulario -->
                    <div class="rsv-modal-hero" aria-hidden="true">
                        <img src="<?php echo esc_url( content_url( 'uploads/2026/06/Revserve_Form.png' ) ); ?>" alt="">
                        <div class="rsv-modal-hero-overlay"></div>
                        <!-- Indicador de pasos -->
                        <div class="rsv-steps">
                            <span class="rsv-step rsv-step--active" data-step-dot="1">1</span>
                            <span class="rsv-step-line"></span>
                            <span class="rsv-step" data-step-dot="2">2</span>
                            <span class="rsv-step-line"></span>
                            <span class="rsv-step" data-step-dot="3">3</span>
                        </div>
                    </div>

                    <div class="rsv-modal-body">
                        <button class="rsv-modal-close" type="button" data-modal-close aria-label="<?php echo esc_attr( tbt_text('close') ); ?>">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="1" y1="1" x2="13" y2="13"/><line x1="13" y1="1" x2="1" y2="13"/></svg>
                        </button>

                        <h3 class="rsv-modal-title" id="customer-info-modal-title"
                            data-form-modal-title
                            data-step-one-title="<?php echo esc_attr( tbt_text( 'customer_info' ) ); ?>"
                            data-step-two-title="<?php echo esc_attr( tbt_text( 'vehicle_info' ) ); ?>">
                            <?php echo esc_html( tbt_text( 'customer_info' ) ); ?>
                        </h3>

                        <form class="rsv-form" data-reservation-form>

                            <!-- ── Paso 1: Info del conductor ── -->
                            <div class="rsv-form-step is-active" data-form-step="1">
                                <div class="rsv-form-grid">
                                    <label class="rsv-label">
                                        <span><?php echo esc_html( tbt_text( 'driver_full_name' ) ); ?></span>
                                        <input type="text" name="driver_full_name" required placeholder="John Doe">
                                    </label>
                                    <label class="rsv-label">
                                        <span><?php echo esc_html( tbt_text( 'company_name' ) ); ?></span>
                                        <input type="text" name="company_name" required placeholder="ACME Trucking LLC">
                                    </label>
                                    <label class="rsv-label">
                                        <span><?php echo esc_html( tbt_text( 'driver_phone' ) ); ?></span>
                                        <input type="tel" name="driver_phone" required placeholder="(817) 000-0000">
                                    </label>
                                    <label class="rsv-label">
                                        <span><?php echo esc_html( tbt_text( 'emergency_phone' ) ); ?></span>
                                        <input type="tel" name="emergency_phone" required placeholder="(817) 000-0000">
                                    </label>
                                    <label class="rsv-label">
                                        <span><?php echo esc_html( tbt_text( 'driver_email' ) ); ?></span>
                                        <input type="email" name="driver_email" required placeholder="driver@email.com">
                                    </label>
                                    <label class="rsv-label">
                                        <span><?php echo esc_html( tbt_text( 'company_billing_email' ) ); ?></span>
                                        <input type="email" name="company_billing_email" required placeholder="billing@company.com">
                                    </label>
                                    <label class="rsv-label rsv-label--full">
                                        <span><?php echo esc_html( tbt_text( 'physical_address' ) ); ?></span>
                                        <input type="text" name="physical_address" required placeholder="123 Main St, City, TX">
                                    </label>
                                    <label class="rsv-label">
                                        <span><?php echo esc_html( tbt_text( 'entry_date' ) ); ?></span>
                                        <input type="date" name="entry_date" required>
                                    </label>
                                </div>
                                <div class="rsv-form-actions">
                                    <button class="rsv-btn rsv-btn--primary" type="button" data-form-next>
                                        <?php echo esc_html( tbt_text( 'continue' ) ); ?>
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="3" y1="8" x2="13" y2="8"/><polyline points="9,4 13,8 9,12"/></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- ── Paso 2: Info del vehículo ── -->
                            <div class="rsv-form-step" data-form-step="2" hidden>
                                <div class="rsv-form-grid">
                                    <label class="rsv-label">
                                        <span><?php echo esc_html( tbt_text( 'assigned_vehicle' ) ); ?></span>
                                        <input type="text" name="assigned_vehicle" required placeholder="Freightliner Cascadia">
                                    </label>
                                    <label class="rsv-label">
                                        <span><?php echo esc_html( tbt_text( 'vehicle_year' ) ); ?></span>
                                        <input type="number" name="vehicle_year" min="1900" max="2100" required placeholder="2022">
                                    </label>
                                    <label class="rsv-label">
                                        <span><?php echo esc_html( tbt_text( 'vehicle_plate' ) ); ?></span>
                                        <input type="text" name="vehicle_plate" required placeholder="ABC-1234">
                                    </label>
                                    <label class="rsv-label">
                                        <span><?php echo esc_html( tbt_text( 'vehicle_vin' ) ); ?></span>
                                        <input type="text" name="vehicle_vin" required placeholder="1FUJGBDV…">
                                    </label>
                                    <label class="rsv-label rsv-label--full">
                                        <span><?php echo esc_html( tbt_text( 'regular_cargo' ) ); ?></span>
                                        <input type="text" name="regular_cargo" required placeholder="General freight, dry goods…">
                                    </label>
                                    <label class="rsv-label rsv-label--file">
                                        <span><?php echo esc_html( tbt_text( 'truck_photo' ) ); ?></span>
                                        <div class="rsv-file-wrap">
                                            <input type="file" name="truck_photo" accept="image/*" required data-file-input>
                                            <span class="rsv-file-placeholder">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                                <?php echo esc_html( 'es' === tbt_current_lang() ? 'Subir foto' : 'Upload photo' ); ?>
                                            </span>
                                        </div>
                                    </label>
                                    <label class="rsv-label rsv-label--file">
                                        <span><?php echo esc_html( tbt_text( 'driver_door_photo' ) ); ?></span>
                                        <div class="rsv-file-wrap">
                                            <input type="file" name="driver_door_photo" accept="image/*" required data-file-input>
                                            <span class="rsv-file-placeholder">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                                <?php echo esc_html( 'es' === tbt_current_lang() ? 'Subir foto' : 'Upload photo' ); ?>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <div class="rsv-form-actions rsv-form-actions--two">
                                    <button class="rsv-btn rsv-btn--ghost" type="button" data-form-back>
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="13" y1="8" x2="3" y2="8"/><polyline points="7,4 3,8 7,12"/></svg>
                                        <?php echo esc_html( tbt_text( 'back' ) ); ?>
                                    </button>
                                    <button class="rsv-btn rsv-btn--primary" type="submit">
                                        <?php echo esc_html( tbt_text( 'continue' ) ); ?>
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="3" y1="8" x2="13" y2="8"/><polyline points="9,4 13,8 9,12"/></svg>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div><!-- /.rsv-modal-body -->
                </div><!-- /.rsv-modal-box -->
            </div>

            <!-- Modal: contrato y firma (paso 3) -->
            <div class="rsv-modal rsv-modal--agreement" data-modal="agreement" hidden role="dialog" aria-modal="true" aria-labelledby="agreement-modal-title">
                <div class="rsv-modal-backdrop" data-modal-close></div>
                <div class="rsv-modal-box rsv-modal-box--agreement">

                    <div class="rsv-modal-body">
                        <button class="rsv-modal-close" type="button" data-modal-close aria-label="<?php echo esc_attr( tbt_text('close') ); ?>">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="1" y1="1" x2="13" y2="13"/><line x1="13" y1="1" x2="1" y2="13"/></svg>
                        </button>

                        <!-- Cabecera del paso 3 con indicador -->
                        <div class="rsv-agreement-header">
                            <div class="rsv-steps rsv-steps--inline">
                                <span class="rsv-step rsv-step--done" data-step-dot="1">✓</span>
                                <span class="rsv-step-line rsv-step-line--done"></span>
                                <span class="rsv-step rsv-step--done" data-step-dot="2">✓</span>
                                <span class="rsv-step-line rsv-step-line--done"></span>
                                <span class="rsv-step rsv-step--active" data-step-dot="3">3</span>
                            </div>
                            <h3 class="rsv-modal-title" id="agreement-modal-title"><?php echo esc_html( tbt_text( 'agreement_title' ) ); ?></h3>
                            <p class="rsv-agreement-intro"><?php echo esc_html( tbt_text( 'agreement_intro' ) ); ?></p>
                        </div>

                    <div class="agreement-document">
                        <div class="agreement-summary">
                            <section>
                                <h4><?php echo esc_html( tbt_text( 'agreement_customer' ) ); ?></h4>
                                <dl>
                                    <div><dt><?php echo esc_html( tbt_text( 'driver_full_name' ) ); ?></dt><dd data-contract-field="driver_full_name">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'company_name' ) ); ?></dt><dd data-contract-field="company_name">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'driver_phone' ) ); ?></dt><dd data-contract-field="driver_phone">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'emergency_phone' ) ); ?></dt><dd data-contract-field="emergency_phone">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'driver_email' ) ); ?></dt><dd data-contract-field="driver_email">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'company_billing_email' ) ); ?></dt><dd data-contract-field="company_billing_email">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'physical_address' ) ); ?></dt><dd data-contract-field="physical_address">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'entry_date' ) ); ?></dt><dd data-contract-field="entry_date">-</dd></div>
                                </dl>
                            </section>

                            <section>
                                <h4><?php echo esc_html( tbt_text( 'vehicle_info' ) ); ?></h4>
                                <dl>
                                    <div><dt><?php echo esc_html( tbt_text( 'assigned_vehicle' ) ); ?></dt><dd data-contract-field="assigned_vehicle">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'vehicle_year' ) ); ?></dt><dd data-contract-field="vehicle_year">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'vehicle_plate' ) ); ?></dt><dd data-contract-field="vehicle_plate">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'vehicle_vin' ) ); ?></dt><dd data-contract-field="vehicle_vin">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'regular_cargo' ) ); ?></dt><dd data-contract-field="regular_cargo">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'agreement_spaces' ) ); ?></dt><dd data-contract-field="spaces">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'selected_plan' ) ); ?></dt><dd data-contract-field="selected_plan">-</dd></div>
                                    <div><dt><?php echo esc_html( tbt_text( 'selected_plan_price' ) ); ?></dt><dd data-contract-field="selected_plan_price">-</dd></div>
                                </dl>
                            </section>
                        </div>

                        <section class="agreement-terms">
                            <h4><?php echo esc_html( tbt_text( 'agreement_terms' ) ); ?></h4>
                            <ol>
                                <li><?php echo esc_html( tbt_text( 'agreement_term_one' ) ); ?></li>
                                <li><?php echo esc_html( tbt_text( 'agreement_term_two' ) ); ?></li>
                                <li><?php echo esc_html( tbt_text( 'agreement_term_three' ) ); ?></li>
                                <li><?php echo esc_html( tbt_text( 'agreement_term_four' ) ); ?></li>
                                <li class="agreement-important-term"><span aria-hidden="true">!</span><strong><?php echo esc_html( tbt_text( 'agreement_term_card_payment' ) ); ?></strong></li>
                            </ol>
                            <button class="button-primary agreement-toggle" type="button" data-agreement-toggle data-open-label="<?php echo esc_attr( tbt_text( 'read_full_agreement' ) ); ?>" data-close-label="<?php echo esc_attr( tbt_text( 'hide_full_agreement' ) ); ?>"><?php echo esc_html( tbt_text( 'read_full_agreement' ) ); ?></button>
                        </section>

                        <section class="full-agreement" data-full-agreement hidden>
                            <h4>COMMERCIAL VEHICLE PARKING AGREEMENT</h4>
                            <p><strong>Introduction</strong></p>
                            <p>This Commercial Vehicle Parking Agreement is entered into by and between the company Two Buck Trucks and the parking service user <strong data-contract-field="full_name">-</strong>, for the purpose of establishing the terms and conditions under which the use of designated parking spaces for commercial vehicles will be permitted within the facilities located at 11129 FM 1902, Crowley, TX 76036.</p>
                            <p>Before using the services offered by the Company, the User must provide the following information, which shall form an integral part of this Agreement. This information will identify the person responsible for the vehicle and formalize the legal relationship, whether as the owner, contracting company, or designated driver.</p>

                            <h5>REQUIRED INFORMATION</h5>
                            <p><strong>1. VEHICLE OWNER / COMPANY INFORMATION</strong></p>
                            <p>(This section must be completed by the vehicle owner or the legal representative of the contracting company.)</p>
                            <ul>
                                <li>Owner or company name: <strong data-contract-field="full_name">-</strong></li>
                                <li>Company: <strong data-contract-field="company_name">-</strong></li>
                                <li>Address: <strong data-contract-field="physical_address">-</strong></li>
                                <li>Email address: <strong data-contract-field="email">-</strong></li>
                                <li>Company billing email: <strong data-contract-field="company_billing_email">-</strong></li>
                                <li>Contact phone number: <strong data-contract-field="phone">-</strong></li>
                                <li>Entrance Date: <strong data-contract-field="entry_date">-</strong></li>
                                <li>Website (if applicable): ______________________________________</li>
                            </ul>

                            <p><strong>2. DRIVER INFORMATION (IF APPLICABLE)</strong></p>
                            <p>(If the driver is not the owner but an employee or representative, this section must be completed.)</p>
                            <ul>
                                <li>Full name of driver: <strong data-contract-field="driver_full_name">-</strong></li>
                                <li>Email address: <strong data-contract-field="driver_email">-</strong></li>
                                <li>Phone number: <strong data-contract-field="driver_phone">-</strong></li>
                                <li>Emergency phone number: <strong data-contract-field="emergency_phone">-</strong></li>
                                <li>Make / Model: <strong data-contract-field="assigned_vehicle">-</strong></li>
                                <li>Vehicle year: <strong data-contract-field="vehicle_year">-</strong></li>
                                <li>License plate: <strong data-contract-field="vehicle_plate">-</strong></li>
                                <li>Truck number: <strong data-contract-field="vehicle_vin">-</strong></li>
                                <li>Type of regular cargo: <strong data-contract-field="regular_cargo">-</strong></li>
                            </ul>

                            <h5>I. DECLARATIONS</h5>
                            <p><strong>1.1. By the Company</strong></p>
                            <p>Two Buck Trucks declares:</p>
                            <ol type="a">
                                <li>That it is the lawful operator of the parking facilities located at 11129 FM 1902, Crowley, TX 76036 (the "Parking Lot").</li>
                                <li>That it holds all licenses, permits, and insurance required by the laws of the State of Texas to operate said facilities.</li>
                                <li>That it has the authority to issue this Agreement.</li>
                            </ol>
                            <p><strong>1.2. By the User</strong></p>
                            <p><strong data-contract-field="full_name">-</strong> declares:</p>
                            <ol type="a">
                                <li>That they are the driver, representative, or owner of the commercial vehicle described.</li>
                                <li>That they maintain valid liability insurance applicable to the vehicle and its cargo.</li>
                                <li>That they understand and accept the terms of this Agreement.</li>
                            </ol>

                            <h5>II. PURPOSE</h5>
                            <p>2.1. The Company grants the User a non-exclusive right to park their vehicle in the Parking Lot, subject to payment of the Fees (defined in Clause III) and compliance with the Rules. The Company may update these rules by providing written notice to the User at least thirty (30) days in advance.</p>

                            <h5>III. FEES AND PAYMENTS</h5>
                            <p><strong>3.1. Rates:</strong></p>
                            <ul>
                                <li>Contracted plan: <strong data-contract-field="selected_plan">-</strong></li>
                                <li>Total contracted amount: <strong data-contract-field="selected_plan_price">-</strong></li>
                                <li data-recurring-contract-note hidden>Recurring monthly total: <strong data-contract-field="selected_plan_price">-</strong> will be charged automatically to the payment method on file.</li>
                            </ul>
                            <p><strong>3.2. Payment Terms:</strong></p>
                            <p><strong>a) Payment due date:</strong> All payments must be made on the 1st day of each month without exception. Payments not received by the 2nd day will be considered late.</p>
                            <p><strong>b) Card registration:</strong> Each User must register a valid credit or debit card with the Company. If the User does not make the payment by the due date, the Company may automatically charge the registered card.</p>
                            <p><strong>c) Late fee:</strong> If the payment is not reflected in the system by the 10th day of each month, a late fee of $40 USD per month will automatically apply.</p>
                            <p><strong>d) Outstanding payments:</strong> If the previous month's payment remains unpaid and the current month is also unpaid, the vehicle will be deemed abandoned after proper notification and may be towed at the User's expense.</p>
                            <p><strong>e) Card conditions:</strong> The registered card must be in good standing and free of any restrictions for automatic transactions. If, within a period of six consecutive or cumulative months, the card is declined on two occasions, the Company will notify the User to update the payment information or register a new card. If the User fails to update the card and another decline occurs, the User shall vacate the Parking Facility immediately for breach of the payment terms.</p>

                            <h5>IV. PARKING RULES</h5>
                            <ol>
                                <li><strong>Speed limit:</strong> The maximum speed within the Parking Lot is 5 mph.</li>
                                <li><strong>Space assignment:</strong> Each User must park only in the space assigned by the Company. It is strictly prohibited to occupy any other space, even if it appears vacant.</li>
                                <li><strong>Personal vehicles:</strong> Any personal vehicle of the User must remain within the assigned space without encroaching on adjacent spaces.</li>
                                <li><strong>Objects and obstacles:</strong> It is prohibited to leave non-towable objects inside or outside the assigned space, such as loose tires, truck parts, tools, trash, or materials that obstruct or dirty common areas.</li>
                                <li><strong>Safe maneuvers:</strong> Loading or unloading maneuvers that block driveways, emergency exits, or obstruct other drivers' visibility are prohibited.</li>
                                <li><strong>Mechanical work:</strong> Heavy mechanical work (such as disassembly or major repairs) is prohibited. Only basic maintenance is allowed.</li>
                                <li><strong>Hazardous substances:</strong> Smoking or handling flammable materials outside designated areas is prohibited.</li>
                                <li><strong>Access:</strong> Access to the Parking Lot is available 24 hours a day unless otherwise notified in writing by the Company.</li>
                                <li><strong>Space invasion:</strong> If a vehicle is found parked outside its assigned space, the User will be notified and given between 30 minutes and 1 hour to remove it. Failure to comply will result in immediate towing at the User's expense.</li>
                            </ol>

                            <h5>V. CLEANLINESS, WASTE, AND RESTRICTED MATERIALS</h5>
                            <p><strong>5.1. Space cleanliness:</strong> The User must keep their space free from trash, fuel spills, oil, chemicals, or any other waste that could pose a risk or harm the image of the Parking Lot.</p>
                            <p><strong>5.2. Offensive or harmful materials:</strong> Vehicles carrying materials with strong odors, corrosive substances, or toxic materials that cause discomfort are prohibited. The Company may deny access or require immediate removal.</p>
                            <p><strong>5.3. Corrective cleaning:</strong> Any spill, stain, or residue caused by the User must be cleaned immediately. Otherwise, the Company may perform the cleaning and charge the corresponding administrative and operational costs.</p>

                            <h5>VI. LIABILITY, INSURANCE, AND INDEMNIFICATION</h5>
                            <p><strong>6.1. Assumed risk:</strong> The User acknowledges that parking in the Parking Lot is at their own risk. The Company is not responsible for theft, vandalism, fire, incidents, accidents, or collisions between vehicles or with third parties.</p>
                            <p><strong>6.2. Mandatory insurance:</strong> The User must maintain liability insurance and provide proof of coverage when requested by the Company.</p>
                            <p><strong>6.3. Indemnification:</strong> The User agrees to indemnify and hold the Company harmless from any claim, demand, or fine arising from acts or omissions by the User, their employees, or representatives within the Parking Lot.</p>

                            <h5>VII. BREACH AND PENALTIES</h5>
                            <p>Violation of this Agreement will result in penalties determined by the Company, based on the severity of the violation, the impact caused, inconvenience to other Users, and the User's history. The Company may also suspend or terminate services if it deems the User's behavior risky or a serious breach.</p>
                            <ol>
                                <li><strong>Unauthorized space occupation:</strong> Immediate notification, 30 to 60 minutes to remove the vehicle, immediate towing if not corrected, and fine determined by the Company.</li>
                                <li><strong>Unauthorized storage of objects:</strong> Removal of objects without prior notice and fine determined by the Company.</li>
                                <li><strong>Heavy mechanical work:</strong> Fine determined by the Company and suspension or termination of the Agreement in case of recurrence.</li>
                                <li><strong>Contamination or spills:</strong> Cleaning charge, additional fine depending on affected area, and possible notification to authorities if applicable.</li>
                                <li><strong>Blocking or dangerous maneuvers:</strong> Fine determined by the Company and service suspension if repeated.</li>
                                <li><strong>Use of fire or hazardous materials in unauthorized areas:</strong> Variable fine and immediate termination of the Agreement in case of serious risk.</li>
                                <li><strong>Non-payment or prolonged debts:</strong> Monthly late fees, towing for abandonment, and early termination of the Agreement.</li>
                                <li><strong>Inappropriate conduct or repeated violations:</strong> Variable fine, service suspension, and immediate termination of the Agreement.</li>
                            </ol>

                            <h5>VIII. NOTIFICATIONS</h5>
                            <p>All communications shall be sent to the addresses or email accounts indicated on the first page of this Agreement and shall be deemed notified by the Company once sent, whether through email, text message, phone call, or any other documented method of communication.</p>

                            <h5>IX. AMENDMENTS</h5>
                            <p>This Agreement may only be amended by a written addendum signed by both parties. No delay or tolerance shall constitute a waiver of rights.</p>

                            <h5>X. GOVERNING LAW AND JURISDICTION</h5>
                            <p>This Agreement shall be governed by the laws of the State of Texas. The parties submit to the jurisdiction of the competent courts of Tarrant County, Texas, waiving any other jurisdiction that might apply.</p>

                            <h5>XI. ACCEPTANCE AND SIGNATURE</h5>
                            <p>Having read and understood this Agreement and its legal implications, the parties sign it in duplicate in Crowley, Texas, on <strong data-contract-field="signed_on">-</strong>.</p>
                            <p>Representative of Two Buck Trucks <strong>Esmeralda Berenice Nunez Baez</strong></p>
                            <p>User's Name and Signature <strong data-contract-field="full_name">-</strong></p>
                        </section>

                        <div class="rsv-signature-block">
                            <label class="rsv-agreement-checkbox">
                                <input type="checkbox" data-agreement-accept>
                                <span><?php echo esc_html( tbt_text( 'agreement_accept' ) ); ?></span>
                            </label>
                            <label class="rsv-signature-label" for="agreement-signature"><?php echo esc_html( tbt_text( 'signature_label' ) ); ?></label>
                            <canvas id="agreement-signature" class="rsv-signature-pad" width="760" height="180" data-signature-pad></canvas>
                            <div class="rsv-signature-meta">
                                <span><?php echo esc_html( tbt_text( 'signed_on' ) ); ?>: <strong data-contract-field="signed_on">-</strong></span>
                                <button class="rsv-btn rsv-btn--ghost rsv-btn--sm" type="button" data-clear-signature><?php echo esc_html( tbt_text( 'clear_signature' ) ); ?></button>
                            </div>
                        </div>
                    </div><!-- /.agreement-document -->

                    <div class="rsv-form-actions rsv-agreement-actions">
                        <button class="rsv-btn rsv-btn--primary rsv-btn--reserve" type="button" data-agreement-continue disabled>
                            <span class="rsv-btn-spinner" aria-hidden="true"></span>
                            <span data-button-label><?php echo esc_html( tbt_text( 'sign_continue' ) ); ?></span>
                            <span class="rsv-btn-total" data-agreement-total></span>
                        </button>
                    </div>

                    </div><!-- /.rsv-modal-body -->
                </div><!-- /.rsv-modal-box -->
            </div>

            <!-- Modal: selección de plan (paso intermedio entre paso 2 y 3) -->
            <div class="rsv-modal" data-modal="plans" hidden role="dialog" aria-modal="true" aria-labelledby="plans-modal-title">
                <div class="rsv-modal-backdrop" data-modal-close></div>
                <div class="rsv-modal-box rsv-modal-box--sm">
                    <button class="rsv-modal-close" type="button" data-modal-close aria-label="<?php echo esc_attr( tbt_text('close') ); ?>">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="1" y1="1" x2="13" y2="13"/><line x1="13" y1="1" x2="1" y2="13"/></svg>
                    </button>
                    <div class="rsv-modal-body" data-plan-selection>
                        <h3 class="rsv-modal-title" id="plans-modal-title"><?php echo esc_html( tbt_text( 'choose_plan' ) ); ?></h3>
                        <p class="rsv-modal-sub"><?php echo esc_html( 'es' === tbt_current_lang() ? 'Selecciona el plan que mejor se adapte a tus necesidades.' : 'Select the plan that best fits your needs.' ); ?></p>
                        <div class="rsv-plan-grid">
                            <button class="rsv-plan-card" type="button" data-plan="<?php echo esc_attr( tbt_text( 'plan_day' ) ); ?>" data-contract-plan="1 Day" data-plan-price="$15 USD" data-unit-price="15">
                                <span class="rsv-plan-name"><?php echo esc_html( tbt_text( 'plan_day' ) ); ?></span>
                                <span class="rsv-plan-price">$15<small>USD</small></span>
                                <span class="rsv-plan-per"><?php echo esc_html( 'es' === tbt_current_lang() ? 'por día / lugar' : 'per day / spot' ); ?></span>
                            </button>
                            <button class="rsv-plan-card" type="button" data-plan="<?php echo esc_attr( tbt_text( 'plan_week' ) ); ?>" data-contract-plan="1 Week" data-plan-price="$50 USD" data-unit-price="50">
                                <span class="rsv-plan-name"><?php echo esc_html( tbt_text( 'plan_week' ) ); ?></span>
                                <span class="rsv-plan-price">$50<small>USD</small></span>
                                <span class="rsv-plan-per"><?php echo esc_html( 'es' === tbt_current_lang() ? 'por semana / lugar' : 'per week / spot' ); ?></span>
                            </button>
                            <button class="rsv-plan-card" type="button" data-plan="<?php echo esc_attr( tbt_text( 'plan_month' ) ); ?>" data-contract-plan="1 Month" data-plan-price="$175 USD" data-unit-price="175">
                                <span class="rsv-plan-name"><?php echo esc_html( tbt_text( 'plan_month' ) ); ?></span>
                                <span class="rsv-plan-price">$175<small>USD</small></span>
                                <span class="rsv-plan-per"><?php echo esc_html( 'es' === tbt_current_lang() ? 'por mes / lugar' : 'per month / spot' ); ?></span>
                            </button>
                            <button class="rsv-plan-card rsv-plan-card--featured" type="button" data-plan="<?php echo esc_attr( tbt_text( 'plan_recurring' ) ); ?>" data-contract-plan="Monthly Recurring" data-plan-price="$175 USD" data-unit-price="175" data-recurring-plan="true">
                                <span class="rsv-plan-badge"><?php echo esc_html( 'es' === tbt_current_lang() ? 'Popular' : 'Popular' ); ?></span>
                                <span class="rsv-plan-name"><?php echo esc_html( tbt_text( 'plan_recurring' ) ); ?></span>
                                <span class="rsv-plan-price">$175<small>USD</small></span>
                                <span class="rsv-plan-per"><?php echo esc_html( 'es' === tbt_current_lang() ? 'recurrente / lugar' : 'recurring / spot' ); ?></span>
                            </button>
                        </div>
                        <p class="rsv-plan-total" data-plan-total hidden>
                            <span><?php echo esc_html( tbt_text( 'selected_spaces_count' ) ); ?>: <strong data-selected-space-count>0</strong></span>
                            <span class="rsv-plan-total-price"><?php echo esc_html( tbt_text( 'selected_plan_price' ) ); ?>: <strong data-selected-plan-total>-</strong></span>
                        </p>
                        <button class="rsv-btn rsv-btn--primary" type="button" data-confirm-subscription disabled>
                            <?php echo esc_html( tbt_text( 'continue' ) ); ?>
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="3" y1="8" x2="13" y2="8"/><polyline points="9,4 13,8 9,12"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal: procesando pago -->
            <div class="rsv-modal rsv-modal--loading" data-modal="loading" hidden role="dialog" aria-modal="true" aria-live="polite" aria-labelledby="loading-modal-title">
                <div class="rsv-modal-box rsv-modal-box--loading">
                    <div class="rsv-spinner" aria-hidden="true">
                        <svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                            <!-- Pista fija (fondo tenue) -->
                            <circle class="rsv-spinner-track" cx="25" cy="25" r="20" fill="none" stroke-width="4"/>
                            <!-- Arco animado -->
                            <circle class="rsv-spinner-arc" cx="25" cy="25" r="20" fill="none" stroke-width="4"
                                stroke-linecap="round"
                                stroke-dasharray="80 45"
                                stroke-dashoffset="0"
                                transform="rotate(-90 25 25)"/>
                        </svg>
                    </div>
                    <h3 class="rsv-loading-title" id="loading-modal-title"
                        data-loading-title
                        data-processing-title="<?php echo esc_attr( tbt_text( 'processing_payment' ) ); ?>"
                        data-confirming-title="<?php echo esc_attr( tbt_text( 'confirming_payment' ) ); ?>">
                        <?php echo esc_html( tbt_text( 'processing_payment' ) ); ?>
                    </h3>
                    <p class="rsv-loading-copy"
                        data-loading-copy
                        data-processing-copy="<?php echo esc_attr( tbt_text( 'processing_payment_copy' ) ); ?>"
                        data-confirming-copy="<?php echo esc_attr( tbt_text( 'confirming_payment_copy' ) ); ?>">
                        <?php echo esc_html( tbt_text( 'processing_payment_copy' ) ); ?>
                    </p>
                </div>
            </div>

            <!-- Modal: reserva exitosa -->
            <div class="rsv-modal" data-modal="success" hidden role="dialog" aria-modal="true" aria-labelledby="success-modal-title">
                <div class="rsv-modal-backdrop" data-modal-close></div>
                <div class="rsv-modal-box rsv-modal-box--sm">
                    <div class="rsv-modal-body rsv-modal-body--success">
                        <div class="rsv-success-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <h3 class="rsv-modal-title" id="success-modal-title"><?php echo esc_html( tbt_text( 'subscription_success' ) ); ?></h3>
                        <p class="rsv-modal-sub"><?php echo esc_html( 'es' === tbt_current_lang() ? 'Tu reserva ha sido confirmada. Recibirás un correo con los detalles.' : 'Your reservation has been confirmed. You will receive an email with details.' ); ?></p>
                        <button class="rsv-btn rsv-btn--primary" type="button" data-modal-close><?php echo esc_html( tbt_text( 'close' ) ); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
/* ══════════════════════════════════════════════════════════════
   LOT MAP — Spots sobre plano real
   · Máx 15 spots visibles; scroll snap por zona
   · Indicadores … izq/der vía .has-more-left / .has-more-right
   · Panel lateral: spot activo, selección, botón reservar
   ══════════════════════════════════════════════════════════════ */
(() => {
    const MAX_SELECTION = 4;

    // ── i18n ──
    const I18N = {
        remove:      '<?php echo esc_js( "es" === tbt_current_lang() ? "Quitar"        : "Remove" ); ?>',
        available:   '<?php echo esc_js( "es" === tbt_current_lang() ? "Disponible"    : "Available" ); ?>',
        reserved:    '<?php echo esc_js( "es" === tbt_current_lang() ? "Reservado"     : "Reserved" ); ?>',
        processing:  '<?php echo esc_js( "es" === tbt_current_lang() ? "En proceso"    : "Processing" ); ?>',
        selected:    '<?php echo esc_js( "es" === tbt_current_lang() ? "Seleccionado"  : "Selected" ); ?>',
    };

    // ── Referencias del panel ──
    const infoSpotId    = document.querySelector('[data-info-spot-id]');
    const infoStatusDot = document.querySelector('[data-info-status-dot]');
    const infoStatusTxt = document.querySelector('[data-info-status-text]');
    const infoAddBtn    = document.querySelector('[data-info-add-btn]');
    const infoRemoveBtn = document.querySelector('[data-info-remove-btn]');
    const selectedList  = document.querySelector('[data-selected-list]');
    const selectedEmpty = document.querySelector('[data-selected-empty]');

    // ── Estado ──
    const allSpots = Array.from(document.querySelectorAll('.lot-spot'));
    let activeSpot = null;

    const isUnavailable = s => s.disabled || s.getAttribute('data-reserved') === 'true';

    const getSelected = () => allSpots.filter(s =>
        s.classList.contains('is-selected') && !isUnavailable(s)
    );

    // ══════════════════════════════════════════════
    // Flechas de scroll por zona
    // ══════════════════════════════════════════════
    const ARROW_SVG_LEFT  = `<svg viewBox="0 0 10 10" aria-hidden="true"><polyline points="7,2 3,5 7,8"/></svg>`;
    const ARROW_SVG_RIGHT = `<svg viewBox="0 0 10 10" aria-hidden="true"><polyline points="3,2 7,5 3,8"/></svg>`;

    const updateOverflow = (zone, track) => {
        const threshold = 4;
        zone.classList.toggle('has-more-left',  track.scrollLeft > threshold);
        zone.classList.toggle('has-more-right',
            track.scrollLeft < track.scrollWidth - track.clientWidth - threshold
        );
    };

    document.querySelectorAll('.lot-area-zone').forEach(zone => {
        const track = zone.querySelector('.lot-zone-track');
        if (!track) return;

        // ── Crear botones flecha ──
        const btnLeft  = document.createElement('button');
        const btnRight = document.createElement('button');
        btnLeft.type  = 'button';
        btnRight.type = 'button';
        btnLeft.className  = 'lot-scroll-arrow lot-scroll-arrow-left';
        btnRight.className = 'lot-scroll-arrow lot-scroll-arrow-right';
        btnLeft.setAttribute('aria-label',  '<?php echo esc_js( "es" === tbt_current_lang() ? "Anterior" : "Scroll left" ); ?>');
        btnRight.setAttribute('aria-label', '<?php echo esc_js( "es" === tbt_current_lang() ? "Siguiente" : "Scroll right" ); ?>');
        btnLeft.innerHTML  = ARROW_SVG_LEFT;
        btnRight.innerHTML = ARROW_SVG_RIGHT;

        // Ancho de página = ancho visible del track
        const scrollPage = () => track.clientWidth * 0.85; // desplazar ~85% del ancho visible

        btnLeft.addEventListener('click', () => {
            track.scrollBy({ left: -scrollPage(), behavior: 'smooth' });
        });
        btnRight.addEventListener('click', () => {
            track.scrollBy({ left:  scrollPage(), behavior: 'smooth' });
        });

        // Insertar antes y después del track dentro de la zona
        zone.insertBefore(btnLeft, track);
        zone.appendChild(btnRight);

        // Actualizar visibilidad en cada scroll
        track.addEventListener('scroll', () => updateOverflow(zone, track), { passive: true });

        // Actualizar al cambiar tamaño
        if (typeof ResizeObserver !== 'undefined') {
            new ResizeObserver(() => updateOverflow(zone, track)).observe(track);
        }

        // Estado inicial: posicionar al final del track (spots más bajos = entrada)
        requestAnimationFrame(() => {
            track.scrollLeft = track.scrollWidth;
            updateOverflow(zone, track);
        });
    });

    // ══════════════════════════════════════════════
    // Click/tap fuera de las zonas → desactivar spot
    // ══════════════════════════════════════════════
    const lotPlanWrap = document.querySelector('.lot-plan-wrap');
    if (lotPlanWrap) {
        lotPlanWrap.addEventListener('pointerdown', (e) => {
            // Si el target está dentro de alguna zona, no hacer nada
            if (e.target.closest('.lot-area-zone')) return;
            // Deactivar spot activo (sin borrar selecciones)
            if (activeSpot) {
                allSpots.forEach(s => s.classList.remove('is-active'));
                activeSpot = null;
                refreshPanel(null);
            }
        });
    }

    // ══════════════════════════
    // Panel lateral
    // ══════════════════════════
    const refreshPanel = (spot) => {
        if (!infoSpotId) return;
        if (!spot) {
            infoSpotId.textContent = '—';
            infoStatusDot.className = 'lot-status-dot';
            if (infoStatusTxt) infoStatusTxt.textContent = '';
            if (infoAddBtn)    infoAddBtn.hidden    = true;
            if (infoRemoveBtn) infoRemoveBtn.hidden = true;
            return;
        }

        const id      = spot.getAttribute('data-spot') || '—';
        const taken   = isUnavailable(spot);
        const selec   = spot.classList.contains('is-selected');

        infoSpotId.textContent    = id;
        infoStatusDot.className   = 'lot-status-dot';

        if (taken) {
            infoStatusDot.classList.add('is-taken');
            infoStatusTxt.textContent = spot.classList.contains('is-processing')
                ? I18N.processing : I18N.reserved;
        } else if (selec) {
            infoStatusDot.classList.add('is-selected');
            infoStatusTxt.textContent = I18N.selected;
        } else {
            infoStatusDot.classList.add('is-free');
            infoStatusTxt.textContent = I18N.available;
        }

        if (infoAddBtn && infoRemoveBtn) {
            if (taken) {
                infoAddBtn.hidden    = true;
                infoRemoveBtn.hidden = true;
            } else if (selec) {
                infoAddBtn.hidden    = true;
                infoRemoveBtn.hidden = false;
            } else {
                infoAddBtn.hidden    = getSelected().length >= MAX_SELECTION;
                infoRemoveBtn.hidden = true;
            }
        }
    };

    const refreshList = () => {
        if (!selectedList) return;
        selectedList.querySelectorAll('.lot-selected-item').forEach(el => el.remove());
        const sel = getSelected();
        if (selectedEmpty) selectedEmpty.hidden = sel.length > 0;

        sel.forEach(spot => {
            const id  = spot.getAttribute('data-spot');
            const li  = document.createElement('li');
            li.className       = 'lot-selected-item';
            li.dataset.listSpot = id;

            const lbl = document.createElement('span');
            lbl.textContent = id;

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.setAttribute('aria-label', `${I18N.remove} ${id}`);
            btn.textContent = '✕';
            btn.addEventListener('click', () => {
                spot.classList.remove('is-selected');
                spot.setAttribute('aria-pressed', 'false');
                refreshList();
                if (activeSpot === spot) refreshPanel(spot);
            });

            li.appendChild(lbl);
            li.appendChild(btn);
            selectedList.appendChild(li);
        });

        if (activeSpot) refreshPanel(activeSpot);
    };

    // ── Botones del panel ──
    infoAddBtn?.addEventListener('click', () => {
        if (!activeSpot || isUnavailable(activeSpot)) return;
        if (getSelected().length >= MAX_SELECTION) {
            window.openMaxSelectionModal?.();
            return;
        }
        activeSpot.classList.add('is-selected');
        activeSpot.setAttribute('aria-pressed', 'true');
        refreshList();
    });

    infoRemoveBtn?.addEventListener('click', () => {
        if (!activeSpot) return;
        activeSpot.classList.remove('is-selected');
        activeSpot.setAttribute('aria-pressed', 'false');
        refreshList();
    });

    // ══════════════════════════
    // Click en spot
    // ══════════════════════════
    allSpots.forEach(spot => {
        spot.addEventListener('click', () => {
            // Quitar activo anterior
            allSpots.forEach(s => s.classList.remove('is-active'));
            spot.classList.add('is-active');
            activeSpot = spot;

            if (!isUnavailable(spot)) {
                if (spot.classList.contains('is-selected')) {
                    spot.classList.remove('is-selected');
                    spot.setAttribute('aria-pressed', 'false');
                } else if (getSelected().length < MAX_SELECTION) {
                    spot.classList.add('is-selected');
                    spot.setAttribute('aria-pressed', 'true');
                } else {
                    // Límite alcanzado — mostrar modal
                    window.openMaxSelectionModal?.();
                }
            }
            refreshList();
        });
    });

    // ── Init ──
    refreshList();
})();

const TBT_MONDAY_RESERVATION = {
    ajaxUrl: '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>',
    nonce: '<?php echo esc_js( wp_create_nonce( 'tbt_monday_reservation' ) ); ?>',
};

(() => {
    const reserveButtons = Array.from(document.querySelectorAll('[data-reserve-button]'));
    const messages = Array.from(document.querySelectorAll('[data-reservation-message]'));
    const reservedModal = document.querySelector('[data-modal="reserved"]');
    const noSelectionModal = document.querySelector('[data-modal="no-selection"]');
    const maxSelectionModal = document.getElementById('maxSelectionModal');
    const customerInfoModal = document.querySelector('[data-modal="customer-info"]');
    const agreementModal = document.querySelector('[data-modal="agreement"]');
    const plansModal = document.querySelector('[data-modal="plans"]');
    const loadingModal = document.querySelector('[data-modal="loading"]');
    const loadingTitle = document.querySelector('[data-loading-title]');
    const loadingCopy = document.querySelector('[data-loading-copy]');
    const successModal = document.querySelector('[data-modal="success"]');
    const reservedSpaces = document.querySelector('[data-reserved-spaces]');
    const infoButton = document.querySelector('[data-info-button]');
    const reservationForm = document.querySelector('[data-reservation-form]');
    const formModalTitle = document.querySelector('[data-form-modal-title]');
    const formStepOne = document.querySelector('[data-form-step="1"]');
    const formStepTwo = document.querySelector('[data-form-step="2"]');
    const formNext = document.querySelector('[data-form-next]');
    const formBack = document.querySelector('[data-form-back]');
    const signaturePad = document.querySelector('[data-signature-pad]');
    const clearSignature = document.querySelector('[data-clear-signature]');
    const agreementAccept = document.querySelector('[data-agreement-accept]');
    const agreementContinue = document.querySelector('[data-agreement-continue]');
    const agreementToggle = document.querySelector('[data-agreement-toggle]');
    const fullAgreement = document.querySelector('[data-full-agreement]');
    const confirmSubscription = document.querySelector('[data-confirm-subscription]');
    const recurringContractNote = document.querySelector('[data-recurring-contract-note]');
    const planTotal = document.querySelector('[data-plan-total]');
    const selectedSpaceCount = document.querySelector('[data-selected-space-count]');
    const selectedPlanTotal = document.querySelector('[data-selected-plan-total]');
    const spots = Array.from(document.querySelectorAll('[data-spot]'));
    const fileInputs = Array.from(document.querySelectorAll('[data-file-input]'));

    let selectedPlan = '';
    let selectedPlanPrice = '';
    let selectedPlanUnitPrice = 0;
    let selectedPlanRecurring = false;
    let reservationData = {};
    let hasSignature = false;
    let isSigning = false;
    let isSubmittingReservation = false;

    const openModal = (modal) => {
        if (!modal) return;
        modal.hidden = false;
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
        // Scroll del modal al inicio
        const box = modal.querySelector('.rsv-modal-box, .rsv-modal-box--form, .rsv-modal-box--agreement');
        if (box) box.scrollTop = 0;
    };

    const closeModals = () => {
        document.querySelectorAll('[data-modal]').forEach((modal) => {
            modal.hidden = true;
            modal.setAttribute('aria-hidden', 'true');
        });
        // Cerrar también el modal cs-modal de límite de selección
        if (maxSelectionModal) {
            maxSelectionModal.classList.remove('cs-modal--open');
            maxSelectionModal.setAttribute('aria-hidden', 'true');
        }
        document.body.classList.remove('modal-open');
    };

    // Actualizar indicador de pasos visual en el modal de formulario
    const setFormStep = (step) => {
        document.querySelectorAll('[data-step-dot]').forEach(dot => {
            const n = parseInt(dot.getAttribute('data-step-dot'));
            dot.classList.remove('rsv-step--active', 'rsv-step--done');
            if (n < step)       dot.classList.add('rsv-step--done');
            else if (n === step) dot.classList.add('rsv-step--active');
        });
        document.querySelectorAll('.rsv-step-line').forEach((line, i) => {
            line.classList.toggle('rsv-step-line--done', i + 1 < step);
        });
    };

    window.openMaxSelectionModal = () => {
        if (!maxSelectionModal) return;
        maxSelectionModal.classList.add('cs-modal--open');
        maxSelectionModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
    };
    const closeMaxSelectionModal = () => {
        if (!maxSelectionModal) return;
        maxSelectionModal.classList.remove('cs-modal--open');
        maxSelectionModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    };

    // Botón cerrar + backdrop del modal de límite
    document.getElementById('maxSelectionModalClose')?.addEventListener('click', closeMaxSelectionModal);
    document.getElementById('maxSelectionModalBackdrop')?.addEventListener('click', closeMaxSelectionModal);

    const openLoadingModal = (mode = 'processing') => {
        if (loadingTitle) {
            loadingTitle.textContent = loadingTitle.getAttribute(`data-${mode}-title`) || loadingTitle.textContent;
        }

        if (loadingCopy) {
            loadingCopy.textContent = loadingCopy.getAttribute(`data-${mode}-copy`) || loadingCopy.textContent;
        }

        openModal(loadingModal);
    };

    const setAgreementLoading = (isLoading) => {
        if (!agreementContinue) {
            return;
        }

        agreementContinue.classList.toggle('is-loading', isLoading);
        agreementContinue.setAttribute('aria-busy', isLoading ? 'true' : 'false');
    };

    const selectedSpots = () => spots
        .filter((spot) => spot.classList.contains('is-selected') && !spot.disabled && spot.getAttribute('data-reserved') !== 'true')
        .map((spot) => spot.getAttribute('data-spot'));

    const formattedPlanTotal = () => `$${selectedPlanUnitPrice * Math.max(1, selectedSpots().length)} USD`;

    const updatePlanTotal = () => {
        if (!planTotal || !selectedSpaceCount || !selectedPlanTotal || !selectedPlanUnitPrice) {
            return;
        }

        selectedSpaceCount.textContent = String(selectedSpots().length);
        selectedPlanTotal.textContent = formattedPlanTotal();
        planTotal.hidden = false;
    };

    const hideMessages = () => {
        messages.forEach((item) => {
            item.hidden = true;
        });
    };

    const updateFormModalTitle = (step) => {
        if (!formModalTitle) {
            return;
        }

        const title = step === 2
            ? formModalTitle.getAttribute('data-step-two-title')
            : formModalTitle.getAttribute('data-step-one-title');

        formModalTitle.textContent = title || '';
    };

    const updateAgreementButton = () => {
        if (agreementContinue) {
            agreementContinue.disabled = !(hasSignature && agreementAccept?.checked);
        }
    };

    const clearSignaturePad = () => {
        if (!signaturePad) {
            return;
        }

        const context = signaturePad.getContext('2d');
        context.clearRect(0, 0, signaturePad.width, signaturePad.height);
        context.fillStyle = '#ffffff';
        context.fillRect(0, 0, signaturePad.width, signaturePad.height);
        hasSignature = false;
        updateAgreementButton();
    };

    const signaturePoint = (event) => {
        const rect = signaturePad.getBoundingClientRect();
        return {
            x: (event.clientX - rect.left) * (signaturePad.width / rect.width),
            y: (event.clientY - rect.top) * (signaturePad.height / rect.height),
        };
    };

    const fillContract = () => {
        document.querySelectorAll('[data-contract-field]').forEach((field) => {
            const key = field.getAttribute('data-contract-field');
            field.textContent = reservationData[key] || '-';
        });

        if (recurringContractNote) {
            recurringContractNote.hidden = !selectedPlanRecurring;
        }
    };

    const fileName = (formData, key) => {
        const file = formData.get(key);
        return file && file.name ? file.name : '';
    };

    const collectReservationData = () => {
        const formData = new FormData(reservationForm);
        const driverFullName = formData.get('driver_full_name') || '';
        const driverEmail = formData.get('driver_email') || '';
        const driverPhone = formData.get('driver_phone') || '';

        reservationData = {
            full_name: driverFullName,
            phone: driverPhone,
            email: driverEmail,
            entry_date: formData.get('entry_date') || '',
            emergency_phone: formData.get('emergency_phone') || '',
            company_name: formData.get('company_name') || '',
            physical_address: formData.get('physical_address') || '',
            company_billing_email: formData.get('company_billing_email') || '',
            driver_full_name: driverFullName,
            driver_email: driverEmail,
            driver_phone: driverPhone,
            assigned_vehicle: formData.get('assigned_vehicle') || '',
            vehicle_year: formData.get('vehicle_year') || '',
            vehicle_plate: formData.get('vehicle_plate') || '',
            vehicle_vin: formData.get('vehicle_vin') || '',
            regular_cargo: formData.get('regular_cargo') || '',
            truck_photo_name: fileName(formData, 'truck_photo'),
            driver_door_photo_name: fileName(formData, 'driver_door_photo'),
            spaces: selectedSpots().join(', '),
            selected_plan: selectedPlan,
            selected_plan_price: selectedPlanUnitPrice ? formattedPlanTotal() : selectedPlanPrice,
            signed_on: new Date().toLocaleString(),
        };
    };

    const submitReservationToMonday = async () => {
        const formData = new FormData(reservationForm);

        formData.append('action', 'tbt_create_monday_reservation');
        formData.append('nonce', TBT_MONDAY_RESERVATION.nonce);
        formData.append('spaces', reservationData.spaces || selectedSpots().join(', '));
        formData.append('selected_plan', selectedPlan);
        formData.append('selected_plan_price', selectedPlanPrice);
        formData.append('contract_text', fullAgreement ? fullAgreement.innerText : '');

        const response = await fetch(TBT_MONDAY_RESERVATION.ajaxUrl, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin',
        });

        const result = await response.json();

        if (!response.ok || !result.success) {
            throw new Error(result?.data?.message || 'Unable to create the reservation in Monday.');
        }

        return result.data;
    };

    const confirmStripeCheckout = async () => {
        const params = new URLSearchParams(window.location.search);
        const sessionId = params.get('session_id');

        if (params.get('stripe_status') !== 'success' || !sessionId) {
            return;
        }

        openLoadingModal('confirming');

        const formData = new FormData();
        formData.append('action', 'tbt_confirm_stripe_checkout');
        formData.append('nonce', TBT_MONDAY_RESERVATION.nonce);
        formData.append('session_id', sessionId);

        try {
            const response = await fetch(TBT_MONDAY_RESERVATION.ajaxUrl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin',
            });
            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result?.data?.message || 'Unable to confirm Stripe payment.');
            }

            markSpacesAsReserved(result?.data?.spaces || []);
            closeModals();
            openModal(successModal);
            window.history.replaceState({}, document.title, window.location.pathname + window.location.hash);
        } catch (error) {
            window.alert(error.message);
        }
    };


    const markSpacesAsReserved = (spacesToReserve) => {
        spacesToReserve.forEach((space) => {
            const spot = spots.find((item) => item.getAttribute('data-spot') === space);

            if (!spot) {
                return;
            }

            spot.classList.remove('is-selected');
            spot.classList.add('is-reserved');
            spot.disabled = true;
            spot.setAttribute('aria-disabled', 'true');
            spot.setAttribute('aria-pressed', 'false');
            spot.setAttribute('data-reserved', 'true');
        });
    };

    const markSelectedSpotsAsReserved = () => {
        markSpacesAsReserved(selectedSpots());
    };

    // NOTE: spot click handling (is-selected toggle, aria-pressed, max-selection guard)
    // is managed entirely by the focal-scroll IIFE above. No second handler needed here.

    // Helper para abrir el paso 1 del formulario desde cero
    const openReservationForm = () => {
        if (reservationForm) reservationForm.reset();
        if (formStepOne && formStepTwo) {
            formStepOne.hidden = false;
            formStepOne.classList.add('is-active');
            formStepTwo.hidden = true;
            formStepTwo.classList.remove('is-active');
        }
        updateFormModalTitle(1);
        setFormStep(1);
        openModal(customerInfoModal);
    };

    // Botón "Reservar": va directo al formulario paso 1
    reserveButtons.forEach((reserveButton) => {
        reserveButton.addEventListener('click', () => {
            if (!selectedSpots().length) {
                hideMessages();
                openModal(noSelectionModal);
                return;
            }
            closeModals();
            openReservationForm();
        });
    });

    // infoButton: compatibilidad (botón hidden en modal reserved)
    if (infoButton) infoButton.addEventListener('click', () => {
        closeModals();
        openReservationForm();
    });

    if (formNext && formStepOne && formStepTwo) {
        formNext.addEventListener('click', () => {
            const stepFields = Array.from(formStepOne.querySelectorAll('input'));
            const valid = stepFields.every((field) => field.reportValidity());
            if (!valid) return;

            formStepOne.hidden = true;
            formStepOne.classList.remove('is-active');
            formStepTwo.hidden = false;
            formStepTwo.classList.add('is-active');
            updateFormModalTitle(2);
            setFormStep(2);
            // Scroll del box al inicio al cambiar paso
            customerInfoModal?.querySelector('.rsv-modal-box')?.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    if (formBack && formStepOne && formStepTwo) {
        formBack.addEventListener('click', () => {
            formStepTwo.hidden = true;
            formStepTwo.classList.remove('is-active');
            formStepOne.hidden = false;
            formStepOne.classList.add('is-active');
            updateFormModalTitle(1);
            setFormStep(1);
            customerInfoModal?.querySelector('.rsv-modal-box')?.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    fileInputs.forEach((input) => {
        input.addEventListener('change', () => {
            input.classList.toggle('has-file', input.files && input.files.length > 0);
        });
    });

    if (signaturePad) {
        clearSignaturePad();
        signaturePad.addEventListener('pointerdown', (event) => {
            const context = signaturePad.getContext('2d');
            const point = signaturePoint(event);

            isSigning = true;
            signaturePad.setPointerCapture(event.pointerId);
            context.beginPath();
            context.moveTo(point.x, point.y);
            event.preventDefault();
        });

        signaturePad.addEventListener('pointermove', (event) => {
            if (!isSigning) {
                return;
            }

            const context = signaturePad.getContext('2d');
            const point = signaturePoint(event);

            context.lineTo(point.x, point.y);
            context.strokeStyle = '#000000';
            context.lineWidth = 4;
            context.lineCap = 'round';
            context.lineJoin = 'round';
            context.stroke();
            hasSignature = true;
            updateAgreementButton();
            event.preventDefault();
        });

        ['pointerup', 'pointercancel', 'pointerleave'].forEach((eventName) => {
            signaturePad.addEventListener(eventName, () => {
                isSigning = false;
            });
        });
    }

    if (clearSignature) {
        clearSignature.addEventListener('click', clearSignaturePad);
    }

    if (agreementAccept) {
        agreementAccept.addEventListener('change', updateAgreementButton);
    }

    if (agreementToggle && fullAgreement) {
        agreementToggle.addEventListener('click', () => {
            const isHidden = fullAgreement.hidden;

            fullAgreement.hidden = !isHidden;
            agreementToggle.textContent = isHidden
                ? agreementToggle.getAttribute('data-close-label')
                : agreementToggle.getAttribute('data-open-label');

            if (isHidden) {
                fullAgreement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });
    }

    if (agreementContinue) {
        agreementContinue.addEventListener('click', async () => {
            if (agreementContinue.disabled || isSubmittingReservation) {
                return;
            }

            isSubmittingReservation = true;
            agreementContinue.disabled = true;
            setAgreementLoading(true);

            try {
                openLoadingModal('processing');
                const reservationResult = await submitReservationToMonday();

                if (reservationResult.checkout_url) {
                    window.location.href = reservationResult.checkout_url;
                    return;
                }

                markSelectedSpotsAsReserved();
                closeModals();
                openModal(successModal);
            } catch (error) {
                window.alert(error.message);
                updateAgreementButton();
                setAgreementLoading(false);
            } finally {
                isSubmittingReservation = false;
            }
        });
    }

    reservationForm.addEventListener('submit', (event) => {
        event.preventDefault();
        collectReservationData();
        selectedPlan = '';
        selectedPlanPrice = '';
        selectedPlanUnitPrice = 0;
        selectedPlanRecurring = false;
        if (confirmSubscription) {
            confirmSubscription.disabled = true;
        }
        document.querySelectorAll('[data-plan]').forEach((item) => item.classList.remove('is-selected'));
        if (planTotal) {
            planTotal.hidden = true;
        }
        closeModals();
        openModal(plansModal);
    });

    document.querySelectorAll('[data-plan]').forEach((planButton) => {
        planButton.addEventListener('click', () => {
            document.querySelectorAll('[data-plan]').forEach((item) => item.classList.remove('is-selected'));
            planButton.classList.add('is-selected');
            selectedPlan = planButton.getAttribute('data-contract-plan') || planButton.getAttribute('data-plan') || '';
            selectedPlanPrice = planButton.getAttribute('data-plan-price') || '';
            selectedPlanUnitPrice = Number(planButton.getAttribute('data-unit-price') || 0);
            selectedPlanPrice = selectedPlanUnitPrice ? formattedPlanTotal() : selectedPlanPrice;
            selectedPlanRecurring = planButton.getAttribute('data-recurring-plan') === 'true';
            updatePlanTotal();
            if (confirmSubscription) {
                confirmSubscription.disabled = false;
            }
        });
    });

    if (confirmSubscription) {
        confirmSubscription.disabled = true;
        confirmSubscription.addEventListener('click', () => {
            if (!selectedPlan) return;
            reservationData.selected_plan = selectedPlan;
            reservationData.selected_plan_price = selectedPlanPrice;
            fillContract();
            if (agreementAccept) agreementAccept.checked = false;
            clearSignaturePad();
            // Actualizar monto total en el botón de reservar del paso 3
            const totalEl = agreementModal?.querySelector('[data-agreement-total]');
            if (totalEl) totalEl.textContent = formattedPlanTotal();
            setFormStep(3);
            closeModals();
            openModal(agreementModal);
        });
    }

    confirmStripeCheckout();

    document.querySelectorAll('[data-modal-close]').forEach((button) => {
        button.addEventListener('click', closeModals);
    });

    document.querySelectorAll('[data-modal]').forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModals();
            }
        });
    });
})();
</script>

<?php
get_footer();
