# BaksDev Field Tire

[![Version](https://img.shields.io/badge/version-7.3.0-blue)](https://github.com/baks-dev/field-tire/releases)
![php 8.4+](https://img.shields.io/badge/php-min%208.4-red.svg)
[![packagist](https://img.shields.io/badge/packagist-green)](https://packagist.org/packages/baks-dev/field-tire)

Пакет полей HTML для автомобильных шин

## Установка

``` bash
composer require baks-dev/field-tire
```

## Настройки

Для отображения в выпадающих списках полей, добавить настройку сервиса в конфиг:

config/packages/field.php

``` php
<?php

use Symfony\Config\TwigConfig;

return static function (TwigConfig $twig) {
	
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

Шаблоны переопределяются в директории templates в виде текстового представления (content.html.twig), и шаблона (
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


