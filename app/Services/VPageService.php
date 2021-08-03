<?php

namespace App\Services;

use App\Repositories\VPageRepository;
use App\Models\VPage;

class VPageService extends BaseService
{
    protected $vPageRepository;

    public function __construct(
        VPageRepository $vPageRepository
    )
    {
        parent::__construct($vPageRepository);
        $this->vPageRepository = $vPageRepository;
    }

    public function store(VPage $vPage)
    {
        return $this->vPageRepository->create($vPage);
    }

    public function getAvailablePageByUserId($userId)
    {
        return $this->vPageRepository->getAvailablePageByUserId($userId);
    }


    public function checkPagePermission($pageId, $userId)
    {
        $vPage = $this->find($pageId);
        if($vPage->user_id !== $userId) {
            abort(401);
        }
    }

    public function updateLayoutCodeByPageId(string $pageId, string $layoutCode)
    {
        return $this->vPageRepository->update($pageId, [
            'layout_code' => $layoutCode
        ]);
    }

    public function getPageByPageUrl(string $url)
    {
        return $this->vPageRepository->findBy('page_url', $url);
    }

    public function updateCustomDataByPageId(string $pageId, string $customData)
    {
        return $this->vPageRepository->update($pageId, [
            'custom_data' => $customData
        ]);
    }

    public function findByPageIdWithUser(string $pageId)
    {
        return $this->vPageRepository->findByPageIdWithUser($pageId);
    }

    public function findAvailablePageByPageIdWithUser(string $pageId)
    {
        return $this->vPageRepository->findAvailablePageByPageIdWithUser($pageId);
    }

    public function disableAllPageByUserId(string $userId)
    {
        return $this->vPageRepository->disableAllPageByUserId($userId);
    }

    public function enableAllPageByUserId(string $userId)
    {
        return $this->vPageRepository->enableAllPageByUserId($userId);
    }
}
