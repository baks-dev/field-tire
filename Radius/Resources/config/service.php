<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BaksDev\Field\Pack\Integer\Choice\IntegerFieldChoice;

return static function (ContainerConfigurator $configurator) {
	
	$services = $configurator->services()
		->defaults()
		->autowire(true)
		->autoconfigure(true)
	;
	
	$namespace = 'BaksDev\Field\Tire\Radius';

	$services->load($namespace.'\Form\\', __DIR__.'/../../Form');
    $services->load($namespace.'\Type\Radius\\', __DIR__.'/../../Type/Radius');
    $services->load($namespace.'\Listeners\\', __DIR__.'/../../Listeners');
    $services->load($namespace.'\Repository\\', __DIR__.'/../../Repository');


};

