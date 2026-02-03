<?php
header('Content-Type: text/plain');
echo "PHP Version: " . PHP_VERSION . "\n";
echo "SAPI: " . PHP_SAPI . "\n";
echo "pgsql extension loaded: " . (extension_loaded('pgsql') ? 'YES' : 'NO') . "\n";
echo "pdo_pgsql extension loaded: " . (extension_loaded('pdo_pgsql') ? 'YES' : 'NO') . "\n";

if (!function_exists('pg_connect')) {
    echo "ERROR: Function pg_connect() does NOT exist.\n";
} else {
    echo "SUCCESS: Function pg_connect() exists.\n";
}

echo "\nLoaded Extensions:\n";
print_r(get_loaded_extensions());
?>