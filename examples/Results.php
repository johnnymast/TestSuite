<?php

/**
 * Single.php
 *
 * This file demonstrate how the getAnswers function can help you
 * interpret the answers given bij the test.
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

$questions = [
  [
    'text' => '5+5 = ',
    'answer' => 10,
    'score_good' => 1,
    'score_wrong' => 0,
    'answer_wrong' => 'You are Wrong 5+5=10',
    'answer_current' => 'You are right 5+5=10',
  ],
  [
    'text' => 'Is this script running on php? ',
    'answer' => 'yes',
    'score_good' => 1,
    'score_wrong' => 0,
    'answer_wrong' => 'You are wrong this script is running on php.',
    'answer_current' => 'You are right this script is created in php.',
  ],
];

class Test extends TestCase
{
    public function minScore()
    {
        return 0;
    }
    
    public function maxScore()
    {
        return 2;
    }
    
    private function askQuestion($question)
    {
        $sentence = $question->text;
        
    }
    
    public function run(ContainerInterface $container)
    {
        $questions = $container->get('questions');
        foreach ($questions as $question) {
            $this->askQuestion($question);
        }
    }
    
}

$suite = new TestSuite();
$suite->getContainer()->set('questions', $questions);
