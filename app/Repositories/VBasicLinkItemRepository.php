<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\VBasicLinkItem;

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
            ->get();
    }
}
