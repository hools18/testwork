# Тестовый новостной каталог
На основе технического задания была спроектирована и создана база данных (схему можно посмотреть в вложении <a href="https://github.com/hools18/testwork/blob/master/testwork_db.jpg" target="_blank">testwork_db.jpg</a>)

**Backend**

Для работы использовалась база данных 10.1.44-MariaDB

Для работы с базой данных использовалась бибилиотека  "illuminate/database": "^7.0",

Для наполнения данными использовалась бибилиотека "fzaninotto/faker": "^1.9"

Для осуществления роутинга использовалась бибилиотека  "illuminate/routing": "^7.0",

В качестве вебсервера использовался nginx/1.17.10

В качестве ЯП использовался PHP 7.4.5 

Проверить работоспособность можно на сайте https://testwork.gq/
________________________________________________________________________________________

**Frontend**

Для визуального отображения работы API был создан небольшой сайт.

Для работы сайта использовались следующие бибилиотеки:

1. Vue
2. jQuery
3. Bootstrap 
2. Для настройки окружения Vue-cli
3. В качестве сборщика Webpack

________________________________________________________________________________________

**Установка и настройка проекта:**

1. Выкачать репозиторий https://github.com/hools18/testwork.git
2. Переименовать файл db_connection.example.php в db_connection.php.
3. Настроить подключение к БД.
4. В браузере открыть ссылку http:/localhost/setting/install
5. После чего произойдет формирование база даныых и наполнение тестовыми данными.
6. Чтобы удалить все данные из БД необходимо перейти по ссылке http:/localhost/setting/drop
____________________________________________________________________________________________

###### **Описание методов API**

**Работа с авторами:**

1. https://testwork.gq/authors - Получаем список авторов

    Структура ответа: 
    
        data: [{
            id: integer (Идентификатор автора в БД)
            name: string (ФИО автора)
            image: string (Аватар)
        },
        {
            id: integer (Идентификатор автора в БД)
            name: string (ФИО автора)
            image: string (Аватар)
        }],
        status: 200, (Статус ответа, 200 - успешно, 404 - ошибка)
        message: '', (Описание ошибки)
        
2. https://testwork.gq/authors?author_id={author_id} - Получаем информацию по конкретному автору (передаем параметр author_id - целое число)

    Структура ответа: 
    
        data: {
            id: integer (Идентификатор автора в БД)
            name: string (ФИО автора)
            image: string (Аватар)
        },
        status: 200, (Статус ответа, 200 - успешно, 404 - ошибка)
        message: '', (Описание ошибки)

3. https://testwork.gq/authors/getNews?author_id={author_id} - Получаем список новостей по конкретному автору (передаем параметр author_id - целое число)

    Структура ответа: 
    
        data: [{
              id: integer (Идентификатор новости в БД)
              title: string (Заголовок)
              subtitle: string (Подзаголовок)
              text: string (Текст)
        },
        {
              id: integer (Идентификатор новости в БД)
              title: string (Заголовок)
              subtitle: string (Подзаголовок)
              text: string (Текст)
        }],
        status: 200, (Статус ответа, 200 - успешно, 404 - ошибка)
        message: '', (Описание ошибки)
        
**Работа с разделами:**

1. https://testwork.gq/sections - Получаем список разделов

    Структура ответа: 
    
        data: [{
            id: integer (Идентификатор раздела в БД)
            name: string (Название раздела)
            child: [{
                id: integer  (Идентификатор дочернего раздела в БД)
                name: string  (Название дочернего раздела)
            },
            {
                id: integer  (Идентификатор дочернего раздела в БД)
                name: string  (Название дочернего раздела)  
            }]
        },
        {
            id: 2 (Идентификатор автора в БД)
            name: Люди (ФИО автора)
            child: [{
                id: integer  (Идентификатор дочернего раздела в БД)
                name: string  (Название дочернего раздела)
            },
            {
                id: integer  (Идентификатор дочернего раздела в БД)
                name: string  (Название дочернего раздела)  
            }]
        }],
        status: 200, (Статус ответа, 200 - успешно, 404 - ошибка)
        message: '', (Описание ошибки)
        
2. https://testwork.gq/sections?section_id={section_id} - Получаем информацию по конкретному разделу (передаем параметр section_id - целое число)

    Структура ответа: 
    
        data: {
            id: 1 (Идентификатор раздела в БД)
            name: Происшествия (Название раздела)
            child: [{
                id: integer  (Идентификатор дочернего раздела в БД)
                name: string  (Название дочернего раздела)
            },
            {
                id: integer  (Идентификатор дочернего раздела в БД)
                name: string  (Название дочернего раздела)  
            }]
        },
        status: 200, (Статус ответа, 200 - успешно, 404 - ошибка)
        message: '', (Описание ошибки)

3. https://testwork.gq/sections/getNews?section_id={section_id} - Получаем список новостей по конкретному разделу (передаем параметр section_id - целое число)

    Структура ответа: 
    
        data: [{
              id: 1 (Идентификатор новости в БД)
              title: string (Заголовок)
              subtitle: string (Подзаголовок)
              text: string (Текст)
        },
        {
              id: 2 (Идентификатор новости в БД)
              title: string (Заголовок)
              subtitle: string (Подзаголовок)
              text: string (Текст)
        }],
        status: 200, (Статус ответа, 200 - успешно, 404 - ошибка)
        message: '', (Описание ошибки)
        
**Работа с новостями:**

1. https://testwork.gq/news - Получаем список новостей
     Структура ответа: 
        
        data: [{
            id: 1 (Идентификатор новости в БД)
            title: string (Заголовок)
            subtitle: string (Подзаголовок)
            text: string (Текст)
            author_id: integer (Текст)
            sections: string (Список разделов к каким относится новость через запятую)
        },
        {
            id: 1 (Идентификатор новости в БД)
            title: string (Заголовок)
            subtitle: string (Подзаголовок)
            text: string (Текст)
            author_id: integer (Текст)
            sections: string (Список разделов к каким относится новость через запятую)
        }],
        status: 200, (Статус ответа, 200 - успешно, 404 - ошибка)
        message: '', (Описание ошибки)
        
2. https://testwork.gq/news?news_id={news_id} - Получаем информацию по конкретной новости
     Структура ответа: 
        
        data: [{
            id: 1 (Идентификатор новости в БД)
            title: string (Заголовок)
            subtitle: string (Подзаголовок)
            text: string (Текст)
            author_id: integer (Текст)
            sections: string (Список разделов к каким относится новость через запятую)
        ],
        status: 200, (Статус ответа, 200 - успешно, 404 - ошибка)
        message: '', (Описание ошибки)
        
3. https://testwork.gq/news/search?search={search} - Поиск новостой по заголовку (передаем параметр search строкой)
    
    Структура ответа: 
           
       data: [{
           id: 1 (Идентификатор новости в БД)
           title: string (Заголовок)
           subtitle: string (Подзаголовок)
           text: string (Текст)
           author_id: integer (Текст)
           sections: string (Список разделов к каким относится новость через запятую)
       },
       {
           id: 1 (Идентификатор новости в БД)
           title: string (Заголовок)
           subtitle: string (Подзаголовок)
           text: string (Текст)
           author_id: integer (Текст)
           sections: string (Список разделов к каким относится новость через запятую)
       }],
       status: 200, (Статус ответа, 200 - успешно, 404 - ошибка)
       message: '', (Описание ошибки)

**TODO:**

Конечно же для полнеценной работы ресурса необходимо еще добавить Vue-Router для роутинга фронта, кэширование запросов для Backend (например Redis), настройть под конкретный сервер php, nginx, mysql.