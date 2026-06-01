<?php
session_start();
header('Content-Type: text/plain; charset=utf-8');

echo "=== SESSION DEBUG ===\n";
echo "Session ID: " . session_id() . "\n";
echo "\n";
print_r($_SESSION);
echo "\nCOOKIES:\n";
print_r($_COOKIE);

echo "\n=== END ===\n";
