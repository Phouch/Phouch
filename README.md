Phouch
======

Welcome to Phouch! CouchDB library for PHP.

Will be subject to change, unstable, under-development until version 1.0.0!

## Usage

The following examples show common database transactions using Phouch. 


###To start

Requiring the Phouch library is as simple as including the phouch autoloader, after that you're able to use the Phouch object to initiate database transactions or create Phouch entities.

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

Adding new databases to your CouchDB instance with Phouch is simple. We provide a simplified interface, as well as a full object interface for creating and handling Phouch entities (and therefore CouchDB entities) in real object-oriented fashion.

####Simplified

Simply pass an array to the Phouch object, and Phouch\Phouch::addDatabase() will parse the options provided and persist the database.

```php
$result = $phouch->addDatabase(array("name" => "songs"));

```

####Using Objects

Create your own Phouch\Database object, and send it to the Phouch object to be persisted with Phouch\Phouch::save(). The Phouch Entity Objects can accept an array in their constructor to set properties for that entity.

```php

$phouch->save(new Phouch\Database(array("name" => "songs")));

```
Equally, a full range of setters will be available to the object for integration with complex business logic in an elegant fashion.

```php

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
