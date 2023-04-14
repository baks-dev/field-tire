<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BaksDev\Field\Pack\Integer\Choice\IntegerFieldChoice;

return static function (ContainerConfigurator $configurator) {
	
	$services = $configurator->services()
		->defaults()
		->autowire(true)
		->autoconfigure(true)
	;
	
	$namespace = 'BaksDev\Field\Tire\Euro';

    $services->load($namespace.'\Form\\', __DIR__.'/../../Form')
        ->exclude(__DIR__.'/../../Form/**/*DTO.php');
	
};

