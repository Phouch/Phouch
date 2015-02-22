<?php
class GetTest extends PHPUnit_Framework_TestCase 
{
    public function testMethodIsGet()
    {
        $httpGET = new \Phouch\HTTP\Options\Get();
        $this->assertEquals('GET', $httpGET->getMethod());
    }
}