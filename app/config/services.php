<?php

use flight\Engine;
use flight\database\PdoWrapper;
use flight\debug\database\PdoQueryCapture;
use flight\debug\tracy\TracyExtensionLoader;
use Tracy\Debugger;

/*********************************************
 *         FlightPHP Service Setup           *
 *********************************************
 * This file registers services and integrations
 * for your FlightPHP application.
 *
 * @var array  $config  From config.php
 * @var Engine $app     FlightPHP app instance
 **********************************************/

/*********************************************
 *           Tracy Debugger Setup            *
 *********************************************
 * Tracy is a powerful error handler and debugger for PHP.
 * Docs: https://tracy.nette.org/
 **********************************************/
Debugger::enable(); // Auto-detects environment
Debugger::$logDirectory = __DIR__ . $ds . '..' . $ds . 'log'; // Log directory
Debugger::$strictMode = true; // Show all errors

if (Debugger::$showBar === true && php_sapi_name() !== 'cli') {
	(new TracyExtensionLoader($app)); // Load FlightPHP Tracy extensions
}

/**********************************************
 *           Database Service Setup           *
 **********************************************/
// Build DSN for MySQL
$dsn = 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['dbname'] . ';charset=' . $config['database']['charset'];

// Register Flight::db() service
// In development, use PdoQueryCapture to log queries; in production, use PdoWrapper for performance.
$pdoClass = Debugger::$showBar === true ? PdoQueryCapture::class : PdoWrapper::class;
$app->register('db', $pdoClass, [ 
	$dsn, 
	$config['database']['user'], 
	$config['database']['password'],
	[
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	]
]);

/**********************************************
 *         Session Management                 *
 **********************************************/
// Start session for authentication
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
