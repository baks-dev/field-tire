<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BaksDev\Field\Tire\CarType\Type\TireCarTypeField;
use BaksDev\Field\Tire\CarType\Type\TireCarTypeFieldType;
use BaksDev\Field\Tire\Euro\Type\TireEuroField;
use BaksDev\Field\Tire\Euro\Type\TireEuroFieldType;
use BaksDev\Field\Tire\Homologation\Type\TireHomologationField;
use BaksDev\Field\Tire\Homologation\Type\TireHomologationFieldType;
use BaksDev\Field\Tire\Profile\Type\TireProfileField;
use BaksDev\Field\Tire\Profile\Type\TireProfileFieldType;
use BaksDev\Field\Tire\Radius\Type\TireRadiusField;
use BaksDev\Field\Tire\Radius\Type\TireRadiusFieldType;
use BaksDev\Field\Tire\Season\Type\TireSeasonField;
use BaksDev\Field\Tire\Season\Type\TireSeasonFieldType;
use BaksDev\Field\Tire\Studs\Type\TireStudsField;
use BaksDev\Field\Tire\Studs\Type\TireStudsFieldType;
use BaksDev\Field\Tire\Width\Type\TireWidthField;
use BaksDev\Field\Tire\Width\Type\TireWidthFieldType;
use Symfony\Config\DoctrineConfig;

return static function (DoctrineConfig $doctrine) {

    $doctrine->dbal()->type(TireCarTypeField::TYPE)->class(TireCarTypeFieldType::class);
    $doctrine->dbal()->type(TireEuroField::TYPE)->class(TireEuroFieldType::class);
    $doctrine->dbal()->type(TireHomologationField::TYPE)->class(TireHomologationFieldType::class);
    $doctrine->dbal()->type(TireProfileField::TYPE)->class(TireProfileFieldType::class);
    $doctrine->dbal()->type(TireRadiusField::TYPE)->class(TireRadiusFieldType::class);
    $doctrine->dbal()->type(TireSeasonField::TYPE)->class(TireSeasonFieldType::class);
    $doctrine->dbal()->type(TireStudsField::TYPE)->class(TireStudsFieldType::class);
    $doctrine->dbal()->type(TireWidthField::TYPE)->class(TireWidthFieldType::class);

};
