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

    public function getAvailableOnlineLinksByPageId($pageId)
    {
        return $this->vBasicLinkItemRepository->getAvailableOnlineLinksByPageId($pageId);
    }


    public function linkItemsOriTransformer(Collection $collection)
    {
        return $collection->map(function($item) {
            return [
                'id' => $item->id,
                'linkType' => $item->link_type,
                'linkArea' => $item->link_area,
                'linkName' => $item->link_name,
                'link' => $item->link,
                'thumbnail' => $item->thumbnail,
                'online' => ($item->online === 0) ? false : true,
                'startAt' => $item->start_at,
                'endAt' => $item->end_at,
                'linkCustomData' => json_decode($item->link_custom_data),
                'mediaOpenType' => $item->media_open_type,
                'mediaName' => $item->media_name,
                'collector' => json_decode($item->collector),
                'linkImgMode' => $item->link_img_mode,
                'linkColMode' => $item->link_col_mode,
                'valid' => $item->valid
            ];
        });
    }

    public function linkItemsFormatterPage(Collection $collection)
    {

        // todo 時間判斷

        return $collection->map(function($item) {
            return [
                'id' => $item->id,
                'linkType' => $item->link_type,
                'linkArea' => $item->link_area,
                'linkName' => $item->link_name,
                'link' => $item->link,
                'thumbnail' => $item->thumbnail,
                'online' => ($item->online === 0) ? false : true,
                'startAt' => $item->start_at,
                'endAt' => $item->end_at,
                'linkCustomData' => json_decode($item->link_custom_data),
                'mediaOpenType' => $item->media_open_type,
                'mediaName' => $item->media_name,
                'collector' => json_decode($item->collector),
                'valid' => $item->valid
            ];
        })->values()->all();
    }

    public function linkItemsOrderFormatter(array $linkItems, array $order)
    {
        $collection = collect($linkItems);
        if(count($linkItems) !== count($order)) {
            Log::info("linkItemsOrderFormatter count not equal ". count($linkItems).' '.count($order));
            return $collection->values()->all();
        }


        return $collection->sortBy(function($item) use ($order) {
            return array_search($item['id'], $order);
        })->values()->all();
    }

    public function updateOrCreate(array $key, array $data)
    {
        return $this->vBasicLinkItemRepository->updateOrCreate($key, $data);
    }

    public function multiDeleteById(array $ids)
    {
        return $this->vBasicLinkItemRepository->multiDeleteById($ids);
    }
}
