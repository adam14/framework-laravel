<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Exception;
use DB;

use App\Entities\Categories;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        try {
            $offset = $request->offset ?? 0;
            $limit = $request->limit ?? 25;
            
            $data = Categories::offset($offset)->limit($limit)->get();

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

    public function add(Request $request)
    {
        DB::beginTransaction();
        try {
            $name = $request->name;
            $enable = $request->enable;

            $categories = new Categories;
            $categories->name = $name;
            $categories->enable = $enable;
            $categories->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'data' => $categories,
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

            $categories = Categories::find($id);

            if (!$categories) {
                throw new Exception('Data not found.');
            }

            $name = $request->name;
            $enable = $request->enable;

            $categories->name = $name;
            $categories->enable = $enable;
            $categories->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'data' => $categories,
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

            $categories = Categories::find($id);
            $categories->delete();

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