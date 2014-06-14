Javascript-библиотека для определения пола по фамилии, имени, отчеству на русском языке
=======================================================================================

[Демо](http://vadimiztveri.github.io/)

JavaScript код, который по традиционным русским Имени, Фамилии и Отчеству определяет пол.

### Установка
Подключите к вашему приложению скрипт, например:

`<script src="Sex.js"></script>`

### Инициализация
`new Sex("Иванов", "Иван", "Иванович")`

Например:

```
var sex = new Sex("Иванов", "Иван", "Иванович");
```

### Получение результата

`new Sex("Иванов", "Иван", "Иванович").get_gender()`

Например:

`var sex = new Sex("Иванов", "Иван", "Иванович");
 sex.get_gender();`

### Формат ввода

Аргументы вводятся в виде строк (string):

* Первый аргумент: фамилия.
* Второй аргумент: имя.
* Третий аргумент: отчество.

Если нет одной из частей имени, то необходимо передать пустую строку (""). Например:

`var sex = new Sex("Иванов", "", "");`


### Формат вывода

Метод *.get_gender* возвращает один из трех вариантов:

* *1* (мужской пол),
* *0* (женский пол),
* *undefined* (не удалось определить пол).


Как это работает
----------------

Скрипт пытается определить пол сначала у каждой строки отдельно:

* по фамилии,
* по имени,
* по отчеству.

Если в одной или в нескольких строках удалось определить один пол и не определился другой, то этот пол возвращается как определенный.

Скрипт возвращает undefined, если:

* не удалось определить пол ни по одной из строк,
* в разных строках был определен разный пол.

[Поробнее о способах определения пола в вики.](https://github.com/vadimiztveri/sex_by_russian_name/wiki/how_work_it)

Лицензия
--------

sexing_by_russian_name является бесплатным ПО, подробности в файле LICENSE.


Благодарность
-------------

Скрипт написан в студии «[Цифрономика](http://cifronomika.ru/)». Авторы:
* [Вадим Галкин](https://github.com/vadimiztveri/)
* [Александр Борисов](https://github.com/aishek)
* [Кирилл Храпков](https://github.com/cubbiu)
