<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;


return static function (ContainerConfigurator $configurator) {
	
	$services = $configurator->services()
		->defaults()
		->autowire(true)
		->autoconfigure(true)
	;
	
	$namespace = 'BaksDev\Field\Tire\Width';
	
	$services->load($namespace.'\Form\\', __DIR__.'/../../Form')
		//->exclude(__DIR__.'/../../Repository/**/*DTO.php')
	;
	
};

