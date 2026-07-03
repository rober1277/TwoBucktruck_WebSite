<?php
/**
 * Funciones para el tema Two Buck Trucks
 *
 * Este archivo registra el menú de navegación principal y encola
 * los estilos y scripts necesarios para el tema.
 */

// Evitar acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Salir si se accede directamente
}

/**
 * Encolar hojas de estilo y scripts.
 */
function tbt_enqueue_styles() {
    // Hoja de estilos principal
    $style_path = get_stylesheet_directory() . '/style.css';
    $style_version = file_exists( $style_path ) ? filemtime( $style_path ) : '1.0';

    wp_enqueue_style( 'tbt-style', get_stylesheet_uri(), [], $style_version );
}
add_action( 'wp_enqueue_scripts', 'tbt_enqueue_styles' );

/**
 * Configurar SMTP para wp_mail cuando las constantes esten definidas.
 */
function tbt_configure_smtp( $phpmailer ) {
    if (
        ! defined( 'TBT_SMTP_HOST' ) ||
        ! defined( 'TBT_SMTP_USER' ) ||
        ! defined( 'TBT_SMTP_PASS' ) ||
        'PASTE_SMTP_HOST_HERE' === TBT_SMTP_HOST ||
        'PASTE_SMTP_USER_HERE' === TBT_SMTP_USER ||
        'PASTE_SMTP_PASSWORD_HERE' === TBT_SMTP_PASS
    ) {
        return;
    }

    $phpmailer->isSMTP();
    $phpmailer->Host       = TBT_SMTP_HOST;
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = (int) TBT_SMTP_PORT;
    $phpmailer->Username   = TBT_SMTP_USER;
    $phpmailer->Password   = TBT_SMTP_PASS;
    $phpmailer->SMTPSecure = defined( 'TBT_SMTP_SECURE' ) ? TBT_SMTP_SECURE : 'tls';
    $phpmailer->From       = defined( 'TBT_SMTP_FROM' ) ? TBT_SMTP_FROM : TBT_SMTP_USER;
    $phpmailer->FromName   = defined( 'TBT_SMTP_FROM_NAME' ) ? TBT_SMTP_FROM_NAME : get_bloginfo( 'name' );
}
add_action( 'phpmailer_init', 'tbt_configure_smtp' );

/**
 * Registrar menús de navegación.
 */
function tbt_register_menus() {
    register_nav_menus( [
        'primary' => __( 'Menú Principal', 'tbt-theme' ),
    ] );
}
add_action( 'after_setup_theme', 'tbt_register_menus' );

/**
 * Activar soporte para títulos dinámicos y miniaturas de entradas.
 */
function tbt_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'tbt_theme_support' );

/**
 * Detectar y conservar el idioma elegido por el visitante.
 */
function tbt_current_lang() {
    $allowed = [ 'en', 'es' ];
    $lang    = 'en';

    if ( isset( $_COOKIE['tbt_lang'] ) && in_array( $_COOKIE['tbt_lang'], $allowed, true ) ) {
        $lang = sanitize_key( $_COOKIE['tbt_lang'] );
    }

    if ( isset( $_GET['lang'] ) && in_array( $_GET['lang'], $allowed, true ) ) {
        $lang = sanitize_key( $_GET['lang'] );
    }

    return $lang;
}

/**
 * Guardar el idioma seleccionado antes de enviar salida HTML.
 */
function tbt_store_language_choice() {
    if ( isset( $_GET['lang'] ) && in_array( $_GET['lang'], [ 'en', 'es' ], true ) ) {
        setcookie( 'tbt_lang', sanitize_key( $_GET['lang'] ), time() + MONTH_IN_SECONDS, COOKIEPATH ?: '/' );
    }
}
add_action( 'init', 'tbt_store_language_choice' );

/**
 * Texto bilingüe del tema.
 */
