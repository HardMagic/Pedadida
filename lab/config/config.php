<?php
 
    require_once('/../../pedadida-config.php');
  define('DB_ADAPTER', 'mysql'); 
  define('DB_HOST', $pedadida_database_host); 
  define('DB_USER', $pedadida_database_username); 
  define('DB_PASS', $pedadida_database_password); 
  define('DB_NAME', $pedadida_database_name); 
  define('DB_PERSIST', true); 
  define('TABLE_PREFIX', 'fo_'); 
  define('DB_ENGINE', 'InnoDB'); 
  define('ROOT_URL', $pedadida_lab_base); 
  define('DEFAULT_LOCALIZATION', 'en_us'); 
  define('COOKIE_PATH', '/'); 
  define('DEBUG', false); 
  define('SEED', '82f21a752847e73589a51b4b7086c425'); 
  define('DB_CHARSET', 'utf8'); 
  return true;
?>