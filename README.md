FVOTE
====

FVOTE - это веб-приложения для проведения голосований в различных номинациях.

## Используемые технологии

- [Laravel PHP framework](https://laravel.com/docs)

## Инструкции по сборке

При первой сборке:
```bash
git clone git@github.com:MIR24/FVOTE.git
cd FVOTE/
cp .env.example .env
# Внести настройки в конфигурационный файл .env
composer update
php artisan migrate
php artisan key:generate
npm install
npm run dev
php artisan serve
```
Увидеть интерфейс можно будет по адресу:
http://127.0.0.1:8000/

Для последующих сборок можно использовать команду:
```bash
git pull && composer update && php artisan migrate && npm install && npm run dev
```
