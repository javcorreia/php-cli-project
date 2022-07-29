<?php

namespace App\Cli\Commands;

use PDO;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Cli\Config;

class TestCommand extends Command
{
    protected static $defaultName = 'app:test';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("Just testing...");

        // do some testing stuff
        $cache = new RedisAdapter(RedisAdapter::createConnection('redis://redis:6379/1'), "pla_");

        /*
         * REDIS CACHE TESTS
         */
//        $testCacheItem = $cache->getItem('pla.cache.pool');
//        $testCacheItem->set("stuff");
//        $cache->save($testCacheItem);

//        $testCacheItem = $cache->getItem('pla.cache.pool');
//        if (!$testCacheItem->isHit()) {
//            $output->writeln("NOT CACHED");
//            return Command::SUCCESS;
//        }
//
//        $testCacheValue = $testCacheItem->get();
//        $output->writeln(">> {$testCacheValue}");
//
//        $cache->deleteItem('pla.cache.pool');


        /*
         * FILES TESTS
         */
//        $fd = fopen("test_file", 'c');
//        fclose($fd);
//        file_put_contents(Config::FILES_PATH . "test_file", "nhaca\n");

        /*
         * SQLITE DB TESTS
         */
        $pdo = new PDO('sqlite:' . Config::MAIN_DB_FILE);
        if (!is_null($pdo)) {
            $output->writeln('Connection to [' . Config::MAIN_DB_FILE . '] successful.');
        } else {
            $output->writeln('Connection to [' . Config::MAIN_DB_FILE . '] unsuccessful!');
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

        $output->writeln("...done.");

        return Command::SUCCESS;
    }
}
