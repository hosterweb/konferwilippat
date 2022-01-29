<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'konferwi_wp200' );

/** MySQL database username */
define( 'DB_USER', 'konferwi_wp200' );

/** MySQL database password */
define( 'DB_PASSWORD', '@(S323Up90' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'al12m4cevlizpqvrkdkjrjf4xlzmrvtabv2k7sdlf9pteu5wvttv60zysuc0j9ee' );
define( 'SECURE_AUTH_KEY',  '5cxwbuqtf7d12uihnszbphyrkxwf1mkgure4ne9g6knft4wt9lspq2d82gzrtydm' );
define( 'LOGGED_IN_KEY',    'iribqtdppnqrvakpobgmjqkrfzinzzrqdxbkmlbb0qf3termzacbkklb3dxfnpt3' );
define( 'NONCE_KEY',        'bcc73ofe2pjjo1stelgfcjhaztceseywmiwuy0ivpstsi5yoaxfne5ocxfilwtpn' );
define( 'AUTH_SALT',        'xjjwslu7sbjmlmvhaqpook6bhibdec4glflmtzbwufwpi7qimnfv01splwjjzken' );
define( 'SECURE_AUTH_SALT', 'yb8mqc15trewmef78ha63necalg2ypvcn5r9fanbc2eoixshs9ttg4ihh8pzbiyw' );
define( 'LOGGED_IN_SALT',   'ltddoi2pow7r6p3vry7jl1mw0amjluvmoje8s4tavpqv9emczp2goypwxd7hidsa' );
define( 'NONCE_SALT',       'j8hztihtricylusoeenzf0qjgxxuljowqbk1walciwihrxbscwryti4atih9dfv0' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpk1_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
