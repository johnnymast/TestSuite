<?php

require '../vendor/autoload.php';

use Redbox\Testsuite\Test;
use Redbox\Testsuite\TestSuite;

/**
 * JUST A SPEC DEMO FOR MY SELF
 */
class HttpTestCase extends Test
{
   
    public function minScore()
    {
        return 3;
    }
    
    public function maxScore()
    {
        return 10;
    }
    
    
    public function run()
    {
        echo "RUNNING 1\n";
//        $this->score = ($this->maxScore() - $this->minScore());
        
        return true;
    }
}

class ExtendedHttpTest extends HttpTestCase
{
    public function run()
    {
        echo "RUNNING 2\n";
   //     $this->score = 5;
        
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
//$suite->attach([HttpTestCase::class, ExtendedHttpTest::class]);


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