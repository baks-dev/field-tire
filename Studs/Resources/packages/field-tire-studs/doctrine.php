<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BaksDev\Field\Tire\Studs\Type\TireStudsField;
use BaksDev\Field\Tire\Studs\Type\TireStudsFieldType;
use Symfony\Config\DoctrineConfig;

return static function(DoctrineConfig $doctrine) {
	$doctrine->dbal()->type(TireStudsField::TYPE)->class(TireStudsFieldType::class);
};