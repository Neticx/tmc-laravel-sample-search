<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProductInterface;
use App\Traits\QueryParamsTrait;
use App\Transformers\SearchTransformer;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use QueryParamsTrait;
    public function exec(Request $request, ProductInterface $product)
    {
        $arrFilter = self::splitMultipleParam($request->server->get('QUERY_STRING'));
        $data = $product->findAll($arrFilter);

        return response()->json([
            'data' => $data->items(),
            'paging' => [
                'size' => $data->perPage(),
                'total' => $data->lastPage(),
                'current' => $data->currentPage()
            ]
        ]);
    }
}
