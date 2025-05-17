<?php

// Tampilkan konfigurasi database
$database_config = include (__DIR__ . '/config/database.php');
echo "PostgreSQL config: \n";
print_r($database_config['connections']['pgsql']);

// Cek apakah 'options' tidak berupa array
if (isset($database_config['connections']['pgsql']['options']) &&
    !is_array($database_config['connections']['pgsql']['options'])) {
  echo "\nPROBLEM FOUND: 'options' is not an array, it's a: "
    . gettype($database_config['connections']['pgsql']['options']) . "\n";
  echo 'Value: ' . $database_config['connections']['pgsql']['options'] . "\n";
}

echo "\nEnvironment variables:\n";
print_r($_ENV);
