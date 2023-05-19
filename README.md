# PHP CLI Project Starter
Simple cli project starter for a variety of usages. All up to you.

It uses [symfony/console](https://symfony.com/doc/current/components/console.html) to implement cli commands  
and redis for [cache](https://symfony.com/doc/current/components/cache.html), if needed.  
And it comes with a sqlite database for simple sql db needs.

## Project Installation
- download project files
  - download zip file: https://github.com/javcorreia/php-cli-project/archive/refs/heads/main.zip
  - or clone it: 
  ```shell script
  git clone https://github.com/javcorreia/php-cli-project.git
  ```
### with Docker
- install [docker](https://docs.docker.com/engine/install/) on your system
- run `docker compose up` in docker folder and wait for the first build (later executions are faster)
- in project root (the one with _composer.json_ and _composer.lock_ files) run:
  ```shell script
  ./bin/dcomposer install
  ```
### without Docker
- without Docker you can use your computer or a VM (VirtualBox|VMWare|KVM|etc) with linux
- install at least [PHP8.1](https://www.php.net/downloads) on it
- install [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)
- in project root (the one with _composer.json_ and _composer.lock_ files) run:
  ```shell script
  composer install
  ```

## Useful commands in `bin` folder (to use with Docker)
- `dockerterm`: wrapper of `docker exec -it` to enter inside the console container to execute commands as your current user (useful if creating files inside the container)
- `dockertermroot`: the same as above, but as the root user.
- `dconsole`: wrapper to the application console command inside the container. No need to open a terminal into the container to execute it.
- `dcomposer`: wrapper to composer inside console docker container. No need to open a terminal into the container to execute it.
### Tip
In most Linux systems you can run this in you terminal to run the above commands without the trailing dot slash:
```shell script
export PATH=$PATH:$PWD/bin
```
Also, you can put it inside your `.bashrc` file if you want to make it permanent.  
Other shells may vary.

## Usage 
- the main config is in class `Config.php`  
  change it according to your needs.
### with Docker
- to execute commands use the `dconsole` main executable, for example, run test command to see its help:
    ```shell script
    ./bin/dconsole app:test -h
    ```
- list all available commands:
    ```shell script
    ./bin/dconsole
    ```
### without Docker
- to execute commands use the `console` shortcut in project root, for example, run test command to see its help:
    ```shell script
    ./console app:test -h
    ```
- list all available commands:
    ```shell script
    ./console
    ```

## Create new commands
- Create new commands in folder `src/Commands`  
  Tip: use `src/Commands/TestCommand.php` as a base for new commands and for testing purposes.
  ```php
  <?php
  
  namespace App\Cli\Commands;
  
  use Symfony\Component\Console\Command\Command;
  use Symfony\Component\Console\Input\InputInterface;
  use Symfony\Component\Console\Output\OutputInterface;
  
  class NewCommand extends Command
  {
      protected static $defaultName = 'app:new-command';
  
      protected function execute(InputInterface $input, OutputInterface $output): int
      {
          // TODO: do stuff
  
          return Command::SUCCESS;
      }
  }
  ```
- Register the new command in `src/bin/console.php`
  ```php
  // ...
  use App\Cli\Commands\NewCommand;
  // ... 
  $application->add(new NewCommand());
  // ...
  ```