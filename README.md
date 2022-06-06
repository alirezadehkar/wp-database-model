# WP Database Model

If you are a wordpress developer 😍:

You can use this database model for your wordpress projects, using wordpress database makes your job a little easier.

Sample usage:

```php

use ADHK\WP\Database_Model;

class DB_Requests extends Database_Model
{
    public static $table = 'requests';
}

# Example
$requests = DB_Requests::getResults(); // return all rows from 'requests' table
$request = DB_Requests::get(['id' => 1]); // return a row with params
$insert = DB_Requests::insert(['name' => 'Alireza', 'family' => 'Dehkar']); // insert data to 'requests' table
$delete = DB_Requests::delete(['id' => 1]); // delete data with params from 'requests' table
$count = DB_Requests::count(); // get all rows count
$countBy = DB_Requests::countBy(['user_id' => 1]); get rows coutn with params

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
