<?php

class HttpOptionTest extends PHPUnit_Framework_TestCase {
    public function testSetWithArrayByConstruct(){
        $httpPOST = new \Phouch\HTTP\Options\Post(array(
            'host' => 'tau.pe',
            'port' => 80
        ));

        $this->assertEquals('tau.pe',$httpPOST->getHost());
        $this->assertEquals(80, $httpPOST->getPort());

    }
}