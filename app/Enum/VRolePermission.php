<?php

namespace App\Enum;

use App\Models\VBasicLinkItem;

class VRolePermission {

    const VIP = 'VIP';
    const VVIP = 'VVIP';

    const VIP_DISPLAY_NAME = '一般會員';
    const VVIP_DISPLAY_NAME = '高級會員';

    const CAN_USE_LINK_ITEM_NORMAL = 'can_use_link_item_normal';
    const CAN_USE_LINK_ITEM_MAIN = 'can_use_link_item_main';
    const CAN_USE_LINK_ITEM_MEDIA = 'can_use_link_item_media';
    const CAN_USE_LINK_ITEM_COLLECTOR = 'can_use_link_item_collector';

    const CAN_USE_LINK_ITEM_DBOARD_IMAGE = 'can_use_link_item_dboard_image';
    const CAN_USE_LINK_ITEM_DBOARD_DISPLAY = 'can_use_link_item_dboard_display';
    const CAN_USE_LINK_ITEM_DBOARD_SCHEDULE = 'can_use_link_item_dboard_schedule';
    const CAN_USE_LINK_ITEM_DBOARD_STAR = 'can_use_link_item_dboard_star';
    const CAN_USE_LINK_ITEM_DBOARD_PWD = 'can_use_link_item_dboard_pwd';
    const CAN_USE_LINK_ITEM_DBOARD_CHART = 'can_use_link_item_dboard_chart';

    const CAN_USE_LAYOUT_CUSTOM_DATA = 'can_use_layout_custom_data';

    const CAN_USE_LINK_ITEM_COUNT = 'can_use_link_item_count';

    // const VP
    const V_PERMISSIONS = [
        self::CAN_USE_LINK_ITEM_NORMAL,
        self::CAN_USE_LINK_ITEM_MAIN,
        self::CAN_USE_LINK_ITEM_MEDIA,
        self::CAN_USE_LINK_ITEM_COLLECTOR,
        self::CAN_USE_LINK_ITEM_DBOARD_IMAGE,
        self::CAN_USE_LINK_ITEM_DBOARD_SCHEDULE,
        self::CAN_USE_LINK_ITEM_DBOARD_STAR,
        self::CAN_USE_LINK_ITEM_DBOARD_CHART,
        self::CAN_USE_LAYOUT_CUSTOM_DATA,
    ];

    const V_ROLE_PERMISSIONS = [
        self::VIP => [
            self::CAN_USE_LINK_ITEM_DBOARD_IMAGE => [],
            self::CAN_USE_LINK_ITEM_NORMAL => [],
            self::CAN_USE_LINK_ITEM_DBOARD_STAR => [],
            self::CAN_USE_LINK_ITEM_DBOARD_PWD => [],
            self::CAN_USE_LINK_ITEM_MAIN => [],
            self::CAN_USE_LINK_ITEM_COUNT => [
                VBasicLinkItem::LINK_AREA_MAIN => 3,
                VBasicLinkItem::LINK_AREA_NORMAL => 10,
                VBasicLinkItem::LINK_AREA_SOCIAL => 3
            ],
        ],
        self::VVIP => [
            self::CAN_USE_LINK_ITEM_NORMAL => [],
            self::CAN_USE_LINK_ITEM_MAIN => [],
            self::CAN_USE_LINK_ITEM_MEDIA => [],
            self::CAN_USE_LINK_ITEM_COLLECTOR => [],
            self::CAN_USE_LINK_ITEM_DBOARD_IMAGE => [],
            self::CAN_USE_LINK_ITEM_DBOARD_DISPLAY => [],
            self::CAN_USE_LINK_ITEM_DBOARD_SCHEDULE => [],
            self::CAN_USE_LINK_ITEM_DBOARD_STAR => [],
            self::CAN_USE_LINK_ITEM_DBOARD_PWD => [],
            self::CAN_USE_LINK_ITEM_DBOARD_CHART => [],
            self::CAN_USE_LAYOUT_CUSTOM_DATA => [],
            self::CAN_USE_LINK_ITEM_COUNT => [
                VBasicLinkItem::LINK_AREA_MAIN => 6,
                VBasicLinkItem::LINK_AREA_NORMAL => 20,
                VBasicLinkItem::LINK_AREA_SOCIAL => 10
            ],
        ]
    ];
}
