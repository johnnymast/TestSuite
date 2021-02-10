<?php

namespace Redbox\Testsuite\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Redbox\Testsuite\Tests\Assets\MockableTest;

class TestTest extends TestCase
{
    protected $testInstance;
    
    protected function setUp(): void
    {
        $this->testInstance = new class extends \Redbox\Testsuite\Test {
            
            public function minScore()
            {
                return 0;
            }
            
            public function maxScore()
            {
                return 200;
            }
            
            private function executeTest1()
            {
                $this->score->increment(4);
            }
            
            public function run(): bool
            {
                $this->executeTest1();
                return true;
            }
        };
    }
    
    public function test_score_is_0_by_default()
    {
        $this->assertEquals(0, $this->testInstance->score->getScore());
    }
    
    public function test_set_and_get_score_work_correct()
    {
        $this->testInstance->score->setScore(5);
        
        $this->assertEquals(5, $this->testInstance->score->getScore());
    }
    
    public function test_core_can_be_incremented()
    {
        $this->testInstance->score->setScore(5);
        $this->testInstance->score->increment(5);
        $this->assertEquals(10, $this->testInstance->score->getScore());
    }
    
    public function test_run_should_increment_score()
    {
        $this->testInstance->run();
        $this->assertEquals(4, $this->testInstance->score->getScore());
    }
    
    public function test_score_knows_the_min_score()
    {
        $this->assertEquals(0, $this->testInstance->score->minScore(),);
    }
    
    public function test_score_knows_the_max_score()
    {
        $this->assertEquals(200, $this->testInstance->score->maxScore());
    }
    
    public function test_average_can_be_correctly_calculated()
    {
        $this->testInstance->score->increment(5);
        $this->testInstance->score->increment(5);
        $this->testInstance->score->increment(5);
        $this->assertEquals(5, $this->testInstance->score->average());
    }
    
    public function test_average_does_not_divide_by_zero_increments_but_returns_false()
    {
        $this->assertEquals(0, $this->testInstance->score->average());
        $this->assertFalse($this->testInstance->score->average());
    }
    
    public function test_percentage_is_calculated_correctly() {
        $this->testInstance->score->increment(15);
        $this->testInstance->score->increment(15);
        $this->testInstance->score->increment(1);
        $this->assertEquals(62, $this->testInstance->score->percentage());
    }
    
    public function test_percentage_should_be_0_without_increments() {
        $this->assertEquals(0, $this->testInstance->score->percentage());
    }
}
