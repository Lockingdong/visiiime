<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VPage extends Model
{
    use HasFactory;
    use Uuids;

    // page_status
    const AVAILABLE = 'AVAL';
    const UNCOMPLETED = 'UNCO';
    const DISABLED = 'DISA';

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
    ];


    public function getCustomData()
    {
        if($this->custom_data === null) {
            return [
                'background' => [
                    'customBgOn' => false,
                    'bgType' => '',
                    'bgName' => '',
                    'bgContent' => '',
                    'bgColor' => ''
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
}
