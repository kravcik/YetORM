<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/yetorm.php';
require_once __DIR__ . '/model/ServiceLocator.php';

Tester\Environment::setup();
date_default_timezone_set('UTC');

function test(\Closure $function) { $function(); }
function dd() { call_user_func_array('dump', func_get_args()); die(); }

Tester\Environment::lock('yetorm', __DIR__ . '/temp');

ServiceLocator::getCacheStorage()->clean([
	Nette\Caching\Cache::ALL => TRUE,
]);

$loader = new Nette\Loaders\RobotLoader;
$loader->setTempDirectory(ServiceLocator::getTempDir());
$loader->addDirectory(__DIR__ . '/model');
$loader->register();
