<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Exception;
use DB;
use Storage;

use App\Entities\Images;

class ImagesController extends Controller
{
    public function index(Request $request)
    {
        try {
            $offset = $request->offset ?? 0;
            $limit = $request->limit ?? 25;
            
            $data = Images::offset($offset)
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

            $images = Images::find($id);

            if (!$images) {
                throw new Exception('Data not found.');
            }

            return response()->json([
                'status' => true,
                'data' => $images
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
            $file = $request->file('file_image');
            $enable = $request->enable;

            if (!$name || !$file || !$enable || !is_numeric($enable)) {
                throw new Exception('Field empty, try again.');
            }

            $storage = Storage::disk('public')->put('images', $file);

            $images = new Images;
            $images->name = $name;
            $images->file = $storage;
            $images->enable = $enable;
            $images->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'data' => $images,
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

            $images = Images::find($id);

            if (!$images) {
                throw new Exception('Data not found.');
            }
            
            $name = $request->name;
            $file = $request->file('file_image');
            $enable = $request->enable;

            if (!$name || !$file || !$enable || !is_numeric($enable)) {
                throw new Exception('Field empty, try again.');
            }

            unlink(public_path() . '/uploads/' . $images->file);

            $storage = Storage::disk('public')->put('images', $file);

            $images->name = $name;
            $images->file = $storage = Storage::disk('public')->put('images', $file);
            $images->enable = $enable;
            $images->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'data' => $images,
                'message' => 'successfully edited.'
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

            $images = Images::find($id);

            if (!$images) {
                throw new Exception('Data not found.');
            }

            unlink(public_path() . '/uploads/' . $images->file);

            $images->delete();

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