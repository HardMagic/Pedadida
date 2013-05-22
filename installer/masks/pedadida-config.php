<?php

// ** MySQL settings  - You can get this info from your web host ** //

// Type of Database Used
$pedidada_database_type = '{database_type}'; // 'pgsql', 'mysqli', 'mssql', 'sqlsrv' or 'oci'

/** The name of the database for Pedadida */
$pedadida_database_name = '{database}';

/** MySQL database username */
$pedadida_database_username = '{username}';

/** MySQL database password */
$pedadida_database_password = '{password}';

/** MySQL hostname */
$pedadida_database_host = '{hostname}';

/** Database Charset to use in creating database tables. */
$pedadida_database_charset = '{charset}';

/** The Database Collate type. Don't change this if in doubt. */
$pedadida_database_collate = '{collate}';

/** Optional Prefix for all Database Tables **/
$pedadida_database_prefix    = '{dbprefix}'; 

/** Database Port - Usually works to leave blank **/
$pedadida_database_port     = '{dbport}'; 

/** Database Port - Usually works to leave blank **/
$pedadida_server_ip    = '{server_ip}'; 

/** MORE SETTINGS YOU CAN CUSTOMIZE **/

// Set Your Time Zone **/
$pedadida_time_zone = '{timezone}';

// Want to set when system was installed?
$date_installed = '{datenow}';

$pedadida_key1 = '{key1}';
$pedadida_key2 = '{key2}';
$pedadida_key3 = '{key3}';
$pedadida_key4 = '{key4}';
$pedadida_key5 = '{key5}';
$pedadida_key6 = '{key6}';
$pedadida_key7 = '{key7}';
$pedadida_key8 = '{key8}';

// Path to MySQL Bin
$mysql_bin_path = '{bin_path}';

// Full Domain Link with trailing slash included
$pedadida_base = '{web_address}';

// Name for Lab
$pedadida_university_name = '{university_name}';

// Base Site for Lab
$pedadida_lab_base = 'http://'.$pedadida_base . '/lab';

// Files Directory for Lab
$pedadida_lab_storage = '{lab_storage}';

// Name for Lab
$pedadida_lab_name = '{lab_name}';

// Base Site for Classroom
$pedadida_classroom_base = 'http://'.$pedadida_base . '/class';

// Now you need a place where Classroom can save uploaded files.
$pedadida_classroom_data = '{classroom_data}';

// Name for Classroom
$pedadida_classroom_name= '{class_name}';

// Base Site for Library
$pedadida_library_base = 'http://'.$pedadida_base . '/library';

$pedadida_library_secure = '{library_secure}'; // Using SSL for Library?

// Email Notification Address
$pedadida_email_notify = '{email_notify}';

// Paths used in Library - Can be modified in Library Config to override these settings
$pedadida_imagemagick_path = '{imagemagick_path}'; 
$pedadida_ffmpeg_path = '{ffmpeg_path}'; 
$pedadida_exiftool_path='{exiftool_path}';
$pedadida_antiword_path='{antiword_path}';
$pedadida_ghostscript_path='{ghostscript_path}';

// Default Language
$pedadida_language = '{language}'; 

# To be able to run certain actions asyncronus (eg. preview transcoding), define the path to php:
 $pedadida_php_path="/usr/local/bin";

// Name of Your Pedadida Library
$pedadida_library_name = '{library_name}';




?>