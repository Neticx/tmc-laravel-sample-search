<?php

namespace App\Models\MongoDb;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    const SCOPE_QUERY_MAPPING = [
       'name' => [
           'scope' => 'likeBy',
           'field' => 'name',
           'is_multiple' => true
       ],
       'sku' => [
           'scope' => 'likeBy',
           'field' => 'name',
           'is_multiple' => true
       ],
       'category.name' => [
           'scope' => 'likeBy',
           'field' => 'category.name',
           'is_multiple' => true
       ],
       'category.id' => [
           'scope' => 'likeBy',
           'field' => 'category.id',
           'is_multiple' => true
       ],
        'price.start' => [
            'scope' => 'greaterThan',
            'field' => 'price',
            'is_multiple' => false
        ],
        'price.end' => [
            'scope' => 'lessThan',
            'field' => 'price',
            'is_multiple' => false
        ],
        'stock.start' => [
            'scope' => 'greaterThan',
            'field' => 'stock',
            'is_multiple' => false
        ],
        'stock.end' => [
            'scope' => 'lessThan',
            'field' => 'stock',
            'is_multiple' => false
        ],
    ];
    protected $connection = 'mongodb';

    protected $table = 'products';

    protected $guarded = [];

    public $timestamps = false;
    public function scopeLikeBy($query, $column, $value)
    {
        $typeData = gettype($value);
        if ($typeData == 'string') {
            return $query->where($column, 'LIKE',"%{$value}%");
        }else if ($typeData == 'array' && !empty($value)) {
            if (count($value) > 1) {
                $iteration = 1;
                foreach ($value as $item) {
                    if ($iteration === 1) {
                        $query->where($column, 'LIKE',"%{$item}%");
                    }else{
                        $query->orWhere($column, 'LIKE',"%{$item}%");
                    }
                    $iteration++;
                }
            }else{
                return $query->where($column, 'LIKE',"%{$value[0]}%");
            }
        }
    }
    public function scopeGreaterThan($query, $column, $value)
    {
        return $query->where($column,'>=', (int)$value);
    }
    public function scopeLessThan($query, $column, $value)
    {
        return $query->where($column,'<=', (int)$value);
    }
}