function tbt_text( $key ) {
    $texts = [
        'nav_home'               => [ 'en' => 'Home', 'es' => 'Inicio' ],
        'nav_services'           => [ 'en' => 'Reserve Now', 'es' => 'Reserva Ahora' ],
        'nav_location'           => [ 'en' => 'Location', 'es' => 'Ubicación' ],
        'nav_contact'            => [ 'en' => 'Contact Us', 'es' => 'Contacto' ],
        'language_label'         => [ 'en' => 'Español', 'es' => 'English' ],
        'home_intro'             => [ 'en' => 'Secure and convenient trailer parking solutions.', 'es' => 'Soluciones seguras y convenientes de estacionamiento para trailers.' ],
        'home_cta'               => [ 'en' => 'View Plans', 'es' => 'Ver Planes' ],
        'home_video_label'       => [ 'en' => 'Introductory video', 'es' => 'Video introductorio' ],
        'home_video_fallback'    => [ 'en' => 'Your browser does not support video playback.', 'es' => 'Tu navegador no soporta la reproduccion de video.' ],
        'home_services_title'    => [ 'en' => 'Parking that keeps your equipment ready', 'es' => 'Estacionamiento que mantiene tu equipo listo' ],
        'home_services_copy'     => [ 'en' => 'Two Buck Trucks offers secure and convenient trailer parking solutions designed for drivers, owner-operators, and transportation companies. The property features 24-hour on-site surveillance, well-lit parking areas, and security cameras to provide a safer and more reliable environment for your units. With easy electronic payments and flexible rental plans, customers can choose the parking option that best fits their needs.', 'es' => 'Two Buck Trucks ofrece soluciones seguras y convenientes de estacionamiento para trailers, disenadas para conductores, operadores propietarios y empresas de transporte. La propiedad cuenta con vigilancia las 24 horas, areas de estacionamiento bien iluminadas y camaras de seguridad para brindar un entorno mas seguro y confiable para tus unidades. Con pagos electronicos faciles y planes de renta flexibles, los clientes pueden elegir la opcion de estacionamiento que mejor se adapte a sus necesidades.' ],
        'home_tips_title'        => [ 'en' => 'Maintenance Tips', 'es' => 'Tips de mantenimiento' ],
        'home_tips_copy'         => [ 'en' => 'Simple checks that help drivers keep their trucks in better condition before and after each route.', 'es' => 'Revisiones simples que ayudan a los conductores a mantener sus vehiculos en mejores condiciones antes y despues de cada ruta.' ],
        'home_tip_default_title' => [ 'en' => 'Maintenance tip', 'es' => 'Tip de mantenimiento' ],
        'home_tips_empty'        => [ 'en' => 'Upload maintenance images to the Media Library to show them here.', 'es' => 'Sube imagenes de mantenimiento a la libreria de medios para mostrarlas aqui.' ],
        'home_feature_one_title' => [ 'en' => 'Main entrance', 'es' => 'Entrada principal' ],
        'home_feature_one_copy'  => [ 'en' => 'Access is coordinated with our security staff based on each customer subscription, which is completed online for convenience. Every subscribed vehicle is assigned a numbered parking space, and customers with multiple vehicles can subscribe to multiple spaces as needed.', 'es' => 'El acceso se coordina con nuestro personal de seguridad de acuerdo con la suscripcion de cada cliente, la cual se realiza en linea para mayor comodidad. Cada vehiculo suscrito recibe un numero de lugar asignado, y los clientes con varios vehiculos pueden suscribirse a multiples espacios segun sus necesidades.' ],
        'home_feature_two_title' => [ 'en' => 'FM1902 view and access route', 'es' => 'Vista desde FM1902 y ruta de acceso' ],
        'home_feature_two_copy'  => [ 'en' => 'The property is visible from 11129 FM1902, Crowley, TX 76036, United States; however, the main entrance is accessed from 920A. When arriving from FM1902, turn onto 920A and continue toward the marked entrance so security staff can coordinate access according to your active subscription.', 'es' => 'La propiedad se puede ver desde 11129 FM1902, Crowley, TX 76036, Estados Unidos; sin embargo, la entrada principal se realiza por la calle 920A. Al llegar desde FM1902, toma 920A y continua hacia la entrada indicada para que el personal de seguridad coordine el acceso de acuerdo con tu suscripcion activa.' ],
        'home_feature_three_title' => [ 'en' => 'Satellite view of the property', 'es' => 'Vista satelital de la propiedad' ],
        'home_feature_three_copy'  => [ 'en' => 'The operations field for the parking spaces is wide and practical, giving drivers more room to maneuver, park, and position their vehicles comfortably in their assigned spaces.', 'es' => 'El campo de operaciones para los lugares de estacionamiento es amplio y practico, lo que brinda a los conductores mas espacio para maniobrar, estacionarse y acomodar sus vehiculos comodamente en su lugar asignado.' ],
        'services_title'         => [ 'en' => 'Our Plans', 'es' => 'Nuestros Planes' ],
        'services_intro'         => [ 'en' => 'Choose the parking plan that fits your schedule. Prices can be updated once the final rates are confirmed.', 'es' => 'Elige el plan de estacionamiento que se ajuste a tu ruta. Los precios pueden actualizarse cuando se confirmen las tarifas finales.' ],
        'plan_day'               => [ 'en' => '1 Day', 'es' => '1 Día' ],
        'plan_week'              => [ 'en' => '1 Week', 'es' => '1 Semana' ],
        'plan_month'             => [ 'en' => '1 Month', 'es' => '1 Mes' ],
        'plan_recurring'         => [ 'en' => 'Monthly Recurring', 'es' => 'Mensual Recurrente' ],
        'plan_day_copy'          => [ 'en' => 'Short-term parking for a single stop or overnight stay.', 'es' => 'Estacionamiento de corto plazo para una parada o estancia nocturna.' ],
        'plan_week_copy'         => [ 'en' => 'A practical option for several days on the same route.', 'es' => 'Una opcion practica para varios dias en la misma ruta.' ],
        'plan_month_copy'        => [ 'en' => 'Reserve a space for longer stays and predictable scheduling.', 'es' => 'Reserva un espacio para estancias mas largas y mejor planeacion.' ],
        'plan_recurring_copy'    => [ 'en' => 'Keep your space active month after month with automatic payment to the payment method on file.', 'es' => 'Mantén tu espacio activo mes a mes con cargo automatico al metodo de pago registrado.' ],
        'subscribe'              => [ 'en' => 'Reserve', 'es' => 'Reservar' ],
        'site_map'               => [ 'en' => 'Site Map', 'es' => 'Mapa de Lugares' ],
        'available_spot'         => [ 'en' => 'Parking spot', 'es' => 'Lugar' ],
        'reserved_spot'          => [ 'en' => 'Reserved parking spot', 'es' => 'Lugar reservado' ],
        'available_spaces'       => [ 'en' => 'available spaces', 'es' => 'lugares disponibles' ],
        'section_a'              => [ 'en' => 'Section A', 'es' => 'Seccion A' ],
        'section_b'              => [ 'en' => 'Section B', 'es' => 'Seccion B' ],
        'select_section'         => [ 'en' => 'Select a section to view every numbered parking space.', 'es' => 'Selecciona una seccion para ver todos los lugares numerados.' ],
        'entrance_label'         => [ 'en' => 'Entrance', 'es' => 'Entrada' ],
        'reserve_selected'       => [ 'en' => 'Reserve selected spaces', 'es' => 'Reservar espacios seleccionados' ],
        'no_spaces_selected'     => [ 'en' => 'Select one or more spaces to reserve.', 'es' => 'Seleccione uno o mas lugares para reservar.' ],
        'max_spaces_selected'    => [ 'en' => 'You can only reserve a maximum of four spaces at a time.', 'es' => 'Solo puede reservar maximo cuatro lugares a la vez.' ],
        'reserved_spaces'        => [ 'en' => 'You have reserved the following spaces:', 'es' => 'Ha reservado los espacios:' ],
        'subscribe_now'          => [ 'en' => 'Subscribe now', 'es' => 'Suscribirse' ],
        'continue'               => [ 'en' => 'Continue', 'es' => 'Continuar' ],
        'customer_info'          => [ 'en' => 'Driver / Customer Information', 'es' => 'Informacion del Conductor / Cliente' ],
        'customer_step'          => [ 'en' => 'Customer information', 'es' => 'Informacion del cliente' ],
        'customer_driver_step'   => [ 'en' => 'Driver / Customer Information', 'es' => 'Informacion del Conductor / Cliente' ],
        'driver_step'            => [ 'en' => 'Driver information', 'es' => 'Informacion del conductor' ],
        'vehicle_info'           => [ 'en' => 'Vehicle information', 'es' => 'Informacion del vehiculo' ],
        'back'                   => [ 'en' => 'Back', 'es' => 'Regresar' ],
        'entry_date'             => [ 'en' => 'Entrance Date', 'es' => 'Fecha de entrada' ],
        'driver_full_name'       => [ 'en' => 'Full name of driver', 'es' => 'Nombre completo del conductor' ],
        'driver_email'           => [ 'en' => 'Email', 'es' => 'Correo' ],
        'driver_phone'           => [ 'en' => 'Phone number', 'es' => 'Telefono' ],
        'emergency_phone'        => [ 'en' => 'Emergency phone number', 'es' => 'Telefono de emergencia' ],
        'company_name'           => [ 'en' => 'Company', 'es' => 'Compañia' ],
        'company_billing_email'  => [ 'en' => 'Company Billing Email', 'es' => 'Email de facturacion de la compañia' ],
        'physical_address'       => [ 'en' => 'Address', 'es' => 'Direccion' ],
        'assigned_vehicle'       => [ 'en' => 'Make / Model', 'es' => 'Marca / Modelo' ],
        'vehicle_year'           => [ 'en' => 'Vehicle year', 'es' => 'Año del Vehiculo' ],
        'vehicle_plate'          => [ 'en' => 'License plate', 'es' => 'Placa' ],
        'vehicle_vin'            => [ 'en' => 'Truck Number', 'es' => 'Numero de Camion' ],
        'regular_cargo'          => [ 'en' => 'Type of regular cargo', 'es' => 'Tipo de carga regular' ],
        'truck_photo'            => [ 'en' => 'Photograph of the truck', 'es' => 'Fotografia del camion' ],
        'driver_door_photo'      => [ 'en' => 'Driver door photo', 'es' => 'Foto de la puerta del conductor' ],
        'agreement_title'        => [ 'en' => 'Commercial Vehicle Parking Agreement', 'es' => 'Contrato de Estacionamiento para Vehiculo Comercial' ],
        'agreement_intro'        => [ 'en' => 'Please review the agreement with your reservation information before signing electronically.', 'es' => 'Revise el contrato con la informacion de su reserva antes de firmar electronicamente.' ],
        'read_full_agreement'    => [ 'en' => 'Read full agreement', 'es' => 'Leer contrato completo' ],
        'hide_full_agreement'    => [ 'en' => 'Hide full agreement', 'es' => 'Ocultar contrato completo' ],
        'agreement_customer'     => [ 'en' => 'Customer', 'es' => 'Cliente' ],
        'agreement_vehicle'      => [ 'en' => 'Vehicle', 'es' => 'Vehiculo' ],
        'agreement_spaces'       => [ 'en' => 'Reserved spaces', 'es' => 'Espacios reservados' ],
        'selected_plan'          => [ 'en' => 'Selected plan', 'es' => 'Plan seleccionado' ],
        'selected_plan_price'    => [ 'en' => 'Total price', 'es' => 'Precio total' ],
        'selected_spaces_count'  => [ 'en' => 'Selected spaces', 'es' => 'Espacios seleccionados' ],
        'agreement_terms'        => [ 'en' => 'Agreement terms', 'es' => 'Terminos del contrato' ],
        'agreement_term_one'     => [ 'en' => 'Customer requests parking service for the selected commercial vehicle spaces at Two Buck Trucks Parking Lot & Storage.', 'es' => 'El cliente solicita servicio de estacionamiento para los espacios seleccionados en Two Buck Trucks Parking Lot & Storage.' ],
        'agreement_term_two'     => [ 'en' => 'Access to the property is coordinated with security staff according to the active subscription and assigned parking spaces.', 'es' => 'El acceso a la propiedad se coordina con el personal de seguridad de acuerdo con la suscripcion activa y los espacios asignados.' ],
        'agreement_term_three'   => [ 'en' => 'Customer agrees to keep vehicle and contact information accurate and to follow property rules, payment terms, and safety instructions.', 'es' => 'El cliente acepta mantener correcta la informacion del vehiculo y contacto, y cumplir las reglas de la propiedad, terminos de pago e instrucciones de seguridad.' ],
        'agreement_term_four'    => [ 'en' => 'This electronic signature confirms that the customer has reviewed and accepts this parking agreement.', 'es' => 'Esta firma electronica confirma que el cliente ha revisado y acepta este contrato de estacionamiento.' ],
        'agreement_term_card_payment' => [ 'en' => 'Payments will be made with a bank credit or debit card.', 'es' => 'Los pagos seran efectuados con tarjeta bancaria de credito o debito.' ],
        'agreement_accept'       => [ 'en' => 'I have read and accept this parking agreement.', 'es' => 'He leido y acepto este contrato de estacionamiento.' ],
        'signature_label'        => [ 'en' => 'Electronic signature', 'es' => 'Firma electronica' ],
        'clear_signature'        => [ 'en' => 'Clear signature', 'es' => 'Limpiar firma' ],
        'sign_continue'          => [ 'en' => 'Sign and continue', 'es' => 'Firmar y continuar' ],
        'processing_payment'     => [ 'en' => 'Processing your reservation', 'es' => 'Procesando su reserva' ],
        'processing_payment_copy' => [ 'en' => 'Please wait while we prepare your secure payment.', 'es' => 'Espere mientras preparamos su pago seguro.' ],
        'confirming_payment'     => [ 'en' => 'Confirming your payment', 'es' => 'Confirmando su pago' ],
        'confirming_payment_copy' => [ 'en' => 'Please wait while we confirm your payment and update your reservation.', 'es' => 'Espere mientras confirmamos su pago y actualizamos su reserva.' ],
        'signed_on'              => [ 'en' => 'Signed on', 'es' => 'Firmado el' ],
        'choose_plan'            => [ 'en' => 'Choose a rental plan', 'es' => 'Elige un plan de renta' ],
        'subscription_success'   => [ 'en' => 'Subscription completed successfully.', 'es' => 'Suscripcion efectuada con exito.' ],
        'close'                  => [ 'en' => 'Close', 'es' => 'Cerrar' ],
        'location_title'         => [ 'en' => 'Drive Directions', 'es' => 'Drive Directions' ],
        'location_address_label' => [ 'en' => 'Address', 'es' => 'Dirección' ],
        'location_address'       => [ 'en' => '11129 FM1902, Crowley, TX 76036, United States', 'es' => '11129 FM1902, Crowley, TX 76036, Estados Unidos' ],
        'map_directions'         => [ 'en' => 'Directions', 'es' => 'Indicaciones' ],
        'entrance_title'         => [ 'en' => 'Main Entrance', 'es' => 'Entrada Principal' ],
        'entrance_copy'          => [ 'en' => 'The main entrance is accessed from 920A. Drivers arriving at the property should use 920A and coordinate entry with the security staff according to their active subscription and assigned parking space.', 'es' => 'La entrada principal se realiza por la calle 920A. Los conductores que lleguen a la propiedad deben usar 920A y coordinar el acceso con el personal de seguridad de acuerdo con su suscripcion activa y su lugar asignado.' ],
        'secondary_title'        => [ 'en' => 'FM1902 Approach', 'es' => 'Llegada desde FM1902' ],
        'secondary_copy'         => [ 'en' => 'The property is visible from 11129 FM1902, but the entrance is not directly on FM1902. Turn onto 920A, then continue toward the marked access point for safer entry into the parking area.', 'es' => 'La propiedad se puede ver desde 11129 FM1902, pero la entrada no esta directamente sobre FM1902. Toma la calle 920A y continua hacia el punto de acceso indicado para entrar de forma mas segura al area de estacionamiento.' ],
        'contact_title'          => [ 'en' => 'Contact Us', 'es' => 'Contáctanos' ],
        'contact_intro'          => [ 'en' => 'Request a quote or ask us to call you back. We will help you choose the parking option that fits your needs.', 'es' => 'Solicita una cotizacion o pide que te llamemos. Te ayudamos a elegir la opcion de estacionamiento que se adapte a tus necesidades.' ],
        'contact_details'        => [ 'en' => 'Contact details', 'es' => 'Datos de contacto' ],
        'contact_name'           => [ 'en' => 'Full name', 'es' => 'Nombre completo' ],
        'contact_email'          => [ 'en' => 'Email', 'es' => 'Correo electronico' ],
        'contact_phone'          => [ 'en' => 'Phone number', 'es' => 'Telefono' ],
        'contact_request_type'   => [ 'en' => 'Request type', 'es' => 'Tipo de solicitud' ],
        'request_quote'          => [ 'en' => 'Request a quote', 'es' => 'Solicitar cotizacion' ],
        'request_call'           => [ 'en' => 'Request a call', 'es' => 'Solicitar llamada' ],
        'contact_message'        => [ 'en' => 'Message', 'es' => 'Mensaje' ],
        'send_request'           => [ 'en' => 'Send request', 'es' => 'Enviar solicitud' ],
        'contact_success'        => [ 'en' => 'Your request has been sent. We will contact you as soon as possible.', 'es' => 'Su solicitud ha sido enviada, nos pondremos en contacto con usted lo mas pronto posible.' ],
        'phone'                  => [ 'en' => 'Phone', 'es' => 'Teléfono' ],
        'email'                  => [ 'en' => 'Email', 'es' => 'Correo electrónico' ],
        'address'                => [ 'en' => 'Address', 'es' => 'Dirección' ],
        'social'                 => [ 'en' => 'Follow us', 'es' => 'Síguenos' ],
        'register_title'         => [ 'en' => 'Customer Registration', 'es' => 'Registro de Cliente' ],
        'register_intro'         => [ 'en' => 'Complete the form to request your parking plan.', 'es' => 'Completa el formulario para solicitar tu plan de estacionamiento.' ],
        'register_success'       => [ 'en' => 'Thank you for registering. We will contact you soon.', 'es' => 'Gracias por registrarte. Nos pondremos en contacto contigo pronto.' ],
        'full_name'              => [ 'en' => 'Full Name', 'es' => 'Nombre Completo' ],
        'select_plan'            => [ 'en' => 'Select a Plan', 'es' => 'Selecciona un Plan' ],
        'comments'               => [ 'en' => 'Additional Comments (optional)', 'es' => 'Comentarios Adicionales (opcional)' ],
        'submit_registration'    => [ 'en' => 'Submit Registration', 'es' => 'Enviar Registro' ],
        'footer_rights'          => [ 'en' => 'All rights reserved.', 'es' => 'Todos los derechos reservados.' ],
    ];

    $lang = tbt_current_lang();

    return $texts[ $key ][ $lang ] ?? $texts[ $key ]['en'] ?? $key;
}

/**
 * URL interna conservando el idioma activo.
 */
function tbt_page_url( $path = '/' ) {
    return add_query_arg( 'lang', tbt_current_lang(), home_url( $path ) );
}

/**
 * Obtener las imagenes mas recientes de la libreria de medios para los tips.
 */
