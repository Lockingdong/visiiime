<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\VPageService;
use Validator;
use App\Models\VPage;
use Illuminate\Http\Request;
use Log;

class VPageController extends Controller
{

    protected $vPageService;

    public function __construct(
        VPageService $vPageService
    )
    {
        $this->vPageService = $vPageService;
    }

    public function show($pageId)
    {
        $vPage = $this->vPageService->find($pageId);
        $status = [
            VPage::AVAILABLE,
            VPage::DISABLED,
        ];
        $action = route('admin.vPage.update', $pageId);

        return view('components.admin.vPage.show', compact(
            'vPage',
            'action',
            'status'
        ));
    }

    public function update(Request $request)
    {
        try {
            $pageId = $request->page_id;

            $this->vPageService->update($pageId, [
                'page_status' => $request->status
            ]);

            return redirect()->back()->with('success', 'success');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->with('danger', $th->getMessage());
        }
    }

    public function list(Request $request)
    {
        $pageUrl = $request->page_url;

        if($pageUrl !== null) {
            $vPages = $this->vPageService->paginateBy('page_url', $pageUrl, 12);
        } else {
            $vPages = $this->vPageService->paginate(12);
        }

        return view('components.admin.vPage.list', compact(
            'vPages'
        ));
    }
}
