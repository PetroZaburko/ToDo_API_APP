## About

API for ToDo list.

## How to configure

At first you must rename .env.example file to .env. Then customize general settings at this file.
You need to set this parameters:
```php
APP_URL
APP_NAME
APP_ENV

#Mysql DB connection settings
DB_CONNECTION=mysql
DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD
```
After that you must create tables in you database. Use this comand in your terminal:
```shell script
php artisan migrate 
```
It will autiamticaly create all needed tables in your database.
When your tables are created, you can use this command in your terminal to fill database with fake data:
```shell script
php artisan db:seed
```

## How to use

List of all endpoints (method  |  URI  |  description):
```
  POST      | api/v1/login                | login
            |                             | pass:     email & password in request body in json format
            |                             | return:   user and bearer token, or validation errors
------------------------------------------------------------------------------------------------------------------------
  POST      | api/v1/logout               | logout 
            |                             | pass:     user bearer token
            |                             | return:   response status 200
------------------------------------------------------------------------------------------------------------------------
  POST      | api/v1/register             | register 
            |                             | pass:     name, surname, email, password in request body in json format
            |                             | return:   user and bearer token, or validation errors
------------------------------------------------------------------------------------------------------------------------
  GET       | api/v1/tasks                | all tasks 
            |                             | pass:      user bearer token
            |                             | return:    collection of all tasks
------------------------------------------------------------------------------------------------------------------------
  POST      | api/v1/tasks                | create new task 
            |                             | pass:      user bearer token, data for new task in json format in request body 
            |                             | return:    created task data, or validation errors
------------------------------------------------------------------------------------------------------------------------
  GET       | api/v1/tasks/{id}           | get one task by id
            |                             | pass:      user bearer token
            |                             | return:    one task data by id
------------------------------------------------------------------------------------------------------------------------
  PATCH     | api/v1/tasks/{id}           | update one task by id 
            |                             | pass:      user bearer token, partial data for udating in json format
            |                             | return:    updated task data, or validation errors
------------------------------------------------------------------------------------------------------------------------   
  DELETE    | api/v1/tasks/{id}           | delete one task by id
            |                             | pass:      user bearer token
            |                             | return:    response status 204
------------------------------------------------------------------------------------------------------------------------
  PATCH     | api/v1/tasks/{id}/status    | change task status by id
            |                             | pass:      user bearer token
            |                             | return:    response status 204
------------------------------------------------------------------------------------------------------------------------
```

## Testing
You can open ToDo.postman_collection.json file in your POSTMAN program for testing. 
