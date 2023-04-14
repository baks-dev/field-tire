# Список изменений

Все заметные изменения в модуле будут задокументированы в этом файле.


## 14.04.2023 ![Version](https://img.shields.io/badge/version-v6.2.1-blue)

Добавлено поле Евроэтикетка. В конфиг полей нужно добавить

``` php

<?php

/** Евроэтикетка шины */
$services->set(TireEuroFieldChoice::class)
->tag('baks.fields.choice')
;

/** Шаблоны полей в форме */
$twig->formThemes([
'@TireEuroField/form.row.html.twig',
]);

```

## 09.04.2023 ![Version](https://img.shields.io/badge/version-v6.2.0-blue)

Новая версия 6.2, соотвтетсвующей версии фрейворка Symfony