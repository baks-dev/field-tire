<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;


use BaksDev\Field\Tire\Season\Type\TireSeasonField;
use BaksDev\Field\Tire\Season\Type\TireSeasonFieldType;
use Symfony\Config\DoctrineConfig;

return static function(DoctrineConfig $doctrine) {
	$doctrine->dbal()->type(TireSeasonField::TYPE)->class(TireSeasonFieldType::class);
};