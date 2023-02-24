<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BaksDev\Field\Tire\Width\Type\TireWidthField;
use BaksDev\Field\Tire\Width\Type\TireWidthFieldType;
use Symfony\Config\DoctrineConfig;

return static function(DoctrineConfig $doctrine) {
	$doctrine->dbal()->type(TireWidthField::TYPE)->class(TireWidthFieldType::class);
};