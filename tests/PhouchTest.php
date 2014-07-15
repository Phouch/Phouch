<?php
class PhouchTest extends PHPUnit_Framework_TestCase
{
    public function createCollectionAndDocument(){
        require_once '../phouch.php';
        
        $phouch = new Phouch\Phouch();
        $document = new Phouch\Document('alone_in_kyoto');
        $collection = new Phouch\Collection('songs');
        
        $document->addFields([
              'track'     => 'Alone in Kyoto',
              'artist'    => 'Air',
              'album'     => 'Talkie Walkie',
              'released'  => 2004
            ]);
        
        $collection->create($document);
        
        $result = $phouch->create($collection);
        
        $this->assertTrue($result, "Could not create a collection");
    }
}