<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return ResponseFormatter::success($products);
    }

    public function fetchData(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $category_id = $request->input('category_id');
        $description = $request->input('description');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');
        $limit = $request->input('limit', 6);

        if($id)
        {
            $products = Product::with('category')->where('id', $id)->get();

            if($products->count() > 0)
            {
                return ResponseFormatter::success($products);
            }
            else
            {
                return ResponseFormatter::error('Product not found', 404);
            }
        }

        $products::with('category');

        if($name)
        {
            $products = $products->where('name', 'LIKE', '%'.$name.'%');
        }

        if($category_id)
        {
            $products = $products->where('category_id', $category_id);
        }

        if($description)
        {
            $products = $products->where('description', 'LIKE', '%'.$description.'%');
        }

        if($price_from)
        {
            $products = $products->where('price', '>=', $price_from);
        }

        if($price_to)
        {
            $products = $products->where('price', '<=', $price_to);
        }

        return ResponseFormatter::success($products->paginate($limit), 'Products fetched successfully');
    }
}
