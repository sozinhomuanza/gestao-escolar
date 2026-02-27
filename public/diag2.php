<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
echo '<pre>';
print_r(scandir(__DIR__));
echo '</pre>';
echo '<hr>';
echo '<pre>';
print_r(scandir(dirname(__DIR__)));
echo '</pre>';
