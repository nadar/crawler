<?php

namespace Nadar\Crawler;

/**
 * Parser Result which will be Ignored.
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class ParserIgnoreResult extends ParserResult
{
    /**
     * {@inheritDoc}
     */
    public $ignore = true;
}
