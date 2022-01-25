<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Traits\Uuids;
use stdClass;

class VPage extends Model
{
    use HasFactory;
    use Uuids;

    // page_status
    const AVAILABLE = 'AVAL'; // 可使用
    const DISABLED = 'DISA'; // 不可使用
    const UNCOMPLETED = 'UNCO';
    const DELETED = 'DELE'; // 已刪除

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
        'layout_code',
        'custom_data',
        'meta',
        'page_default',
        'online'
    ];


    public function getCustomData()
    {
        if($this->custom_data === null) {
            return [
                'background' => [
                    'customBgOn' => false,
                    'bgType' => '',
                    'bgName' => '',
                    'bgCustomImage' => '',
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
                ],
                'support' => [
                    'display' => true
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
        switch ($this->online) {
            case self::PAGE_ONLINE:
                return '已發布';
                break;

            case self::PAGE_OFFLINE:
                return '關閉中';
                break;

        }
    }

    public function getPageTitle()
    {
        return $this->page_url;
    }

    public function getPageDesc()
    {
        return $this->description;
    }

    public function getMeta()
    {
        if($this->meta === null) {
            $meta = new stdClass;
            $meta->ga_id = null;
            $meta->fb_px = null;
            return $meta;
        }

        return json_decode($this->meta);
    }
}
