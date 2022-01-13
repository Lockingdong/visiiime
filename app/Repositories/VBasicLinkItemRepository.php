<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\VBasicLinkItem;
use Carbon\Carbon;
use Batch;

class VBasicLinkItemRepository extends BaseRepository
{
    protected $vBasiVBasicLinkItem;

    public function __construct(VBasicLinkItem $vBasiVBasicLinkItem)
    {
        parent::__construct($vBasiVBasicLinkItem);
        $this->vBasiVBasicLinkItem = $vBasiVBasicLinkItem;
    }

    public function getAvailableLinksByPageId($pageId)
    {
        return $this->vBasiVBasicLinkItem
            ->where('page_id', $pageId)
            ->where('link_status', VBasicLinkItem::AVAILABLE)
            ->orderBy('link_order', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getAvailableOnlineLinksByPageId($pageId)
    {
        $now = Carbon::now();
        return $this->vBasiVBasicLinkItem
            ->where('page_id', $pageId)
            ->where('link_status', VBasicLinkItem::AVAILABLE)
            ->where(function($q) use ($now) {
                return $q->where('start_at', '<', $now)
                        ->where('end_at', '>', $now);
            })
            ->orWhere(function($q) {
                return $q->where('start_at', null)
                        ->orWhere('end_at', null);
            })
            ->where('online', true)
            ->orderBy('link_order', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function updateOrCreate(array $key, array $data)
    {
        return $this->vBasiVBasicLinkItem->updateOrCreate($key, $data);
    }

    public function multiDeleteById(array $ids)
    {
        return $this->vBasiVBasicLinkItem->whereIn('id', $ids)->delete();
    }

    public function linkItemsOrderUpdate(VBasicLinkItem $model, array $dataset, string $pk)
    {
        return Batch::update($model, $dataset, $pk);
    }
}
