<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;


use BaksDev\Field\Tire\CarType\Type\TireCarTypeField;
use BaksDev\Field\Tire\CarType\Type\TireCarTypeFieldType;
use Symfony\Config\DoctrineConfig;

return static function(DoctrineConfig $doctrine) {
	$doctrine->dbal()->type(TireCarTypeField::TYPE)->class(TireCarTypeFieldType::class);
};