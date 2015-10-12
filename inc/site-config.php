<?php
/**
 * Singleton class which wraps configuration data
 *
 * Loading a configuration value is simple with `HSInsider_site_config()`.
 * You are able to pass any level configuration key via a dot notation.
 *
 * `key1.key2.key3` "finds":
 *
 * ```
 * [
 *     'key1' => [
 *         'key2' => [
 *             'key3' => 'configuration value'
 *         ]
 *     ]
 * ]
 */
class HSInsider_Site_Config {

	/**
	 * @var HSInsider_Site_Config
	 */
	protected static $instance;
	public $config;

	/**
	 * Build configuration information about the site
	 */
	protected function __construct() {
		$config_file = HSINSIDER_PATH . '/config.php';

		if ( ! file_exists( $config_file ) ) {
			$this->config = array();
		} else {
			$this->config = include( $config_file );
		}
	}

	/**
	 * Static accessor.
	 *
	 * @return HSInsider_Site_Config singleton
	 */
	public static function instance() {
		if ( ! is_object( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Get a configuration setting from array.
	 *
	 * @param string $key A '.' delimited string that will retrieve the key
	 *                    we're looking for.
	 * @param mixed $default Optional. The default value when the config doesn't
	 *                       exist.
	 * @return mixed value
	 */
	public function setting( $key, $default = null ) {
		// Reference to the last config we've decended into
		$config = $this->config;

		// Explode the array keys by a period
		$keys = explode( '.', $key );

		// Determine the key we're looking for
		foreach ( $keys as $k ) {
			if ( isset( $config[ $k ] ) ) {
				$config = $config[ $k ];
			} else {
				return $default;
			}
		}

		return $config;
	}
}

/**
 * Shortcut function for the most common case; get a value from the config
 * defined in the site config file.
 *
 * @see HSInsider_Site_Config::setting().
 */
function hsinsider_site_config( $key, $default = null ) {
	return HSInsider_Site_Config::instance()->setting( $key, $default );
}
