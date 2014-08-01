<?php

class RequestTest extends PHPUnit_Framework_TestCase {

    public function testUnconfiguredExecution(){
        $req = new \Phouch\HTTP\Request();
        $response = $req->execute();
        $this->assertTrue($response->hasError());
    }
}