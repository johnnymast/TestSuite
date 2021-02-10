<?php
/**
 * Test.php
 *
 * The abstract class for Tests inside the TestSuite.
 *
 * PHP version 7.4
 *
 * @category Core
 * @package  RedboxTestSuite
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-testsuite
 * @since    GIT:1.0
 */

namespace Redbox\Testsuite;

/**
 * Class Test
 *
 * @package Redbox\Testsuite
 */
abstract class Test
{
    
    /**
     * Instance that keeps track of the score
     * for this test.
     *
     * @var Score
     */
    public ?Score $score = null;
    
    /**
     * Test constructor.
     *
     * Please not tests cant overwrite the function.
     */
    final function __construct()
    {
        $this->score = new Score($this);
    }
    
    /**
     * Tests must implement this method to indicate
     * the minimum score this test can reach.
     *
     * @return mixed
     */
    abstract public function minScore();
    
    /**
     * Tests must implement this method to indicate
     * the maximum score this test can reach.
     *
     * @return mixed
     */
    abstract public function maxScore();
    
    /**
     * Tests must implement this method to start
     * running their tests.
     *
     * @return void
     */
    abstract public function run();
}
