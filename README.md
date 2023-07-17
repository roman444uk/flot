Скачать репозиторий
------------

```
git clone git@github.com:roman444uk/flot.git
```

Запуск Laravel сервера
------------

```
cd flot
composer install
cp -a .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Запуск клиента
------------

```
cd client
npm install
npm run dev
```

Клиент доступен по адресу
------------
```
http://localhost:3000/
```