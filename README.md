# PHP CLI Project
Simple cli project for a variety of usages. All up to you.

It uses [symfony/console](https://symfony.com/doc/current/components/console.html) to implement cli commands  
and redis for cache system, if needed.  
And it comes with a sqlite database for simple sql db needs.

## Project Installation
- download project files
- install [docker](https://docs.docker.com/engine/install/) on your system
- run `docker compose up` in docker folder and wait for the first build (later executions are faster)
- get inside main container with the following command: (_the following will work in linux, other OS's may vary slightly_)
    ```shell script
    docker exec -it --user $(id -u):$(id -g) php_la_log-analyser_1 /bin/bash
    ```     
  or use another way related to your installation (gui tools, etc)
- run `composer install` in root directory (the one with _composer.json_ and _composer.lock_ files)

## Usage
- the main config is in class `Config.php`  
  change it according to your needs.
- to execute commands use the `console` main executable, for example, run test command to see its help:
    ```shell script
    php console app:test -h
    ```
- list all available commands:
    ```shell script
    php console
    ```
- Create new commands in folder `src/Commands`  
  Tip: use `src/Commands/TestCommand.php` as a base for new commands and for testing purposes.
