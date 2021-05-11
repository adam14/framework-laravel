<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Exception;
use DB;

use App\Entities\CategoryProducts;

class CategoryProductsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $offset = $request->offset ?? 0;
            $limit = $request->limit ?? 25;
            $product_id = $request->product_id ?? '';
            $category_id = $request->category_id ?? '';
            
            $data = CategoryProducts::with(['products', 'categories'])
                    ->when(
                        $product_id != '',
                        function ($q) use ($product_id) {
                            return $q->where(['product_id' => $product_id]);
                        }
                    )
                    ->when(
                        $category_id != '',
                        function ($q) use ($category_id) {
                            return $q->where(['category_id' => $category_id]);
                        }
                    )
                    ->offset($offset)
                    ->limit($limit)
                    ->get();

            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => 'success'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function detail($id)
    {
        try {
            if (!$id || !is_numeric($id)) {
                throw new Exception('ID not found.');
            }

            $category_products = CategoryProducts::find($id);

            if (!$category_products) {
                throw new Exception('Data not found.');
            }

            return response()->json([
                'status' => true,
                'data' => $category_products
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function add(Request $request)
    {
        DB::beginTransaction();
        try {
            $product_id = $request->product_id;
            $category_id = $request->category_id;

            if (!$product_id || !$category_id || !is_numeric($product_id) || !is_numeric($category_id)) {
                throw new Exception('Field empty, try again.');
            }

            $category_products = new CategoryProducts;
            $category_products->product_id = $product_id;
            $category_products->category_id = $category_id;
            $category_products->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'data' => $category_products,
                'message' => 'successfully added.'
            ], 201);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function edit($id, Request $request)
    {
        DB::beginTransaction();
        try {
            if (!$id || !is_numeric($id)) {
                throw new Exception('ID not found.');
            }

            $category_products = CategoryProducts::find($id);

            if (!$category_products) {
                throw new Exception('Data not found.');
            }

            $product_id = $request->product_id;
            $category_id = $request->category_id;

            if (!$product_id || !$category_id || !is_numeric($product_id) || !is_numeric($category_id)) {
                throw new Exception('Field empty, try again.');
            }

            $category_products->product_id = $product_id;
            $category_products->category_id = $category_id;
            $category_products->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'data' => $category_products,
                'message' => 'successfully updated'
            ], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function delete($id, Request $request)
    {
        DB::beginTransaction();
        try {
            if (!$id || !is_numeric($id)) {
                throw new Exception('ID not found.');
            }

            $category_products = CategoryProducts::find($id);
            $category_products->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'ID '.$id.' successfully deleted.'
            ], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}