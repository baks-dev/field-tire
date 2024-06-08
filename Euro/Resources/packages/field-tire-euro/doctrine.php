<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BaksDev\Field\Tire\Euro\Type\TireEuroField;
use BaksDev\Field\Tire\Euro\Type\TireEuroFieldType;
use Symfony\Config\DoctrineConfig;

return static function(DoctrineConfig $doctrine) {
	$doctrine->dbal()->type(TireEuroField::TYPE)->class(TireEuroFieldType::class);
};