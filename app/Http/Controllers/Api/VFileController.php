<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VFileService;
use App\Models\VFile;
use Validator;
use DB;
use Log;

class VFileController extends Controller
{

    protected $vFileService;

    public function __construct(
        VFileService $vFileService
    )
    {
        $this->vFileService = $vFileService;
    }

    public function imageUpload(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'model_id' => 'required',
                'model_name' => 'required',
                'field_name' => 'required',
                'image' => 'required|max:5120',
                'size' => 'max:1024'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 500);
            }

            $modelId = $request->model_id;
            $modelName = $request->model_name;
            $fieldName = $request->field_name;
            $imageFile = $request->file('image');
            $size = $request->size ?? 500;

            $modelService = app()->make('App\Services\\' . $modelName . 'Service');
            $model = $modelService->find($modelId);

            if($model === null) {
                return response()->json([
                    'status' => 'fail',
                    'data' => 'model not found'
                ], 500);
            }

            // create v file record
            $vFile = new VFile([
                'model_id' => $modelId,
                'model_name' => $modelName,
                'field_name' => $fieldName,
                'file_type' => VFile::FILE_IMAGE,
                'file_path' => 'no path'
            ]);

            $path = $this->vFileService->createImage($vFile, $imageFile, $size);

            DB::commit();

            return response()->json([
                'status' => 'succ',
                'data' => [
                    'path' => url('/') . $path
                ]
            ], 200);

        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error($th->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);
        }

    }
}
