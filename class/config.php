<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();
require_once(__DIR__.'/../pedadida-config.php');

$CFG->dbtype    = $pedidada_database_type;
$CFG->dblibrary = 'native';
$CFG->dbhost    = $pedadida_database_host;
$CFG->dbname    = $pedadida_database_name;
$CFG->dbuser    = $pedadida_database_username;
$CFG->dbpass    = $pedadida_database_password;
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbsocket' => 0,
);

$CFG->wwwroot   = $pedadida_classroom_base;
$CFG->dataroot  = $pedadida_classroom_data;
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

require_once(dirname(__FILE__) . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
