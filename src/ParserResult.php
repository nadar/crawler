<?php

namespace Nadar\Crawler;

/**
 * Parser Result
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class ParserResult
{
    use ResultPropertiesTrait;
    
    /**
     * @var boolean Whether the result should be ignored for any further processing. Ignored
     * ParserResult will also not pushed to the `HandlerInterface::afterRun()` method.
     */
    public $ignore = false;

    /**
     * @var array An array with links found on this parsers. The links are not validated whether they are on
     * the curren site or not. Therefore this can also contain external links. The key of the array is the link value the value is
     * the link content. f.e. <a href="https://luya.io">Go to Website</a> would be ['https://luya.io' => 'Go to Website'].
     */
    public $links = [];

    /**
     * Trim whitespaces also inbetween the content.
     *
     * This can be usefull when generate a result in order to safe memory.
     *
     * @param string $string The string to trim
     * @return string
     */
    public function trim($string)
    {
        return preg_replace('/\s+/', ' ', trim($string));
    }
}
