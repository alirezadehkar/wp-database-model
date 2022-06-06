# WP Database Model

If you are a wordpress developer 😍:

You can use this database model for your wordpress projects, using wordpress database makes your job a little easier.

Sample usage:

```php

use ADHK\WP\Database_Model;

class DB_Requests extends Database_Model
{
    protected static $table = 'requests';
}

# Examples

// return all rows from 'requests' table
$requests = DB_Requests::getResults(); 

// return a row with params
$request = DB_Requests::get(['id' => 1]);

// insert data to 'requests' table
$insert = DB_Requests::insert(['name' => 'Alireza', 'family' => 'Dehkar']);

$update = DB_Requests::update(['name' => 'Alireza'], ['id' => 1]); // $data, $where

// delete data with params from 'requests' table
$delete = DB_Requests::delete(['id' => 1]); 

// get all rows count
$count = DB_Requests::count(); 

// get rows coutn with params
$countBy = DB_Requests::countBy(['user_id' => 1]); 

# Methods "getResults,count" supports parameters (per_page, offset, order, order_by, fields)

$byFields = DB_Requests::getResults([
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
