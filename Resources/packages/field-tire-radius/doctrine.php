<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;


use BaksDev\Field\Pack\Checkbox\Type\CheckboxField;
use BaksDev\Field\Pack\Checkbox\Type\CheckboxFieldType;
use BaksDev\Field\Tire\Radius\Type\TireRadiusField;
use BaksDev\Field\Tire\Radius\Type\TireRadiusFieldType;
use Symfony\Config\DoctrineConfig;

return static function(DoctrineConfig $doctrine) {
	$doctrine->dbal()->type(TireRadiusField::TYPE)->class(TireRadiusFieldType::class);
};