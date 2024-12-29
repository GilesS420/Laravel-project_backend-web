
> [!warning]
> Before cloning and setting up this project, make sure you have Laravel and Composer installed (preferably in the directory where you will clone this project)

# How to install
```
composer install
composer global require laravel/installer
```
### .env setup
when installed you need to setup an .env file (you can copy the .env.example file)
in the .env file, make sure you have this with the right values to these varibles:

```
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
Run: ``` php artisan key:generate ``` to generate an  ``` APP_KEY ```. witouht this the page will display an internal server error and imply that: No application encryption key has been specified.

Next, navigate to the project with ```cd your/location/of/the/project/Laravel-project_backend-web``` 

### Finnaly you can start the server 
frontend assets:
``` npm install ```
``` npm run dev ```

in another terminal to run the development server:
``` php artisan serve ```
>[!IMPORTANT]
> Make sure both are running, otherwise the project won't be visible.

### Profile picture's
to visualize the profile pictures run: ``` php artisan storage:link ```. This will create a storage link on your device and enable the visibility of profile pictures.

# Possible troubles
If the admin account does not work imediatly 

OR

 certain information from the community tab does not display when starting the application. 
 
Run: 
```php artisan migrate:fresh --seed```.
This will:
1) Drop all tables.
2) Run all migrations
3) Create the admin user (admin@ehb.be / Password!321)
4) seed samlpe data for all features
5) set up proper relationships

# introduction
this project is made as an assignment for the course Backend Web. This project showcases my skill in php, laravel-Blade and javascript. The project is based on Counterstrike 2 using inspiration form Steam and the official CS2 site.





# sources:
Courses from Backend web EHB

https://stackoverflow.com/questions/31543175/getting-a-500-internal-server-error-require-failed-opening-required-path-on 

https://chatgpt.com/share/677150d0-cb08-8010-955b-3fe07f519be5

https://laravel.com/docs/11.x/controllers 

https://stackoverflow.com/questions/5207160/what-is-a-csrf-token-what-is-its-importance-and-how-does-it-work

https://www.imperva.com/learn/application-security/csrf-cross-site-request-forgery/?utm_source=google&utm_medium=cpc&utm_campaign=sw-waf-nord&utm_content=&utm_term=csrf&gad_source=1&gclid=CjwKCAiAg8S7BhATEiwAO2-R6gpg335NIUN5iknmTVX8b1oUmbIR8nUTkwbbuTZx5vjxQThGGAlctRoCTLQQAvD_BwE

https://en.wikipedia.org/wiki/Cross-site_request_forgery

https://www.youtube.com/watch?v=Ub5TLow9GL4

https://en.wikipedia.org/wiki/Modal_window

https://chatgpt.com/share/6768279c-e658-8010-9139-124fe8758cf9

https://chatgpt.com/share/676d3cd1-1ef4-8010-94a8-d3e616a88ac9

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

https://laravel.com/docs/11.x/encryption

https://laravel.com/docs/11.x/authorization

https://laravel.com/docs/11.x/migrations

https://laravel.com/docs/11.x/seeding

https://laravel.com/api/11.x/

https://kinsta.com/blog/laravel-crud/

https://www.counter-strike.net/cs2

https://store.steampowered.com/app/730/CounterStrike_2/
