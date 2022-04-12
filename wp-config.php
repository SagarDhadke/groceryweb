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
define( 'DB_NAME', 'groceryweb_db' );

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
define( 'AUTH_KEY',         'q9sA<TP?nx1SR_@mg)n~oe@S+=t8z:9NqQb5(kQhdc/i6Z2tWdC?.<-^s<,FbP]g' );
define( 'SECURE_AUTH_KEY',  '[K?W]~cz/D#Yr&D5f5zDZ_$$^}jtAqRrnb|}q3! ?c%j.8,,F;%2m^]BeYd&jMeD' );
define( 'LOGGED_IN_KEY',    'v+r3)nkwC8KBn`Xwc</6BZZ/k(6gi|5J/Hzli6Ylm6olhfd2rjqMY5]v`.ca>:6_' );
define( 'NONCE_KEY',        'x6)PU/%-%jpD [.<M;YVbtL38RI.Bq$6=lX&Ivat~T{+dfg#ynp),J>P^>%e*s@h' );
define( 'AUTH_SALT',        'W[;=61e{HMUDDPq?^3RAlwhL=0;0ZT=(qS3WtMuej`4]xsQHszpgi_IzD{kJR3_T' );
define( 'SECURE_AUTH_SALT', 'Kls~#ve9d92GlG} +>0eO&^Qhh:UKQb)_s2<yoW44*G?+]aKS[3:oc.~;@w~TR:U' );
define( 'LOGGED_IN_SALT',   'uZ*ifCI^Hkig}fv@Y<o %R(l;Q]]R.C:yB.Lzt0$m(A5775}+w0RO%s+G;AZI%h{' );
define( 'NONCE_SALT',       'S1]5tK!B:GyH4e8EaE@Fw6>*W6WJuvS`)Os$oFrM4n2,T[VEn=5TrP<NuZd5@hmT' );

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