function tbt_get_maintenance_tip_images( $limit = 18 ) {
    $tip_filenames = [
        'WhatsApp-Image-2026-05-08-at-3.20.43-PM.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.43-PM-1.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.43-PM-2.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.43-PM-3.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.43-PM-4.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.44-PM.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.44-PM-1.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.45-PM.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.45-PM-1.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.45-PM-2.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.45-PM-3.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.45-PM-4.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.45-PM-5.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.45-PM-6.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.45-PM-7.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.46-PM.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.46-PM-1.jpeg',
        'WhatsApp-Image-2026-05-08-at-3.20.46-PM-2.jpeg',
    ];

    $images = get_posts( [
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'post_status'    => 'inherit',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ] );

    $images = array_values(
        array_filter(
            $images,
            static function( $image ) use ( $tip_filenames ) {
                $file = get_attached_file( $image->ID );

                return in_array( basename( (string) $file ), $tip_filenames, true );
            }
        )
    );

    usort(
        $images,
        function( $first, $second ) {
            $first_meta  = wp_get_attachment_metadata( $first->ID );
            $second_meta = wp_get_attachment_metadata( $second->ID );

            $first_area  = (int) ( $first_meta['width'] ?? 0 ) * (int) ( $first_meta['height'] ?? 0 );
            $second_area = (int) ( $second_meta['width'] ?? 0 ) * (int) ( $second_meta['height'] ?? 0 );

            if ( $first_area === $second_area ) {
                return strtotime( $second->post_date ) <=> strtotime( $first->post_date );
            }

            return $second_area <=> $first_area;
        }
    );

    return array_slice( $images, 0, min( $limit, count( $tip_filenames ) ) );
}

/**
 * Renderizar el carrusel de tips de mantenimiento en la pagina de inicio.
 */
function tbt_render_home_maintenance_carousel() {
    $tips = tbt_get_maintenance_tip_images();
    ?>
    <section class="maintenance-tips-section">
        <div class="maintenance-tips-heading">
            <h2><?php echo esc_html( tbt_text( 'home_tips_title' ) ); ?></h2>
            <p><?php echo esc_html( tbt_text( 'home_tips_copy' ) ); ?></p>
        </div>

        <?php if ( empty( $tips ) ) : ?>
            <p class="maintenance-tips-empty"><?php echo esc_html( tbt_text( 'home_tips_empty' ) ); ?></p>
        <?php else : ?>
            <div class="maintenance-carousel" data-carousel>
                <button class="carousel-button carousel-button-prev" type="button" data-carousel-prev aria-label="Previous tip">&#8249;</button>
                <div class="maintenance-tips-track" data-carousel-track>
                    <?php foreach ( $tips as $index => $tip ) : ?>
                        <?php
                        $title   = get_the_title( $tip );
                        $caption = wp_get_attachment_caption( $tip->ID );
                        ?>
                        <article class="maintenance-tip-card" data-carousel-card>
                            <figure class="maintenance-tip-photo">
                                <?php
                                echo wp_get_attachment_image(
                                    $tip->ID,
                                    'large',
                                    false,
                                    [
                                        'loading' => 'lazy',
                                        'alt'     => $title ?: sprintf( '%s %d', tbt_text( 'home_tip_default_title' ), $index + 1 ),
                                    ]
                                );
                                ?>
                            </figure>
                            <div class="maintenance-tip-content">
                                <h3>
                                    <?php
                                    echo esc_html(
                                        $title ?: sprintf( '%s %d', tbt_text( 'home_tip_default_title' ), $index + 1 )
                                    );
                                    ?>
                                </h3>
                                <?php if ( $caption ) : ?>
                                    <p><?php echo esc_html( $caption ); ?></p>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-button carousel-button-next" type="button" data-carousel-next aria-label="Next tip">&#8250;</button>
                <div class="carousel-dots" data-carousel-dots aria-label="Carousel indicators"></div>
            </div>
        <?php endif; ?>

        <div class="home-cta">
            <a class="button-primary" href="<?php echo esc_url( tbt_page_url( '/services' ) ); ?>"><?php echo esc_html( tbt_text( 'home_cta' ) ); ?></a>
        </div>
    </section>
    <?php
}

/**
 * URL para alternar idioma.
 */
function tbt_language_switch_url() {
    $target_lang = 'en' === tbt_current_lang() ? 'es' : 'en';
    $url         = add_query_arg( 'lang', $target_lang );

    return remove_query_arg( [ 'contact' ], $url );
}

/**
 * Manejar el envío del formulario de registro.
 *
 * Esta función procesa los datos enviados desde la página de registro,
 * valida el nonce de seguridad y envía un correo electrónico al
 * administrador del sitio con la información del cliente. Después de
 * procesar, redirige al usuario de nuevo a la página de registro con
 * un parámetro de éxito.
 */
function tbt_handle_registration() {
    // Verificar el nonce
    if ( ! isset( $_POST['tbt_registration_nonce'] ) || ! wp_verify_nonce( $_POST['tbt_registration_nonce'], 'tbt_registration_form' ) ) {
        wp_die( __( 'Nonce de seguridad inválido. Intenta nuevamente.', 'tbt-theme' ) );
    }

    // Sanitizar datos del formulario
    $nombre  = sanitize_text_field( $_POST['nombre'] ?? '' );
    $correo  = sanitize_email( $_POST['correo'] ?? '' );
    $telefono = sanitize_text_field( $_POST['telefono'] ?? '' );
    $tarifa  = sanitize_text_field( $_POST['tarifa'] ?? '' );
    $mensaje = sanitize_textarea_field( $_POST['mensaje'] ?? '' );

    // Construir el cuerpo del correo
    $email_to   = get_option( 'admin_email' );
    $subject    = 'Nuevo registro de cliente en Two Buck Trucks';
    $body       = "Se ha recibido un nuevo registro:\n\n";
    $body      .= "Nombre: {$nombre}\n";
    $body      .= "Correo: {$correo}\n";
    $body      .= "Teléfono: {$telefono}\n";
    $body      .= "Tarifa seleccionada: {$tarifa}\n";
    $body      .= "Comentarios: {$mensaje}\n";
    $headers    = [ 'Content-Type: text/plain; charset=UTF-8' ];

    // Enviar correo
    wp_mail( $email_to, $subject, $body, $headers );

    // Redirigir con parámetro de éxito
    $redirect_url = add_query_arg( 'registro', 'exitoso', wp_get_referer() ?: home_url( '/register' ) );
    wp_safe_redirect( $redirect_url );
    exit;
}
add_action( 'admin_post_nopriv_tbt_handle_registration', 'tbt_handle_registration' );
add_action( 'admin_post_tbt_handle_registration', 'tbt_handle_registration' );

/**
 * Manejar solicitudes desde la pagina de contacto.
 */
function tbt_handle_contact_request() {
    if ( ! isset( $_POST['tbt_contact_nonce'] ) || ! wp_verify_nonce( $_POST['tbt_contact_nonce'], 'tbt_contact_request' ) ) {
        wp_die( esc_html__( 'Nonce de seguridad inválido. Intenta nuevamente.', 'tbt-theme' ) );
    }

    $name         = sanitize_text_field( wp_unslash( $_POST['contact_name'] ?? '' ) );
    $email        = sanitize_email( wp_unslash( $_POST['contact_email'] ?? '' ) );
    $phone        = sanitize_text_field( wp_unslash( $_POST['contact_phone'] ?? '' ) );
    $message      = sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ?? '' ) );
    $request_label = 'Solicitar llamada';

    if ( '' === $name || '' === $email ) {
        wp_die( esc_html__( 'Nombre y correo son requeridos.', 'tbt-theme' ) );
    }

    $body  = "Nueva solicitud desde la pagina de contacto:\n\n";
    $body .= "Nombre: {$name}\n";
    $body .= "Correo: {$email}\n";
    $body .= "Telefono: {$phone}\n";
    $body .= "Tipo de solicitud: {$request_label}\n";
    $body .= "Mensaje: {$message}\n";

    wp_mail(
        'info@2bucktrucks.com',
        'Nueva solicitud de contacto - Two Buck Trucks',
        $body,
        [
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: ' . $name . ' <' . $email . '>',
        ]
    );

    $contact_page = get_permalink( get_page_by_path( 'contact' ) ) ?: home_url( '/contact' );
    $redirect_url = add_query_arg( 'contact', 'sent', $contact_page );
    wp_safe_redirect( $redirect_url );
    exit;
}
add_action( 'admin_post_nopriv_tbt_handle_contact_request', 'tbt_handle_contact_request' );
add_action( 'admin_post_tbt_handle_contact_request', 'tbt_handle_contact_request' );

add_action( 'admin_post_nopriv_tbt_renew_reservation', 'tbt_handle_renew_reservation' );
add_action( 'admin_post_tbt_renew_reservation', 'tbt_handle_renew_reservation' );

add_action( 'init', 'tbt_schedule_renewal_reminders' );
add_action( 'tbt_send_renewal_reminders', 'tbt_send_renewal_reminders' );

/**
 * Crear una reserva en Monday.com desde el flujo de servicios.
 */
function tbt_handle_monday_reservation() {
    check_ajax_referer( 'tbt_monday_reservation', 'nonce' );

    if (
        ! defined( 'TBT_MONDAY_API_TOKEN' ) ||
        ! defined( 'TBT_MONDAY_BOARD_ID' ) ||
        'PASTE_MONDAY_API_TOKEN_HERE' === TBT_MONDAY_API_TOKEN ||
        'PASTE_MONDAY_BOARD_ID_HERE' === TBT_MONDAY_BOARD_ID
    ) {
        wp_send_json_error( [ 'message' => 'Monday.com is not configured.' ], 500 );
    }

    $reservation = [
        'driver_full_name'     => sanitize_text_field( wp_unslash( $_POST['driver_full_name'] ?? '' ) ),
        'driver_email'         => sanitize_email( wp_unslash( $_POST['driver_email'] ?? '' ) ),
        'driver_phone'         => sanitize_text_field( wp_unslash( $_POST['driver_phone'] ?? '' ) ),
        'emergency_phone'      => sanitize_text_field( wp_unslash( $_POST['emergency_phone'] ?? '' ) ),
        'company_name'         => sanitize_text_field( wp_unslash( $_POST['company_name'] ?? '' ) ),
        'company_billing_email' => sanitize_email( wp_unslash( $_POST['company_billing_email'] ?? '' ) ),
        'physical_address'     => sanitize_text_field( wp_unslash( $_POST['physical_address'] ?? '' ) ),
        'entry_date'           => sanitize_text_field( wp_unslash( $_POST['entry_date'] ?? '' ) ),
        'assigned_vehicle'     => sanitize_text_field( wp_unslash( $_POST['assigned_vehicle'] ?? '' ) ),
        'vehicle_year'         => sanitize_text_field( wp_unslash( $_POST['vehicle_year'] ?? '' ) ),
        'vehicle_plate'        => sanitize_text_field( wp_unslash( $_POST['vehicle_plate'] ?? '' ) ),
        'vehicle_vin'          => sanitize_text_field( wp_unslash( $_POST['vehicle_vin'] ?? '' ) ),
        'regular_cargo'        => sanitize_text_field( wp_unslash( $_POST['regular_cargo'] ?? '' ) ),
        'spaces'               => sanitize_text_field( wp_unslash( $_POST['spaces'] ?? '' ) ),
        'selected_plan'        => sanitize_text_field( wp_unslash( $_POST['selected_plan'] ?? '' ) ),
        'selected_plan_price'  => sanitize_text_field( wp_unslash( $_POST['selected_plan_price'] ?? '' ) ),
        'contract_text'        => sanitize_textarea_field( wp_unslash( $_POST['contract_text'] ?? '' ) ),
    ];

    if ( '' === $reservation['driver_full_name'] || '' === $reservation['selected_plan'] || '' === $reservation['spaces'] ) {
        wp_send_json_error( [ 'message' => 'Missing required reservation data.' ], 400 );
    }

    $reservation_spaces = tbt_extract_parking_spaces( $reservation['spaces'] );

    if ( count( $reservation_spaces ) > 4 ) {
        wp_send_json_error( [ 'message' => 'A maximum of 4 spaces may be reserved at one time.' ], 400 );
    }

    $reservation['space_count']         = max( 1, count( $reservation_spaces ) );
    $reservation['selected_plan_price'] = tbt_format_plan_total_price(
        $reservation['selected_plan'],
        $reservation['space_count']
    );

    $item = tbt_monday_upsert_reservation_item( $reservation );

    if ( is_wp_error( $item ) ) {
        wp_send_json_error( [ 'message' => $item->get_error_message() ], 500 );
    }

    delete_transient( 'tbt_monday_reserved_spaces' );
    delete_transient( 'tbt_monday_space_statuses_v2' );

    $item_id = (string) ( $item['id'] ?? '' );
    $uploads = [];

    if ( $item_id ) {
        $uploads['vehicle_photo'] = tbt_monday_upload_submitted_file( $item_id, 'file_mm32p4vz', 'truck_photo' );
        $uploads['driver_door_photo'] = tbt_monday_upload_submitted_file( $item_id, 'file_mm32qrmg', 'driver_door_photo' );
        $uploads['contract']      = tbt_monday_upload_contract_text( $item_id, $reservation );
    }

    $checkout = tbt_stripe_create_checkout_session( $reservation, $item_id );

    if ( is_wp_error( $checkout ) ) {
        wp_send_json_error( [ 'message' => $checkout->get_error_message() ], 500 );
    }

    wp_send_json_success( [
        'item_id'      => $item_id,
        'name'         => $item['name'] ?? '',
        'uploads'      => $uploads,
        'checkout_id'  => $checkout['id'] ?? '',
        'checkout_url' => $checkout['url'] ?? '',
    ] );
}
add_action( 'wp_ajax_nopriv_tbt_create_monday_reservation', 'tbt_handle_monday_reservation' );
add_action( 'wp_ajax_tbt_create_monday_reservation', 'tbt_handle_monday_reservation' );

