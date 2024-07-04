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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '2/<YfO^)z?KD1vLSEj.^v&hukXZsTRMn`7T6* )2fC>/E}_>V`[EDUT,IV;:8iw$' );
define( 'SECURE_AUTH_KEY',  'D:>/)(#ulY>]nX{zsFy#bGMnLK}`IhG$OCJD;Ek)n,:$%y3{e!JY19Hk]3>e;?4+' );
define( 'LOGGED_IN_KEY',    'o!(PdJ&qL;xzH5-.X7C{I2^]1nNGQI*i4Jq.l:O`7|nE87$(=y!B02]tc_+;>6P@' );
define( 'NONCE_KEY',        'k8kdK~v3X;l)&dsyR?p-f7b9F[g5?-0Wf!F~BuU}:^7Dv?n,~;PT+EDP;J1+7=jB' );
define( 'AUTH_SALT',        'CICfNr2%<v%{%n=4bq6Z:I:bV/e1*l&F>nR%TZ-Lpr*wc7BZru20vUs~r>HW-%[K' );
define( 'SECURE_AUTH_SALT', 'L_|oj)crHe#Y*56thOxRdp>WmoOr+j%7x6Gi7W0im,y:u*YAx4PW_/`*!>+Gg@&H' );
define( 'LOGGED_IN_SALT',   'L6R?q+aE.k!{UQVGgWQ7{*QY|Mh?M+JGr-x@(J`DbEzZ1#Q39P@m}`3 >V|=^6hG' );
define( 'NONCE_SALT',       '{(KA0<8QcYjM#v_fBPw[~=reY[>W,Y!R?Y@Fgd*^$LOu~F{IW$()K[Pm6Y,(T+s,' );

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
