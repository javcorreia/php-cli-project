# PHP CLI Project Starter
Simple cli project starter for a variety of usages. All up to you.

It uses [symfony/console](https://symfony.com/doc/current/components/console.html) to implement cli commands  
and redis for [cache](https://symfony.com/doc/current/components/cache.html), if needed.  
And it comes with a sqlite database for simple sql db needs.

## Project Installation
- download project files
- install [docker](https://docs.docker.com/engine/install/) on your system
- run `docker compose up` in docker folder and wait for the first build (later executions are faster)
- get inside main container with the following command: (_the following will work in linux, other OS's may vary slightly_)
    ```shell script
    ./dockerterm
    ```     
  or use another way related to your installation (gui tools, etc)
- run `./dcomposer install` in root directory (the one with _composer.json_ and _composer.lock_ files)

## Useful commands
- `dockerterm`: wrapper of `docker exec` to enter inside the console container to execute commands as your current user (useful if creating files inside de container, like a composer install)
- `dockertermroot`: the same as above, but as the root user.
- `dconsole`: wrapper to the application console command inside the container. No need to open a terminal into the container to execute it.
- `dcomposer`: wrapper to composer inside console docker container. No need to open a terminal into the container to execute it.

## Usage
- the main config is in class `Config.php`  
  change it according to your needs.
- to execute commands use the `dconsole` main executable, for example, run test command to see its help:
    ```shell script
    ./dconsole app:test -h
    ```
- list all available commands:
    ```shell script
    ./dconsole
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