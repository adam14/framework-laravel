<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Exception;
use DB;

use App\Entities\Products;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $offset = $request->offset ?? 0;
            $limit = $request->limit ?? 25;
            
            $data = Products::offset($offset)->limit($limit)->get();

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

            $products = Products::find($id);

            if (!$products) {
                throw new Exception('Data not found.');
            }

            return response()->json([
                'status' => true,
                'data' => $products
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
            $name = $request->name;
            $description = $request->description;
            $enable = $request->enable;

            if (empty($name) || empty($enable) || empty($description)) {
                throw new Exception('Field empty, try again.');
            }

            $products = new products;
            $products->name = $name;
            $products->description = $description;
            $products->enable = $enable;
            $products->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'data' => $products,
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

            $products = Products::find($id);

            if (!$products) {
                throw new Exception('Data not found.');
            }

            $name = $request->name;
            $description = $request->description;
            $enable = $request->enable;

            if (empty($name) || empty($enable) || empty($description)) {
                throw new Exception('Field empty, try again.');
            }

            $products->name = $name;
            $products->description = $description;
            $products->enable = $enable;
            $products->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'data' => $products,
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

            $products = Products::find($id);
            $products->delete();

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