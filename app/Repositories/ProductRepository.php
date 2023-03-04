<?php

namespace App\Repositories;

use App\Models\MongoDb\Product;
use App\Repositories\Interfaces\ProductInterface;

class ProductRepository implements ProductInterface
{
    /**
     * @var Product
     */
    protected $model;

    /**
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findAll($filters)
    {
        $query = $this->model->newQuery();

        $scopeMapping = Product::SCOPE_QUERY_MAPPING;
        foreach ($filters as $filter => $value) {
            if (array_key_exists($filter,$scopeMapping)) {
                $mapping = $scopeMapping[$filter];

                if ($mapping['is_multiple'] || gettype($value) == 'string'){
                    $query->{$mapping['scope']}($mapping['field'],$value);
                }else{
                    $query->{$mapping['scope']}($mapping['field'],$value[0]);
                }
            }
        }
        return $query->paginate(10);
    }
}