/**
 * Confirmar una sesion de Stripe cuando el cliente regresa al sitio.
 *
 * Esto es un respaldo util para pruebas locales; en produccion el webhook sigue
 * siendo la fuente principal del estado de pago.
 */
function tbt_handle_stripe_checkout_confirmation() {
    check_ajax_referer( 'tbt_monday_reservation', 'nonce' );

    if ( ! tbt_stripe_is_configured() ) {
        wp_send_json_error( [ 'message' => 'Stripe Checkout is not configured.' ], 500 );
    }

    $session_id = sanitize_text_field( wp_unslash( $_POST['session_id'] ?? '' ) );

    if ( '' === $session_id ) {
        wp_send_json_error( [ 'message' => 'Missing Stripe session ID.' ], 400 );
    }

    $session = tbt_stripe_request( 'GET', 'checkout/sessions/' . rawurlencode( $session_id ), [
        'expand[]' => 'subscription.latest_invoice.payment_intent.latest_charge',
    ] );

    if ( is_wp_error( $session ) ) {
        wp_send_json_error( [ 'message' => $session->get_error_message() ], 500 );
    }

    $is_complete = in_array( $session['status'] ?? '', [ 'complete', 'open' ], true );
    $is_paid     = in_array( $session['payment_status'] ?? '', [ 'paid', 'no_payment_required' ], true );

    if ( ! $is_complete || ! $is_paid ) {
        wp_send_json_error( [ 'message' => 'Stripe payment is not complete yet.' ], 400 );
    }

    $result = tbt_monday_update_payment_from_stripe_session( $session );

    if ( is_wp_error( $result ) ) {
        wp_send_json_error( [ 'message' => $result->get_error_message() ], 500 );
    }

    wp_send_json_success( [
        'message' => 'Stripe payment confirmed.',
        'spaces'  => tbt_extract_parking_spaces( $session['metadata']['reserved_spaces'] ?? '' ),
    ] );
}
add_action( 'wp_ajax_nopriv_tbt_confirm_stripe_checkout', 'tbt_handle_stripe_checkout_confirmation' );
add_action( 'wp_ajax_tbt_confirm_stripe_checkout', 'tbt_handle_stripe_checkout_confirmation' );

/**
 * Crear una sesion de pago segura en Stripe Checkout.
 */
function tbt_stripe_create_checkout_session( array $reservation, $item_id ) {
    if ( ! tbt_stripe_is_configured() ) {
        return new WP_Error( 'tbt_stripe_not_configured', 'Stripe Checkout is not configured.' );
    }

    $price_id = tbt_stripe_price_for_plan( $reservation['selected_plan'] );

    if ( '' === $price_id ) {
        return new WP_Error( 'tbt_stripe_price_missing', 'Stripe price ID is missing for the selected plan.' );
    }

    $mode        = tbt_stripe_is_recurring_plan( $reservation['selected_plan'] ) ? 'subscription' : 'payment';
    $return_url  = wp_get_referer() ?: home_url( '/' );
    $return_url  = remove_query_arg( [ 'stripe_status', 'reservation', 'session_id' ], $return_url );
    $success_url = add_query_arg( [
        'stripe_status' => 'success',
        'reservation'   => $item_id,
    ], $return_url );
    $success_url .= ( false === strpos( $success_url, '?' ) ? '?' : '&' ) . 'session_id={CHECKOUT_SESSION_ID}';
    $cancel_url = add_query_arg( [
        'stripe_status' => 'cancelled',
        'reservation'   => $item_id,
    ], $return_url );
    $due_date = tbt_calculate_reservation_due_date( $reservation['entry_date'], $reservation['selected_plan'] );
    $metadata = [
        'monday_item_id' => (string) $item_id,
        'reserved_spaces' => $reservation['spaces'],
        'selected_plan'  => $reservation['selected_plan'],
        'due_date'       => $due_date,
    ];
    $body = [
        'mode'                         => $mode,
        'success_url'                  => $success_url,
        'cancel_url'                   => $cancel_url,
        'customer_email'               => $reservation['company_billing_email'] ?: $reservation['driver_email'],
        'client_reference_id'          => (string) $item_id,
        'billing_address_collection'   => 'required',
        'phone_number_collection[enabled]' => 'true',
        'adaptive_pricing[enabled]'    => 'false',
        'line_items[0][price]'         => $price_id,
        'line_items[0][quantity]'      => max( 1, (int) ( $reservation['space_count'] ?? count( tbt_extract_parking_spaces( $reservation['spaces'] ) ) ) ),
    ];

    if ( defined( 'TBT_STRIPE_AUTOMATIC_TAX' ) && filter_var( TBT_STRIPE_AUTOMATIC_TAX, FILTER_VALIDATE_BOOLEAN ) ) {
        $body['automatic_tax[enabled]'] = 'true';
    }

    foreach ( $metadata as $key => $value ) {
        $body[ 'metadata[' . $key . ']' ] = $value;
    }

    if ( 'subscription' === $mode ) {
        foreach ( $metadata as $key => $value ) {
            $body[ 'subscription_data[metadata][' . $key . ']' ] = $value;
        }
    } else {
        foreach ( $metadata as $key => $value ) {
            $body[ 'payment_intent_data[metadata][' . $key . ']' ] = $value;
        }
    }

    return tbt_stripe_request( 'POST', 'checkout/sessions', $body );
}

function tbt_stripe_create_renewal_checkout_session( array $reservation, $renewal_plan ) {
    if ( ! tbt_stripe_is_configured() ) {
        return new WP_Error( 'tbt_stripe_not_configured', 'Stripe Checkout is not configured.' );
    }

    $renewal_plan = tbt_normalize_plan_label( $renewal_plan );

    if ( tbt_stripe_is_recurring_plan( $renewal_plan ) || ! in_array( $renewal_plan, [ '1 Day', '1 Week', '1 Month' ], true ) ) {
        return new WP_Error( 'tbt_invalid_renewal_plan', 'Invalid renewal plan.' );
    }

    $price_id = tbt_stripe_price_for_plan( $renewal_plan );

    if ( '' === $price_id ) {
        return new WP_Error( 'tbt_stripe_price_missing', 'Stripe price ID is missing for the selected renewal plan.' );
    }

    $item_id      = (string) ( $reservation['id'] ?? '' );
    $current_due  = $reservation['due_date'] ?? '';
    $new_due_date = tbt_calculate_reservation_due_date( $current_due, $renewal_plan );
    $spaces       = implode( ', ', tbt_extract_parking_spaces( $reservation['spaces'] ?? '' ) );
    $space_count  = max( 1, count( tbt_extract_parking_spaces( $spaces ) ) );

    if ( '' === $item_id || '' === $new_due_date ) {
        return new WP_Error( 'tbt_renewal_missing_data', 'The renewal is missing reservation data.' );
    }

    $return_url  = home_url( '/services/' );
    $success_url = add_query_arg( [
        'stripe_status' => 'success',
        'reservation'   => $item_id,
    ], $return_url );
    $success_url .= ( false === strpos( $success_url, '?' ) ? '?' : '&' ) . 'session_id={CHECKOUT_SESSION_ID}';
    $cancel_url = add_query_arg( [
        'stripe_status' => 'cancelled',
        'reservation'   => $item_id,
    ], $return_url );
    $metadata = [
        'payment_flow'         => 'renewal',
        'monday_item_id'       => $item_id,
        'reserved_spaces'      => $spaces,
        'selected_plan'        => $renewal_plan,
        'renewal_plan'         => $renewal_plan,
        'previous_due_date'    => $current_due,
        'renewal_new_due_date' => $new_due_date,
    ];
    $body = [
        'mode'                         => 'payment',
        'success_url'                  => $success_url,
        'cancel_url'                   => $cancel_url,
        'customer_email'               => $reservation['email'] ?? '',
        'client_reference_id'          => $item_id,
        'billing_address_collection'   => 'required',
        'phone_number_collection[enabled]' => 'true',
        'adaptive_pricing[enabled]'    => 'false',
        'line_items[0][price]'         => $price_id,
        'line_items[0][quantity]'      => $space_count,
    ];

    if ( defined( 'TBT_STRIPE_AUTOMATIC_TAX' ) && filter_var( TBT_STRIPE_AUTOMATIC_TAX, FILTER_VALIDATE_BOOLEAN ) ) {
        $body['automatic_tax[enabled]'] = 'true';
    }

    foreach ( $metadata as $key => $value ) {
        $body[ 'metadata[' . $key . ']' ] = $value;
        $body[ 'payment_intent_data[metadata][' . $key . ']' ] = $value;
    }

    return tbt_stripe_request( 'POST', 'checkout/sessions', $body );
}

function tbt_normalize_plan_label( $plan ) {
    $normalized = strtolower( trim( (string) $plan ) );
    $plans = [
        '1 day'             => '1 Day',
        '1 dia'             => '1 Day',
        '1 día'             => '1 Day',
        '1 week'            => '1 Week',
        '1 semana'          => '1 Week',
        '1 month'           => '1 Month',
        '1 mes'             => '1 Month',
        'monthly recurring' => 'Monthly Recurring',
        'mensual recurrente' => 'Monthly Recurring',
    ];

    return $plans[ $normalized ] ?? trim( (string) $plan );
}

