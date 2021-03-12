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

use Redbox\Testsuite\Interfaces\ContainerInterface;

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
     * @var string
     */
    public string $name = '';
    
    
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
     * Return the name of the test.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * Set the test name.
     *
     * @param  string  $name The name of the test.
     */
    public function setName(string $name)
    {
        $this->name = $name;
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
     * @param  ContainerInterface  $container  The storage container for the TestSuite.
     *
     * @return void
     */
    abstract public function run(ContainerInterface $container);
}
