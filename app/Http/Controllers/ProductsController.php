<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of products owned by the authenticated user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $userId = Auth::user()->id;
        $products = Product::where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->paginate(5)
            ->toArray();

        $response = [
            'total_count' => $products['total'],
            'limit' => $products['per_page'],
            'pagination' => [
                'next_page' => $products['next_page_url'],
                'current_page' => $products['current_page']
            ],
            'data' => $products['data'],
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created product.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $validationRules = [
            'name' => 'required|min:3',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ];

        $validator = Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $product = Product::create($input);

        return response()->json($product, 201);
    }

    /**
     * Display the specified product.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $product = Product::where('user_id', $userId)->where('id', $id)->first();

        if (!$product) {
            abort(404);
        }

        return response()->json($product, 200);
    }

    /**
     * Update the specified product.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $product = Product::where('user_id', $userId)->where('id', $id)->first();

        if (!$product) {
            abort(404);
        }

        $input = $request->all();

        $validationRules = [
            'name' => 'sometimes|required|min:3',
            'category' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0'
        ];

        $validator = Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $product->fill($input);
        $product->save();

        return response()->json($product, 200);
    }

    /**
     * Remove the specified product.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $userId = Auth::user()->id;
        $product = Product::where('user_id', $userId)->where('id', $id)->first();

        if (!$product) {
            abort(404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
            'product_id' => $id
        ], 200);
    }
}
