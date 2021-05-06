# OC_P5_Blog
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/daf4eb11bfe44fe0b619a80671dcfc7f)](https://www.codacy.com/gh/fleurdeveley/OC_P5_Blog/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=fleurdeveley/OC_P5_Blog&amp;utm_campaign=Badge_Grade)

[![SymfonyInsight](https://insight.symfony.com/projects/ba539702-398e-4251-98bd-338a427ea5c2/small.svg)](https://insight.symfony.com/projects/ba539702-398e-4251-98bd-338a427ea5c2)

## Description of the project
As a part of a study project, realization of the structure of a blog.

## Technolgies
* PHP v7.4
* Composer
* GitHub

## Server configuration
* Host : Linux Ubuntu
* The web server must be configured to point to the public folder in which index.php is located.

#### Examples configurations
* Apache configuration example : <br />
  Allow url rewriting in .htaccess <br />
  
  ```
    <Directory />
      Options Indexes FollowSymLinks
      AllowOverride All
    </Directory>
  ```  

* Nginx configuration example : <br />

  ```
    root /var/www/html/public;
    index index.php index.html;
  
      location / {
           try_files $uri $uri/ /index.php$is_args$args;
      }
  ```

## Development in PHP
* MVC
* POO

## Database
* Creating a "Blog" database using MySQL : import blog.sql

## Source
* git clone https://github.com/fleurdeveley/OC_P5_Blog

## Installation
* composer install
* Copy .env.example to .env and fill your information
