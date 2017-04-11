<?php

namespace johnnymast\Testsuite;

interface Test
{
    /**
     * @return mixed
     */
    public function minScore();

    /**
     * @return mixed
     */
    public function maxScore();

    /**
     * @return mixed
     */
    public function score();

    /**
     * @return mixed
     */
    public function run();
}
