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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '(5TQ#vp2GuXS,j51L~aTSF)lHV79G|hf2%}U<@C;7,>/cy{4NetOzH;ic?baC>;=' );
define( 'SECURE_AUTH_KEY',   '_h8%D:+&33Xub`,Ir1.j5BvZQCuU^/6LhySkMYwBNjWt%y_D*zO`R nwHSBNcd/}' );
define( 'LOGGED_IN_KEY',     'EH>=2F5%)5KB^h}v1xzAKY;uL_>Z@GzOn&8ECqH:w3.3SEy&>>vK:K@&x$oc@|22' );
define( 'NONCE_KEY',         'J8<#98URN 3IO:MWGm(0.{4l?Mg0>1yS_]]Oa|c=+~fu&82A7P6?7j]O^02D|4_v' );
define( 'AUTH_SALT',         '6|qjiPWCE6@4^c?F~Q{T9MD]{wvS`EiJVUlV2fXw5B>!c#6Z8Y7<^?(4Sack&u<U' );
define( 'SECURE_AUTH_SALT',  '>c5x6`3IhIhJdBEBRk@jW.AoEZD8X`57VDCK|4]XJ<Gcht6){&BUL`z6 (lv1[|i' );
define( 'LOGGED_IN_SALT',    ';0<Q%$GB,lzU5E.lre=A~yMN<$XFMMUHGce8yp4GuA&W]cn~0cD/WB1NJE[)hr8v' );
define( 'NONCE_SALT',        '7<Q2zRGyS3hT dnroS[Ef]KqwJH!y<KBHZSbiEP7,KK6gtaLJx>BUG[uvZ:yPDT{' );
define( 'WP_CACHE_KEY_SALT', 'p(6C-|Lx.v0508Q07Yl)]F{el%4ky1D,ZqEeIY:P{pz4S&u|Zh-Ioh^*C{CHbbS?' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
