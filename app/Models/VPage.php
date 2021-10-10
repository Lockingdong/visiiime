<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Traits\Uuids;

class VPage extends Model
{
    use HasFactory;
    use Uuids;

    // page_status
    const AVAILABLE = 'AVAL';
    const UNCOMPLETED = 'UNCO';
    const DISABLED = 'DISA';

    const PAGE_ONLINE = 1;
    const PAGE_OFFLINE = 0;

    const PAGE_DEFAULT_Y = 'Y';
    const PAGE_DEFAULT_N = 'N';

    protected $fillable = [
        'user_id',
        'theme_id',
        'page_status',
        'page_url',
        'avatar',
        'user_title',
        'description',
        'link_item_order',
        'link_item_order_main',
        'social_links',
        'layout_code',
        'custom_data',
        'ga_id',
        'fb_px',
        'seo_title',
        'seo_desc',
        'page_default'
    ];


    public function getCustomData()
    {
        if($this->custom_data === null) {
            return [
                'background' => [
                    'customBgOn' => false,
                    'bgType' => '',
                    'bgName' => '',
                    'bgImage' => '',
                    'bgColor' => '',
                    'bgColor2' => ''
                ],
                'linkButton' => [
                    'buttonName' => '',
                    'buttonBorder' => '',
                    'buttonRadius' => '',
                    'buttonBgColor' => '',
                    'buttonTextColor' => ''
                ],
                'text' => [
                    'textColor' => ''
                ]
            ];
        }
        $customData = json_decode($this->custom_data, true);

        return $customData;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getValidSocialLinks()
    {
        if($this->social_links === null) {
            return [];
        }

        return array_filter(json_decode($this->social_links, true), function($item) {
            return $item['valid'] !== false;
        });
    }

    public function pageStatus()
    {
        switch ($this->page_status) {
            case self::AVAILABLE:
                return '正常';
                break;

            case self::DISABLED:
                return '不可使用';
                break;

        }
    }

    public function pageOnline()
    {
        switch ($this->page_status) {
            case self::PAGE_ONLINE:
                return '已開啟';
                break;

            case self::PAGE_OFFLINE:
                return '關閉中';
                break;

        }
    }
}