function tbt_handle_renew_reservation() {
    $item_id = sanitize_text_field( wp_unslash( $_GET['item_id'] ?? '' ) );
    $plan    = tbt_normalize_plan_label( sanitize_text_field( wp_unslash( $_GET['plan'] ?? '' ) ) );
    $token   = sanitize_text_field( wp_unslash( $_GET['token'] ?? '' ) );

    if ( '' === $item_id || '' === $plan || '' === $token ) {
        wp_die( esc_html__( 'Missing renewal information.', 'tbt-theme' ) );
    }

    $reservation = tbt_monday_get_reservation_for_renewal( $item_id );

    if ( is_wp_error( $reservation ) ) {
        wp_die( esc_html( $reservation->get_error_message() ) );
    }

    if ( ! tbt_verify_renewal_token( $item_id, $plan, $reservation['due_date'] ?? '', $token ) ) {
        wp_die( esc_html__( 'Invalid renewal link.', 'tbt-theme' ) );
    }

    $session = tbt_stripe_create_renewal_checkout_session( $reservation, $plan );

    if ( is_wp_error( $session ) ) {
        wp_die( esc_html( $session->get_error_message() ) );
    }

    if ( empty( $session['url'] ) ) {
        wp_die( esc_html__( 'Stripe did not return a checkout URL.', 'tbt-theme' ) );
    }

    wp_redirect( esc_url_raw( $session['url'] ) );
    exit;
}

function tbt_schedule_renewal_reminders() {
    if ( ! wp_next_scheduled( 'tbt_send_renewal_reminders' ) ) {
        wp_schedule_event( time() + HOUR_IN_SECONDS, 'daily', 'tbt_send_renewal_reminders' );
    }
}

function tbt_send_renewal_reminders() {
    $reservations = tbt_monday_get_renewal_candidates();

    if ( empty( $reservations ) ) {
        return;
    }

    $sent = get_option( 'tbt_renewal_reminders_sent', [] );

    if ( ! is_array( $sent ) ) {
        $sent = [];
    }

    $today = new DateTimeImmutable( current_time( 'Y-m-d' ) );

    foreach ( $reservations as $reservation ) {
        $plan = tbt_normalize_plan_label( $reservation['plan'] ?? '' );

        if ( ! in_array( $plan, [ '1 Week', '1 Month' ], true ) ) {
            continue;
        }

        if (
            'pagado' !== tbt_normalize_monday_group_title( $reservation['payment_status'] ?? '' ) ||
            'reservado' !== tbt_normalize_monday_group_title( $reservation['spot_status'] ?? '' )
        ) {
            continue;
        }

        if ( empty( $reservation['email'] ) || empty( $reservation['due_date'] ) ) {
            continue;
        }

        try {
            $due_date = new DateTimeImmutable( $reservation['due_date'] );
        } catch ( Exception $exception ) {
            continue;
        }

        $days_until_due = (int) $today->diff( $due_date )->format( '%r%a' );
        $notice_days    = '1 Month' === $plan ? [ 5, 3, 0 ] : [ 1 ];

        if ( ! in_array( $days_until_due, $notice_days, true ) ) {
            continue;
        }

        $sent_key = implode( '|', [
            $reservation['id'],
            $reservation['due_date'],
            (string) $days_until_due,
        ] );

        if ( ! empty( $sent[ $sent_key ] ) ) {
            continue;
        }

        $sent_successfully = tbt_send_renewal_email( $reservation, $days_until_due );

        if ( $sent_successfully ) {
            $sent[ $sent_key ] = current_time( 'mysql' );
        }
    }

    update_option( 'tbt_renewal_reminders_sent', $sent, false );
}

function tbt_send_renewal_email( array $reservation, $days_until_due ) {
    $renewal_links = [];

    foreach ( [ '1 Day', '1 Week', '1 Month' ] as $plan ) {
        $renewal_links[] = sprintf(
            '%s: %s',
            $plan,
            tbt_renewal_url( $reservation['id'], $plan, $reservation['due_date'] )
        );
    }

    $when = 0 === (int) $days_until_due
        ? 'today'
        : 'in ' . (int) $days_until_due . ' day' . ( 1 === (int) $days_until_due ? '' : 's' );

    $body  = "Hello {$reservation['name']},\n\n";
    $body .= "Your Two Buck Trucks parking plan expires {$when}.\n\n";
    $body .= "Reserved space(s): {$reservation['spaces']}\n";
    $body .= "Current plan: {$reservation['plan']}\n";
    $body .= "Expiration date: {$reservation['due_date']}\n\n";
    $body .= "Renew your parking plan using one of these secure links:\n";
    $body .= implode( "\n", $renewal_links );
    $body .= "\n\nIf you already renewed, you can ignore this message.\n\n";
    $body .= "Two Buck Trucks Parking Lot";

    return wp_mail(
        $reservation['email'],
        'Your Two Buck Trucks parking plan is about to expire',
        $body,
        [ 'Content-Type: text/plain; charset=UTF-8' ]
    );
}

function tbt_renewal_url( $item_id, $plan, $due_date ) {
    return add_query_arg( [
        'action'  => 'tbt_renew_reservation',
        'item_id' => (string) $item_id,
        'plan'    => (string) $plan,
        'token'   => tbt_renewal_token( $item_id, $plan, $due_date ),
    ], admin_url( 'admin-post.php' ) );
}

function tbt_renewal_token( $item_id, $plan, $due_date ) {
    return hash_hmac(
        'sha256',
        implode( '|', [ (string) $item_id, (string) $plan, (string) $due_date ] ),
        wp_salt( 'auth' )
    );
}

function tbt_verify_renewal_token( $item_id, $plan, $due_date, $token ) {
    return hash_equals( tbt_renewal_token( $item_id, $plan, $due_date ), (string) $token );
}

function tbt_stripe_is_configured() {
    return (
        defined( 'TBT_STRIPE_SECRET_KEY' ) &&
        '' !== TBT_STRIPE_SECRET_KEY &&
        'PASTE_STRIPE_SECRET_KEY_HERE' !== TBT_STRIPE_SECRET_KEY
    );
}

function tbt_stripe_price_for_plan( $plan ) {
    $normalized = strtolower( trim( (string) $plan ) );

    if (
        defined( 'TBT_STRIPE_USE_TEST_PRICE' ) &&
        filter_var( TBT_STRIPE_USE_TEST_PRICE, FILTER_VALIDATE_BOOLEAN )
    ) {
        if (
            'monthly recurring' === $normalized &&
            defined( 'TBT_STRIPE_PRICE_TEST_RECURRING' ) &&
            'PASTE_STRIPE_PRICE_TEST_RECURRING_HERE' !== TBT_STRIPE_PRICE_TEST_RECURRING
        ) {
            return TBT_STRIPE_PRICE_TEST_RECURRING;
        }

        if (
            defined( 'TBT_STRIPE_PRICE_TEST' ) &&
            'PASTE_STRIPE_PRICE_TEST_HERE' !== TBT_STRIPE_PRICE_TEST
        ) {
            return TBT_STRIPE_PRICE_TEST;
        }
    }

    $prices = [
        '1 day'             => defined( 'TBT_STRIPE_PRICE_DAY' ) ? TBT_STRIPE_PRICE_DAY : '',
        '1 week'            => defined( 'TBT_STRIPE_PRICE_WEEK' ) ? TBT_STRIPE_PRICE_WEEK : '',
        '1 month'           => defined( 'TBT_STRIPE_PRICE_MONTH' ) ? TBT_STRIPE_PRICE_MONTH : '',
        'monthly recurring' => defined( 'TBT_STRIPE_PRICE_RECURRING' ) ? TBT_STRIPE_PRICE_RECURRING : '',
    ];
    $price = $prices[ $normalized ] ?? '';

    return 0 === strpos( $price, 'PASTE_' ) ? '' : $price;
}

function tbt_stripe_is_recurring_plan( $plan ) {
    return 'monthly recurring' === strtolower( trim( (string) $plan ) );
}

function tbt_plan_unit_price( $plan ) {
    $prices = [
        '1 day'             => 15,
        '1 week'            => 50,
        '1 month'           => 175,
        'monthly recurring' => 175,
    ];

    return $prices[ strtolower( trim( (string) $plan ) ) ] ?? 0;
}

function tbt_format_plan_total_price( $plan, $space_count = 1 ) {
    $total = tbt_plan_unit_price( $plan ) * max( 1, (int) $space_count );

    return '$' . number_format( $total, 0 ) . ' USD';
}

function tbt_stripe_request( $method, $endpoint, array $body = [] ) {
    $url  = 'https://api.stripe.com/v1/' . ltrim( $endpoint, '/' );
    $args = [
        'timeout' => 20,
        'headers' => [
            'Authorization' => 'Bearer ' . TBT_STRIPE_SECRET_KEY,
        ],
    ];

    if ( 'POST' === strtoupper( $method ) ) {
        $args['body'] = $body;
        $response = wp_remote_post( $url, $args );
    } else {
        $response = wp_remote_get( add_query_arg( $body, $url ), $args );
    }

    if ( is_wp_error( $response ) ) {
        return $response;
    }

    $decoded = json_decode( wp_remote_retrieve_body( $response ), true );

    if ( wp_remote_retrieve_response_code( $response ) >= 400 ) {
        return new WP_Error( 'tbt_stripe_error', $decoded['error']['message'] ?? 'Stripe request failed.' );
    }

    return is_array( $decoded ) ? $decoded : [];
}

/**
 * Endpoint del webhook de Stripe.
 */
function tbt_register_stripe_webhook_route() {
    register_rest_route( 'tbt/v1', '/stripe-webhook', [
        'methods'             => 'POST',
        'callback'            => 'tbt_handle_stripe_webhook',
        'permission_callback' => '__return_true',
    ] );
}
add_action( 'rest_api_init', 'tbt_register_stripe_webhook_route' );

function tbt_handle_stripe_webhook( WP_REST_Request $request ) {
    $payload = $request->get_body();

    if ( ! tbt_stripe_verify_webhook_signature( $payload, $request->get_header( 'stripe-signature' ) ) ) {
        return new WP_REST_Response( [ 'message' => 'Invalid Stripe signature.' ], 400 );
    }

    $event = json_decode( $payload, true );

    if ( ! is_array( $event ) ) {
        return new WP_REST_Response( [ 'message' => 'Invalid Stripe payload.' ], 400 );
    }

    $type   = $event['type'] ?? '';
    $object = $event['data']['object'] ?? [];

    if ( in_array( $type, [ 'checkout.session.completed', 'checkout.session.async_payment_succeeded' ], true ) ) {
        $result = tbt_monday_update_payment_from_stripe_session( $object );

        if ( is_wp_error( $result ) ) {
            return new WP_REST_Response( [ 'message' => $result->get_error_message() ], 500 );
        }
    }

    if ( 'invoice.payment_succeeded' === $type ) {
        $result = tbt_monday_update_payment_from_stripe_invoice( $object );

        if ( is_wp_error( $result ) ) {
            return new WP_REST_Response( [ 'message' => $result->get_error_message() ], 500 );
        }
    }

    if ( 'subscription.updated' === $type ) {
        $result = tbt_monday_update_subscription_period( $object );

        if ( is_wp_error( $result ) ) {
            return new WP_REST_Response( [ 'message' => $result->get_error_message() ], 500 );
        }
    }

    if ( in_array( $type, [ 'checkout.session.async_payment_failed', 'payment_intent.payment_failed' ], true ) ) {
        tbt_monday_update_payment_status_from_stripe_object( $object, 'Fallido' );
    }

    return new WP_REST_Response( [ 'received' => true ], 200 );
}

