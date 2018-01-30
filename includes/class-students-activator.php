<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.linkedin.com/in/piotr-jacek-gumulka/
 * @since      1.0.0
 *
 * @package    Students
 * @subpackage Students/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Students
 * @subpackage Students/includes
 * @author     Piotr Jacek Gumulka <pjgumulka@gmail.com>
 */
class Students_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$prefix= $wpdb->prefix;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		$table_name= $prefix.'students';
		$sql = "
		CREATE TABLE IF NOT EXISTS $table_name (
			`stuId` int(11) NOT NULL AUTO_INCREMENT,
		  `stuName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
		  `stuText` text COLLATE utf8_unicode_ci NOT NULL,
		  `stuPhoto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
		  `stuKgs` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
		  `stuCountry` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
		  `stuBirth` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
		  `stuRank` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
		  `stuTripDuration` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
		  `stuGossip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
		  `stuOrder` tinyint(4) NOT NULL,
		  `isCurrent` tinyint(4) NOT NULL DEFAULT '1',
		  `isApproved` tinyint(1) NOT NULL DEFAULT '0',
			PRIMARY KEY  (stuId)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		";
		dbDelta($sql);
	}

}
