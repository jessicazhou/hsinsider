<?php

/*
 * This file is loaded in /inc/site-config.php.
 *
 *     * Varibles can be retrieved anywhere in the site using
 *       `hsinsider_site_config( 'variable' )`
 *     * Descendant variables can be retrieved using dot-notation, e.g.
 *       `hsinsider_site_config( 'variable1.variable2' )`
 *
 * Note: never use a `.` in a variable name.
 */

return array(
	'versions' => array(
		'styles'  => '0.0.1',
	),
	'domains' => array(
		'text' => 'hsinsider',
	),
	'mailchimp' => array(
		'list'  => '08707b9bf8',
	),
	'image_sizes' => array(
		'homepage_centerpiece'	=>	array(
			'w' => 746,
			'h' => 496
		)
	),
	'api' => array(
		'googlemaps' => 'AIzaSyCP4R3wOPrv5m-PlI3zRl6LGiZJ48aBsH8'
	),
);
