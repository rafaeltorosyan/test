
#installation guid
- create ```.env``` file, from ```.env.example``` file content
- set your settings in ```.env``` file
- ```composer install```
- ```php artisan migrate```
- ```php artisan db:seed```
- ```настроить laravel schedule```

#server start
- run ```php artisan serve```
- run ```php artisan queue:work```
#rest API
````
rout: /send-sms
method: POST
body: 
    message (text, required)
    time    (required, fromat 04.09.2018 12:30:00) 
````

#overview 
````
принцип работы. добавляется сообщение и время отправки в базу.
cron постоянно сканирует базу на неотправленных смс,
если найдет неотправленные смс, проверяете время. если время отправки ровно или меньше текущей времени, добавлять в очеред для отправки этих смс всем пользователям. и отмечаеть сообшение как отправленний.
````
#commands

команда для ручного запуска 
- ```php artisan addSmsToQueue```
