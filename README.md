Before cloning and setting up this project, make sure you have Laravel and Composer installed (preferably in the directory where you will clone this project)
composer install
composer global require laravel/installer

when installed you need to setup an .env file (you can copy the .env.example file)
in the .env file, make sure you have this with the right values of your database

DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

Run: php artisan key:generate to generate an APP_KEY. witouht this the page will an internal server error and imply that No application encryption key has been specified.

Navigate to the project with cd .../Laravel-project_backend-web with ... being the directory this project is installed at

to install frontedn assets:
npm install
nmp run dev

in another terminal to run the development server:
php artisan serve

If the admin account does not work imediatly, run php artisan db:seed this wil seed the database and the standart admin account will be in the Users table.

when setting up the .env file, make sure FILESYSTEM_DISK is set to public instead of local

Make sure both are running, otherwise the project won't be visible.


Running php artisan migrate:fresh --seed will:
Drop all tables
Run all migrations
Create admin user (admin@ehb.be / Password!321)
Seed sample data for all features
Set up proper relationships

sources:
https://stackoverflow.com/questions/31543175/getting-a-500-internal-server-error-require-failed-opening-required-path-on 
https://laravel.com/docs/11.x/controllers 
https://stackoverflow.com/questions/5207160/what-is-a-csrf-token-what-is-its-importance-and-how-does-it-work
https://www.imperva.com/learn/application-security/csrf-cross-site-request-forgery/?utm_source=google&utm_medium=cpc&utm_campaign=sw-waf-nord&utm_content=&utm_term=csrf&gad_source=1&gclid=CjwKCAiAg8S7BhATEiwAO2-R6gpg335NIUN5iknmTVX8b1oUmbIR8nUTkwbbuTZx5vjxQThGGAlctRoCTLQQAvD_BwE
https://en.wikipedia.org/wiki/Cross-site_request_forgery
https://www.youtube.com/watch?v=Ub5TLow9GL4
https://en.wikipedia.org/wiki/Modal_window
https://chatgpt.com/share/6768279c-e658-8010-9139-124fe8758cf9
https://stackoverflow.com/questions/14639235/opening-a-modal-window-using-php
https://www.w3schools.com/bootstrap5/bootstrap_modal.php
https://stackoverflow.com/questions/67507517/laravel-controller-trigger-modal-to-show-data 
https://phppot.com/php/php-time-ago-function/#:~:text=PHP%20Custom%20Time%20Ago%20Function&text=In%20timeago()%20function%20the,calculate%20the%20time%20ago%20string.
https://chatgpt.com/share/676d3cd1-1ef4-8010-94a8-d3e616a88ac9
https://blog.counter-strike.net/index.php/faq/
https://steamcommunity.com/faqs/steam-help/view/5ED2-ED8E-81F4-0C18
https://stackoverflow.com/questions/35301846/filtering-get-results-in-laravel
https://w3schools.invisionzone.com/topic/59650-the-8-biggest-laravel-development-mistakes-you-can-easily-avoid/
https://laravel.com/docs/11.x/seeding
https://chatgpt.com/share/676ec913-aa0c-8010-b5d0-85e230ac1e6e
https://www.w3.org/TR/SVG/
