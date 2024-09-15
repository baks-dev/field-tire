<?php
/*
 * This file is part of the FreshCentrifugoBundle.
 *
 * (c) Artem Henvald <genvaldartem@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BaksDev\Field\Tire;

use BaksDev\Field\Tire\CarType\Choice\TireCarTypeFieldChoice;
use BaksDev\Field\Tire\Euro\Choice\TireEuroFieldChoice;
use BaksDev\Field\Tire\Homologation\Choice\TireHomologationFieldChoice;
use BaksDev\Field\Tire\Profile\Choice\TireProfileFieldChoice;
use BaksDev\Field\Tire\Radius\Choice\TireRadiusFieldChoice;
use BaksDev\Field\Tire\Season\Choice\TireSeasonFieldChoice;
use BaksDev\Field\Tire\Studs\Choice\TireStudsFieldChoice;
use BaksDev\Field\Tire\Width\Choice\TireWidthFieldChoice;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class BaksDevFieldTireBundle extends AbstractBundle
{
    public const NAMESPACE = __NAMESPACE__.'\\';

    public const PATH = __DIR__.DIRECTORY_SEPARATOR;

//    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
//    {
//        $services = $container->services()
//            ->defaults()
//            ->autowire()
//            ->autoconfigure();
//
//
//        $services->load(self::NAMESPACE.'CarType\Twig\\', self::PATH.'CarType/Twig');
//        $services
//            ->load(self::NAMESPACE.'CarType\Form\\', self::PATH.'CarType/Form')
//            ->exclude(self::PATH.'CarType/Form/**/*DTO.php');
//
//
//        $services->load(self::NAMESPACE.'Euro\Twig\\', self::PATH.'Euro/Twig');
//        $services
//            ->load(self::NAMESPACE.'Euro\Form\\', self::PATH.'Euro/Form')
//            ->exclude(self::PATH.'Euro/Form/**/*DTO.php');
//
//
//        $services->load(self::NAMESPACE.'Homologation\Type\Choice\\', self::PATH.'Homologation/Type/Choice');
//        $services->load(self::NAMESPACE.'Homologation\Listeners\\', self::PATH.'Homologation/Listeners');
//        $services->load(self::NAMESPACE.'Homologation\Twig\\', self::PATH.'Homologation/Twig');
//        $services
//            ->load(self::NAMESPACE.'Homologation\Form\\', self::PATH.'Homologation/Form')
//            ->exclude(self::PATH.'Homologation/Form/**/*DTO.php');
//
//
//        $services->load(self::NAMESPACE.'Profile\Type\Profile\\', self::PATH.'Profile/Type/Profile');
//        $services->load(self::NAMESPACE.'Profile\Listeners\\', self::PATH.'Profile/Listeners');
//        $services->load(self::NAMESPACE.'Profile\Repository\\', self::PATH.'Profile/Repository');
//        $services->load(self::NAMESPACE.'Profile\Twig\\', self::PATH.'Profile/Twig');
//        $services
//            ->load(self::NAMESPACE.'Profile\Form\\', self::PATH.'Profile/Form')
//            ->exclude(self::PATH.'Profile/Form/**/*DTO.php');
//
//
//        $services->load(self::NAMESPACE.'Radius\Type\Radius\\', self::PATH.'Radius/Type/Radius');
//        $services->load(self::NAMESPACE.'Radius\Listeners\\', self::PATH.'Radius/Listeners');
//        $services->load(self::NAMESPACE.'Radius\Repository\\', self::PATH.'Radius/Repository');
//        $services->load(self::NAMESPACE.'Radius\Twig\\', self::PATH.'Radius/Twig');
//        $services
//            ->load(self::NAMESPACE.'Radius\Form\\', self::PATH.'Radius/Form')
//            ->exclude(self::PATH.'Radius/Form/**/*DTO.php');
//
//
//        $services->load(self::NAMESPACE.'Season\Twig\\', self::PATH.'Season/Twig');
//        $services
//            ->load(self::NAMESPACE.'Season\Form\\', self::PATH.'Season/Form')
//            ->exclude(self::PATH.'Season/Form/**/*DTO.php');
//
//
//        $services->load(self::NAMESPACE.'Studs\Twig\\', self::PATH.'Studs/Twig');
//        $services
//            ->load(self::NAMESPACE.'Studs\Form\\', self::PATH.'Studs/Form')
//            ->exclude(self::PATH.'Studs/Form/**/*DTO.php');
//
//
//        $services->load(self::NAMESPACE.'Width\Type\Width\\', self::PATH.'Width/Type/Width');
//        $services->load(self::NAMESPACE.'Width\Listeners\\', self::PATH.'Width/Listeners');
//        $services->load(self::NAMESPACE.'Width\Repository\\', self::PATH.'Width/Repository');
//        $services->load(self::NAMESPACE.'Width\Twig\\', self::PATH.'Width/Twig');
//        $services
//            ->load(self::NAMESPACE.'Width\Form\\', self::PATH.'Width/Form')
//            ->exclude(self::PATH.'Width/Form/**/*DTO.php');
//
//
//        // Радиус
//        $services->set(TireRadiusFieldChoice::class)
//            ->tag('baks.fields.choice')
//            ->tag('baks.reference.choice');
//
//        // Профиль
//        $services->set(TireProfileFieldChoice::class)
//            ->tag('baks.fields.choice')
//            ->tag('baks.reference.choice');
//
//        // Ширина
//        $services->set(TireWidthFieldChoice::class)
//            ->tag('baks.fields.choice')
//            ->tag('baks.reference.choice');
//
//        // Сезон
//        $services->set(TireSeasonFieldChoice::class)
//            ->tag('baks.fields.choice');
//
//        // Шипы
//        $services->set(TireStudsFieldChoice::class)
//            ->tag('baks.fields.choice');
//
//        // Тип автомобиля
//        $services->set(TireCarTypeFieldChoice::class)
//            ->tag('baks.fields.choice');
//
//        // Евроэтикетка шины
//        $services->set(TireEuroFieldChoice::class)
//            ->tag('baks.fields.choice');
//
//        // Homologation
//        $services->set(TireHomologationFieldChoice::class)
//            ->tag('baks.fields.choice')
//            ->tag('baks.reference.choice');
//
//
//    }

}
