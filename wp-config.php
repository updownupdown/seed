<?php
/**
* The base configurations of the WordPress.
*
* This file has the following configurations: MySQL settings, Table Prefix,
* Secret Keys, WordPress Language, and ABSPATH. You can find more information
* by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
* wp-config.php} Codex page. You can get the MySQL settings from your web host.
*
* This file is used by the wp-config.php creation script during the
* installation. You don't have to use the web site, you can just copy this file
* to "wp-config.php" and fill in the values.
*
* @package WordPress
*/

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', 'D:\Web\seed\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'seed');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/* LIMIT NUMBER OF REVISIONS */
define( 'WP_POST_REVISIONS', 5 );

/* DISABLE FILE EDITOR */
define( 'DISALLOW_FILE_EDIT', true );

/**#@+
* Authentication Unique Keys and Salts.
*
* Change these to different unique phrases!
* You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
* You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
*
* @since 2.6.0
*/
define('AUTH_KEY',         'iCh!=3*F7T/zR7@=x$ K)_|*`r;`sa&%msW%$uL>^2=8kA43$*EHgmB>(B$egni~');
define('SECURE_AUTH_KEY',  'oba2S3:qE~>cN-}:i7MqK8T:]*G{x;wlN<Fn<<bj6AV2NJh>|wXO&J<v{$ZXKX?}');
define('LOGGED_IN_KEY',    'K3}63y4B]`%CA=6Xho)tq.1Do/4evARpKE>Qwt`yh]Yg]vi_I>bD8[:&;JpZvQWi');
define('NONCE_KEY',        '=(^(E<2Bv$q50#./oOS`.qrTuN?[GeXuhZ|0:I2+:Z*GAvC2rh.>Be9977NvL|][');
define('AUTH_SALT',        'gN|Z4*9);Ck0+]CX ]n;{x(&Yop(f0b)_IuFIhX9ln} tg514dT)/N!;annx2Y>(');
define('SECURE_AUTH_SALT', 'QiZF`d]Hg<6yW^jP@6gL46NN-D:?XfS;HhO97I[01U(XW[`]&~MX0f~-:|[k*p?>');
define('LOGGED_IN_SALT',   ';|_mu{Oi8J+y./9B~Jz[_riesN=X^n?|?q8.o!E[kBkX. d7{J5f-7~L5?/z,Jdb');
define('NONCE_SALT',       '@uad Qf-Y +%p{g:Q[^A+$[C5KqbU%1K-8r|cy8wci?Z`%{~S*;]V]Q0Jsujij5P');

/**#@-*/

/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each a unique
* prefix. Only numbers, letters, and underscores please!
*/
$table_prefix  = 'wp_';

/**
* WordPress Localized Language, defaults to English.
*
* Change this to localize WordPress. A corresponding MO file for the chosen
* language must be installed to wp-content/languages. For example, install
* de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
* language support.
*/
define('WPLANG', '');

/**
* For developers: WordPress debugging mode.
*
* Change this to true to enable the display of notices during development.
* It is strongly recommended that plugin and theme developers use WP_DEBUG
* in their development environments.
*/
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');