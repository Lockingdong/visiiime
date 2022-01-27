<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\VPageRepository;
use App\Repositories\VPageDelRepository;
use App\Models\VPage;
use App\Models\VPageDel;

class VPageService extends BaseService
{
    protected $vPageRepository;
    protected $vPageDelRepository;

    public function __construct(
        VPageRepository $vPageRepository,
        VPageDelRepository $vPageDelRepository
    )
    {
        parent::__construct($vPageRepository);
        $this->vPageRepository = $vPageRepository;
        $this->vPageDelRepository = $vPageDelRepository;
    }

    public function store(VPage $vPage)
    {
        return $this->vPageRepository->create($vPage);
    }

    public function getAvailablePageByUserId($userId)
    {
        return $this->vPageRepository->getAvailablePageByUserId($userId);
    }

    public function checkPageViewableByVPage(VPage $vPage): void
    {
        
        $this->checkPageAvailableByVPage($vPage);

        if($vPage->online === VPage::PAGE_OFFLINE) {
            throw new \Exception($vPage->id . ' v page is offline');
        }
    }

    public function checkPageAvailableByVPage(VPage $vPage): void
    {
        if(in_array($vPage->page_status, [VPage::DISABLED, VPage::DELETED])) {
            throw new \Exception($vPage->id . ' v page is disabled or deleted');
        }

        if(in_array($vPage->user->user_status, [User::DELE, User::DISA])) {
            throw new \Exception("v page's user is deleted or disabled");
        }
    }

