Phouch
======

CouchDB library for PHP!

Will be subject to change, unstable, under-development until version 1.0.0!

## Currently Proposed Usage

The following example shows a CouchDB collection being created, named songs, with one entry added.

```php
require_once 'phouch.php';
$phouch = new Phouch\Phouch();

$phouch->create(
  new Phouch\Collection('songs')->create(
    new Phouch\Document('alone_in_kyoto')
      ->addFields([
        'track'     => 'Alone in Kyoto',
        'artist'    => 'Air',
        'album'     => 'Talkie Walkie',
        'released'  => 2004
      ])
));
```
