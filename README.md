# BaksDev Field Tire

![Version](https://img.shields.io/badge/version-6.3.3-blue) ![php 8.1+](https://img.shields.io/badge/php-min%208.1-red.svg)

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

	/** Радиус  */
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
		'@TireSeasonField/form.row.html.twig',
		'@TireStudsField/form.row.html.twig',
		'@TireCarTypeField/form.row.html.twig',
		'@TireEuroField/form.row.html.twig',
	]);

};

```

## Переопределение шаблонов

Шаблоны пееропределяются в директории templates в виде текстового представления (content.html.twig), и шаблона (
template.html.twig)

#### Радиус шины

- /templates/TireRadiusField/content.html.twig
- /templates/TireRadiusField/template.html.twig

#### Профиль нины

- /templates/TireProfileField/content.html.twig
- /templates/TireProfileField/template.html.twig

#### Ширина нины

- /templates/TireWidthField/content.html.twig
- /templates/TireWidthField/template.html.twig

#### Сезонность

- /templates/TireSeasonField/content.html.twig
- /templates/TireSeasonField/template.html.twig

#### Шипы

- /templates/TireStudsField/content.html.twig
- /templates/TireStudsField/template.html.twig

#### Тип автомобиля

- /templates/TireCarTypeField/content.html.twig
- /templates/TireCarTypeField/template.html.twig

#### Евроэтикетка

- /templates/TireEuroField/content.html.twig
- /templates/TireEuroField/template.html.twig


## Лицензия ![License](https://img.shields.io/badge/MIT-green)

The MIT License (MIT). Обратитесь к [Файлу лицензии](LICENSE.md) за дополнительной информацией.


