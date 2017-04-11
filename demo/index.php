<?php
require '../vendor/autoload.php';

use johnnymast\Testsuite\TestSuite;
use johnnymast\Testsuite\Test;

class HttpTestCase implements Test {

    protected $score = 0;

    public function minScore()
    {
        return 3;
    }

    public function maxScore()
    {
        return 10;
    }

    public function score()
    {
        return $this->score;
    }

    public function run()
    {
        echo "RUNNING 1\n";
        $this->score = ($this->maxScore() - $this->minScore());
        return true;
    }
}

class ExtendedHttpTest extends HttpTestCase {
    public function run()
    {
        echo "RUNNING 2\n";
        $this->score = 5;
        return true;
    }
}

$basic = new HttpTestCase();
$extended = new ExtendedHttpTest();

/**
 * Create a test suite
 */
$suite = new TestSuite();
$suite->attach([$basic, $extended]);


/**
 * Score should be
 *
 * Test 1 -> Score == 7
 * Test 2 -> Score == 5
 * ===================+
 * Total suite score 12
 */
$suite->run();


echo "Total suite score: ".$suite->score()."\n";