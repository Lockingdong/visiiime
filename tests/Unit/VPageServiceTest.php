<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\VFile;
use App\Models\VPage;
use App\Services\VPageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class VPageServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    private $vPageService;

    public function setUp(): void
    {
        parent::setUp();
        $this->vPageService = app(VPageService::class);
    }

    public function test_create_page()
    {
        $fakeUrl = '/fakeUrl';
        $user = User::factory()->create();
        $this->be($user);
        $this->vPageService->createPage($fakeUrl);

        $this->assertEquals(1, VPage::all()->count());

        $this->assertDatabaseHas('v_pages', [
            'user_id' => $user->id,
            'page_url' => $fakeUrl,
            'page_status' => VPage::AVAILABLE,
            'page_default' => VPage::PAGE_DEFAULT_Y,
            'theme_id' => 'VBasic',
            'online' => (int) false
        ]);
    }
}
