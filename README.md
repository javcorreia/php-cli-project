# PHP CLI Project Starter
Simple cli project starter for a variety of usages. All up to you.

It uses: 
- [symfony/console](https://symfony.com/doc/current/components/console.html) to implement cli commands,  
- redis for your caching needs: 
  - with symfony [cache](https://symfony.com/doc/current/components/cache.html) component 
  - and [predis](https://github.com/predis/predis) for the redis client 
- [Monolog](https://github.com/Seldaek/monolog) for logging needs.
- it comes with a sqlite database for simple sql db needs.

---

## Project Installation
- download project files
  - download zip file: https://github.com/javcorreia/php-cli-project/archive/refs/heads/main.zip
  - or clone it: 
  ```shell script
  git clone https://github.com/javcorreia/php-cli-project.git
  ```

### with Docker
- install [docker](https://docs.docker.com/engine/install/) on your system
- run `bin/composer-install` to add the vendor folder to the project
- run `docker compose up --watch` in docker folder and wait for the first build (later executions are faster)
- **TIP**: if you need to install new composer packages, use the docker composer via the following command:
  ```shell script
  bin/composer require vendor/package
  ```

### without Docker
- install [PHP >= 8.2](https://www.php.net/) and [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)
  - **TIP**: use [php.new](https://php.new/) to a fast and easy way to install PHP and composer on your system
- run the following command to install the project dependencies:
  ```shell script
  composer -d app install --ignore-platform-reqs --prefer-dist --optimize-autoloader
  ```

---

## Usage 
- all configurations are in the `.env` file.  
- the `.env` file is not versioned:
  - running directly in your computer, copy the `.env.example` file to `.env` and **adjust the values as paths may differ from docker ones**.
  - running with Docker, just change the values from .env.example file. It gets rebuilt every time it changes with docker compose watch.

### with Docker
- to execute commands use the `dconsole` main executable
- to list all available commands `app/dconsole`:
### without Docker
- to execute commands use the `console` main executable
- to list all available commands `app/console`:

---

## Create new commands
- Create new commands in folder `src/Commands`  
  **TIP**: use `src/Commands/TestCommand.php` as a base for new commands and for testing purposes.
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
- new commands are auto-registered as long as they live in the root of `src/Commands` folder

---

## Logging
[Monolog](https://github.com/Seldaek/monolog) is installed and a helper class, `app/Logger/Log.php`, is available to use.  
The usual levels are available: `debug`, `info`, `notice`, `warning`, `error`, `critical`, `alert`, `emergency`.  
```php
use App\Cli\Logger\Log;

Log::alert('This is an alert');
Log::debug('This is a debug message with some context info', ['context' => 'value']);
// ... etc
```

---

## Caching
[Symfony Cache Component](https://symfony.com/doc/current/components/cache.html) is installed and a helper class, `app/Cache/Cache.php`, is available to use.  
```php
use App\Cli\Cache\Cache;

Cache::set('key', 'value', 60);
$value = Cache::get('key');
Cache::delete('key');
```
