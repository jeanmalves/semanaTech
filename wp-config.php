<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('DB_NAME', 'st2015');
define('DB_NAME', 'st1br');

/** MySQL database username */
//define('DB_USER', 'st2015adm');
define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', 'st2015@utfpr');
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'wqqwben06kvgrkkfs366oobgapw9zxegi7xjtwjc8foybci4wjycc17tnwrh97ld');
define('SECURE_AUTH_KEY',  'u6mhnzd49zogoqorknqsvbxp4o4ultf5eady3hu0zn4lv901gyv1rltxf389aexf');
define('LOGGED_IN_KEY',    'pusbmhiz0sc0rpivnvxer9lkvnpibu6jjbmjsxa5mayuzuplmk7ogxipdejj3nv0');
define('NONCE_KEY',        'ijyb6xgus1b9x1in7be1gh316wh7e9jjkqtevzgljbnjh2hyovia5dkjwjyzwdbc');
define('AUTH_SALT',        'vqoahmhcfruzbxxna2xlh8b0ytpmfdzydi9n4n6tslu1qvxchneyv5ng0pvvxq93');
define('SECURE_AUTH_SALT', 'ahj2dxzwlozdcqigfxgoustnmgvqrcxsxsf7n9zocm6vp18p7wykfcpqeh7idjsk');
define('LOGGED_IN_SALT',   'ncu5wpyhvhy8ly6o32ahpfjs1g0pxjwneddknarcyowdcsp2mivwa3z6jzatpqe9');
define('NONCE_SALT',       'ifujmubzlmnlrstzaaz78uqx23pcnj7edrnybukjsxvkmqqd8oush2xlcxi73xl0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
