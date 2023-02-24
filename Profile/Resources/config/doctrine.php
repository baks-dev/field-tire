<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;


use BaksDev\Field\Pack\Checkbox\Type\CheckboxField;
use BaksDev\Field\Pack\Checkbox\Type\CheckboxFieldType;
use BaksDev\Field\Tire\Profile\Type\TireProfileField;
use BaksDev\Field\Tire\Profile\Type\TireProfileFieldType;
use Symfony\Config\DoctrineConfig;

return static function(DoctrineConfig $doctrine) {
	$doctrine->dbal()->type(TireProfileField::TYPE)->class(TireProfileFieldType::class);
};