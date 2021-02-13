<?php

/**
 * Container.php
 *
 * This file demonstrate how to add values to the suite storage container
 * and use it inside the tests.
 *
 * PHP version 7.4
 *
 * @category Examples
 * @package  RedboxTestSuite
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-testsuite
 * @since    GIT:1.0
 */

require __DIR__.'/../vendor/autoload.php';

use Redbox\Testsuite\Interfaces\ContainerInterface;
use Redbox\Testsuite\TestCase;
use Redbox\Testsuite\TestSuite;

/**
 * Class MyFirstTest
 */
class MyFirstTestCase extends TestCase
{
    /**
     * Required function for tests indicating
     * the minimal score for this test.
     *
     * @return int
     */
    public function minScore(): int
    {
        return 0;
    }
    
    /**
     * Required function for tests indicating
     * the maximum score for this test.
     *
     * @return int
     */
    public function maxScore(): int
    {
        return 10;
    }
    
    /**
     * Demo function show how values are passed.
     *
     * @param string $word Word to echo.
     *
     * @return void
     */
    protected function say(string $word)
    {
        echo $word."\n";
    }
    
    /**
     * Run the test.
     *
     * @param ContainerInterface $container The storage container for the TestSuite.
     *
     * @return bool
     */
    public function run(ContainerInterface $container)
    {
        if ($container->has('words')) {
            $words = $container->get('words');
            
            foreach ($words as $word) {
                $this->say($word);
            }
        }
        
        return true;
    }
}

/**
 * Instantiate the test.
 */
$testInstance = new MyFirstTestCase();

/**
 * Create a test suite and attach the test.
 */
$suite = new TestSuite();
$suite->attach($testInstance);

$suite->getContainer()->set('words', ["Hello", "2021", "How", "Are", "You?"]);

$suite->run();
