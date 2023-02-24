<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BaksDev\Field\Tire\Type\TireStudsField;
use BaksDev\Field\Tire\Type\TireStudsFieldType;
use Symfony\Config\DoctrineConfig;

return static function(DoctrineConfig $doctrine) {
	$doctrine->dbal()->type(TireStudsField::TYPE)->class(TireStudsFieldType::class);
};