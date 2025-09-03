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
define( 'AUTH_KEY',         '37oTdXT|nj323g5W@J_R% |k^lgmX3s1Ga4LsLEf,WF|Hr eaUC{1gVqi-Xlc++m' );
define( 'SECURE_AUTH_KEY',  'Ua[m+%*)bEy>$#fEK8UE$r?tm>8~6;r+O[o34e>=N[&Bl4EapFn1=_0lD,1B Yh4' );
define( 'LOGGED_IN_KEY',    'ke8DH>6Va!9N8519@N%Qv>K?n0j]X(5QXf?7;WgTaSu[iW!fcDMx,u?Ve(QaaE%9' );
define( 'NONCE_KEY',        'YB_XArjqA1M-:F$V9jXZ6M!1Us pD536!zw|F]iVm%:J^!:15j9W)M-t>Q^zOC~T' );
define( 'AUTH_SALT',        'Y!m`;Y^>&GASa>dd9iu6PQz)Gt%LMqRT^/VT=wCkRA2#XI{4@[7kZRJdae?yR]OX' );
define( 'SECURE_AUTH_SALT', 'COu=]uH*BzK_~<7rZ7030?RF &W-c~5W84pYQc<KUzSovZ`b0hOg_cKLBn0H$2a/' );
define( 'LOGGED_IN_SALT',   'C@.*Z8Q&g 79b6H{N?y*G6jN&n}96ft=uII5sN.3=f#^/#f-PZfLC)12:$qoiK,a' );
define( 'NONCE_SALT',       'KETN?9 =i8r uk>TV^g6oeLPz6:/_;N)#XLq@2]nD-4=3H}s|VohX3:vE$Ih+[;S' );

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
