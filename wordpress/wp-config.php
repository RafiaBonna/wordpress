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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
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
define( 'AUTH_KEY',         'F/Q(*`XF>K9F=3zut<Q10WF_:;Thh7M$o]/$DnWYib,`s}!1v P4U/(xoJ%5NY3I' );
define( 'SECURE_AUTH_KEY',  '*3I2[eT6O(0~&hC?s<k ,fL%Q6c1Y2.Zz*k2T0Ec,[}H4@ffX nrk/p37^fFNh-@' );
define( 'LOGGED_IN_KEY',    '`W$kwh4_i0l%zpaB!5xkSig:*Uk+{D5EP-A[mUJ0kcw8y. ?Lat<Co lWAdOX_5i' );
define( 'NONCE_KEY',        'hNN$t;^*-C},3j0IoW@fvD1PsO]CNX=Y&[fX3-+!nQq-CRdSM!UNAS1guU92#_J}' );
define( 'AUTH_SALT',        'PEx&G`=yr6 Tc@,J:k6JZ|M|zD VXmrTj7%[l>1}NX$aC(7z<(.GnDf#Vz<M!&Wp' );
define( 'SECURE_AUTH_SALT', 'ny/$*(}G?+-I#TXmd,:AMHuG>%= `RFG$@.2=Wx=(]NNV,xkXPoPOLjkv`pvvf^q' );
define( 'LOGGED_IN_SALT',   'V29B%X`4wU%A,`[9-DL/>a/r39c;1-hJf,H4!Q(/7iYPGOD9Y}X->i0UeMeluY.I' );
define( 'NONCE_SALT',       'E7/vg;2*$f7g.-B*Ygl+!:>g[7L U<.?BzoIylnoXZZb*mZ(cF8Ad5&3I7yD-M*h' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
