## Laravel GitHub OAuth

Laravel Github OAuth is a simple program. It lets users log in using their GitHub account.

## How to Install

1. `~$ git clone git@github.com:ibishek/laravel-oauth.git`
2. `~$ cd laravel-oauth`
3. `~$ composer install`
4. `~$ mv .env.example to .env`
5. Enter database credentials to `.env`
6. `~$ php artisan migrate`
7. `~$ php artisan serve`
8. Goto https://localhost:8000

## Create a GitHub OAuth App

1. Head over to [Developer applications](https://github.com/settings/developers) and create a new oauth app. *Note: Set callback url to http://localhost:8000/github/response*
2. Copy the Client ID and paste it into `GITHUB_CLIENT_ID` inside `.env`
3. Copy the Client scerets and paste it into `GITHUB_CLIENT_SECRET` inside `.env`
4. Authorization callback Url and `GITHUB_CALLBACK_URL` inside `.env` must point to the same URL.
