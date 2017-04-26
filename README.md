# DO*it*

A Symfony todo application.

## How does it work?

Users can register, login and manage lists of tasks. 
The application features some advanced Symfony setup, 
config, services, factory design pattern, form type classes, 
security access control and voters, translations, styling, etc. 
Some elements were generated automatically via Symphony's built-in console, 
such as entity classes and CRUD controller actions. 

## Resources

* [Bootstrap](http://getbootstrap.com/)
* [Bootswatch](https://bootswatch.com/)
* [FontAwesome](http://fontawesome.io/)
* [jQuery](https://jquery.com/)

## 3rd party bundles

* [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle)

## Installation

`git clone https://github.com/leohajder/do-it.git` to clone the repository  
`cd do-it`  
`composer install` and provide the database parameters when prompted  
`php bin/console doctrine:database:create`  to create the database   
`php bin/console doctrine:schema:update --force`  to update the schema  
`php bin/console fos:user:create <username>`  to create a user, read more [here](http://symfony.com/doc/current/bundles/FOSUserBundle/command_line_tools.html)  
`php bin/console server:start` and go to `http://127.0.0.1:8000` to view the application

