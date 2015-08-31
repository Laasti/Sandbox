# Laasti

A Laasti Framework distribution sample code project. Requires all supported packages.

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

