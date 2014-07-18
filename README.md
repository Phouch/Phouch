Phouch
======

Welcome to Phouch! CouchDB library for PHP.

Will be subject to change, unstable, under-development until version 1.0.0!

## Currently Proposed Usage

The following example shows a CouchDB database being created, named songs, with one entry added.


To start:
```php
require_once 'phouch.php';
$phouch = new Phouch\Phouch();
```

To get all databases:
```php
$result = $phouch->getAllDatabases();
```

Add a new database:
```php
$result = $phouch->addDatabase(array("name" => "songs"));

//or

$phouch->save(new Phouch\Database(array("name" => "songs")));

//or

$database = new Phouch\Database();

$database->setName("songs");

$phouch->save($database);
```

Add new document to database:
```php
$result = $phouch->addDocument("songs", array("title" => "Ice Ice Baby", "artist" => "Vanilla Ice"));

//or

$phouch->save(new Phouch\Document(array("database" => "songs", "values" => array("title" => "Ice Ice Baby", "artist" => "Vanilla Ice")));

//or

$document = new Phouch\Document();

$document->setDatabase();
$document->setValue("title", "Ice Ice Baby");
$document->setValue("artist", "Vanilla Ice");

$phouch->save($document);

//or

$database = $phouch->getDatabase("songs");

$database->addDocument($document);

$phouch->save($database);
```
