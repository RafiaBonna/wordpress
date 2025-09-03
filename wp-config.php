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
define( 'AUTH_KEY',         'Rc(,C9NyfKwP>qc(_hmhNB_I~B{WXH5&`OX;V+cjyxN>S(%GF7|tLg}Y;mOm]0tu' );
define( 'SECURE_AUTH_KEY',  '.;eMiH8MPFAaTKX=v^xA_CxzS9RYlpc/US_zT$mn<VfRKMPx.] ,viSUjKk^Y}Jx' );
define( 'LOGGED_IN_KEY',    'y#(V?]}yt$(nNvzp=Rqg9Eo9}2B-Cns]gl7?!)-1]{AWQ./G4q,+12#&0vj(>K=Y' );
define( 'NONCE_KEY',        'j|<Ss0{llMvP<7JwU;^BobI1v-x9v<SWm!5EyLyuakunA.{@#jL}oLLz|.{`Y8__' );
define( 'AUTH_SALT',        '87!zH92>}F^}5QQEy[k=e`W>@vV}<Ca:]fR=(h7_u~J3s4;pm=uRx_T6C}ELrx:t' );
define( 'SECURE_AUTH_SALT', 'RbpY&sae%`9{0)G#_[lQ!Ioo?3]N|lL7f(eWBeGrzM{k^DQ{DY$4jG.U;)nY5uJ@' );
define( 'LOGGED_IN_SALT',   'tW,4H`|,S^M+HrfNbU.v~s# Zrnm@5xv+zZ`VDx1*LhBvVqZ W} /Y6TgBU)+PPh' );
define( 'NONCE_SALT',       '-Hpkye x9``rL.~2WdJ[0~@3I1s6$l<dLOTM*l#HvIQ^jh9SAA4ezOv>H`b9TTk/' );

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
