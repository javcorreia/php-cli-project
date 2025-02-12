<?php

namespace App\Cli\Commands;

use App\Cli\Cache\Cache;
use App\Cli\Logger\Log;
use PDO;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'app:test';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("Just testing...");

        $redisConnectionString = "redis://{$_ENV['REDIS_HOST']}:{$_ENV['REDIS_PORT']}/1";

        // do some testing stuff
        $redisConn = RedisAdapter::createConnection($redisConnectionString);
        if (!$redisConn->ping()) {
            $output->writeln("<error>Could not connect to Redis</error>");
            return Command::FAILURE;
        }

        /*
         * REDIS CACHE TESTS
         */
        $output->writeln('Testing Redis cache...');

        if (!Cache::set('pla.cache.pool', 'stuff')) {
            $output->writeln("<error>Could not set cache item!</error>");
            return Command::FAILURE;
        }
        $output->writeln('cached item [stuff]');

        $cachedItem = Cache::get('pla.cache.pool');
        if ($cachedItem === null) {
            $output->writeln("<error>Could not retrieve cache item!</error>");
            return Command::FAILURE;
        }
        $output->writeln("get cached item>> {$cachedItem}");

        if (!Cache::delete('pla.cache.pool')) {
            $output->writeln("<error>Could not delete cache item!</error>");
            return Command::FAILURE;
        }
        $output->writeln('delete cached item successful');

        /*
         * FILES TESTS
         */
//        $fd = fopen("test_file", 'c');
//        fclose($fd);
//        file_put_contents($_ENV['FILES_PATH'] . "test_file", "nhaca\n");

        /*
         * SQLITE DB TESTS
         */
        $pdo = new PDO('sqlite:' . $_ENV['MAIN_DB_FILE']);
        if (!is_null($pdo)) {
            $output->writeln('Connection to [' . $_ENV['MAIN_DB_FILE'] . '] successful.');
        } else {
            $output->writeln('Connection to [' . $_ENV['MAIN_DB_FILE'] . '] unsuccessful!');
        }

        // Inserting Stuff
        /*$output->writeln("inserting some random values");

        $testCol1 = strtoupper(bin2hex(random_bytes(15)));
        $testCol2 = rand();
        $output->writeln("inserting values: {$testCol1} | {$testCol2}");

        $sql = "INSERT INTO test_table (test_col_1, test_col_2) VALUES (:test_col_1, :test_col_2)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':test_col_1' => $testCol1,
            ':test_col_2' => $testCol2,
        ]);

        $output->writeln("inserted with id: " . $pdo->lastInsertId());*/

        // reading stuff
        /*$stmt = $pdo->query("SELECT test_col_1, test_col_2 FROM test_table");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $output->write("col1: " . $row['test_col_1'] . " | ");
            $output->writeln("col2: " . $row['test_col_2']);
        }*/

        $output->writeln('logging something to stdout...');
        Log::debug('logged a debug message to stdout');

        $output->writeln("...done.");

        return Command::SUCCESS;
    }
}
