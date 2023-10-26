<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BaksDev\Field\Pack\Integer\Choice\IntegerFieldChoice;

return static function (ContainerConfigurator $configurator) {
	
	$services = $configurator->services()
		->defaults()
		->autowire(true)
		->autoconfigure(true)
	;
	
	$namespace = 'BaksDev\Field\Tire\Profile';
	
	$services->load($namespace.'\Form\\', __DIR__.'/../../Form');
	$services->load($namespace.'\Type\Profile\\', __DIR__.'/../../Type/Profile');
	$services->load($namespace.'\Listeners\\', __DIR__.'/../../Listeners');

};

