<?php

namespace App\Models\MongoDb;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'products';

    protected $guarded = [];

    public $timestamps = false;
}
