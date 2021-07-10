<?php

namespace App\Services;

use App\Repositories\VBasicLinkItemRepository;
use Arr;
use Log;
use Illuminate\Database\Eloquent\Collection;

class VBasicLinkItemService extends BaseService
{
    protected $vBasicLinkItemRepository;

    public function __construct(
        VBasicLinkItemRepository $vBasicLinkItemRepository
    )
    {
        parent::__construct($vBasicLinkItemRepository);
        $this->vBasicLinkItemRepository = $vBasicLinkItemRepository;
    }


    public function getAvailableLinksByPageId($pageId)
    {
        return $this->vBasicLinkItemRepository->getAvailableLinksByPageId($pageId);
    }


    public function linkItemsOriFormatter(Collection $collection)
    {
        return $collection->map(function($item) {
            return [
                'id' => $item->id,
                'linkType' => $item->link_type,
                'linkName' => $item->link_name,
                'link' => $item->link,
                'thumbnail' => $item->thumbnail,
                'online' => ($item->online === 0) ? false : true,
                'startAt' => $item->start_at,
                'endAt' => $item->end_at,
                'linkCustomData' => json_decode($item->link_custom_data),
                'mediaOpenType' => $item->media_open_type,
                'mediaName' => $item->media_name,
                'collector' => $item->collector
            ];
        });
    }

    public function linkItemsOrderFormatter(array $linkItems, array $order)
    {
        if(count($linkItems) !== count($order)) {
            Log::info("linkItemsOrderFormatter count not equal ". count($linkItems).' '.count($order));
            return $linkItems;
        }

        $collection = collect($linkItems);
        return $collection->sortBy(function($item) use ($order) {
            return array_search($item['id'], $order);
        })->values()->all();
    }
}
