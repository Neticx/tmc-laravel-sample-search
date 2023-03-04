<?php

namespace App\Traits;

use App\Constant\GeneralConstant;
use App\Models\MongoDb\Product;

trait QueryParamsTrait
{
    static function splitMultipleParam($queryString):array
    {
        $rawQuery = explode('&',$queryString);
        $collectionRequest = [];
        foreach ($rawQuery as $item) {
            $arrRequest = explode('=', $item);
            if (array_key_exists($arrRequest[0],Product::SCOPE_QUERY_MAPPING)){
                $collectionRequest[$arrRequest[0]][] = $arrRequest[1];
            }
        }

        return $collectionRequest;
    }
}
