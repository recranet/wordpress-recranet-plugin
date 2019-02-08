<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://recranet.com/
 * @since      1.0.0
 *
 * @package    Recranet
 * @subpackage Recranet/public/partials
 */

$options = array(
    'organization' => get_option( 'recranet_organization', 1000 ),
    'breakpoint_small' => get_option( 'recranet_breakpoint_small', 720 ),
    'breakpoint_medium' => get_option( 'recranet_breakpoint_medium', 940 ),
    'breakpoint_large' => get_option( 'recranet_breakpoint_large', 1140 ),
    'html5mode' => get_option( 'recranet_html5mode', 0 ),
);

$locale = get_locale();
$locale = substr($locale, 0, 2);
?>

<div class="recranet-container recranet-container-init" data-recranet-container-init data-eq-pts="small: <?php echo $options['breakpoint_small']; ?>, medium:  <?php echo $options['breakpoint_medium']; ?>, large:  <?php echo $options['breakpoint_large']; ?>">
    <recranet-accommodation-reservation-form<?php if (isset($atts['action'])) { echo ' action="' . $atts['action'] . '"'; } ?>></recranet-accommodation-reservation-form>
</div>

<?php if (!defined('RECRANET_SDK')) : define('RECRANET_SDK', true); ?>

<script type="text/javascript">
    var recranetConfig = {
         accommodation: <?php echo (int) $atts['accommodation']; ?>
        ,accommodationsView: 'grid'
        ,html5Mode: <?php echo ($options['html5mode'] ? 'true': 'false') ?>
        ,locale: '<?php echo $locale; ?>'
        ,organization: <?php echo $options['organization']; ?>
        ,baseUrl: 'https://app.recranet.com'
    };

    (function(d, random) {
        var l = d.createElement('link'); l.rel = 'stylesheet'; l.type = 'text/css';
        l.href = recranetConfig.baseUrl + '/sdk/sdk.css?' + random + '=' + random + '&organization=' + recranetConfig.organization;
        var s = d.createElement('script'); s.id = 'sdk'; s.type = 'text/javascript'; s.async = true;
        s.src = recranetConfig.baseUrl + '/sdk/sdk.js?' + random + '=' + random;
        var h = d.getElementsByTagName('head')[0]; h.appendChild(l); h.appendChild(s);
    })(document, (new Date()).getTime());
</script>

<?php endif; ?>
