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
define('DB_NAME', 'WellToldFilm');

/** MySQL database username */
define('DB_USER', 'Dan');

/** MySQL database password */
define('DB_PASSWORD', 'Iwbot27th');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'EiGEE_L+Ykz.nwaNVTEDbJwj;v}Y%I{^(b% ih5a.tsITgeA }]&@Yby{~V{T~1r');
define('SECURE_AUTH_KEY',  '(t/-j K 1>0p[]uX6(}#.]r_@$pj1pfTEp`m@N!ET9575ug@-Q.Urp),b __M%|f');
define('LOGGED_IN_KEY',    'B?GUuQcK;MDEM(5(-5]|d1*HeTT8i}/1z(8^6X&phm9(2}^2Jz~*I[b4mta%o=%!');
define('NONCE_KEY',        'Rifm.n*coy&H~qUWWHV3VeOn,n~m1kn|^+j`+<gH(b];MMYWpIgYyYv {bAi)X{s');
define('AUTH_SALT',        'x6N^d0A:+UIG,{iT _qo 7!1_]?>LITwQjILLd-!9aa_+Z<wL-i}P>Y+[YnU>q3&');
define('SECURE_AUTH_SALT', '<_8wKd`x:pi1m}?.U(NtPV{V8<s(dA9q-]{}]flp:0-hBMmJ*5{V+c#]a@eR)>6U');
define('LOGGED_IN_SALT',   'C~@ZUS<[Q)c$w>q5 MMK5ShQy`mQwo[B[$I%_CrPkk2irfa7h8b2ggaal_$AbX/+');
define('NONCE_SALT',       'sM(XBNa:GC e![*-XayspD6l?K)+{ECg6tWvZ(d*GJIt|Xx}&!8|ZI3a4U}aljjb');

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
