<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\VFileRepository;
use App\Services\VFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class VFileController extends Controller
{
    protected $vFile;
    protected $vFileService;
    protected $vFileRepository;

    public function __construct(
        VFileService    $vFileService,
        VFileRepository $vFileRepository
    )
    {
        $this->vFileService = $vFileService;
        $this->vFileRepository = $vFileRepository;
    }

    public function list(Request $request)
    {
        $vFiles = !empty($request->search) ?
            $this->vFileService->searchPaginatedFiles($request->search, 20) :
            $this->vFileService->getAllPaginatedFiles(20);

        return view('components.admin.vFile.list', compact('vFiles'));
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->vFileService->deleteImageVFile($request->file_id);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withErrors('發生了錯誤');
        }

        return redirect()->route('admin.vFile.list')->with('success', '刪除成功');
    }
}