function tbt_stripe_verify_webhook_signature( $payload, $signature_header ) {
    if (
        ! defined( 'TBT_STRIPE_WEBHOOK_SECRET' ) ||
        '' === TBT_STRIPE_WEBHOOK_SECRET ||
        'PASTE_STRIPE_WEBHOOK_SECRET_HERE' === TBT_STRIPE_WEBHOOK_SECRET ||
        '' === $signature_header
    ) {
        return false;
    }

    $parts = [];

    foreach ( explode( ',', $signature_header ) as $part ) {
        $pair = explode( '=', $part, 2 );

        if ( 2 === count( $pair ) ) {
            $parts[ $pair[0] ][] = $pair[1];
        }
    }

    $timestamp = $parts['t'][0] ?? '';
    $signatures = $parts['v1'] ?? [];

    if ( '' === $timestamp || empty( $signatures ) || abs( time() - (int) $timestamp ) > 300 ) {
        return false;
    }

    $expected = hash_hmac( 'sha256', $timestamp . '.' . $payload, TBT_STRIPE_WEBHOOK_SECRET );

    foreach ( $signatures as $signature ) {
        if ( hash_equals( $expected, $signature ) ) {
            return true;
        }
    }

    return false;
}

function tbt_monday_update_payment_from_stripe_session( array $session ) {
    $item_id = $session['metadata']['monday_item_id'] ?? $session['client_reference_id'] ?? '';

    if ( '' === $item_id ) {
        return new WP_Error( 'tbt_stripe_missing_item', 'Stripe session is missing the Monday item ID.' );
    }

    $metadata       = $session['metadata'] ?? [];
    $is_renewal     = 'renewal' === ( $metadata['payment_flow'] ?? '' );
    $renewal_plan   = tbt_normalize_plan_label( $metadata['renewal_plan'] ?? $metadata['selected_plan'] ?? '' );
    $renewal_due    = $metadata['renewal_new_due_date'] ?? '';
    $transaction_id = $session['payment_intent'] ?? $session['subscription'] ?? $session['id'] ?? '';
    $receipt_url    = '';
    $next_payment   = $is_renewal && '' !== $renewal_due ? $renewal_due : ( $metadata['due_date'] ?? '' );

    if ( is_array( $transaction_id ) ) {
        $transaction_id = $transaction_id['id'] ?? $session['id'] ?? '';
    }

    if ( ! empty( $session['payment_intent'] ) && is_array( $session['payment_intent'] ) ) {
        $receipt_url = $session['payment_intent']['latest_charge']['receipt_url'] ?? '';
    } elseif ( ! empty( $session['payment_intent'] ) ) {
        $payment_intent = tbt_stripe_request( 'GET', 'payment_intents/' . rawurlencode( $session['payment_intent'] ), [
            'expand[]' => 'latest_charge',
        ] );

        if ( ! is_wp_error( $payment_intent ) ) {
            $receipt_url = $payment_intent['latest_charge']['receipt_url'] ?? '';
        }
    }

    if ( ! empty( $session['subscription'] ) ) {
        $subscription = is_array( $session['subscription'] )
            ? $session['subscription']
            : tbt_stripe_request( 'GET', 'subscriptions/' . rawurlencode( $session['subscription'] ), [
                'expand[]' => 'latest_invoice.payment_intent.latest_charge',
            ] );

        if ( ! is_wp_error( $subscription ) && ! empty( $subscription['current_period_end'] ) ) {
            $next_payment = gmdate( 'Y-m-d', (int) $subscription['current_period_end'] );
            $invoice = $subscription['latest_invoice'] ?? [];
            $receipt_url = tbt_stripe_receipt_url_from_invoice( is_array( $invoice ) ? $invoice : [] ) ?: $receipt_url;

            if ( is_array( $invoice ) && ! empty( $invoice['payment_intent'] ) ) {
                $payment_intent = $invoice['payment_intent'];
                $transaction_id = is_array( $payment_intent ) ? ( $payment_intent['id'] ?? $transaction_id ) : $payment_intent;
            }
        }
    }

    $amount = isset( $session['amount_total'] ) ? ( (float) $session['amount_total'] / 100 ) : null;
    $columns = [
        'numeric_mm32epsb' => $amount,
        'date_mm32mr2x'   => [ 'date' => current_time( 'Y-m-d' ) ],
        'text_mm325mqh'   => $transaction_id,
    ];

    if ( '' !== $next_payment ) {
        $columns['date_mm32wn48'] = [ 'date' => $next_payment ];
    }

    if ( $is_renewal && '' !== $renewal_due ) {
        $columns['date_mkz6qwkk'] = [ 'date' => $renewal_due ];
    }

    if ( $is_renewal && '' !== $renewal_plan ) {
        $columns['dropdown_mkz6nmyj'] = [ 'labels' => [ $renewal_plan ] ];
    }

    if ( '' !== $receipt_url ) {
        $columns['text_mm32ymfs'] = $receipt_url;
    }

    $details_result = tbt_monday_update_item_columns( $item_id, $columns );
    tbt_monday_update_item_columns( $item_id, [
        'dropdown_mm327tn5' => [ 'labels' => [ 'Card' ] ],
    ] );
    $status_result  = tbt_monday_update_payment_status( $item_id, 'Pagado' );
    tbt_monday_update_item_columns( $item_id, [
        'color_mm328y0' => [ 'label' => 'Reservado' ],
    ] );

    if ( is_wp_error( $details_result ) ) {
        return $details_result;
    }

    if ( is_wp_error( $status_result ) ) {
        return new WP_Error(
            'tbt_monday_payment_status_failed',
            'Stripe payment details were saved, but Monday rejected the payment status label. Check the Estado de Pago labels in Monday.'
        );
    }

    if ( $is_renewal ) {
        tbt_notify_admin_renewal_paid( $item_id, $session );
    }

    return $details_result;
}

function tbt_notify_admin_renewal_paid( $item_id, array $session ) {
    $session_id = $session['id'] ?? '';

    if ( '' !== $session_id ) {
        $notice_key = 'tbt_renewal_admin_notice_' . md5( $session_id );

        if ( get_transient( $notice_key ) ) {
            return;
        }
    }

    $metadata    = $session['metadata'] ?? [];
    $reservation = tbt_monday_get_reservation_for_renewal( $item_id );

    if ( is_wp_error( $reservation ) ) {
        $reservation = [
            'name'     => '',
            'spaces'   => $metadata['reserved_spaces'] ?? '',
            'due_date' => $metadata['renewal_new_due_date'] ?? '',
        ];
    }

    $new_due_date = $metadata['renewal_new_due_date'] ?? ( $reservation['due_date'] ?? '' );
    $plan         = tbt_normalize_plan_label( $metadata['renewal_plan'] ?? $metadata['selected_plan'] ?? '' );

    $body  = "Un cliente renovó una plaza en Two Buck Trucks.\n\n";
    $body .= "Cliente: " . ( $reservation['name'] ?? '' ) . "\n";
    $body .= "Plaza(s): " . ( $metadata['reserved_spaces'] ?? ( $reservation['spaces'] ?? '' ) ) . "\n";
    $body .= "Plan renovado: {$plan}\n";
    $body .= "Nueva fecha de vencimiento: {$new_due_date}\n";
    $body .= "Monday item ID: {$item_id}\n";
    $body .= "Stripe session ID: {$session_id}\n";

    wp_mail(
        'info@2bucktrucks.com',
        'Renovacion de plaza - Two Buck Trucks',
        $body,
        [ 'Content-Type: text/plain; charset=UTF-8' ]
    );

    if ( '' !== $session_id ) {
        set_transient( $notice_key, 1, 30 * DAY_IN_SECONDS );
    }
}

function tbt_monday_update_payment_from_stripe_invoice( array $invoice ) {
    $metadata = $invoice['metadata'] ?? [];
    $item_id  = $metadata['monday_item_id'] ?? $invoice['subscription_details']['metadata']['monday_item_id'] ?? '';

    if ( '' === $item_id && ! empty( $invoice['subscription'] ) ) {
        $subscription = tbt_stripe_request( 'GET', 'subscriptions/' . rawurlencode( $invoice['subscription'] ) );

        if ( ! is_wp_error( $subscription ) ) {
            $item_id = $subscription['metadata']['monday_item_id'] ?? '';
        }
    }

    if ( '' === $item_id ) {
        return new WP_Error( 'tbt_stripe_missing_item', 'Stripe invoice is missing the Monday item ID.' );
    }

    $transaction_id = $invoice['payment_intent'] ?? $invoice['id'] ?? '';
    $receipt_url    = tbt_stripe_receipt_url_from_invoice( $invoice );
    $amount         = isset( $invoice['amount_paid'] ) ? ( (float) $invoice['amount_paid'] / 100 ) : null;
    $period_start   = ! empty( $invoice['period_start'] ) ? gmdate( 'Y-m-d', (int) $invoice['period_start'] ) : '';
    $period_end     = ! empty( $invoice['period_end'] ) ? gmdate( 'Y-m-d', (int) $invoice['period_end'] ) : '';
    $columns        = [
        'numeric_mm32epsb' => $amount,
        'date_mm32mr2x'   => [ 'date' => current_time( 'Y-m-d' ) ],
        'text_mm325mqh'   => is_array( $transaction_id ) ? ( $transaction_id['id'] ?? $invoice['id'] ?? '' ) : $transaction_id,
    ];

    if ( '' !== $period_start ) {
        $columns['date_mkz6h425'] = [ 'date' => $period_start ];
    }

    if ( '' !== $period_end ) {
        $columns['date_mkz6qwkk'] = [ 'date' => $period_end ];
        $columns['date_mm32wn48'] = [ 'date' => $period_end ];
    }

    if ( '' !== $receipt_url ) {
        $columns['text_mm32ymfs'] = $receipt_url;
    }

    $details_result = tbt_monday_update_item_columns( $item_id, $columns );
    delete_transient( 'tbt_monday_reserved_spaces' );
    delete_transient( 'tbt_monday_space_statuses_v2' );
    tbt_monday_update_item_columns( $item_id, [
        'dropdown_mm327tn5' => [ 'labels' => [ 'Card' ] ],
    ] );
    $status_result = tbt_monday_update_payment_status( $item_id, 'Pagado' );
    tbt_monday_update_item_columns( $item_id, [
        'color_mm328y0' => [ 'label' => 'Reservado' ],
    ] );

    if ( is_wp_error( $details_result ) ) {
        return $details_result;
    }

    if ( is_wp_error( $status_result ) ) {
        return new WP_Error(
            'tbt_monday_payment_status_failed',
            'Stripe invoice details were saved, but Monday rejected the payment status label.'
        );
    }

    return $details_result;
}

function tbt_monday_update_subscription_period( array $subscription ) {
    $item_id = $subscription['metadata']['monday_item_id'] ?? '';

    if ( '' === $item_id ) {
        return new WP_Error( 'tbt_stripe_missing_item', 'Stripe subscription is missing the Monday item ID.' );
    }

    $current_period_start = ! empty( $subscription['current_period_start'] ) ? gmdate( 'Y-m-d', (int) $subscription['current_period_start'] ) : '';
    $current_period_end   = ! empty( $subscription['current_period_end'] ) ? gmdate( 'Y-m-d', (int) $subscription['current_period_end'] ) : '';

    if ( '' === $current_period_start || '' === $current_period_end ) {
        return new WP_Error( 'tbt_subscription_missing_periods', 'Subscription is missing period dates.' );
    }

    $columns = [];

    $columns['date_mkz6h425'] = [ 'date' => $current_period_start ];
    $columns['date_mkz6qwkk'] = [ 'date' => $current_period_end ];
    $columns['date_mm32wn48'] = [ 'date' => $current_period_end ];

    $result = tbt_monday_update_item_columns( $item_id, $columns );

    if ( ! is_wp_error( $result ) ) {
        delete_transient( 'tbt_monday_reserved_spaces' );
        delete_transient( 'tbt_monday_space_statuses_v2' );
    }

    if ( is_wp_error( $result ) ) {
        return $result;
    }

    return $result;
}

