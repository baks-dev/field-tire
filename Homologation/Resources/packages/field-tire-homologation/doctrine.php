<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;


use BaksDev\Field\Tire\Homologation\Type\TireHomologationField;
use BaksDev\Field\Tire\Homologation\Type\TireHomologationFieldType;
use Symfony\Config\DoctrineConfig;

return static function(DoctrineConfig $doctrine) {
	$doctrine->dbal()->type(TireHomologationField::TYPE)->class(TireHomologationFieldType::class);
};