<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Exception;
use DB;

use App\Entities\ProductImages;

class ProductImagesController extends Controller
{
    public function index(Request $request)
    {
        try {
            $offset = $request->offset ?? 0;
            $limit = $request->limit ?? 25;
            $product_id = $request->product_id ?? '';
            $image_id = $request->image_id ?? '';
            
            $data = ProductImages::with(['products', 'images'])
                    ->when(
                        $product_id != '',
                        function ($q) use ($product_id) {
                            return $q->where(['product_id' => $product_id]);
                        }
                    )
                    ->when(
                        $images_id != '',
                        function ($q) use ($images_id) {
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

            $product_images = ProductImages::with(['products', 'images'])->find($id);

            if (!$product_images) {
                throw new Exception('Data not found.');
            }

            return response()->json([
                'status' => true,
                'data' => $product_images
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
            $image_id = $request->image_id;

            if (!$product_id || !$image_id || !is_numeric($product_id) || !is_numeric($image_id)) {
                throw new Exception('Field empty, try again.');
            }

            $product_images = new ProductImages;
            $product_images->product_id = $product_id;
            $product_images->image_id = $image_id;
            $product_images->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'data' => $product_images,
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

            $product_images = ProductImages::find($id);

            if (!$product_images) {
                throw new Exception('Data not found.');
            }

            $product_id = $request->product_id;
            $image_id = $request->image_id;

            if (!$product_id || !$image_id || !is_numeric($product_id) || !is_numeric($image_id)) {
                throw new Exception('Field empty, try again.');
            }

            $product_images->product_id = $product_id;
            $product_images->image_id = $image_id;
            $product_images->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'data' => $product_images,
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

            $product_images = ProductImages::find($id);
            $product_images->delete();

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