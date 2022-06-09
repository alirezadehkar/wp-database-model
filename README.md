# WP Database Model

If you are a wordpress developer 😍:

You can use this database model for your wordpress projects, using wordpress database makes your job a little easier.

Sample usage:

Sample 1/

```php
use AlirezaDehkar\WPDBModel\Database;

class DB_Users extends Database
{
    protected static $table = 'users';
}

$users = new DB_Users();
```

Sample 2/

```php
use AlirezaDehkar\WPDBModel\Database as DB;

$users = new DB('users');
```

Methods

```php

# Usage Methods

$all = $users->getResults(); // return all rows from 'users' table

$request = $users->get(['id' => 1]); // return a row with params

$insert = $users->insert(['name' => 'Alireza', 'family' => 'Dehkar']); // insert data to 'requests' table

$update = $users->update(['name' => 'Alireza'], ['id' => 1]); // $data, $where

$delete = $users->delete(['id' => 1]); // delete data with params from 'requests' table

$count = $users->count(); // get all rows count

$countBy = $users->countBy(['user_id' => 1]); // get rows coutn with params

# Methods "getResults,count" supports parameters (per_page, offset, order, order_by, fields)

$byParams = $users->getResults([
  'per_page' => 10,
  'offset' => 0,
  'order' => 'DESC',
  'order_by' => 'created_at',
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
