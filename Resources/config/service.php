<?php
/*
 *  Copyright 2024.  Baks.dev <admin@baks.dev>
 *  
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is furnished
 *  to do so, subject to the following conditions:
 *  
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *  
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BaksDev\Field\Tire\BaksDevFieldTireBundle;
use BaksDev\Field\Tire\CarType\Choice\TireCarTypeFieldChoice;
use BaksDev\Field\Tire\Euro\Choice\TireEuroFieldChoice;
use BaksDev\Field\Tire\Homologation\Choice\TireHomologationFieldChoice;
use BaksDev\Field\Tire\Profile\Choice\TireProfileFieldChoice;
use BaksDev\Field\Tire\Radius\Choice\TireRadiusFieldChoice;
use BaksDev\Field\Tire\Season\Choice\TireSeasonFieldChoice;
use BaksDev\Field\Tire\Spiky\Choice\TireSpikyFieldChoice;
use BaksDev\Field\Tire\Studs\Choice\TireStudsFieldChoice;
use BaksDev\Field\Tire\Width\Choice\TireWidthFieldChoice;

return static function (ContainerConfigurator $configurator) {

    $services = $configurator->services()
        ->defaults()
        ->autowire(true)
        ->autoconfigure(true);


    $NAMESPACE = BaksDevFieldTireBundle::NAMESPACE;
    $PATH = BaksDevFieldTireBundle::PATH;


    $services->load($NAMESPACE, $PATH)
        ->exclude([
            $PATH.'{Entity,Resources,Type}',
            $PATH.'**'.DIRECTORY_SEPARATOR.'*Message.php',
            $PATH.'**'.DIRECTORY_SEPARATOR.'*DTO.php',
            $PATH.'**'.DIRECTORY_SEPARATOR.'*Test.php',
        ]);

    //    $services
    //        ->load($NAMESPACE.'Profile\Form\\', $PATH.'Profile/Form')
    //        ->exclude($PATH.'Profile/Form/**/*DTO.php');


    //    $services->load(
    //        $NAMESPACE.'Profile\Form\\',
    //        $PATH.'Profile/Form'
    //    );

    $services->load(
        $NAMESPACE.'Profile\Type\Profile\\',
        $PATH.implode(DIRECTORY_SEPARATOR, ['Profile', 'Type', 'Profile'])
    );

    //    $services->load(
    //        $NAMESPACE.'Profile\Listeners\\',
    //        $PATH.'Profile/Listeners'
    //    );

    //    $services->load(
    //        $NAMESPACE.'Profile\Repository\\',
    //        $PATH.'Profile/Repository'
    //    );

    //    $services->load(
    //        $NAMESPACE.'Profile\Twig\\',
    //        $PATH.'Profile/Twig'
    //    );


    // Радиус
    $services->set(TireRadiusFieldChoice::class)
        ->tag('baks.fields.choice')
        ->tag('baks.reference.choice');

    // Профиль
    $services->set(TireProfileFieldChoice::class)
        ->tag('baks.fields.choice')
        ->tag('baks.reference.choice');

    // Ширина
    $services->set(TireWidthFieldChoice::class)
        ->tag('baks.fields.choice')
        ->tag('baks.reference.choice');


    // Сезон
    $services->set(TireSeasonFieldChoice::class)
        ->tag('baks.fields.choice');

    // Шипы
    $services->set(TireStudsFieldChoice::class)
        ->tag('baks.fields.choice');

    // Тип автомобиля
    $services->set(TireCarTypeFieldChoice::class)
        ->tag('baks.fields.choice');

    // Евроэтикетка шины
    $services->set(TireEuroFieldChoice::class)
        ->tag('baks.fields.choice');

    // Homologation
    $services->set(TireHomologationFieldChoice::class)
        ->tag('baks.fields.choice');
};
