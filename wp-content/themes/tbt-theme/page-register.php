<?php
/**
 * Plantilla de página: Registro
 *
 * Página con un formulario para que los clientes se registren y elijan
 * la tarifa de estacionamiento que desean. Para funcionalidad real de
 * almacenamiento y procesamiento, se recomienda integrar un plugin de
 * formularios o desarrollar lógica personalizada.
 *
 * @package tbt-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Template Name: Register
 */

get_header();
?>

<main>
    <section class="section">
        <h1><?php echo esc_html( tbt_text( 'register_title' ) ); ?></h1>
        <p><?php echo esc_html( tbt_text( 'register_intro' ) ); ?></p>
        <?php
        if ( isset( $_GET['registro'] ) && 'exitoso' === $_GET['registro'] ) {
            echo '<p><strong>' . esc_html( tbt_text( 'register_success' ) ) . '</strong></p>';
        }
        ?>
        <form class="registration-form" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
            <?php wp_nonce_field( 'tbt_registration_form', 'tbt_registration_nonce' ); ?>
            <input type="hidden" name="action" value="tbt_handle_registration">
            <label for="nombre"><?php echo esc_html( tbt_text( 'full_name' ) ); ?></label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="correo"><?php echo esc_html( tbt_text( 'email' ) ); ?></label>
            <input type="email" id="correo" name="correo" required>

            <label for="telefono"><?php echo esc_html( tbt_text( 'phone' ) ); ?></label>
            <input type="tel" id="telefono" name="telefono" required>

            <label for="tarifa"><?php echo esc_html( tbt_text( 'select_plan' ) ); ?></label>
            <select id="tarifa" name="tarifa" required>
                <option value="Dia"><?php echo esc_html( tbt_text( 'plan_day' ) ); ?></option>
                <option value="Semana"><?php echo esc_html( tbt_text( 'plan_week' ) ); ?></option>
                <option value="Mes"><?php echo esc_html( tbt_text( 'plan_month' ) ); ?></option>
                <option value="Mensual Recurrente"><?php echo esc_html( tbt_text( 'plan_recurring' ) ); ?></option>
            </select>

            <label for="mensaje"><?php echo esc_html( tbt_text( 'comments' ) ); ?></label>
            <textarea id="mensaje" name="mensaje" rows="4"></textarea>

            <button type="submit"><?php echo esc_html( tbt_text( 'submit_registration' ) ); ?></button>
        </form>
    </section>

    <section class="section">
        <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
        ?>
    </section>
</main>

<?php
get_footer();
