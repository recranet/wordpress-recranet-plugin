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
    'html5mode' => get_option( 'html5mode', 0 ),
);

$locale = get_locale();
$locale = substr($locale, 0, 2);
?>

<div class="recranet-container recranet-container-init" data-recranet-container-init data-eq-pts="small: <?php echo $options['breakpoint_small']; ?>, medium:  <?php echo $options['breakpoint_medium']; ?>, large:  <?php echo $options['breakpoint_large']; ?>">
    <recranet-accommodations></recranet-accommodations>
</div>

<script type="text/javascript">
    var recranetConfig = {
         accommodationsView: 'grid'
        ,html5Mode: <?php echo ($options['html5mode'] ? 'true': 'false') ?>
        ,locale: '<?php echo $locale; ?>'
        ,organization: <?php echo $options['organization']; ?>
        ,baseUrl: 'https://recranet.com'
    };

    (function(d, random) {
        var l = d.createElement('link'); l.rel = 'stylesheet'; l.type = 'text/css';
        l.href = recranetConfig.baseUrl + '/sdk/sdk.css?' + random + '=' + random + '&organization=' + recranetConfig.organization;
        var s = d.createElement('script'); s.type = 'text/javascript'; s.async = true;
        s.src = recranetConfig.baseUrl + '/sdk/sdk.js?' + random + '=' + random;
        var h = d.getElementsByTagName('head')[0]; h.appendChild(l); h.appendChild(s);
    })(document, (new Date()).getTime());
</script>
