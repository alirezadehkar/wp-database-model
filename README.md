# WP Database Model

If you are a wordpress developer 😍:

You can use this database model for your wordpress projects, using wordpress database makes your job a little easier.

## Installation

The supported way of installing WP Database Model package is via Composer.

```bash
composer require alirezadehkar/wp-database-model
```

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

$user = $users->get(['id' => 1]); // return a row with params

$insert = $users->insert(['display_name' => 'Alireza Dehkar', 'user_nicename' => 'admin']); // insert data to 'users' table

$update = $users->update(['display_name' => 'Alireza'], ['id' => 1]); // $data, $where

$delete = $users->delete(['id' => 1]); // delete data with params from 'users' table

$count = $users->count(); // get all rows count

$countBy = $users->countBy(['user_status' => 1]); // get rows count with params

# Methods "getResults,count" supports parameters (per_page, offset, order, order_by, fields)

$byParams = $users->getResults([
  'per_page' => 20,
  'offset' => 0,
  'order' => 'DESC',
  'order_by' => 'user_registered',
  'fields' => [
    [
      'key' => 'user_status',
      'value' => 1
    ],
    [
      'key' => 'display_name',
      'value' => '%Alireza%',
      'compare' => 'LIKE'
    ]
  ]
]);
```

## License

license. Please see the [license file](LICENCE) for more information.

[![Latest Stable Version](https://poser.pugx.org/alirezadehkar/wp-database-model/v/stable)](https://packagist.org/packages/alirezadehkar/wp-database-model)
[![Total Downloads](https://poser.pugx.org/alirezadehkar/wp-database-model/downloads)](https://packagist.org/packages/alirezadehkar/wp-database-model)
[![License](https://poser.pugx.org/alirezadehkar/wp-database-model/license)](https://packagist.org/packages/alirezadehkar/wp-database-model)
