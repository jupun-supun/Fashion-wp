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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp' );

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
define( 'AUTH_KEY',         '=7ZoPB-?wG S19`><%(N (~{ii%WT6XJOR}-x}thJ%F1c-fc1;7fy,{a?tq{,GU4' );
define( 'SECURE_AUTH_KEY',  '}MQLk^%[[-{nvJj8Q&UQDYcl/f8C)v)%8GM9BwMK^Us[3_hb<RxGVhEkMs]3:Y+q' );
define( 'LOGGED_IN_KEY',    'laG:/}g+?x*L>?T&nW,#~7R6{Iq<Uq_45&F<cQH>Y+wUSQ-dwXI/1nM (c.nGL)`' );
define( 'NONCE_KEY',        'kviIpdZJ-{^an,ND/4cx>O#/oy9@4BDw,NE^u16rBuU&X7=HQ6x}(!p)@<kkD9Ec' );
define( 'AUTH_SALT',        'i??Ol}JD@f])lmQ-F.O!IzaR6.I[2JH DF=N=ip[I~y}6*mXL*j-wLsfk>D$|)ap' );
define( 'SECURE_AUTH_SALT', 'BZnVkDgP[uZ_.8WTi>Z])41d{^*CvR %CR|zbm%(|bra9_ sH|8Z <&vQffV.eqw' );
define( 'LOGGED_IN_SALT',   'vKoIgD[s^[k0QMCbk(>6o_AV)yml+~D>y75@oaaN(kq_$Y+c]f%Xky`*X_N8Yw|A' );
define( 'NONCE_SALT',       'Z:FiAsau78V~AZ`5s0:LAi8*uYDGRE/Lu3J|XSZ7hF#n;.2W7Px^ qE=PlH$Z8FL' );

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
