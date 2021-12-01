### Тестовое задание для Imagespark
#### _Развертывание_

1) Скопировать репозиторий к себе
2) Выполнить команду ```composer update```
3) Создать файл **.env** и вставить туда следующие настройки для базы данных
    ```
    DB_CONNECTION=mysql
    DB_HOST=imagespark_database
    DB_PORT=3306
    DB_DATABASE=library
    DB_USERNAME=imagespark
    DB_PASSWORD=imagespark
    ```
4) Выполнить следующие команды
- ```php artisan key:generate```
- ```docker-compose up -d --build```
- ```docker exec -it imagespark_database php artisan migrate```
- ```docker exec -it imagespark_php php artisan db:seed```

  Для Ubuntu возможно придется подправить права. Выполнить из корня проекта следующую команду
  ```sudo chown -R www-data:www-data storage/```
#### _Как использоваться_
##### Auth
Методом POST отправить на URL ```/api/v1/login``` следующие json данные:
```json
	{
	    "email": "test@test.com",
	    "password": "password"
	}
```
В ответе будет token, который необходимо вставить в **headers** запроса
```
	Accept: application/json
	Authorization: Bearer {your token}
```

##### Задачи в тестовом по пунктам
1) Для поиска по названию книги или автору добавить параметр "**search**" к GET запросу
   Например:
   ```http://localhost:8080/api/v1/books?search={value}```

2) Для оценки книги/автора необходимо выполнить PUT запрос:
   ```http://localhost:8080/api/v1/books/{id}```
   со следующими json данными:
```json
	{
	    "rating": 5
	}
```

3)	Для отображения общего каталога книг и сортировки по рейтингу необходимо выполнить GET-запрос на URL ```/api/v1/books```  с параметр **sort**
      Например:
      ```http://localhost:8080/api/v1/books?sort=rating```
      ```http://localhost:8080/api/v1/authors?sort=rating```

4) Для отображения общего списка авторов необходимо выполнить GET-запрос на URL ```/api/v1/authors```
   Например:
   ```http://localhost:8080/api/v1/authors```
   А для отображения всех книг выполнить GET-запрос на URL ```/api/v1/authors/{id}/books```

5) CRUD осуществляется в зависимости от типа запроса:
- GET: /api/v1/books/{id} - просмотр
- POST: /api/v1/books/{id} - создание
- PUT: /api/v1/books/{id} - изменение
- DELETE: /api/v1/books/{id} - удаление

Это же касается и авторов по URL /api/v1/authors/{id}
