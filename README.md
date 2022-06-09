# WP Database Model

If you are a wordpress developer 😍:

You can use this database model for your wordpress projects, using wordpress database makes your job a little easier.

Sample usage:

Sample 1/

```php
use AlirezaDehkar\WPDBModel\Database;

class DB_Requests extends Database
{
    protected static $table = 'requests';
}

$requests = new DB_Requests();
```

Sample 2/

```php
use AlirezaDehkar\WPDBModel\Database as DB;

$requests = new DB('requests');
```

Methods

```php

# Usage Methods

$requests = $requests->getResults(); // return all rows from 'requests' table

$request = $requests->get(['id' => 1]); // return a row with params

$insert = $requests->insert(['name' => 'Alireza', 'family' => 'Dehkar']); // insert data to 'requests' table

$update = $requests->update(['name' => 'Alireza'], ['id' => 1]); // $data, $where

$delete = $requests->delete(['id' => 1]); // delete data with params from 'requests' table

$count = $requests->count(); // get all rows count

$countBy = $requests->countBy(['user_id' => 1]); // get rows coutn with params

# Methods "getResults,count" supports parameters (per_page, offset, order, order_by, fields)

$byFields = $requests->getResults([
  'fields' => [
    [
      'key' => 'status',
      'value' => 'active'
    ],
    [
      'key' => 'name',
      'value' => '%Alireza%',
      'compare' => 'LIKE'
    ]
  ]
]);
```