function tbt_stripe_receipt_url_from_invoice( array $invoice ) {
    if ( ! empty( $invoice['payment_intent']['latest_charge']['receipt_url'] ) ) {
        return $invoice['payment_intent']['latest_charge']['receipt_url'];
    }

    if ( ! empty( $invoice['charge']['receipt_url'] ) ) {
        return $invoice['charge']['receipt_url'];
    }

    return $invoice['hosted_invoice_url'] ?? '';
}

function tbt_monday_update_payment_status_from_stripe_object( array $object, $status_label ) {
    $item_id = $object['metadata']['monday_item_id'] ?? $object['client_reference_id'] ?? '';

    if ( '' === $item_id ) {
        return;
    }

    tbt_monday_update_payment_status( $item_id, $status_label );
}

function tbt_monday_update_payment_status( $item_id, $status_label ) {
    $attempts = [
        [ 'label' => $status_label ],
        [ 'label' => ucfirst( strtolower( $status_label ) ) ],
    ];

    foreach ( $attempts as $value ) {
        $result = tbt_monday_update_item_columns( $item_id, [
            'color_mkz63sz7' => $value,
        ] );

        if ( ! is_wp_error( $result ) ) {
            return $result;
        }
    }

    return $result ?? new WP_Error( 'tbt_monday_status_failed', 'Unable to update Monday payment status.' );
}

function tbt_monday_update_item_columns( $item_id, array $column_values ) {
    if (
        ! defined( 'TBT_MONDAY_API_TOKEN' ) ||
        ! defined( 'TBT_MONDAY_BOARD_ID' ) ||
        'PASTE_MONDAY_API_TOKEN_HERE' === TBT_MONDAY_API_TOKEN ||
        'PASTE_MONDAY_BOARD_ID_HERE' === TBT_MONDAY_BOARD_ID
    ) {
        return new WP_Error( 'tbt_monday_not_configured', 'Monday.com is not configured.' );
    }

    $query = 'mutation ($boardId: ID!, $itemId: ID!, $columnValues: JSON!) { change_multiple_column_values(board_id: $boardId, item_id: $itemId, column_values: $columnValues) { id } }';
    $response = tbt_monday_graphql( $query, [
        'boardId'      => (string) TBT_MONDAY_BOARD_ID,
        'itemId'       => (string) $item_id,
        'columnValues' => wp_json_encode( $column_values ),
    ] );

    if ( is_wp_error( $response ) ) {
        return $response;
    }

    return $response['data']['change_multiple_column_values'] ?? true;
}

/**
 * Crear o reutilizar el item principal en Monday.
 */
/**
 * Normalizar un número de teléfono para el formato que acepta Monday.com
 * en columnas de tipo phone: solo dígitos, sin espacios, guiones ni paréntesis.
 *
 * @param  string $phone Número tal como lo escribe el usuario.
 * @return array  Objeto phone aceptado por la API de Monday: { phone, countryShortName }.
 */
function tbt_monday_phone_value( $phone ) {
    // Eliminar cualquier carácter que no sea dígito o el signo +
    $digits = preg_replace( '/[^0-9+]/', '', (string) $phone );

    return [
        'phone'            => $digits,
        'countryShortName' => 'US',
    ];
}

function tbt_monday_reservation_column_values( array $reservation, $include_statuses = true ) {
    $entry_date = tbt_monday_date_value( $reservation['entry_date'] );
    $due_date   = tbt_monday_date_value( tbt_calculate_reservation_due_date( $reservation['entry_date'], $reservation['selected_plan'] ) );
    $amount     = preg_replace( '/[^0-9.]/', '', $reservation['selected_plan_price'] );

    $column_values = [
        'text_mm329zm3'   => $reservation['spaces'],
        'dropdown_mkz6nmyj' => [ 'labels' => [ $reservation['selected_plan'] ] ],
        'text_mkz6gxh2'   => $reservation['vehicle_plate'],
        'text_mkz6wf4q'   => $reservation['assigned_vehicle'],
        'date_mkz6h425'   => $entry_date,
        'date_mkz6qwkk'   => $due_date,
        'long_text_mm32sg6k' => $reservation['physical_address'],
        'text_mm32z25b'   => $reservation['regular_cargo'],
        'text_mm3277xb'   => $reservation['vehicle_vin'],
        'text_mm3220pg'   => $reservation['vehicle_year'],
        'email_mm32g1n'   => [ 'email' => $reservation['driver_email'], 'text' => $reservation['driver_email'] ],
        'phone_mm32w239'  => tbt_monday_phone_value( $reservation['driver_phone'] ),
        'numeric_mm32epsb' => '' !== $amount ? $amount : null,
        'text_mm33324v'   => $reservation['company_name'],
        'phone_mm33rs05'  => tbt_monday_phone_value( $reservation['emergency_phone'] ),
        'text_mm33zawp'   => $reservation['physical_address'],
    ];

    if ( $include_statuses ) {
        $column_values = array_merge( [
            'color_mkz63sz7' => [ 'label' => 'Pendiente' ],
            'color_mm328y0'  => [ 'label' => 'Reserva en proceso' ],
        ], $column_values );
    }

    return $column_values;
}

function tbt_monday_upsert_reservation_item( array $reservation ) {
    $column_values = tbt_monday_reservation_column_values( $reservation );
    $pending_item  = tbt_monday_find_reusable_pending_item( $reservation['spaces'] );

    if ( $pending_item ) {
        $name_result = tbt_monday_update_item_name( $pending_item['id'], $reservation['driver_full_name'] );

        if ( is_wp_error( $name_result ) ) {
            return $name_result;
        }

        $result = tbt_monday_update_item_columns( $pending_item['id'], array_merge( $column_values, [
            'file_mm32p4vz' => [ 'clear_all' => true ],
            'file_mm32qrmg' => [ 'clear_all' => true ],
            'file_mm32jh0w' => [ 'clear_all' => true ],
        ] ) );

        if ( is_wp_error( $result ) ) {
            return $result;
        }

        return [
            'id'   => $pending_item['id'],
            'name' => $reservation['driver_full_name'],
        ];
    }

    $query = 'mutation ($boardId: ID!, $itemName: String!, $columnValues: JSON!) { create_item(board_id: $boardId, item_name: $itemName, column_values: $columnValues, create_labels_if_missing: true) { id name } }';
    $response = tbt_monday_graphql( $query, [
        'boardId'      => (string) TBT_MONDAY_BOARD_ID,
        'itemName'     => $reservation['driver_full_name'],
        'columnValues' => wp_json_encode( tbt_monday_reservation_column_values( $reservation, false ) ),
    ] );

    if ( is_wp_error( $response ) ) {
        return $response;
    }

    $item = $response['data']['create_item'] ?? null;

    if ( ! $item ) {
        return new WP_Error( 'tbt_monday_create_failed', 'Monday did not return a created item.' );
    }

    sleep( 2 );
    $status_result = tbt_monday_update_item_columns( $item['id'], [
        'color_mkz63sz7' => [ 'label' => 'Pendiente' ],
        'color_mm328y0'  => [ 'label' => 'Reserva en proceso' ],
    ] );

    if ( is_wp_error( $status_result ) ) {
        return $status_result;
    }

    return $item;
}

function tbt_monday_find_reusable_pending_item( $spaces ) {
    $requested_spaces = tbt_extract_parking_spaces( $spaces );
    sort( $requested_spaces );
    $released_subset_match = null;

    foreach ( tbt_monday_get_reservation_items() as $item ) {
        $payment_status = tbt_normalize_monday_group_title( $item['payment_status'] ?? '' );
        $spot_status    = tbt_normalize_monday_group_title( $item['spot_status'] ?? '' );

        if ( ! in_array( $payment_status, [ 'pendiente', 'sin pago' ], true ) ) {
            continue;
        }

        if ( in_array( $spot_status, [ 'reservado', 'bloqueado', 'reserva en proceso' ], true ) ) {
            continue;
        }

        $item_spaces = tbt_extract_parking_spaces( $item['spaces'] ?? '' );
        sort( $item_spaces );

        if ( $requested_spaces === $item_spaces ) {
            return $item;
        }

        $can_reuse_released_subset =
            null === $released_subset_match &&
            'sin pago' === $payment_status &&
            'disponible' === $spot_status &&
            empty( array_diff( $requested_spaces, $item_spaces ) );

        if ( $can_reuse_released_subset ) {
            $released_subset_match = $item;
        }
    }

    return $released_subset_match;
}

function tbt_monday_update_item_name( $item_id, $item_name ) {
    if (
        ! defined( 'TBT_MONDAY_API_TOKEN' ) ||
        ! defined( 'TBT_MONDAY_BOARD_ID' ) ||
        'PASTE_MONDAY_API_TOKEN_HERE' === TBT_MONDAY_API_TOKEN ||
        'PASTE_MONDAY_BOARD_ID_HERE' === TBT_MONDAY_BOARD_ID
    ) {
        return new WP_Error( 'tbt_monday_not_configured', 'Monday.com is not configured.' );
    }

    $query = 'mutation ($boardId: ID!, $itemId: ID!, $itemName: String!) { change_simple_column_value(board_id: $boardId, item_id: $itemId, column_id: "name", value: $itemName) { id } }';
    $response = tbt_monday_graphql( $query, [
        'boardId'  => (string) TBT_MONDAY_BOARD_ID,
        'itemId'   => (string) $item_id,
        'itemName' => (string) $item_name,
    ] );

    if ( is_wp_error( $response ) ) {
        return $response;
    }

    return $response['data']['change_simple_column_value'] ?? true;
}

/**
 * Ejecutar una consulta GraphQL contra Monday.
 */
function tbt_monday_graphql( $query, array $variables ) {
    $response = wp_remote_post( 'https://api.monday.com/v2', [
        'timeout' => 20,
        'headers' => [
            'Authorization' => TBT_MONDAY_API_TOKEN,
            'API-Version'   => '2024-01',
            'Content-Type'  => 'application/json',
        ],
        'body' => wp_json_encode( [
            'query'     => $query,
            'variables' => $variables,
        ] ),
    ] );

    if ( is_wp_error( $response ) ) {
        return $response;
    }

    $body = json_decode( wp_remote_retrieve_body( $response ), true );

    if ( isset( $body['errors'][0]['message'] ) ) {
        return new WP_Error( 'tbt_monday_error', $body['errors'][0]['message'] );
    }

    return $body;
}

/**
 * Subir un archivo enviado por el formulario a una columna file de Monday.
 */
function tbt_monday_upload_submitted_file( $item_id, $column_id, $field_name ) {
    if ( empty( $_FILES[ $field_name ]['tmp_name'] ) || UPLOAD_ERR_OK !== (int) $_FILES[ $field_name ]['error'] ) {
        return [ 'skipped' => true ];
    }

    return tbt_monday_upload_file_to_column(
        $item_id,
        $column_id,
        $_FILES[ $field_name ]['tmp_name'],
        sanitize_file_name( $_FILES[ $field_name ]['name'] )
    );
}

/**
 * Crear y subir un archivo de texto con el contrato llenado.
 */
function tbt_monday_upload_contract_text( $item_id, array $reservation ) {
    if ( '' === trim( $reservation['contract_text'] ) ) {
        return [ 'skipped' => true ];
    }

    $file_name = 'contract-' . sanitize_title( $reservation['driver_full_name'] ) . '-' . gmdate( 'Ymd-His' ) . '.txt';
    $file_path = wp_tempnam( $file_name );

    if ( ! $file_path ) {
        return [ 'error' => 'Unable to create temporary contract file.' ];
    }

    file_put_contents( $file_path, $reservation['contract_text'] );
    $result = tbt_monday_upload_file_to_column( $item_id, 'file_mm32jh0w', $file_path, $file_name );
    wp_delete_file( $file_path );

    return $result;
}

