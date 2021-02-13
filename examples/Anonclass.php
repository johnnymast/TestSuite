<?php

/**
 * Anonclass.php
 *
 * This file demonstrate how you could use Anonymous classes to
 * attach to the the test suite.
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

$suite = new TestSuite();
$suite->attach(
    /**
     * Anonymous class
     */
    new class extends TestCase {
    
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
        public function maxScore()
        {
            return 10;
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
            echo "Test case has run.\n";
        }
    }
);

$suite->run();

/**
 * Output:
 *
 * Test case has run.
 */
