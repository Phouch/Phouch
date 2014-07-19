Phouch
======

Welcome to Phouch! CouchDB library for PHP.

Will be subject to change, unstable, under-development until version 1.0.0!

## Usage

The following examples show common database transactions using Phouch. 


###To start
```php
require_once 'phouch.php';
$phouch = new Phouch\Phouch();
```

###To get all databases

Phouch mirrors the CouchDB API very closely, each built-in database command will have similar, user friendly implementations in Phouch. For example, a GET request for retrieving all databases in Phouch, similar to CouchDB's _all_dbs command, could be used the following way.

```php
$result = $phouch->getAllDatabases();
```

###Add a new database
```php
$result = $phouch->addDatabase(array("name" => "songs"));

//or

$phouch->save(new Phouch\Database(array("name" => "songs")));

//or

$database = new Phouch\Database();

$database->setName("songs");

$phouch->save($database);
```

###Add new document to database
```php
$result = $phouch->addDocument(array(
    "database" => "songs", 
    "values" => array(
        "title" => "Ice Ice Baby", 
        "artist" => "Vanilla Ice")
));

//or

$phouch->save(new Phouch\Document(array(
    "database" => "songs", 
    "values" => array(
        "title" => "Ice Ice Baby", 
        "artist" => "Vanilla Ice")
));

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
