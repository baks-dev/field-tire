<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;


return static function (ContainerConfigurator $configurator) {
	
	$services = $configurator->services()
		->defaults()
		->autowire(true)
		->autoconfigure(true)
	;
	
	$namespace = 'BaksDev\Field\Tire\Width';
	
	$services->load($namespace.'\Form\\', __DIR__.'/../../Form');
	$services->load($namespace.'\Type\Width\\', __DIR__.'/../../Type/Width');
	$services->load($namespace.'\Listeners\\', __DIR__.'/../../Listeners');
	$services->load($namespace.'\Repository\\', __DIR__.'/../../Repository');

};

