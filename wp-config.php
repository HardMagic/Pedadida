<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

require_once('pedadida-config.php');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $pedadida_database_name);

/** MySQL database username */
define('DB_USER', $pedadida_database_username);

/** MySQL database password */
define('DB_PASSWORD', $pedadida_database_password);

/** MySQL hostname */
define('DB_HOST', $pedadida_database_host);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', $pedadida_database_charset);

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', $pedadida_database_collate);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         $pedadida_key1);
define('SECURE_AUTH_KEY',  $pedadida_key2);
define('LOGGED_IN_KEY',    $pedadida_key3);
define('NONCE_KEY',        $pedadida_key4);
define('AUTH_SALT',        $pedadida_key5);
define('SECURE_AUTH_SALT', $pedadida_key6);
define('LOGGED_IN_SALT',   $pedadida_key7);
define('NONCE_SALT',       $pedadida_key8);

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);
define('WP_ALLOW_MULTISITE', true);


define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', $pedadida_base);
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

define('MASTER_DOMAIN', $pedadida_base ); // Change this to the domain name of your master site

// WP DOMAIN MAPPING
	define( 'SUNRISE', 'on' );
	
/*
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', true );
$base = '/';

define( 'DOMAIN_CURRENT_SITE', $pedadida_base );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );
define('FORCE_SSL_LOGIN ', true);

define('MASTER_DOMAIN', $pedadida_base ); // Change this to the domain name of your master site
define('CUSTOM_USER_TABLE', 'wp_users');
define('CUSTOM_USER_META_TABLE', 'wp_usermeta');

define( 'NOBLOGREDIRECT', $pedadida_base );
*/
define('WP_MEMORY_LIMIT', '256M');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
