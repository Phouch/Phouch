<?php

class RequestTest extends PHPUnit_Framework_TestCase {

    public function testUnconfiguredExecution(){

        $req = new \Phouch\HTTP\Request();
        $expectedException = new \Phouch\Exception\HTTP\Options\NotSet();

        $response = $req->execute();

        $this->assertTrue($response->hasError());
        $this->assertEquals($expectedException->getMessage(), $response->getError());
    }
}