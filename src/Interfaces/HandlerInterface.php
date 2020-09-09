<?php

namespace Nadar\Crawler\Interfaces;

use \Nadar\Crawler\Result;

interface HandlerInterface
{
    public function afterRun(Result $result);
}