/**
 * Subir un archivo a Monday usando su endpoint de archivos.
 */
function tbt_monday_upload_file_to_column( $item_id, $column_id, $file_path, $file_name ) {
    if ( ! function_exists( 'curl_init' ) || ! file_exists( $file_path ) ) {
        return [ 'error' => 'File upload is unavailable on this server.' ];
    }

    $query = 'mutation ($itemId: ID!, $columnId: String!, $file: File!) { add_file_to_column(item_id: $itemId, column_id: $columnId, file: $file) { id } }';
    $variables = [
        'itemId'   => (string) $item_id,
        'columnId' => $column_id,
        'file'     => null,
    ];

    $curl = curl_init( 'https://api.monday.com/v2/file' );
    curl_setopt_array( $curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => [
            'Authorization: ' . TBT_MONDAY_API_TOKEN,
            'API-Version: 2024-01',
        ],
        CURLOPT_POSTFIELDS     => [
            'query'     => $query,
            'variables' => wp_json_encode( $variables ),
            'map'       => wp_json_encode( [ 'file' => [ 'variables.file' ] ] ),
            'file'      => curl_file_create( $file_path, mime_content_type( $file_path ) ?: 'application/octet-stream', $file_name ),
        ],
    ] );

    $raw_response = curl_exec( $curl );
    $curl_error   = curl_error( $curl );
    curl_close( $curl );

    if ( $curl_error ) {
        return [ 'error' => $curl_error ];
    }

    $response = json_decode( $raw_response, true );

    if ( isset( $response['errors'][0]['message'] ) ) {
        return [ 'error' => $response['errors'][0]['message'] ];
    }

    return [ 'id' => $response['data']['add_file_to_column']['id'] ?? '' ];
}

function tbt_monday_date_value( $date ) {
    return preg_match( '/^\d{4}-\d{2}-\d{2}$/', $date ) ? [ 'date' => $date ] : null;
}

function tbt_calculate_reservation_due_date( $entry_date, $plan ) {
    try {
        $date = new DateTimeImmutable( $entry_date );
    } catch ( Exception $exception ) {
        return '';
    }

    if ( '1 Day' === $plan ) {
        return $date->modify( '+1 day' )->format( 'Y-m-d' );
    }

    if ( '1 Week' === $plan ) {
        return $date->modify( '+7 days' )->format( 'Y-m-d' );
    }

    return $date->modify( '+1 month' )->format( 'Y-m-d' );
}

/**
 * Obtener desde Monday los lugares que ya estan reservados.
 */
function tbt_monday_get_reserved_spaces() {
    $cached = get_transient( 'tbt_monday_space_statuses_v2' );

    if ( false !== $cached ) {
        return is_array( $cached ) ? $cached : [
            'reserved'   => [],
            'processing' => [],
        ];
    }

    if (
        ! defined( 'TBT_MONDAY_API_TOKEN' ) ||
        ! defined( 'TBT_MONDAY_BOARD_ID' ) ||
        'PASTE_MONDAY_API_TOKEN_HERE' === TBT_MONDAY_API_TOKEN ||
        'PASTE_MONDAY_BOARD_ID_HERE' === TBT_MONDAY_BOARD_ID
    ) {
        return [
            'reserved'   => [],
            'processing' => [],
        ];
    }

    $reservation_items = tbt_monday_get_reservation_items();
    $reserved_spaces    = [];
    $processing_spaces  = [];

    foreach ( $reservation_items as $item ) {
        $group_title = tbt_normalize_monday_group_title( $item['group_title'] ?? '' );
        $spot_status = tbt_normalize_monday_group_title( $item['spot_status'] ?? '' );
        $item_spaces = tbt_extract_parking_spaces( $item['spaces'] ?? '' );

        if ( 'reserva en proceso' === $spot_status ) {
            $processing_spaces = array_merge( $processing_spaces, $item_spaces );
            continue;
        }

        if (
            in_array( $group_title, [ 'lugares ocupados', 'lugares bloqueados' ], true ) ||
            in_array( $spot_status, [ 'reservado', 'bloqueado' ], true )
        ) {
            $reserved_spaces = array_merge( $reserved_spaces, $item_spaces );
        }
    }

    $result = [
        'reserved'   => array_values( array_unique( $reserved_spaces ) ),
        'processing' => array_values( array_unique( $processing_spaces ) ),
    ];
    set_transient( 'tbt_monday_space_statuses_v2', $result, MINUTE_IN_SECONDS );

    return $result;
}

function tbt_monday_get_reservation_items() {
    if (
        ! defined( 'TBT_MONDAY_API_TOKEN' ) ||
        ! defined( 'TBT_MONDAY_BOARD_ID' ) ||
        'PASTE_MONDAY_API_TOKEN_HERE' === TBT_MONDAY_API_TOKEN ||
        'PASTE_MONDAY_BOARD_ID_HERE' === TBT_MONDAY_BOARD_ID
    ) {
        return [];
    }

    $query = 'query ($boardId: [ID!]) { boards(ids: $boardId) { items_page(limit: 500) { items { id name created_at group { id title } column_values(ids: ["text_mm329zm3", "color_mkz63sz7", "color_mm328y0"]) { id text } } } } }';
    $response = tbt_monday_graphql( $query, [
        'boardId' => [ (string) TBT_MONDAY_BOARD_ID ],
    ] );

    if ( is_wp_error( $response ) ) {
        return [];
    }

    $items = $response['data']['boards'][0]['items_page']['items'] ?? [];
    $reservation_items = [];

    foreach ( $items as $item ) {
        $reservation_item = [
            'id'             => (string) ( $item['id'] ?? '' ),
            'name'           => $item['name'] ?? '',
            'created_at'     => $item['created_at'] ?? '',
            'group_title'    => $item['group']['title'] ?? '',
            'spaces'         => '',
            'payment_status' => '',
            'spot_status'    => '',
        ];

        foreach ( $item['column_values'] ?? [] as $column ) {
            if ( 'text_mm329zm3' === ( $column['id'] ?? '' ) ) {
                $reservation_item['spaces'] = $column['text'] ?? '';
            }

            if ( 'color_mkz63sz7' === ( $column['id'] ?? '' ) ) {
                $reservation_item['payment_status'] = $column['text'] ?? '';
            }

            if ( 'color_mm328y0' === ( $column['id'] ?? '' ) ) {
                $reservation_item['spot_status'] = $column['text'] ?? '';
            }
        }

        $reservation_items[] = $reservation_item;
    }

    return $reservation_items;
}

function tbt_monday_get_reservation_for_renewal( $item_id ) {
    if (
        ! defined( 'TBT_MONDAY_API_TOKEN' ) ||
        ! defined( 'TBT_MONDAY_BOARD_ID' ) ||
        'PASTE_MONDAY_API_TOKEN_HERE' === TBT_MONDAY_API_TOKEN ||
        'PASTE_MONDAY_BOARD_ID_HERE' === TBT_MONDAY_BOARD_ID
    ) {
        return new WP_Error( 'tbt_monday_not_configured', 'Monday.com is not configured.' );
    }

    $query = 'query ($boardId: [ID!]) { boards(ids: $boardId) { items_page(limit: 500) { items { id name column_values(ids: ["text_mm329zm3", "dropdown_mkz6nmyj", "date_mkz6qwkk", "email_mm32g1n", "color_mkz63sz7", "color_mm328y0"]) { id text value } } } } }';
    $response = tbt_monday_graphql( $query, [
        'boardId' => [ (string) TBT_MONDAY_BOARD_ID ],
    ] );

    if ( is_wp_error( $response ) ) {
        return $response;
    }

    $items = $response['data']['boards'][0]['items_page']['items'] ?? [];
    $item  = null;

    foreach ( $items as $candidate ) {
        if ( (string) ( $candidate['id'] ?? '' ) === (string) $item_id ) {
            $item = $candidate;
            break;
        }
    }

    if ( ! $item ) {
        return new WP_Error( 'tbt_monday_item_not_found', 'Reservation was not found in Monday.' );
    }

    return tbt_monday_reservation_from_item( $item );
}

function tbt_monday_get_renewal_candidates() {
    if (
        ! defined( 'TBT_MONDAY_API_TOKEN' ) ||
        ! defined( 'TBT_MONDAY_BOARD_ID' ) ||
        'PASTE_MONDAY_API_TOKEN_HERE' === TBT_MONDAY_API_TOKEN ||
        'PASTE_MONDAY_BOARD_ID_HERE' === TBT_MONDAY_BOARD_ID
    ) {
        return [];
    }

    $query = 'query ($boardId: [ID!]) { boards(ids: $boardId) { items_page(limit: 500) { items { id name column_values(ids: ["text_mm329zm3", "dropdown_mkz6nmyj", "date_mkz6qwkk", "email_mm32g1n", "color_mkz63sz7", "color_mm328y0"]) { id text value } } } } }';
    $response = tbt_monday_graphql( $query, [
        'boardId' => [ (string) TBT_MONDAY_BOARD_ID ],
    ] );

    if ( is_wp_error( $response ) ) {
        return [];
    }

    $items = $response['data']['boards'][0]['items_page']['items'] ?? [];

    return array_map( 'tbt_monday_reservation_from_item', $items );
}

function tbt_monday_reservation_from_item( array $item ) {
    $columns = [];

    foreach ( $item['column_values'] ?? [] as $column ) {
        $columns[ $column['id'] ?? '' ] = $column;
    }

    return [
        'id'             => (string) ( $item['id'] ?? '' ),
        'name'           => $item['name'] ?? '',
        'spaces'         => tbt_monday_column_text( $columns, 'text_mm329zm3' ),
        'plan'           => tbt_normalize_plan_label( tbt_monday_column_text( $columns, 'dropdown_mkz6nmyj' ) ),
        'due_date'       => tbt_monday_column_date( $columns, 'date_mkz6qwkk' ),
        'email'          => tbt_monday_column_email( $columns, 'email_mm32g1n' ),
        'payment_status' => tbt_monday_column_text( $columns, 'color_mkz63sz7' ),
        'spot_status'    => tbt_monday_column_text( $columns, 'color_mm328y0' ),
    ];
}

function tbt_monday_column_text( array $columns, $column_id ) {
    return trim( (string) ( $columns[ $column_id ]['text'] ?? '' ) );
}

function tbt_monday_column_value( array $columns, $column_id ) {
    $value = $columns[ $column_id ]['value'] ?? '';

    if ( '' === $value || null === $value ) {
        return [];
    }

    $decoded = json_decode( $value, true );

    return is_array( $decoded ) ? $decoded : [];
}

function tbt_monday_column_date( array $columns, $column_id ) {
    $value = tbt_monday_column_value( $columns, $column_id );

    return $value['date'] ?? tbt_monday_column_text( $columns, $column_id );
}

function tbt_monday_column_email( array $columns, $column_id ) {
    $value = tbt_monday_column_value( $columns, $column_id );
    $email = $value['email'] ?? tbt_monday_column_text( $columns, $column_id );

    return sanitize_email( $email );
}

function tbt_normalize_monday_group_title( $title ) {
    $title = strtolower( trim( (string) $title ) );
    $from  = [ 'á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ' ];
    $to    = [ 'a', 'e', 'i', 'o', 'u', 'u', 'n' ];

    return str_replace( $from, $to, $title );
}

function tbt_extract_parking_spaces( $text ) {
    preg_match_all( '/\b[A-B]-\d{1,3}\b/i', (string) $text, $matches );

    return array_values( array_unique( array_map( 'strtoupper', $matches[0] ?? [] ) ) );
}
