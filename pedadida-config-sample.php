<?php

// ** MySQL settings - You can get this info from your web host ** //

// Type of Database Used
$pedidada_database_type = 'mysqli'; // 'pgsql', 'mysqli', 'mssql', 'sqlsrv' or 'oci'

/** The name of the database for Pedadida */
$pedadida_database_name = '';

/** MySQL database username */
$pedadida_database_username = '';

/** MySQL database password */
$pedadida_database_password = '';

/** MySQL hostname */
$pedadida_database_host = 'localhost';

/** Database Charset to use in creating database tables. */
$pedadida_database_charset = 'utf8';

/** The Database Collate type. Don't change this if in doubt. */
$pedadida_database_collate = '';

$pedadida_key1 = '';
$pedadida_key2 = '';
$pedadida_key3 = '';
$pedadida_key4 = '';
$pedadida_key5 = '';
$pedadida_key6 = '';
$pedadida_key7 = '';
$pedadida_key8 = '';

// Path to MySQL Bin
$mysql_bin_path = '/usr/bin';

// Full Domain Link with trailing slash included
$pedadida_base = 'http://example.com/';

// Base Site for Classroom
$pedadida_classroom_base = $pedadida_base . 'class';

// Now you need a place where Classroom can save uploaded files.
$pedadida_classroom_data = '/home/example/classdata';

// Base Site for Library
$pedadida_library_base = $pedadida_base . 'library';

$pedadida_library_secure = 'false'; // Using SSL for Library?

// Email Notification Address
$pedadida_email_notify = 'notify@example.com';

// Paths used in Library - Can be modified in Library Config to override these settings
$pedadida_imagemagick_path = '/usr/bin'; 
$pedadida_ffmpeg_path = '/usr/local/bin'; 
$pedadida_exiftool_path="/usr/bin";
$pedadida_antiword_path="/root/antiword";
$pedadida_ghostscript_path="/usr/bin";

// Default Language
$pedadida_language = 'en-US'; 

# To be able to run certain actions asyncronus (eg. preview transcoding), define the path to php:
 $pedadida_php_path="/usr/local/bin";

// Name of Your Pedadida Library
$pedadida_library_name = 'Library';


// Name of Your Pedadida Library Upload Folder
$pedadida_library_upload_folder = '';


?>