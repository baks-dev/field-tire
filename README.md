# BaksDev Field Tire

[![Version](https://img.shields.io/badge/version-7.1.3-blue)](https://github.com/baks-dev/field-tire/releases)
![php 8.3+](https://img.shields.io/badge/php-min%208.3-red.svg)

Пакет полей HTML для автомобильных шин

## Установка

``` bash
$ composer require baks-dev/field-tire
```

## Настройки

Для отображения в выпадающих списках полей, добавить настройку сервиса в конфиг:

config/packages/field.php

``` php
<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BaksDev\Field\Tire\Profile\Choice\TireProfileFieldChoice;
use BaksDev\Field\Tire\Radius\Choice\TireRadiusFieldChoice;
use BaksDev\Field\Tire\Width\Choice\TireWidthFieldChoice;
use BaksDev\Field\Tire\Season\Choice\TireSeasonFieldChoice;
use BaksDev\Field\Tire\Studs\Choice\TireStudsFieldChoice;
use BaksDev\Field\Tire\Euro\Choice\TireEuroFieldChoice;

return static function (ContainerConfigurator $configurator) {
	
	$services = $configurator->services()
            ->defaults()
            ->autowire(true)
            ->autoconfigure(true)
	;

	/** Диаметр  */
	$services->set(TireRadiusFieldChoice::class)
		->tag('baks.fields.choice')
	;
	
	/** Профиль  */
	$services->set(TireProfileFieldChoice::class)
		->tag('baks.fields.choice')
	;
	
	/** Ширина */
	$services->set(TireWidthFieldChoice::class)
		->tag('baks.fields.choice')
	;
	
	/** Сезон */
	$services->set(TireSeasonFieldChoice::class)
		->tag('baks.fields.choice')
	;
	
	/** Шипы */
	$services->set(TireStudsFieldChoice::class)
		->tag('baks.fields.choice')
	;
	
	/** Тип автомобиля */
	$services->set(TireCarTypeFieldChoice::class)
		->tag('baks.fields.choice')
	;

	/** Евроэтикетка шины */
	$services->set(TireEuroFieldChoice::class)
		->tag('baks.fields.choice')
	;
	
	/** Шаблоны полей в форме */
	$twig->formThemes([
		'@field-tire-season/form.row.html.twig',
		'@field-tire-studs/form.row.html.twig',
		'@field-tire-cartype/form.row.html.twig',
		'@field-tire-euro/form.row.html.twig',
	]);

};

```

## Переопределение шаблонов

Шаблоны пееропределяются в директории templates в виде текстового представления (content.html.twig), и шаблона (
template.html.twig)

#### Диаметр шины

- /templates/field-tire/radius/content.html.twig
- /templates/field-tire/radius/template.html.twig

#### Профиль нины

- /templates/field-tire/profile/content.html.twig
- /templates/field-tire/profile/template.html.twig

#### Ширина нины

- /templates/field-tire/width/content.html.twig
- /templates/field-tire/width/template.html.twig

#### Сезонность

- /templates/field-tire/season/content.html.twig
- /templates/field-tire/season/template.html.twig

#### Шипы

- /templates/field-tire/studs/content.html.twig
- /templates/field-tire/studs/template.html.twig

#### Тип автомобиля

- /templates/field-tire/cartype/content.html.twig
- /templates/field-tire/cartype/template.html.twig

#### Евроэтикетка

- /templates/field-tire/euro/content.html.twig
- /templates/field-tire/euro/template.html.twig


## Лицензия ![License](https://img.shields.io/badge/MIT-green)

The MIT License (MIT). Обратитесь к [Файлу лицензии](LICENSE.md) за дополнительной информацией.

