![cover](https://user-images.githubusercontent.com/121194/107553910-86e08800-6bd5-11eb-9411-500ca30125f0.png)

[![Build Status](https://travis-ci.com/johnnymast/redbox-testsuite.svg?branch=master)](https://travis-ci.com/johnnymast/redbox-testsuite)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/johnnymast/redbox-testsuite/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/johnnymast/redbox-testsuite/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/johnnymast/redbox-testsuite/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/johnnymast/redbox-testsuite/?branch=master)

# Redbox Testsuite

Redbox Testsuite allows you to batch process student like tests in a Suite of tests and collect the results from the suite.

## Requirements

The following PHP versions are supported.

+ PHP 7.4 and above

## Installation

The package can be installed using composer.

```bash
composer require redbox/tracker
```

## Usage

```php
use Redbox\Testsuite\Test;
use Redbox\Testsuite\TestSuite;

/**
 * JUST A SPEC DEMO FOR MY SELF
 */
class SingleTest extends Test
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
        return 4;
    }
    
    /**
     * Demo function for answering demo questions.
     *
     * @param bool $correct For demo only if the answer is true mark correct.
     *
     * @return void
     */
    protected function checkAnswer(bool $correct)
    {
        if ($correct) {
            $this->score->increment(1);
        }
    }
    
    /**
     * Run the test.
     *
     * @return void
     */
    public function run()
    {
        $this->checkAnswer(true);
        $this->checkAnswer(true);
        $this->checkAnswer(false);
    }
}

$test = new SingleTest();

/**
 * Create a test suite
 */
$suite = new TestSuite();
$suite->attach($test);

/**
 * Score should be
 *
 * Test score: 2
 *   - Answer 1 correct: true
 *   - Answer 2 correct: true
 *   - Answer 3 correct: false
 * ===================+
 * Total suite score 2
 */
$suite->run();

echo "Total suite score: ".$suite->getScore()."\n";
echo "Percentage complete: ".$test->score->percentage()."%\n";
```

Will output:

```bash
$ php ./demo/single.php
Total suite score: 2
Percentage complete: 50%

```

## Author

This package is created and maintained by [Johnny Mast](mailto:mastjohnny@gmail.com). For feature requests or suggestions you could consider
emailing  me.

## Enjoy

Oh, and if you've come down this far, you might as well [follow me](https://twitter.com/mastjohnny) on Twitter. If you like this software
please consider giving it a star rating on GitHub.

## Author

This package is created and maintained by [Johnny Mast](mailto:mastjohnny@gmail.com). For feature requests or suggestions you could consider
sending me an e-mail.

## License

Copyright (c) 2021 Johnny Mast <mastjohnny@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "
Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the
following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
