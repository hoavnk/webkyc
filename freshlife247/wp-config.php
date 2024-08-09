<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'freshlife247' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'mtesgP1trcAxoqKyn29hNCqDhN6mqhJ6vAJV8s6imN8oTLRErobZYSQW1daCL72l' );
define( 'SECURE_AUTH_KEY',  'oSEslsQl8e94AsxiJ0LVij8M1KWAtbAIeRT3lWudZgsDzzaktQdBoH8DPTLTubWb' );
define( 'LOGGED_IN_KEY',    'PvB9QOEdMMef0kTbxyTz1pDEy7WPVeLA7Val5yfPyWU3lPOJG0UctDjCZnBbbww6' );
define( 'NONCE_KEY',        'PwLOL7F0H0O7V9Zk2gg2GgUwLy2W2rBibbAqe3hL7C4qgncsMzw9NvSCINKofKHc' );
define( 'AUTH_SALT',        'Qngz63wiFaNytaj7XncQu1Lg99TEzR7JHVd2OrwOEFJnBHtiNPNy3J8ZGEwo2GfV' );
define( 'SECURE_AUTH_SALT', '5cOKNRrHX89ADv2CBVrSbY00wxrOQuBvFz5IKuUAdQxMsCZRscXOK8vu9729TY8r' );
define( 'LOGGED_IN_SALT',   'tZqlTypmz2Pbqa0SXV10Lc60TKFtPk8E990v5bt6NasAN8L9JE1VVH1749eCTAjI' );
define( 'NONCE_SALT',       'SN2XZfn2bUxNcOh0iVApkq1ahYT8PbDMAIdioR2Anunp0Cxp18437hwIYbr8TcvZ' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
