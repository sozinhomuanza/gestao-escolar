<?php
// Suprimir warnings antes de qualquer output
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */
// Ensure the current directory is pointing to the front controller's directory
chdir(__DIR__);

// Load our paths config file
$pathsConfig = FCPATH . '../app/Config/Paths.php';
require realpath($pathsConfig) ?: $pathsConfig;
$paths = new Config\Paths();

// Location of the framework bootstrap file.
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
$app       = require realpath($bootstrap) ?: $bootstrap;

/*
 *---------------------------------------------------------------
 * LAUNCH THE APPLICATION
 *---------------------------------------------------------------
 */
$app->run();
