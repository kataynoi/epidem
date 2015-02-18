<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
//$db['default']['hostname'] = '192.168.10.7';
//$db['default']['hostname'] = '203.157.185.7';
/*$db['default']['username'] = 'root';
$db['default']['password'] = '1234';*/
$db['default']['username'] = 'bancha';
$db['default']['password'] = 'bancha431097789++';
$db['default']['database'] = 'p_epidem';
$db['default']['port'] = 3307;
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

$db['user']['hostname'] = 'localhost';
//$db['user']['hostname'] = '192.168.10.7';
//$db['user']['hostname'] = '203.157.185.7';
/*$db['user']['username'] = 'root';
$db['user']['password'] = '1234';*/
$db['user']['username'] = 'bancha';
$db['user']['password'] = 'bancha431097789++';
$db['user']['database'] = 'p_usercenter';
$db['user']['port'] = 3307;
$db['user']['dbdriver'] = 'mysql';
$db['user']['dbprefix'] = '';
$db['user']['pconnect'] = FALSE;
$db['user']['db_debug'] = TRUE;
$db['user']['cache_on'] = FALSE;
$db['user']['cachedir'] = '';
$db['user']['char_set'] = 'utf8';
$db['user']['dbcollat'] = 'utf8_general_ci';
$db['user']['swap_pre'] = '';
$db['user']['autoinit'] = TRUE;
$db['user']['stricton'] = FALSE;
/* End of file database.php */
/* Location: ./application/config/database.php */
/*
$db['hdc']['hostname'] = '192.168.10.18';
$db['hdc']['username'] = 'thait-rex';
$db['hdc']['password'] = '123456';
$db['hdc']['database'] = 'hdc';
$db['hdc']['dbdriver'] = 'mysql';
$db['hdc']['dbprefix'] = '';
$db['hdc']['pconnect'] = TRUE;
$db['hdc']['db_debug'] = TRUE;
$db['hdc']['cache_on'] = FALSE;
$db['hdc']['cachedir'] = '';
$db['hdc']['char_set'] = 'utf8';
$db['hdc']['dbcollat'] = 'utf8_general_ci';
$db['hdc']['swap_pre'] = '';
$db['hdc']['autoinit'] = TRUE;
$db['hdc']['stricton'] = FALSE;*/