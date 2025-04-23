<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\AdService;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Tests\TestCase;

class AdTest extends TestCase
{
    /** @var AdService|LegacyMockInterface|MockInterface */
    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = \Mockery::mock(AdService::class)->makePartial();
    }

    public function test_create_ad()
    {
        $this->service->shouldReceive('getUserId')->andReturn(1);
        $title = 'title';
        $description = 'description';

        $ad = $this->service->create(compact('title', 'description'));

        $this->assertNotNull($ad);
        $this->assertDatabaseHas('ads', ['id' => $ad->id, 'title' => $title, 'description' => $description]);
    }

    public function test_update_ad()
    {
        $this->service->shouldReceive('getUserId')->andReturn(1);
        $title = 'title';
        $description = 'description';

        $ad = $this->service->create(compact('title', 'description'));

        $this->assertNotNull($ad);
        $this->assertDatabaseHas('ads', ['id' => $ad->id, 'title' => $title, 'description' => $description]);

        $newTitle = 'newTitle';

        $result = $this->service->update($ad, ['title' => $newTitle]);
        $this->assertTrue($result);
        $this->assertDatabaseHas('ads', ['id' => $ad->id, 'title' => $newTitle, 'description' => $description]);
    }

    public function test_delete_ad()
    {
        $this->service->shouldReceive('getUserId')->andReturn(1);
        $title = 'title';
        $description = 'description';

        $ad = $this->service->create(compact('title', 'description'));

        $this->assertNotNull($ad);
        $this->assertDatabaseHas('ads', ['id' => $ad->id, 'title' => $title, 'description' => $description]);

        $result = $this->service->delete($ad);
        $this->assertTrue($result);
        $this->assertDatabaseMissing('ads', ['id' => $ad->id]);
    }
}
