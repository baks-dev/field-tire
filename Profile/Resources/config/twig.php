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
	
	$config->path(__DIR__.'/../view', 'TireProfileField');
	
};