    public function checkPagePermissionByVPage(VPage $vPage, User $user): void
    {
        if($vPage->user_id !== $user->id) {
            throw new \Exception($vPage->id . ' v page permission deny');
        }
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

    public function createPage(string $uri)
    {

        $vPage = new VPage();
        $vPage->user_id = auth()->id();
        $vPage->page_url = $uri;
        $vPage->user_title = $uri;
        $vPage->description = '我的簡介';
        $vPage->avatar = url('/VBasic/avatar-icon.png');
        $vPage->page_status = VPage::AVAILABLE;
        $vPage->online = VPage::PAGE_OFFLINE;
        $vPage->theme_id = 'VBasic';
        $vPage->page_default = $this->checkUserHasPage($vPage->user_id) ? VPage::PAGE_DEFAULT_N : VPage::PAGE_DEFAULT_Y;
        $vPage->layout_code = 'visiiime';
        $vPage->custom_data = '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgGradient","bgImage":"","bgColor":"#b5abf2","bgColor2":"#495ce9"},"linkButton":{"buttonName":"","buttonBorder":"md-border","buttonRadius":"sm-bdrs","buttonBgColor":"transparent","buttonTextColor":"#ffffff"},"text":{"textColor":"#212121"},"support":{"display":true}}';

        return $this->vPageRepository->create($vPage);
    }

    public function checkUserHasPage(string $userId): bool
    {
        return $this->vPageRepository->getAvailablePageByUserId($userId)->count() !== 0;
    }

    public function deleteVPageByPageId(string $pageId): bool 
    {
        $vPage = $this->find($pageId);
        $vPageArr = $vPage->toArray();
        $vPageDel = new VPageDel($vPageArr);
        $this->vPageDelRepository->create($vPageDel);

        return $this->vPageRepository->destroy($pageId);
    }

    public function updateAnalystic(string $pageId, array $data): bool
    {
        return $this->vPageRepository->update(
            $pageId, 
            [ 
                'meta' => json_encode($data)
            ]
        );
    }

    public function getPageUrlBlackList(): array
    {
        return [
            'admin',
            'css',
            'dashboard',
            'images',
            'js',
            'VBasic',
            'visiiime-design-dashboard',
            '.htaccess',
            'favicon.ico',
            'index.php',
            'index',
            'mix-manifest.json',
            'robots.txt',
            'web.config',
            // route collect(\Route::getRoutes())->map(function ($route) { return $route->uri(); })
            'sanctum/csrf-cookie',
            'ecpay/notify',
            'ecpay/return',
            'api/user',
            'api/v1/redirect-dashboard',
            'api/v1/user/logout',
            'api/v1/user/verify-email',
            'api/v1/v-page/test/{pageId}',
            'api/v1/v-page/page-create',
            'api/v1/v-page/profile-update',
            'api/v1/v-page/social-links-update',
            'api/v1/v-page/update-page-data',
            'api/v1/v-page/ori/{pageId}',
            'api/v1/v-page/layout-update',
            'api/v1/v-page/custom-data-update',
            'api/v1/v-page/page-uri-update',
            'api/v1/v-page/page-analystic-update',
            'api/v1/v-page/page-seo-update',
            'api/v1/v-page/page-online-update',
            'api/v1/v-page/page-status-update',
            'api/v1/v-page/page-delete',
            'api/v1/v-file/image-upload',
            'api/v1/v-file/image-upload-admin',
            'api/v1/v-basic-link-item/link-item-create',
            'api/v1/v-basic-link-item/link-item-delete',
            'api/v1/v-basic-link-item/link-item-update',
            'api/v1/v-basic-link-item/link-item-content-update',
            'api/v1/v-basic-link-item/link-items-order-update',
            'api/v1/v-basic-link-item/link-item-start-end-time-update',
            'api/v1/v-basic-link-item/link-item-display-update',
            'api/v1/v-basic-link-item/link-item-pwd-update',
            'api/v1/v-basic-link-item/link-items-update',
            'api/v1/v-layouts/{themeName}',
            'api/v1/v-sub-records/{mer_order_no}',
            'api/v1/v-event-track/event-create',
            'api/v1/v-event-track/event-get',
            'api/v1/v-event-track/get-week-data',
            'api/v1/v-basic-link-item/link-item-check-pwd-correct',
            'api/v1/v-subscription/period/callback',
            'api/v1/v-layouts/create',
            '/',
            'v-page/design',
            'v-page/list',
            'v-page/url',
            'v-page/confirm-url-and-store',
            'v-page/theme-select/{pageId}',
            'v-page/theme-confirm/{pageId}',
            'v-dashboard',
            'v-dashboard/user-setting',
            'v-dashboard/user-subscription-record',
            'v-dashboard/v-page/create',
            'v-dashboard/v-page/store',
            'v-dashboard/v-page/{page_id}/edit',
            'v-dashboard/v-page/{page_id}/update',
            'theme/VBasic',
            'test',
            'auth/redirect/{provider}',
            'callback/{provider}',
            'register',
            'register',
            'login',
            'login',
            'forgot-password',
            'forgot-password',
            'reset-password/{token}',
            'reset-password',
            'verify-email',
            'verify-email/{id}/{hash}',
            'email/verification-notification',
            'confirm-password',
            'confirm-password',
            'logout',
            'memory-leak',
            'about',
            'privacy',
            'terms',
            'contact',
            'pricing',
            'select-plan',
            'help/{cate_id}',
            'help',
            'blog',
            'blog/{id}',
            'v-subscription/period/pay-subscription',
            'v-subscription/period/terminate-subscription',
            '{pageUrl}',
            'v-admin/dashboard',
            'v-admin/v-page/list',
            'v-admin/v-page/{page_id}',
            'v-admin/v-page/{page_id}/update',
            'v-admin/user/list',
            'v-admin/user/{user_id}',
            'v-admin/user/{user_id}/update',
            'v-admin/v-post/list',
            'v-admin/v-post/create',
            'v-admin/v-post/store',
            'v-admin/v-post/{post_id}/edit',
            'v-admin/v-post/{post_id}/update',
            'v-admin/v-category/list',
            'v-admin/v-category/create',
            'v-admin/v-category/store',
            'v-admin/v-category/{cate_id}/edit',
            'v-admin/v-category/{cate_id}/update',
            'v-admin/v-layout/list',
            'v-admin/v-layout/create',
            'v-admin/v-layout/store',
            'v-admin/v-layout/{layout_id}/edit',
            'v-admin/v-layout/{layout_id}/update',
            'v-admin/v-file/list',
            'v-admin/v-file/{file_id}/destroy',
            'v-admin/v-faq/list',
            'v-admin/v-faq/create',
            'v-admin/v-faq/store',
            'v-admin/v-faq/{post_id}/edit',
            'v-admin/v-faq/{post_id}/update',
        ];
    }
}
