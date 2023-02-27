<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BaksDev\Reference\Color\Twig\ColorExtension;
use Symfony\Config\TwigConfig;

return static function(ContainerConfigurator $configurator, TwigConfig $config) {
	$services = $configurator->services()
		->defaults()
		->autowire()
		->autoconfigure()
	;
	
//	$services->set(ColorExtension::class)
//		->class(ColorExtension::class)
//		->tag('twig.extension')
//	;
	
	$namespace = 'BaksDev\Field\Tire\Width';
	
	$services->load($namespace.'\Twig\\', __DIR__.'/../../Twig');
	
	$config->path(__DIR__.'/../view', 'TireWidthField');
	
};




