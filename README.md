# Laasti

A PHP Framework based on PHP League and Symfony components. Laasti is finnish for Mortar. 

Laasti aims to make full use of composer packages to built a development-ready framework. Bringing carefully chosen packages together!

No closure are encouraged, you won't even see them in the docs. Everything is in a class.

A stack of middlewares to deal with the request

I believe that there shouldn't be any HTML/JS/CSS in PHP classes. PHP should only provide data. The views deal with the data. That way there is only one place to look for HTML: the theme.

## Setting up your project

Update composer.json with your project info, don't forget to change the namespace.

A word or two about the file structure:
* cache/: For cache files from services
* public/ The folder your domain should be pointing to
* resources/: For language files and templates
* src/: For classes and configuration files
* .env: For environment configuration keys

## Create your first controller

I suggest putting your Controllers in the folder src/Controllers.

Create your controller: see src/Controllers/HelloWorld.php for a concrete example.

Add your route to src/config.php: ['GET', '/', 'Laasti\Dist\Controllers\HelloWorld::welcome']

Visit http://domain.com and enjoy!

## Display a template view with data from the controller

See src/Controllers/Template.php and resources/views/my-name-is.php.

Visit http://domain.com/template/Anonymous

## Display a paginated list: https://github.com/Kilte/pagination

## Display a form

## Validate a form

## Submit a form

## Display a menu

## Add a third-party library

You can use composer vendor or create a libraries folder and put the source files there.

## Debug with logs

A logger is made available through the Psr\Log\LoggerInterface. 
You can inject it using dependency injection.

## Send an email

## Upload a file

## Localize

## Manage sessions

## Add cronjobs

