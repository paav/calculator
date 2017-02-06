# Overview

Very simple calculator written with [Yii2 framework](http://www.yiiframework.com/) as a programming challenge from [razlet.ru](http://razlet.ru).


# Installation

1. `git clone https://github.com/paav/calculator.git`
2. `cd calculator`
3. `composer install`
4. Create database.
5. `cp config/db.example.php config/db.php`
6. Configure database connection in `config/db.php` file.
7. Apply database migrations with `./yii migrate` command.
8. Enable Apache mod_rewrite.
9. Configure Apache virtual host.
