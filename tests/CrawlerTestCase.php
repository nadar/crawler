<?php

namespace Nadar\Crawler\Tests;

use PHPUnit\Framework\TestCase;

class CrawlerTestCase extends TestCase
{
    /**
     * Call a private or protected method from an object and return the value.
     *
     * ```php
     * public function testProtectedMethod()
     * {
     *     // assuming MyObject has a protected method like:
     *     // protected function hello($title)
     *     // {
     *     //     return $title;
     *     // }
     *     $object = new MyObject();
     *
     *     $this->assertSame('Hello World', $this->invokeMethod($object, 'hello', ['Hello World']));
     * }
     * ```
     *
     * @param object $object The object the method exists from.
     * @param string $methodName  The name of the method which should be called.
     * @param array $parameters An array of paremters which should be passed to the method.
     * @return mixed
     * @since 1.0.8
     */
    public function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}
