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
define( 'DB_NAME', 'demolys' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'T/0lShmEm:}3`SB$)MoT~(R^qP{*R?ZI1}HpSHXy,H(E%YR=(7Ns-8)bg{qVRZ]c' );
define( 'SECURE_AUTH_KEY',  '`s>L!35{J2&?6ZF1(ug{qU}kQtB)T!3Q4SW^{+k2voSzuhjo[03M6|l!HFs@UJy!' );
define( 'LOGGED_IN_KEY',    '0dP%}Pv_v=jKA X3|13AJ])*>afPj f??9 CK%wI&R%U5RO|--xB6@S.=L?U?E!B' );
define( 'NONCE_KEY',        '+E*dV&HY&+_7AreL=1L<w.kjR&BVJoO!PjQF~0pY^Pnj6PqN}f1.5Lh6)ni9B#89' );
define( 'AUTH_SALT',        '+{K:2uQL%f4tkvSY^j1_J?/)K;_r79X8x5`7LV!<2TaFS`@zb{Z5OFei6GLz%-Q}' );
define( 'SECURE_AUTH_SALT', '<+g#V`#wuxl*/9I(r34mN@f^EK3/sLV(B:44?h1ER;P6{{6L]6ee^$~RLVm0O+h ' );
define( 'LOGGED_IN_SALT',   '(nY#$vYAxCU(WlL|+G/ADq8$sn|ff+QB7[iaxYl99~IS{XRNEMB(]U{6IPG{YyyA' );
define( 'NONCE_SALT',       'CtX4jebD2wv$KW~+8G/sj+^3U.C): ]9l[|9q/j{r$bvJH@:DjCDB)<2k=D.WgoW' );

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
