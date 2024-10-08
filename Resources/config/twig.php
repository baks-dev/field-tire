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
use Symfony\Config\TwigConfig;

return static function (TwigConfig $twig) {

    $twig->path(
        BaksDevFieldTireBundle::PATH.implode(DIRECTORY_SEPARATOR, ['CarType', 'Resources', 'view', '']), // .'CarType/Resources/view',
        'field-tire-cartype'
    );

    $twig->path(
        BaksDevFieldTireBundle::PATH.implode(DIRECTORY_SEPARATOR, ['Euro', 'Resources', 'view', '']), //.'Euro/Resources/view',
        'field-tire-euro'
    );

    $twig->path(
        BaksDevFieldTireBundle::PATH.implode(DIRECTORY_SEPARATOR, ['Homologation', 'Resources', 'view', '']), // .'Homologation/Resources/view',
        'field-tire-homologation'
    );

    $twig->path(
        BaksDevFieldTireBundle::PATH.implode(DIRECTORY_SEPARATOR, ['Profile', 'Resources', 'view', '']), //  .'Profile/Resources/view',
        'field-tire-profile'
    );

    $twig->path(
        BaksDevFieldTireBundle::PATH.implode(DIRECTORY_SEPARATOR, ['Radius', 'Resources', 'view', '']), // .'Radius/Resources/view',
        'field-tire-radius'
    );

    $twig->path(
        BaksDevFieldTireBundle::PATH.implode(DIRECTORY_SEPARATOR, ['Season', 'Resources', 'view', '']), //  .'Season/Resources/view',
        'field-tire-season'
    );

    $twig->path(
        BaksDevFieldTireBundle::PATH.implode(DIRECTORY_SEPARATOR, ['Studs', 'Resources', 'view', '']), //  .'Studs/Resources/view',
        'field-tire-studs'
    );

    $twig->path(
        BaksDevFieldTireBundle::PATH.implode(DIRECTORY_SEPARATOR, ['Width', 'Resources', 'view', '']), //  .'Width/Resources/view',
        'field-tire-width'
    );

};
